<?php

namespace App\Http\Controllers\Admin;

use Storage;
use App\Models\LogStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\DokumenPermohonan;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DokumenPermohonanController extends Controller
{
    public function index()
    {
        // Admin bisa melihat semua dokumen
        $dokumen_permohonans = DokumenPermohonan::with('permohonan.user')->latest()->get();

        return view('pages.admin.dokumen.index', compact('dokumen_permohonans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'permohonan_id' => 'required|exists:permohonans,id',
            'nama_dokumen' => 'required|string',
            'file_path' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png',
        ]);

        try {
            $file = $request->file('file_path')->store('dokumen_permohonan', 'public');

            DokumenPermohonan::create([
                'permohonan_id' => $request->permohonan_id,
                'nama_dokumen' => $request->nama_dokumen,
                'file_path' => $file,
                'status' => 'Pending',
                'keterangan' => $request->keterangan ?? '',
            ]);

            Alert::success('Sukses', 'Dokumen berhasil diunggah!');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat mengunggah dokumen!');
        }

        return back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'permohonan_id' => 'required|exists:permohonans,id',
            'nama_dokumen' => 'required|string',
            'keterangan' => 'nullable|string',
            'status' => 'required|string',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png',
        ]);

        try {
            $dokumen = DokumenPermohonan::findOrFail($id);

            if ($request->hasFile('file_path')) {
                // Hapus file lama jika ada
                if ($dokumen->file_path && Storage::disk('public')->exists($dokumen->file_path)) {
                    \Storage::disk('public')->delete($dokumen->file_path);
                }

                // Simpan file baru
                $file = $request->file('file_path')->store('dokumen_permohonan', 'public');
                $dokumen->file_path = $file;
            }

            // Update data dokumen
            $dokumen->permohonan_id = $request->permohonan_id;
            $dokumen->nama_dokumen = $request->nama_dokumen;
            $dokumen->keterangan = $request->keterangan ?? $dokumen->keterangan;
            $dokumen->status = $request->status;

            // Jika ingin reset status ke Pending saat update, aktifkan baris di bawah
            // $dokumen->status = 'Pending';

            $dokumen->save();

            // Simpan ke LogStatus
            LogStatus::create([
                'permohonan_id' => $dokumen->permohonan_id,
                'status'        => $dokumen->status, // status dari dokumen saat ini
                'catatan'       => $request->keterangan ?? '-',
                'updated_by'    => Auth::id(),
                'created_at'    => Carbon::now()->locale('id')->toDateTimeString(),
                'updated_at'    => Carbon::now()->locale('id')->toDateTimeString(),
            ]);

            Alert::success('Sukses', 'Dokumen berhasil diperbarui dan dicatat di log!');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat memperbarui dokumen!');
        }

        return back();
    }

    public function destroy($id)
    {
        try {
            $dokumen = DokumenPermohonan::findOrFail($id);

            // Hapus file dari storage jika ada
            if ($dokumen->file_path && Storage::disk('public')->exists($dokumen->file_path)) {
                Storage::disk('public')->delete($dokumen->file_path);
            }

            // Hapus data dari database
            $dokumen->delete();

            Alert::success('Sukses', 'Dokumen berhasil dihapus!');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menghapus dokumen!');
        }

        return back();
    }


    public function approve(Request $request, $id)
    {
        $permohonan = DokumenPermohonan::with('permohonan.user')->findOrFail($id);

        $status = $request->input('action'); // 'Disetujui' atau 'Ditolak'
        $keterangan = $request->input('keterangan'); // optional

        // Validasi
        if (!in_array($status, ['Disetujui', 'Ditolak'])) {
            return redirect()->back()->with('error', 'Status tidak valid.');
        }

        if ($status === 'Ditolak' && empty($keterangan)) {
            return redirect()->back()->with('error', 'Keterangan wajib diisi jika permohonan ditolak.');
        }

        // Simpan ke LogStatus
        LogStatus::create([
            'permohonan_id' => $permohonan->id,  // ID user pemohon (bukan admin)
            'status'        => $status,
            'catatan'       => $keterangan ?? '-',
            'updated_by'    => Auth::id(),              // admin yang menyetujui
            'created_at'    => now()->locale('id')->toDateTimeString(), // Format dengan locale Indonesia
            'updated_at'    => now()->locale('id')->toDateTimeString(),
        ]);

        // Update permohonan
        $permohonan->status = $status;
        $permohonan->keterangan = $keterangan;
        $permohonan->created_at = now(); // jika ingin diubah juga waktu pengajuannya (opsional)
        $permohonan->save();

        Alert::success('Sukses', 'Permohonan berhasil diperbarui menjadi ' . $status);
        return redirect()->back();
    }

}

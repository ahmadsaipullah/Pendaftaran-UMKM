<?php

namespace App\Http\Controllers\User;

use App\Models\DokumenPermohonan;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use RealRashid\SweetAlert\Facades\Alert;

class DokumenPermohonanController extends Controller
{
    public function index()
{
    $user = auth()->user();

    // Ambil dokumen permohonan milik user login
    $dokumen_permohonans = DokumenPermohonan::whereHas('permohonan', function ($q) use ($user) {
        $q->where('user_id', $user->id);
    })
    ->with('permohonan')
    ->latest()
    ->get();

    $showAksi = $dokumen_permohonans->contains('status', 'Ditolak');

    // Ambil permohonan terakhir milik user (untuk kebutuhan input permohonan_id otomatis)
    $latestPermohonan = \App\Models\Permohonan::where('user_id', $user->id)
                            ->latest()
                            ->first();

    return view('pages.user.dokumen.index', compact('dokumen_permohonans', 'showAksi', 'latestPermohonan'));
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

    // Fungsi untuk upload ulang dokumen setelah ditolak
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_dokumen' => 'required|string',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
        ]);

        try {
            $dokumen = DokumenPermohonan::findOrFail($id);

            // Cek jika ada file baru
            if ($request->hasFile('file_path')) {
                // Hapus file lama jika ada
                if ($dokumen->file_path && Storage::disk('public')->exists($dokumen->file_path)) {
                    Storage::disk('public')->delete($dokumen->file_path);
                }

                // Simpan file baru
                $file = $request->file('file_path')->store('dokumen_permohonan', 'public');
                $dokumen->file_path = $file;
            }

            // Update data lainnya
            $dokumen->nama_dokumen = $request->nama_dokumen;
            $dokumen->status = 'Pending'; // Reset status ke Pending
            $dokumen->save();

            Alert::success('Sukses', 'Dokumen berhasil diperbarui!');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat memperbarui dokumen!');
        }

        return back();
    }
 
}

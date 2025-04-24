<?php

namespace App\Http\Controllers\Admin;

use App\Models\Umkm;
use App\Models\User;
use App\Models\LogStatus;
use App\Models\Permohonan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PermohonanController extends Controller
{
    public function index()
    {
        $permohonans = Permohonan::with(['umkm','user'])->latest()->get();
        $umkms = Umkm::all();
        $users = User::where('level_id', 3)->get();
        return view('pages.admin.permohonan.index', compact('permohonans', 'umkms','users'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'umkm_id' => ['required', 'exists:umkms,id'],
            'tanggal_pengajuan' => ['required', 'date'],
            'status' => ['nullable', 'string'],
            'keterangan' => ['nullable', 'string'],
        ]);

        try {
            // Generate nomor_permohonan otomatis
            $nomor_permohonan = 'PHM' . strtoupper(Str::random(8)); // Atau mt_rand() jika mau angka

            // Cek data yang akan disimpan
            \Log::info('Menyimpan data permohonan:', $request->all()); // Log input data

            // Simpan permohonan
            $permohonan = Permohonan::create([
                'user_id' => $request->user_id,
                'umkm_id' => $request->umkm_id,
                'nomor_permohonan' => $nomor_permohonan,
                'tanggal_pengajuan' => $request->tanggal_pengajuan,
                'status' => $request->status ?? 'Pending',
                'keterangan' => $request->keterangan,
            ]);

            Alert::success('Sukses', 'Data Permohonan berhasil ditambahkan!');
            return redirect()->route('permohonan.index');
        } catch (\Exception $e) {
            \Log::error('Gagal menyimpan permohonan: '.$e->getMessage()); // Log error
            Alert::error('Gagal', 'Gagal menambahkan data Permohonan!');
            return redirect()->back()->withInput();
        }
    }




    public function update(Request $request, $id)
    {
        $request->validate([
            'umkm_id' => ['required', 'exists:umkms,id'],
            'tanggal_pengajuan' => ['required', 'date'],
            'keterangan' => ['nullable', 'string'],
            'status' => ['required', 'string'],
        ]);

        try {
            $permohonan = Permohonan::findOrFail($id);

            // Update data utama
            $permohonan->update([
                'umkm_id' => $request->umkm_id,
                'tanggal_pengajuan' => $request->tanggal_pengajuan,
                'status' => $request->status,
                'keterangan' => $request->keterangan,
            ]);

            // Update created_at dengan waktu saat ini
            $permohonan->created_at = now(); // Menggunakan fungsi 'now()' untuk mendapatkan waktu saat ini
            $permohonan->save(); // Pastikan disimpan kembali setelah update

            // Simpan log ke tabel log_statuses
            LogStatus::create([
                'permohonan_id' => $permohonan->id,
                'status' => $request->status,
                'catatan' => $request->keterangan ?? '-', // boleh ambil dari form, atau default
                'updated_by' => Auth::id(),
                'created_at'    => now()->locale('id')->toDateTimeString(), // Format dengan locale Indonesia
                'updated_at'    => now()->locale('id')->toDateTimeString(),
            ]);

            Alert::success('Sukses', 'Data Permohonan berhasil diperbarui!');
            return redirect()->route('permohonan.index');
        } catch (\Exception $e) {
            \Log::error('Gagal memperbarui permohonan: '.$e->getMessage());
            Alert::error('Gagal', 'Gagal memperbarui data Permohonan!');
            return redirect()->back()->withInput();
        }
    }




    public function destroy($id)
    {
        try {
            $permohonan = Permohonan::findOrFail($id);
            $permohonan->delete();

            Alert::success('Sukses', 'Data Permohonan berhasil dihapus!');
            return redirect()->route('admin.permohonan.index');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Gagal menghapus data Permohonan!');
            return redirect()->route('permohonan.index');
        }
    }


    public function approve(Request $request, $id)
    {
        $permohonan = Permohonan::with('user')->findOrFail($id);

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

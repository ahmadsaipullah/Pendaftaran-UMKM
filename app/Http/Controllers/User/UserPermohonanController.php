<?php

namespace App\Http\Controllers\User;

use App\Models\Umkm;
use App\Models\User;
use App\Models\LogStatus;
use App\Models\Permohonan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class UserPermohonanController extends Controller
{
    public function index()
    {
        $userId = Auth::id(); // ambil user_id yang sedang login

        // Ambil permohonan yang hanya milik user tersebut
        $permohonans = Permohonan::with(['umkm', 'user'])
            ->where('user_id', $userId)
            ->latest()
            ->get();

        // Jika hanya data UMKM dan user tertentu yang dibutuhkan:
        $umkms = Umkm::where('user_id', $userId)->get(); // hanya UMKM milik user ini
        $users = User::where('id', $userId)->get(); // hanya data user yang login
        $showAksi = $permohonans->contains('status', 'Ditolak');
        $umkmss = Umkm::all();

        return view('pages.user.permohonan.index', compact('permohonans', 'umkms', 'users','showAksi', 'umkmss'));
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
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
                'umkm_id' => $request->umkm_id,
                'nomor_permohonan' => $nomor_permohonan,
                'tanggal_pengajuan' => $request->tanggal_pengajuan,
                'status' => $request->status ?? 'Pending',
                'keterangan' => $request->keterangan,
            ]);

            Alert::success('Sukses', 'Data Permohonan berhasil ditambahkan!');
            return redirect()->route('userpermohonan.index');
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
                'status' => $request->status ?? 'Pending',
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
            return redirect()->route('userpermohonan.index');
        } catch (\Exception $e) {
            \Log::error('Gagal memperbarui permohonan: '.$e->getMessage());
            Alert::error('Gagal', 'Gagal memperbarui data Permohonan!');
            return redirect()->back()->withInput();
        }
    }
}

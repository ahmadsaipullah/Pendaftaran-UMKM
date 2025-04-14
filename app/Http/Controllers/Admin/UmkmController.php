<?php

namespace App\Http\Controllers\Admin;

use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class UmkmController extends Controller
{
    /**
     * Tampilkan semua data UMKM.
     */
    public function index()
    {
        $umkms = Umkm::all(); // You can optimize this by paginating if there are a lot of records
        return view('pages.admin.umkm.index', compact('umkms'));
    }

    /**
     * Simpan data UMKM baru.
     */
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'nama_umkm' => ['required', 'string'],
            'jenis_usaha' => ['required', 'string'],
            'alamat_umkm' => ['required', 'string'],
            'kelurahan' => ['required', 'string'],
        ]);

        try {
            // Create the UMKM entry
            $umkm = Umkm::create([
                'user_id' => Auth::id(), // Automatically use the logged-in user's ID
                'nama_umkm' => $request->nama_umkm,
                'jenis_usaha' => $request->jenis_usaha,
                'alamat_umkm' => $request->alamat_umkm,
                'kelurahan' => $request->kelurahan,
                'kecamatan' => 'Sepatan', // Default value
                'kabupaten' => 'Kabupaten Tangerang', // Default value
                'provinsi' => 'Banten', // Default value
            ]);

            if ($umkm) {
                Alert::success('Sukses', 'Data UMKM berhasil ditambahkan!');
            } else {
                Alert::error('Gagal', 'Data UMKM gagal ditambahkan!');
            }

            return redirect()->route('umkm.index');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menambahkan data UMKM!');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Update data UMKM.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Validate the incoming data
            $request->validate([
                'nama_umkm' => ['required', 'string'],
                'jenis_usaha' => ['required', 'string'],
                'alamat_umkm' => ['required', 'string'],
                'kelurahan' => ['required', 'string'],
            ]);

            // Find the UMKM entry by ID
            $umkm = Umkm::findOrFail($id);

            // Update the UMKM entry with the provided data
            $updated = $umkm->update([
                'nama_umkm' => $request->nama_umkm,
                'jenis_usaha' => $request->jenis_usaha,
                'alamat_umkm' => $request->alamat_umkm,
                'kelurahan' => $request->kelurahan,
            ]);

            if ($updated) {
                Alert::success('Sukses', 'Data UMKM berhasil diperbarui!');
            } else {
                Alert::error('Gagal', 'Data UMKM gagal diperbarui!');
            }

            return redirect()->route('umkm.index');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Alert::warning('Peringatan', 'Terjadi kesalahan dalam validasi!');
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat memperbarui data!');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Hapus data UMKM.
     */
    public function destroy(string $id)
    {
        try {
            // Find the UMKM entry by ID
            $umkm = Umkm::findOrFail($id);

            // Attempt to delete the UMKM entry
            $deleted = $umkm->delete();

            if ($deleted) {
                Alert::success('Sukses', 'Data UMKM berhasil dihapus!');
            } else {
                Alert::error('Gagal', 'Data UMKM gagal dihapus!');
            }

            return redirect()->route('umkm.index');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Terjadi kesalahan saat menghapus data UMKM!');
            return redirect()->route('umkm.index');
        }
    }
}

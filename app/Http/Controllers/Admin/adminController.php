<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Level;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;


class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admins = User::with('Level')->get();
        return view('pages.admin.users.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $levels = Level::all();
        return view('pages.admin.users.create', compact('levels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:13'],
            'email' => ['required', 'string', 'lowercase', 'email:dns', 'max:255', 'unique:users'],
            'password' => ['required', 'min:6'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'alamat' => ['required', 'string'],
            'level_id' => ['nullable'],
            'nik' => ['nullable', 'string'],
        ]);

        $data = [
            'name' => $request->name,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'level_id' => $request->level_id,
            'nik' => $request->nik,
        ];

        User::create($data);
        if ($data) {
            toast('Data berhasil ditambah', 'success');
        } else {
            toast('Data Gagal Ditambahkan', 'error');
        }
        return redirect()->route('admin.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $levels = level::all();
        $admin = User::with('level')->findOrFail($id);
        return view('pages.admin.users.edit', compact('levels', 'admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'no_hp' => ['required', 'string', 'max:13'],
            'email' => ['required', 'string', 'lowercase', 'email:dns', 'max:255', 'unique:users,email,' . $id],
            'password' => ['nullable', 'min:6'], // password should be nullable if you're not always updating it
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'alamat' => ['nullable', 'string'],
            'level_id' => ['nullable', 'integer'],
            'nik' => ['nullable', 'string'],
        ]);

        // Find the admin user by ID
        $admin = User::findOrFail($id);

        // Initialize the data array with all the request data
        $data = $request->all();

        // Check if the password is being updated
        if ($request->password) {
            $data['password'] = Hash::make($request->password);  // Hash the new password
        } else {
            // If no password is provided, remove the password field from the data array
            unset($data['password']);
        }

        // Handle image upload if it's provided
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($admin->image) {
                Storage::delete('public/' . $admin->image);
            }
            // Store the new image and update the data array
            $data['image'] = $request->file('image')->store('asset/admin', 'public');
        }

        // Update the user data
        $updated = $admin->update($data);

        // Provide feedback
        if ($updated) {
            toast('Data berhasil diupdate', 'success');
        } else {
            toast('Data Gagal Diupdate', 'error');
        }

        return redirect()->route('admin.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $admin = User::findOrFail($id);
        Storage::delete('public/' . $admin->image);
        $admin->delete();
        if ($admin) {
            toast('Data berhasil dihapus', 'success');
        } else {
            toast('Terjadi Kesalahan', 'error');
        }
        return redirect()->route('admin.index');
    }
}

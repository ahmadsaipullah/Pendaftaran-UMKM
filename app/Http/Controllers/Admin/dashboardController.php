<?php

namespace App\Http\Controllers\Admin;

use App\Models\Umkm;
use App\Models\User;
use App\Models\Permohonan;
use App\Models\DokumenPermohonan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class dashboardController extends Controller
{
    public function index()
    {

        $user = User::all()->count();
        $umkm = Umkm::all()->count();
        $permohonan = Permohonan::all()->count();
        $dokumen = DokumenPermohonan::all()->count();
        return view('pages.dashboard', compact('umkm','user','permohonan','dokumen'));
    }

    public function error()
    {
        return view('error.401');
    }

    public function compro()
    {
        $umkms = Umkm::all();
        return view('pages.index', compact('umkms'));
    }





}

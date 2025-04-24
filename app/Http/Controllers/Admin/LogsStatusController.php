<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogStatus;
use Illuminate\Http\Request;

class LogsStatusController extends Controller
{
    public function index()
    {

            $logStatus = LogStatus::with(['permohonan.user', 'user'])->latest()->get();
            return view('pages.admin.log_status.index', compact('logStatus'));


        abort(403, 'Anda tidak diizinkan mengakses halaman ini.');
    }
}

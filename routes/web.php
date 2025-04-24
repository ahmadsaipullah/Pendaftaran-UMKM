<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\profileController;
use App\Http\Controllers\Admin\UmkmController;
use App\Http\Controllers\Admin\{adminController,dashboardController};
use App\Http\Controllers\User\DokumenPermohonanController as UserDokumenPermohonanController;
use App\Http\Controllers\Admin\DokumenPermohonanController as AdminDokumenPermohonanController;
use App\Http\Controllers\User\UserPermohonanController;
use App\Http\Controllers\User\UserPermohonanController as UserPermohonanUtamaController;
use App\Http\Controllers\Admin\PermohonanController as AdminPermohonanController;
use App\Http\Controllers\Admin\LogsStatusController as AdminLogsStatusController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

require __DIR__.'/auth.php';

Route::get('/error-page', [dashboardController::class,'error'])->name('error');


// dashboard
Route::get('/', [dashboardController::class, 'compro'])->name('/');

Route::group(['middleware' => 'auth', 'PreventBackHistory'], function () {

// dashboard
Route::get('/dashboard', [dashboardController::class, 'index'])->name('dashboard');

// profile
Route::get('/profile/{encryptedId}/edit' ,[profileController::class, 'index'])->name('profile.index');
Route::put('/profile/password-update' ,[profileController::class, 'updatePassword'])->name('profile.updatePassword');
Route::put('/profile/{id}' ,[profileController::class, 'update'])->name('profile.update');


Route::middleware(['Admin'])->group( function(){

// crud admin
Route::resource('/admin', adminController::class);
// crud umkm
Route::resource('/umkm', UmkmController::class);
 // Dokumen Permohonan
 Route::get('dokumen-permohonan', [AdminDokumenPermohonanController::class, 'index'])->name('dokumen.index');
 Route::post('dokumen-permohonan', [AdminDokumenPermohonanController::class, 'store'])->name('dokumen.store');
 Route::put('dokumen/{id}', [AdminDokumenPermohonanController::class, 'update'])->name('dokumen.update');
 Route::delete('dokumen-permohonan/{id}', [AdminDokumenPermohonanController::class, 'destroy'])->name('dokumen.destroy');
 Route::post('dokumen-permohonan/status/{id}', [AdminDokumenPermohonanController::class, 'updateStatus'])->name('dokumen.updateStatus');
 Route::put('dokumen/approve/{id}', [AdminDokumenPermohonanController::class, 'approve'])->name('dokumen.approve');

 // Permohonan
 Route::get('permohonan', [AdminPermohonanController::class, 'index'])->name('permohonan.index');
 Route::get('permohonan/{id}', [AdminPermohonanController::class, 'show'])->name('permohonan.show');
 Route::post('permohonan', [AdminPermohonanController::class, 'store'])->name('permohonan.store');
 Route::put('permohonan/{id}', [AdminPermohonanController::class, 'update'])->name('permohonan.update');
 Route::delete('permohonan/{id}', [AdminPermohonanController::class, 'destroy'])->name('permohonan.destroy');
 Route::put('permohonan/approve/{id}', [AdminPermohonanController::class, 'approve'])->name('permohonan.approve');


 // Logs status admin only
 Route::get('logs-status', [AdminLogsStatusController::class, 'index'])->name('logs.index');


});



Route::middleware(['Petugas'])->group( function(){




});



Route::middleware(['User'])->group( function(){


 // Dokumen Permohonan
 Route::get('dokumen-permohonan-user', [UserDokumenPermohonanController::class, 'index'])->name('userdokumen.index');
 Route::post('dokumen-permohonan-user', [UserDokumenPermohonanController::class, 'store'])->name('userdokumen.store');
 Route::delete('dokumen-permohonan-user/{id}', [UserDokumenPermohonanController::class, 'destroy'])->name('userdokumen.destroy');
 Route::put('dokumen-permohonan-user/update/{id}', [UserDokumenPermohonanController::class, 'update'])->name('userdokumen.update');

 // Permohonan (buat permohonan)
 Route::get('permohonan-user', [UserPermohonanUtamaController::class, 'index'])->name('userpermohonan.index');
 Route::get('permohonan-user/create', [UserPermohonanUtamaController::class, 'create'])->name('userpermohonan.create');
 Route::post('permohonan-user', [UserPermohonanUtamaController::class, 'store'])->name('userpermohonan.store');
 Route::put('permohonan-user/{id}', [UserPermohonanUtamaController::class, 'update'])->name('userpermohonan.update');


});







});


<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KewajibanController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RuangController;
use App\Http\Controllers\SekolahController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\YayasanController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::middleware(['auth', 'active'])->group(function () {
    // Route Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route Administrator
    Route::middleware('role:Administrator')->group(function () {
        Route::resource('role', RoleController::class);
        Route::resource('permission', PermissionController::class);
    });

    // Route Data Master
    Route::resource('yayasan', YayasanController::class);
    Route::get('yayasan/{yayasan:id}/use', [YayasanController::class, 'use'])->name('yayasan.use');
    Route::resource('sekolah', SekolahController::class);
    Route::resource('jurusan', JurusanController::class);
    Route::resource('staff', StaffController::class);
    Route::post('/staff/{staff:id}/activate', [StaffController::class, 'activate'])->name('staff.activate');
    Route::resource('ruang', RuangController::class);
    Route::resource('kelas', KelasController::class);
    Route::get('kelas/{kela:id}/kewajiban', [KelasController::class, 'kewajiban'])->name('kelas.kewajiban');
    Route::post('kelas/{kela:id}/kewajiban', [KelasController::class, 'storeKewajiban'])->name('kelas.storeKewajiban');
    Route::resource('siswa', SiswaController::class);
    Route::post('siswa/import', [SiswaController::class, 'import'])->name('siswa.import');
    Route::resource('tahun-ajaran', TahunAjaranController::class);
    Route::get('kewajiban/pembayaran', [KewajibanController::class, 'pembayaran'])->name('kewajiban.pembayaran');
    Route::get('kewajiban/{kewajiban:id}/bayar', [KewajibanController::class, 'bayar'])->name('kewajiban.bayar');
    Route::post('kewajiban/bayar', [KewajibanController::class, 'bayarKewajiban'])->name('kewajiban.bayarKewajiban');
    Route::resource('kewajiban', KewajibanController::class);
    Route::get('/spp/tagihan', [SppController::class, 'tagihan'])->name('spp.tagihan');
    Route::resource('spp', SppController::class);
});

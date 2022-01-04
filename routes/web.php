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
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TahunAjaranController;
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
    Route::middleware('role:administrator')->group(function () {
        Route::resource('role', RoleController::class);
        Route::resource('permission', PermissionController::class);
    });

    // Route Data Master
    Route::resource('sekolah', SekolahController::class);
    Route::resource('jurusan', JurusanController::class);
    Route::resource('staff', StaffController::class);
    Route::post('/staff/{staff:id}/activate', [StaffController::class, 'activate'])->name('staff.activate');
    Route::resource('ruang', RuangController::class);
    Route::resource('kelas', KelasController::class);
    Route::get('kelas/{kela:id}/kewajiban', [KelasController::class, 'kewajiban'])->name('kelas.kewajiban');
    Route::post('kelas/{kela:id}/kewajiban', [KelasController::class, 'storeKewajiban'])->name('kelas.storeKewajiban');
    Route::resource('siswa', SiswaController::class);
    Route::resource('tahun-ajaran', TahunAjaranController::class);
    Route::resource('kewajiban', KewajibanController::class);
});

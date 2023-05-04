<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DosenController;
use App\Http\Controllers\Admin\MahasiswaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::prefix('/mahasiswa')->group(function () {
    // halaman login mahasiswa
    Route::match(['get', 'post'], '/login', [MahasiswaController::class, 'loginMahasiswa'])->name('loginMahasiswa');

    // middleware Mahasiswa
    Route::group(['middleware' => ['mahasiswa']], function () {
        // Route dashboard mahasiswa
        Route::get('/dashboard', [MahasiswaController::class, 'dashboardMahasiswa'])->name('dashboardMahasiswa');

        // Route untuk update profil mahasiswa
        Route::match(['get', 'post'], '/update-mahasiswa-profile', [MahasiswaController::class, 'updateProfile'])->name('updateProfileMahasiswa');

        // Route untuk update password Mahasiswa
        Route::match(['get', 'post'], '/update-mahasiswa-password', [MahasiswaController::class, 'updatePassword'])->name('updatePasswordMahasiswa');

        // Route untuk daftar sidang
        Route::match(['get', 'post'], '/daftar-sidang/{slug}', [MahasiswaController::class, 'daftarSidang'])->name('daftarSidang');

        // Route untuk logout admin
        Route::get('/logout', [MahasiswaController::class, 'logoutMahasiswa'])->name('logoutMahasiswa');
    });
});

Route::prefix('/dosen')->group(function () {
    // halaman login dosen
    Route::match(['get', 'post'], '/login', [DosenController::class, 'loginDosen'])->name('loginDosen');

    // middleware dosen
    Route::group(['middleware' => ['dosen']], function () {
        // Route dashboard dosen
        Route::get('/dashboard', [DosenController::class, 'dashboardDosen'])->name('dashboardDosen');

        // Route untuk update profil dosen
        Route::match(['get', 'post'], '/update-dosen-profile', [DosenController::class, 'updateProfile'])->name('updateProfileDosen');

        // Route untuk update password Dosen
        Route::match(['get', 'post'], '/update-dosen-password', [DosenController::class, 'updatePassword'])->name('updatePasswordDosen');

        // Route untuk view daftar sidang mahasiswa
        Route::get('/view-daftar-sidang/{slug}', [DosenController::class, 'viewDaftarSidang'])->name('viewDaftarSidang');

        // Route untuk approval daftar sidang mahasiswa
        Route::get('/approval-daftar-sidang/{id}', [DosenController::class, 'showDaftarSidang'])->name('showDaftarSidang');

        // Route logout dosen
        Route::get('/logout', [DosenController::class, 'logoutDosen'])->name('logoutDosen');
    });
});

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function () {
    // halaman login admin
    Route::match(['get', 'post'], '/login', [AdminController::class, 'loginAdmin'])->name('loginAdmin');

    // Route untuk middleware Admin
    Route::group(['middleware' => ['admin']], function () {
        // halaman dashboard admin
        Route::get('/dashboard', [AdminController::class, 'dashboardAdmin'])->name('dashboardAdmin');

        // Route untuk update profil admin
        Route::match(['get', 'post'], '/update-admin-profile', [AdminController::class, 'updateProfile'])->name('updateProfileAdmin');

        // Route untuk update password admin
        Route::match(['get', 'post'], '/update-admin-password', [AdminController::class, 'updatePassword'])->name('updatePasswordAdmin');

        // Route untuk logout admin
        Route::get('/logout', [AdminController::class, 'logoutAdmin'])->name('logoutAdmin');

        // route untuk view semester
        Route::get('/semester', [AdminController::class, 'viewSemester'])->name('viewSemester');

        // Route untuk tambah data semester
        Route::match(['get', 'post'], '/add-edit-semester/{id?}', [AdminController::class, 'addEditSemester'])->name('addEditSemester');

        // route untuk view tahun ajaran
        Route::get('/tahun_ajaran', [AdminController::class, 'viewTahunAjaran'])->name('viewTahunAjaran');

        // route untuk view data daftar sidang semua prodi
        Route::get('/view-daftar-sidang', [AdminController::class, 'viewDaftarSidangAll'])->name('viewDaftarSidangAll');

        // Route untuk tambah data semester
        Route::match(['get', 'post'], '/add-edit-tahun_ajaran/{id?}', [AdminController::class, 'addEditTahunAjaran'])->name('addEditTahunAjaran');

        // Route untuk view dosen
        Route::get('/view-dosen', [DosenController::class, 'viewDosen'])->name('viewDosen');

        // Route untuk tambah dan edit dosen
        Route::match(['get', 'post'], '/add-edit-dosen/{id?}', [DosenController::class, 'addEditDosen'])->name('addEditDosen');

        // Route untuk halaman import dosen
        Route::get('import-page-dosen', [DosenController::class, 'pageImportDosen'])->name('pageImportDosen');

        // Route untuk import dosen
        Route::post('/import-dosen', [DosenController::class, 'importDosen'])->name('importDosen');

        // Route untuk plot status dosen koordinator sidang skripsi
        Route::post('update-dosen-status/{id}', [DosenController::class, 'updateDosenStatus'])->name('updateDosenStatus');

        // Route untuk view mahasiswa
        Route::get('/view-mahasiswa', [MahasiswaController::class, 'viewMahasiswa'])->name('viewMahasiswa');

        // Route untuk tambah dan edit mahasiswa
        Route::match(['get', 'post'], '/add-edit-mahasiswa/{id?}', [MahasiswaController::class, 'addEditMahasiswa'])->name('addEditMahasiswa');

        // Route untuk halaman import mahasiswa
        Route::get('import-page-mahasiswa', [MahasiswaController::class, 'pageImportMahasiswa'])->name('pageImportMahasiswa');

        // Route untuk import mahasiswa
        Route::post('/import-mahasiswa', [MahasiswaController::class, 'importMahasiswa'])->name('importMahasiswa');
    });
});

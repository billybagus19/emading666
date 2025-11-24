<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\EmadingController;

// Route untuk autentikasi
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route untuk halaman utama e-mading
Route::get('/', [EmadingController::class, 'index'])->name('emading.index');
Route::get('/artikel/{id}', [EmadingController::class, 'showArtikel'])->name('emading.show');

Route::get('/kategori/{id}', [EmadingController::class, 'kategori'])->name('emading.kategori');
Route::get('/search', [EmadingController::class, 'search'])->name('emading.search');

// Route untuk like dan komentar (memerlukan login)
Route::middleware(['auth'])->group(function () {
    Route::post('/artikel/{id}/like', [EmadingController::class, 'likeArtikel'])->name('emading.like');
    Route::post('/artikel/{id}/komentar', [EmadingController::class, 'komentarArtikel'])->name('emading.komentar');
});

// Route untuk siswa
Route::middleware(['auth'])->group(function () {
    Route::get('/siswa/dashboard', [SiswaController::class, 'dashboard'])->name('siswa.dashboard');
    Route::get('/siswa/artikel/create', [SiswaController::class, 'createArtikel'])->name('siswa.artikel.create');
    Route::post('/siswa/artikel', [SiswaController::class, 'storeArtikel'])->name('siswa.artikel.store');
    Route::get('/siswa/artikel/{id}/edit', [SiswaController::class, 'editArtikel'])->name('siswa.artikel.edit');
    Route::put('/siswa/artikel/{id}', [SiswaController::class, 'updateArtikel'])->name('siswa.artikel.update');
    Route::delete('/siswa/artikel/{id}', [SiswaController::class, 'destroyArtikel'])->name('siswa.artikel.destroy');
    Route::post('/siswa/artikel/{id}/submit', [SiswaController::class, 'submitArtikel'])->name('siswa.artikel.submit');
    Route::post('/siswa/notifikasi/{id}/read', [SiswaController::class, 'markNotificationRead'])->name('siswa.notifikasi.read');
    Route::post('/siswa/notifikasi/read-all', [SiswaController::class, 'markAllNotificationsRead'])->name('siswa.notifikasi.read-all');
});
     
// Route untuk admin    
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/artikels', [AdminController::class, 'artikels'])->name('admin.artikels');
    Route::get('/admin/artikel/{id}', [AdminController::class, 'showArtikel'])->name('admin.artikel.show');
    Route::post('/admin/artikel/{id}/publish', [AdminController::class, 'publishArtikel'])->name('admin.artikel.publish');
    Route::post('/admin/artikel/{id}/reject', [AdminController::class, 'rejectArtikel'])->name('admin.artikel.reject');
    Route::delete('/admin/artikel/{id}', [AdminController::class, 'destroyArtikel'])->name('admin.artikel.destroy');
    Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('/admin/users/siswa', [AdminController::class, 'usersSiswa'])->name('admin.users.siswa');
    Route::get('/admin/users/guru', [AdminController::class, 'usersGuru'])->name('admin.users.guru');
    Route::post('/admin/users', [AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::put('/admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/admin/users/{id}', [AdminController::class, 'destroyUser'])->name('admin.users.destroy');
    Route::get('/admin/kategori', [AdminController::class, 'kategori'])->name('admin.kategori');
    Route::post('/admin/kategori', [AdminController::class, 'storeKategori'])->name('admin.kategori.store');
    Route::put('/admin/kategori/{id}', [AdminController::class, 'updateKategori'])->name('admin.kategori.update');
    Route::delete('/admin/kategori/{id}', [AdminController::class, 'destroyKategori'])->name('admin.kategori.destroy');
    Route::get('/admin/laporan', [AdminController::class, 'laporan'])->name('admin.laporan');
    Route::get('/admin/laporan/pdf', [AdminController::class, 'generatePDF'])->name('admin.laporan.pdf');

    Route::get('/admin/log-aktivitas', [AdminController::class, 'logAktivitas'])->name('admin.log');
    Route::get('/admin/users/{id}/detail', [AdminController::class, 'userDetail'])->name('admin.users.detail');
    
    // Route untuk guru
    Route::get('/guru/dashboard', [GuruController::class, 'dashboard'])->name('guru.dashboard');
    Route::get('/guru/artikels', [GuruController::class, 'artikels'])->name('guru.artikels');
    Route::get('/guru/artikel/{id}', [GuruController::class, 'showArtikel'])->name('guru.artikel.show');
    Route::post('/guru/artikel/{id}/publish', [GuruController::class, 'publishArtikel'])->name('guru.artikel.publish');
    Route::post('/guru/artikel/{id}/reject', [GuruController::class, 'rejectArtikel'])->name('guru.artikel.reject');
});
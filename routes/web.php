<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\DokterManagementController;
use App\Http\Controllers\admin\ForumController;
use App\Http\Controllers\CariDokterController;
use App\Http\Controllers\JanjiTemuController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// GUEST ROUTES (HALAMAN UMUM)

Route::get('/', function () {
    return view('landing.landing');
});
Route::get('/landing', [LandingController::class, 'landing'])->name('landing');
Route::get('/login', [LoginController::class, 'login'])->name('login');

// GLOBAL AUTHENTICATED ROUTES (BISA DIAKSES SEMUA ROLE SETELAH LOGIN)

Route::middleware(['auth', 'verified'])->group(function () {

    // Rute default setelah login
    Route::get('/dashboard', function () {
        return view('dashboard.role.pasien.dashboard');
    })->name('dashboard');

    // MANAGEMENT PROFIL GLOBAL
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
});

//  ROLE: PASIEN

Route::middleware(['auth', 'role:pasien'])->prefix('pasien')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.role.pasien.dashboard');
    })->name('pasien.dashboard');
});

// ROLE: ADMIN

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // Manajemen Dokter
    Route::get('/dokter/create', [DokterManagementController::class, 'create'])->name('admin.dokter.create');
    Route::post('/dokter/store', [DokterManagementController::class, 'store'])->name('admin.dokter.store');

    // Manajemen User (Tabel Semua Akun)
    Route::get('/manajemen-user', [AdminDashboardController::class, 'usersList'])->name('admin.users.index');
    Route::get('/users/{user}/edit', [AdminDashboardController::class, 'edit'])->name('admin.users.edit');
    Route::put('/users/{user}', [AdminDashboardController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [AdminDashboardController::class, 'destroy'])->name('admin.users.destroy');

    Route::get('/forum', [ForumController::class, 'index'])->name('admin.forum.index');
    Route::post('/forum/{thread}/pin', [ForumController::class, 'togglePin'])->name('admin.forum.pin');
    Route::delete('/forum/{thread}', [ForumController::class, 'destroy'])->name('admin.forum.destroy');

    Route::get('/forum/create', [ForumController::class, 'create'])->name('admin.forum.create');
    Route::post('/forum/store', [ForumController::class, 'store'])->name('admin.forum.store');

});

//  ROLE: DOKTER

Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.role.dokter.dashboard');
    })->name('dokter.dashboard');
});

Route::get('forum', [ForumController::class, 'index'])->name('forum.index');

Route::middleware(['auth'])->group(function () {
    Route::post('/janji-temu/store', [JanjiTemuController::class, 'store'])->name('janji.store');
    });
    
    Route::get('/cari-dokter', [CariDokterController::class, 'index'])->name('cari-dokter.index'); 
    

require __DIR__.'/auth.php';

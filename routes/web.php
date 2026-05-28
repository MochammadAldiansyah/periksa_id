<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\DokterManagementController;
use App\Http\Controllers\Admin\OrderManagementController;
use App\Http\Controllers\admin\ForumController;
use App\Http\Controllers\CariDokterController;
use App\Http\Controllers\JanjiTemuController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FarmasiController;
use App\Models\JanjiTemu;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RumahSakitController;

// GUEST ROUTES (HALAMAN UMUM)

Route::get('/', function () {
    return view('landing.landing');
});
Route::get('/landing', [LandingController::class, 'landing'])->name('landing');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/rumah-sakit', [RumahSakitController::class, 'index'])->name('rumah-sakit');

// GLOBAL AUTHENTICATED ROUTES (BISA DIAKSES SEMUA ROLE SETELAH LOGIN)

Route::middleware(['auth', 'verified'])->group(function () {

    // Rute default setelah login
    Route::get('/dashboard', function () {
        if (auth()->user()->hasRole('dokter')) {
            $jadwalHariIni = JanjiTemu::where('dokter_id', auth()->id())
                ->whereIn('status', ['approved'])
                ->whereDate('scheduled_date', '>=', today())
                ->with('user')
                ->orderBy('scheduled_date')
                ->orderBy('scheduled_time')
                ->get();
            $pendingRequests = JanjiTemu::where('dokter_id', auth()->id())
                ->where('status', 'pending')
                ->with('user')
                ->latest()
                ->get();
            $totalPasien = JanjiTemu::where('dokter_id', auth()->id())->distinct('user_id')->count('user_id');
            $completedCount = JanjiTemu::where('dokter_id', auth()->id())->where('status', 'approved')->whereDate('scheduled_date', '<', today())->count();
            return view('dashboard.role.dokter.dashboard', compact('jadwalHariIni', 'pendingRequests', 'totalPasien', 'completedCount'));
        }
        if (auth()->user()->hasRole('pasien')) {
            $janjiTemus = JanjiTemu::where('user_id', auth()->id())
                ->where('status', 'approved')
                ->whereDate('scheduled_date', '>=', today())
                ->with('dokter')
                ->orderBy('scheduled_date')
                ->orderBy('scheduled_time')
                ->get();
            $activeOrders = Order::where('user_id', auth()->id())
                ->whereIn('status', ['pending', 'dikirim'])
                ->with('medicine')
                ->latest()
                ->get();
            return view('dashboard.role.pasien.dashboard', compact('janjiTemus', 'activeOrders'));
        }
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
        return redirect()->route('dashboard');
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

    // Manajemen Obat (Farmasi)
    Route::get('/farmasi', [FarmasiController::class, 'adminIndex'])->name('admin.farmasi.index');
    Route::get('/farmasi/create', [FarmasiController::class, 'create'])->name('admin.farmasi.create');
    Route::post('/farmasi', [FarmasiController::class, 'store'])->name('admin.farmasi.store');
    Route::get('/farmasi/{medicine}/edit', [FarmasiController::class, 'edit'])->name('admin.farmasi.edit');
    Route::put('/farmasi/{medicine}', [FarmasiController::class, 'update'])->name('admin.farmasi.update');
    Route::delete('/farmasi/{medicine}', [FarmasiController::class, 'destroy'])->name('admin.farmasi.destroy');

    // Manajemen Pesanan Obat
    Route::get('/orders', [OrderManagementController::class, 'index'])->name('admin.orders.index');
    Route::put('/orders/{order}/status', [OrderManagementController::class, 'updateStatus'])->name('admin.orders.status');
});

//  ROLE: DOKTER

Route::middleware(['auth', 'role:dokter'])->prefix('dokter')->group(function () {
    Route::get('/dashboard', function () {
        $jadwalHariIni = JanjiTemu::where('dokter_id', auth()->id())
            ->whereIn('status', ['approved'])
            ->whereDate('scheduled_date', '>=', today())
            ->with('user')
            ->orderBy('scheduled_date')
            ->orderBy('scheduled_time')
            ->get();
        $pendingRequests = JanjiTemu::where('dokter_id', auth()->id())
            ->where('status', 'pending')
            ->with('user')
            ->latest()
            ->get();
        $totalPasien = JanjiTemu::where('dokter_id', auth()->id())->distinct('user_id')->count('user_id');
        $completedCount = JanjiTemu::where('dokter_id', auth()->id())->where('status', 'approved')->whereDate('scheduled_date', '<', today())->count();
        return view('dashboard.role.dokter.dashboard', compact('jadwalHariIni', 'pendingRequests', 'totalPasien', 'completedCount'));
    })->name('dokter.dashboard');

    // Approve / Reject Janji Temu
    Route::post('/janji-temu/{janjiTemu}/approve', [JanjiTemuController::class, 'approve'])->name('dokter.janji.approve');
    Route::post('/janji-temu/{janjiTemu}/reject', [JanjiTemuController::class, 'reject'])->name('dokter.janji.reject');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/janji-temu/store', [JanjiTemuController::class, 'store'])->name('janji.store');
    
    // Forum routes for all authenticated users
    Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
    Route::get('/forum/create', [ForumController::class, 'create'])->name('forum.create');
    Route::post('/forum/store', [ForumController::class, 'store'])->name('forum.store');

    // Katalog Farmasi
    Route::get('/katalog-farmasi', [FarmasiController::class, 'index'])->name('farmasi.index');

    // Pemesanan Obat
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/{order}/status', [OrderController::class, 'checkStatus'])->name('orders.status');
});
    
Route::get('/cari-dokter', [CariDokterController::class, 'index'])->name('cari-dokter.index'); 
    

require __DIR__.'/auth.php';

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\PublicDonationController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\RekapDonasiController;
use App\Http\Controllers\DashboardController;
use App\Models\Campaign;


// ========================
// Halaman Landing (Publik)
// ========================
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard.' . auth()->user()->role);
    }

    $campaigns = Campaign::where('tanggal_selesai', '>=', now())->latest()->get();
    return view('public.landing', compact('campaigns'));
})->name('landing');


// ======================
// Halaman Donasi Publik
// ======================
Route::get('/donasi', fn() => view('public.donasi'))->name('donasi');
Route::post('/donasi', [PublicDonationController::class, 'store'])->name('donasi.store');


// =====================
// Kampanye Donasi Publik
// =====================
Route::get('/campaigns/{id}', [CampaignController::class, 'show'])->name('campaigns.show');
Route::post('/campaigns/{id}/donate', [CampaignController::class, 'donate'])->name('campaigns.donate');

// =====================
// Kampanye (Semua Role Login Bisa Akses Index)
// =====================
Route::middleware(['auth'])->group(function () {
    Route::get('/campaigns', [CampaignController::class, 'index'])->name('campaigns.index');
});

// =====================
// Kampanye (CRUD) - Admin & Bendahara
// =====================
Route::middleware(['auth', 'role:admin,bendahara'])->group(function () {
    Route::resource('campaigns', CampaignController::class)->except(['index', 'show']);
});



// ===================================================
// Kampanye (CRUD) - Hanya Admin dan Bendahara
// ===================================================
Route::middleware(['auth', 'role:admin,bendahara'])->group(function () {
    
    // Donasi internal
    Route::get('/donations', [DonationController::class, 'index'])->name('donations.index');
    Route::get('/donations/export', [DonationController::class, 'export'])->name('donations.export');
    Route::get('/donations/export-pdf', [DonationController::class, 'exportPdf'])->name('donations.exportPdf');

    // Rekap Donasi
    Route::get('/rekap-donasi', [RekapDonasiController::class, 'index'])->name('rekap-donasi.index');
    Route::get('/rekap-donasi/export', [RekapDonasiController::class, 'exportExcel'])->name('rekap-donasi.export');
    Route::get('/rekap-donasi/export-pdf', [RekapDonasiController::class, 'exportPdf'])->name('rekap-donasi.exportPdf');
});


// ===================
// Dashboard Per Role
// ===================
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/admin', [DashboardController::class, 'index'])->name('dashboard.admin')->middleware('role:admin');
    Route::get('/dashboard/bendahara', [DashboardController::class, 'index'])->name('dashboard.bendahara')->middleware('role:bendahara');
    Route::get('/dashboard/anggota', [DashboardController::class, 'index'])->name('dashboard.anggota')->middleware('role:anggota');
});


// ==========================
// Donor Resource (CRUD)
// ==========================
Route::resource('/donors', DonorController::class)->middleware('auth');


// ==============================
// Manajemen User (Hanya Admin)
// ==============================
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.resetPassword');
});


// ===========================
// Profil - Ganti Password
// ===========================
Route::middleware('auth')->group(function () {
    Route::get('/password/edit', [ProfileController::class, 'edit'])->name('password.edit');
    Route::post('/password/update', [ProfileController::class, 'update'])->name('password.update');
});


// ===========================
// Auth (Login / Register)
// ===========================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// ===========================
// Reset Password (Lupa Sandi)
// ===========================
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])->middleware('guest')->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])->middleware('guest')->name('password.email');
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])->middleware('guest')->name('password.reset');
Route::post('/reset-password', [NewPasswordController::class, 'store'])->middleware('guest')->name('password.store');

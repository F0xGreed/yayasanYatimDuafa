<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\PublicDonationController;


// Route::get('/', function () {
//     return view('landing');
// })->name('landing');

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard.' . auth()->user()->role);
    }
    return view('landing');
})->name('landing');

// Public - Halaman donasi landing
Route::get('/donasi', function () {
    return view('donasi');
})->name('donasi');

Route::post('/donasi', [PublicDonationController::class, 'store'])->name('donasi.store');


// Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Password Change (Ubah Password Saat Login)
Route::middleware('auth')->group(function () {
    Route::get('/password/edit', [ProfileController::class, 'edit'])->name('password.edit');
    Route::post('/password/update', [ProfileController::class, 'update'])->name('password.update');
});

// Dashboard khusus masing-masing role
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard/admin', function () {
        return view('dashboard.admin');
    })->name('dashboard.admin')->middleware('role:admin');

    Route::get('/dashboard/bendahara', function () {
        return view('dashboard.bendahara');
    })->name('dashboard.bendahara')->middleware('role:bendahara');

    Route::get('/dashboard/anggota', function () {
        return view('dashboard.anggota');
    })->name('dashboard.anggota')->middleware('role:anggota');
});

// Donor Resource (CRUD)
Route::resource('/donors', DonorController::class)->middleware('auth');

// Manajemen User: Hanya admin yang bisa akses
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{user}/reset-password', [UserController::class, 'resetPassword'])->name('users.resetPassword');
});

// Lupa Password (Request Reset Link)
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')->name('password.request');
Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')->name('password.email');

// Reset Password (Setel Ulang Password Lewat Link Email)
Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')->name('password.reset');
Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')->name('password.store');

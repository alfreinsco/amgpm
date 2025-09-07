<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IbadahController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\UlangTahunController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Pengaturan\WhatsappController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected Routes
Route::get('/beranda', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Ibadah Routes
Route::middleware('auth')->group(function () {
    // Admin only routes
    Route::middleware('admin')->group(function () {
        Route::get('/ibadah/create', [IbadahController::class, 'create'])->name('ibadah.create');
        Route::post('/ibadah', action: [IbadahController::class, 'store'])->name('ibadah.store');
        Route::get('/ibadah/{ibadah}/edit', [IbadahController::class, 'edit'])->name('ibadah.edit');
        Route::put('/ibadah/{ibadah}', [IbadahController::class, 'update'])->name('ibadah.update');
        Route::delete('/ibadah/{ibadah}', [IbadahController::class, 'destroy'])->name('ibadah.destroy');
    });

    // Public routes (index, show)
    Route::get('/ibadah', [IbadahController::class, 'index'])->name('ibadah.index');
    Route::get('/ibadah/{ibadah}', [IbadahController::class, 'show'])->name('ibadah.show');
});

// Anggota Routes (Admin Only)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('anggota', AnggotaController::class);
    Route::patch('/anggota/{anggotum}/reset-password', [AnggotaController::class, 'resetPassword'])->name('anggota.reset-password');
});

// Ulang Tahun Routes (Authenticated Users)
Route::middleware('auth')->group(function () {
    Route::get('/ulang-tahun', [UlangTahunController::class, 'index'])->name('ulang-tahun.index');
});

// Pengaturan Routes
Route::middleware('auth')->prefix('pengaturan')->group(function () {
    // Admin only routes
    Route::middleware('admin')->group(function () {
        Route::get('whatsapp', [WhatsappController::class, 'index'])->name('pengaturan.whatsapp.index');
        Route::get('whatsapp/contacts', [WhatsappController::class, 'getContacts'])->name('pengaturan.whatsapp.contacts');
    });
});

// Dokumentasi Route
Route::get('/dokumentasi', function () {
    return view('dokumentasi.index');
})->name('dokumentasi.index');


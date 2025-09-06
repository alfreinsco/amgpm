<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IbadahController;
use App\Http\Controllers\AnggotaController;

Route::get('/', function () {
    return view('welcome');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected Routes
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Ibadah Routes
Route::middleware('auth')->group(function () {
    // Public routes (index, show)
    Route::get('/ibadah', [IbadahController::class, 'index'])->name('ibadah.index');
    Route::get('/ibadah/{ibadah}', [IbadahController::class, 'show'])->name('ibadah.show');
    
    // Admin only routes
    Route::middleware('admin')->group(function () {
        Route::get('/ibadah/create', [IbadahController::class, 'create'])->name('ibadah.create');
        Route::post('/ibadah', [IbadahController::class, 'store'])->name('ibadah.store');
        Route::get('/ibadah/{ibadah}/edit', [IbadahController::class, 'edit'])->name('ibadah.edit');
        Route::put('/ibadah/{ibadah}', [IbadahController::class, 'update'])->name('ibadah.update');
        Route::delete('/ibadah/{ibadah}', [IbadahController::class, 'destroy'])->name('ibadah.destroy');
    });
});

// Anggota Routes (Admin Only)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('anggota', AnggotaController::class);
});

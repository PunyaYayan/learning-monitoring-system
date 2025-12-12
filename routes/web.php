<?php

use App\Http\Controllers\Admin\ClassController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $role = auth()->user()->role;

    return match ($role) {
        'admin' => redirect('admin/dashboard'),
        'guru' => redirect('guru/dashboard'),
        'ortu' => redirect('ortu/dashboard'),
        default => abort(403),
    };
    // return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// ADMIN
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::view('/dashboard', 'admin.dashboard');

    Route::resource('classes', ClassController::class);
});

// GURU
Route::middleware(['auth', 'role:guru'])->prefix('guru')->group(function () {
    Route::view('/dashboard', 'guru.dashboard');
});

// ORTU
Route::middleware(['auth', 'role:ortu'])->prefix('ortu')->group(function () {
    Route::view('/dashboard', 'ortu.dashboard');
});


<?php

use App\Http\Controllers\Admin\AdminClassController;
use App\Http\Controllers\Admin\AdminStudentController;
use App\Http\Controllers\Admin\AdminTeacherController;
use App\Http\Controllers\Admin\AdminMeetingController;
use App\Http\Controllers\Admin\AdminParentController;
use App\Http\Controllers\Admin\AdminDashboardController;
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
    // Route::view('/dashboard', 'admin.dashboard');

    Route::resource('classes', AdminClassController::class);
    Route::resource('students', AdminStudentController::class);
    Route::resource('teachers', AdminTeacherController::class);
    Route::resource('meetings', AdminMeetingController::class);
    Route::resource('parents', AdminParentController::class);
    // View Meetings
    Route::get('/meetings', [AdminMeetingController::class, 'index'])->name('meetings.index');
    Route::get('/meetings/{meeting}', [AdminMeetingController::class, 'show'])->name('meetings.show');

    // View Student Progress (Admin – Read Only)
    Route::get('/student-progress', [AdminStudentProgressController::class, 'index'])->name('student-progress.index');
    Route::get('/student-progress/{progress}', [AdminStudentProgressController::class, 'show'])->name('student-progress.show');

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('admin.dashboard');
});

// GURU
Route::middleware(['auth', 'role:guru'])->prefix('guru')->group(function () {
    Route::view('/dashboard', 'guru.dashboard');
});

// ORTU
Route::middleware(['auth', 'role:ortu'])->prefix('ortu')->group(function () {
    Route::view('/dashboard', 'ortu.dashboard');
});


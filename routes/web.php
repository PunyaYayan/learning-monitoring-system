<?php

use App\Http\Controllers\Admin\AdminClassController;
use App\Http\Controllers\Admin\AdminStudentController;
use App\Http\Controllers\Admin\AdminTeacherController;
use App\Http\Controllers\Admin\AdminMeetingController;
use App\Http\Controllers\Admin\AdminParentController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminRaporController;
use App\Http\Controllers\Admin\AdminReportPeriodController;
use App\Http\Controllers\Admin\AdminStudentProgressController;
use App\Http\Controllers\Admin\AdminPpdbController;

use App\Http\Controllers\Teacher\TeacherDashboardController;
use App\Http\Controllers\Teacher\TeacherClassController;
use App\Http\Controllers\Teacher\TeacherMeetingController;
use App\Http\Controllers\Teacher\TeacherProgressController;
use App\Http\Controllers\Teacher\TeacherReportController;

use App\Http\Controllers\Parent\ParentDashboardController;
use App\Http\Controllers\Parent\ParentClassController;
use App\Http\Controllers\Parent\ParentMeetingController;
use App\Http\Controllers\Parent\ParentStudentController;

use App\Http\Controllers\Student\StudentDashboardController;
use App\Http\Controllers\Student\StudentReportController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PpdbController;
use App\Http\Controllers\ReportPrintController;
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
        'student' => redirect('student/dashboard'),
        default => abort(403),
    };
    // return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('ppdb', [PpdbController::class, 'create'])->name('ppdb.create');
Route::post('ppdb', [PpdbController::class, 'store'])->name('ppdb.store')->middleware('throttle:5,1');
;
Route::get('/ppdb/confirmation/{ppdb}', [PpdbController::class, 'confirmation'])->name('ppdb.confirmation');

require __DIR__ . '/auth.php';

// ADMIN
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // Route::view('/dashboard', 'admin.dashboard');
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    Route::resource('classes', AdminClassController::class);
    Route::resource('students', AdminStudentController::class);
    Route::resource('teachers', AdminTeacherController::class);
    Route::resource('meetings', AdminMeetingController::class);
    Route::resource('parents', AdminParentController::class);
    Route::resource('report-periods', AdminReportPeriodController::class);

    // View Meetings
    Route::get('/meetings', [AdminMeetingController::class, 'index'])->name('meetings.index');
    Route::get('/meetings/{meeting}', [AdminMeetingController::class, 'show'])->name('meetings.show');

    // View Student Progress (Admin – Read Only)
    Route::get('/student-progress', [AdminStudentProgressController::class, 'index'])->name('student-progress.index');
    Route::get('/student-progress/{progress}', [AdminStudentProgressController::class, 'show'])->name('student-progress.show');

    // Route::get('/rapor', [AdminRaporController::class, 'index'])
    //     ->name('rapor.index');
    Route::get('/rapor', [AdminRaporController::class, 'index'])
        ->name('rapor.index');

    Route::get('/rapor/class/{class}', [AdminRaporController::class, 'students'])
        ->name('rapor.students');

    // Route::get('/rapor/student/{student}', [AdminRaporController::class, 'show'])
    //     ->name('rapor.sho');

    Route::get('/rapor/student/{student}/print', [AdminRaporController::class, 'print'])
        ->name('rapor.print');


    // PPDB
    Route::get('/', [AdminPpdbController::class, 'index'])->name('ppdb.index');
    Route::get('/{ppdb}', [AdminPpdbController::class, 'show'])->name('ppdb.show');

    Route::post('/{ppdb}/approve', [AdminPpdbController::class, 'approve'])->name('ppdb.approve');
    Route::post('/{ppdb}/reject', [AdminPpdbController::class, 'reject'])->name('ppdb.reject');

});

// GURU
Route::middleware(['auth', 'role:guru'])->prefix('guru')->name('teacher.')->group(function () {
    // Route::view('/dashboard', 'guru.dashboard');
    Route::get('/dashboard', [TeacherDashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('classes', [TeacherClassController::class, 'index'])
        ->name('classes.index');

    Route::get('/classes/{class}', [TeacherClassController::class, 'show'])
        ->name('classes.show');

    Route::resource('classes.meetings', TeacherMeetingController::class)
        ->except(['index']);

    Route::resource('meetings.progress', TeacherProgressController::class);

    // REPORT
    Route::get('reports', [TeacherReportController::class, 'index'])
        ->name('reports.index');

    Route::get(
        'reports/create/{student}',
        [TeacherReportController::class, 'create']
    )->name('reports.create');

    Route::post(
        'reports/{student}',
        [TeacherReportController::class, 'store']
    )->name('reports.store');

    Route::get(
        'reports/{report}',
        [TeacherReportController::class, 'show']
    )->name('reports.show');

    Route::get(
        'reports/{report}/edit',
        [TeacherReportController::class, 'edit']
    )->name('reports.edit');

    Route::put(
        'reports/{report}',
        [TeacherReportController::class, 'update']
    )->name('reports.update');
    Route::post(
        'guru/reports/{report}/lock',
        [TeacherReportController::class, 'lock']
    )->name('reports.lock');
});

// ORTU
Route::middleware(['auth', 'role:ortu'])->prefix('ortu')->name('parent.')->group(function () {
    // Route::view('/dashboard', 'ortu.dashboard');

    Route::get('students/{student}', [ParentStudentController::class, 'show'])
        ->name('students.show');

    Route::get('dashboard', [ParentDashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('classes/{class}', [ParentClassController::class, 'show'])
        ->name('classes.show');

    Route::get(
        'students/{student}/meetings/{meeting}',
        [ParentMeetingController::class, 'show']
    )
        ->name('students.meetings.show');

    Route::get('reports/{report}', [ReportPrintController::class, 'print'])->name('reports.print');
});


Route::middleware(['auth', 'role:student'])->prefix('student')->name('student.')->group(function () {

    Route::get('dashboard', [StudentDashboardController::class, 'index'])
        ->name('dashboard');
    Route::get(
        'reports/{report}',
        [ReportPrintController::class, 'print']
    )->name('reports.print');

    // Route::get(
    //     'siswa/reports/{report}/print',
    //     [ReportPrintController::class, 'print']
    // )->middleware(['auth', 'role:student'])
    //     ->name('reports.print');

});

// RAPORT
// ReportPrintController::print(StudentReport $report);

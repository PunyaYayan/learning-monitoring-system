<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentModel;
use App\Models\ClassModel;
use App\Models\TeacherModel;
use App\Models\MeetingModel;
use App\Models\StudentProgressModel;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Statistik utama
        $totalStudents = StudentModel::count();
        $totalClasses = ClassModel::count();
        $totalTeachers = TeacherModel::count();

        // Pertemuan hari ini
        $todayMeetings = MeetingModel::with(['class', 'teacher.user'])
            ->whereDate('meeting_date', Carbon::today())
            ->orderBy('meeting_date')
            ->get();

        // Pertemuan aktif (hari ini dianggap aktif)
        $activeMeetingsCount = $todayMeetings->count();

        // Aktivitas terbaru (ambil meeting terakhir sebagai representasi aktivitas)
        // Aktivitas dari meeting (opsi A)
        $recentMeetings = MeetingModel::with(['class', 'teacher.user'])
            ->latest()
            ->take(3)
            ->get();

        $inactiveClasses = ClassModel::with('teacher.user')
            ->doesntHave('meetings')
            ->orderBy('name')
            ->take(3)
            ->get();

        // Aktivitas dari progres siswa (opsi B)
        $recentProgresses = StudentProgressModel::with([
            'student.class',
            'meeting'
        ])
            ->latest()
            ->take(3)
            ->get();


        return view('admin.dashboard', compact(
            'totalStudents',
            'totalClasses',
            'totalTeachers',
            'activeMeetingsCount',
            'todayMeetings',
            'recentMeetings',
            'recentProgresses',
            'todayMeetings',
            'inactiveClasses'
        ));

    }
}

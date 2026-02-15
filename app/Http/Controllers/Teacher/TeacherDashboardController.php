<?php
namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\MeetingModel;
use App\Models\ClassModel;
use App\Models\ReportPeriod;
use App\Models\TeacherModel;
use Illuminate\Support\Facades\Auth;

class TeacherDashboardController extends Controller
{
    public function index()
    {
        $teacher = TeacherModel::where('user_id', Auth::user()->id)->first();
        // Kelas yang diajar guru

        $classes = ClassModel::where('teacher_id', $teacher->id)->get();
        // Meeting terbaru guru
        $meetings = MeetingModel::where('teacher_id', $teacher->id)
            ->orderBy('meeting_date', 'desc')
            ->take(5)
            ->get();
        // Periode rapor aktif
        $activePeriod = ReportPeriod::where('is_active', true)->first();

        return view('teacher.dashboard', compact(
            'teacher',
            'classes',
            'meetings',
            'activePeriod'
        ));
    }
}
<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;

use App\Models\StudentModel;

use Illuminate\Http\Request;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $student = StudentModel::where('user_id', auth()->id())
            ->with([
                'class.teacher',
                'reports.period',
            ])
            ->firstOrFail();

        $class = $student->class;

        // Paginate meetings
        $meetings = $class?->meetings()
            ->with('progresses')
            ->latest('meeting_date')
            ->paginate(10);

        // Collection untuk statistik
        $meetingCollection = $meetings->getCollection();

        $progresses = $meetingCollection
            ->flatMap->progresses
            ->where('student_id', $student->id);

        $totalMeetings = $class?->meetings()->count() ?? 0;

        $hadirCount = $progresses
            ->where('progress_value', '>', 0)
            ->count();

        $lastMeeting = $meetingCollection->first();

        $lastProgress = $progresses
            ->sortByDesc('created_at')
            ->first();

        $latestReport = $student->reports
            ->sortByDesc(fn($r) => $r->period->start_date ?? $r->created_at)
            ->first();

        return view('student.dashboard', compact(
            'student',
            'class',
            'meetings',
            'totalMeetings',
            'hadirCount',
            'lastMeeting',
            'lastProgress',
            'latestReport'
        ));
    }
}

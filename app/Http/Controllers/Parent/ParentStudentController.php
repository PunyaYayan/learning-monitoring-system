<?php

namespace App\Http\Controllers\Parent;
use App\Models\ParentModel;
use App\Models\StudentModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ParentStudentController extends Controller
{
    public function show(StudentModel $student)
    {
        $parent = ParentModel::where('user_id', auth()->id())->firstOrFail();

        abort_if($student->parent_id !== $parent->id, 403);

        $class = $student->class;

        // Paginate meetings
        $meetings = $class?->meetings()
            ->with('progresses')
            ->latest('meeting_date')
            ->paginate(10);

        // Ambil collection asli
        $meetingCollection = $meetings->getCollection();

        // Semua progress siswa
        $progresses = $meetingCollection
            ->flatMap->progresses
            ->where('student_id', $student->id);

        $totalMeetings = $class?->meetings()->count() ?? 0;

        $hadirCount = $progresses
            ->where('progress_value', '>', 0)
            ->count();

        $lastProgress = $progresses
            ->sortByDesc('created_at')
            ->first();

        $latestReport = $student->reports
            ->sortByDesc(fn($r) => $r->period->start_date ?? $r->created_at)
            ->first();

        return view('parent.students.show', compact(
            'student',
            'class',
            'meetings',
            'totalMeetings',
            'hadirCount',
            'lastProgress',
            'latestReport'
        ));
    }


}

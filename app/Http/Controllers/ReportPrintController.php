<?php

namespace App\Http\Controllers;

use App\Models\ParentModel;
use App\Models\StudentReport;
use App\Models\StudentProgressModel;
use Illuminate\Http\Request;

class ReportPrintController extends Controller
{
    public function print(StudentReport $report)
    {
        $user = auth()->user();
        $student = $report->student;

        // OTORISASI
        if ($user->role === 'student') {
            abort_if($student->user_id !== $user->id, 403);
        }

        if ($user->role === 'ortu') {
            $parent = ParentModel::where('user_id', $user->id)->firstOrFail();

            abort_if($student->parent_id !== $parent->id, 403);
        }

        // admin & teacher lolos

        $period = $report->period;

        $progresses = StudentProgressModel::where('student_id', $student->id)
            ->whereHas('meeting', function ($q) use ($period) {
                $q->whereBetween('meeting_date', [
                    $period->start_date,
                    $period->end_date,
                ]);
            })
            ->with('meeting.class.teacher.user')
            ->orderBy('meeting_id')
            ->get();

        return view('reports.print', compact(
            'student',
            'report',
            'period',
            'progresses'
        ));
    }
}

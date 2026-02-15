<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\StudentModel;
use App\Models\StudentProgressModel;
use App\Models\StudentReport;
use Illuminate\Http\Request;

class StudentReportController extends Controller
{
    public function show(StudentReport $report)
    {
        $student = StudentModel::where('user_id', auth()->id())->firstOrFail();
        abort_if($report->student_id !== $student->id, 403);

        $period = $report->period;

        $progresses = StudentProgressModel::where('student_id', $student->id)
            ->whereHas('meeting', function ($q) use ($period) {
                $q->whereBetween('meeting_date', [
                    $period->start_date,
                    $period->end_date,
                ]);
            })
            ->with('meeting')
            ->orderBy('meeting_id')
            ->get();

        return view('student.reports.show', compact(
            'student',
            'report',
            'period',
            'progresses'
        ));
    }

}

<?php

namespace App\Http\Controllers\Teacher;

use App\Models\StudentModel;
use App\Models\StudentReport;
use App\Models\ReportPeriod;

use App\Http\Controllers\Controller;
use App\Models\TeacherModel;
use App\Models\User;
use Illuminate\Http\Request;

class TeacherReportController extends Controller
{
    public function index()
    {
        $teacher = TeacherModel::where('user_id', auth()->user()->id)->firstOrFail();

        $activePeriod = ReportPeriod::where('is_active', true)->first();

        abort_if(!$activePeriod, 403);

        $classes = $teacher->classes()
            ->with([
                'students',
                'students.reports' => fn($q) =>
                    $q->where('report_period_id', $activePeriod->id),
            ])
            ->get();
        return view('teacher.reports.index', compact(
            'classes',
            'activePeriod'
        ));
    }

    public function show(StudentReport $report)
    {
        abort_if(
            $report->student->class->teacher->user_id !== auth()->id(),
            403
        );

        return view('teacher.reports.show', compact('report'));
    }

    public function edit(StudentReport $report)
    {
        abort_if($report->is_locked, 403);

        abort_if(
            $report->student->class->teacher->user_id !== auth()->id(),
            403
        );

        return view('teacher.reports.edit', compact('report'));
    }

    public function update(Request $request, StudentReport $report)
    {
        abort_if($report->is_locked, 403);

        abort_if(
            $report->student->class->teacher->user_id !== auth()->id(),
            403
        );

        $data = $request->validate([
            'listening_score' => 'required|integer|min:0|max:100',
            'speaking_score' => 'required|integer|min:0|max:100',
            'reading_score' => 'required|integer|min:0|max:100',
            'writing_score' => 'required|integer|min:0|max:100',
            'teacher_note' => 'nullable|string',
        ]);

        $data['final_score'] = round(
            ($data['listening_score']
                + $data['speaking_score']
                + $data['reading_score']
                + $data['writing_score']) / 4
        );

        $report->update($data);

        return redirect()
            ->route('teacher.reports.show', $report);
    }


    public function create(StudentModel $student)
    {
        // otorisasi: siswa harus milik guru ini
        abort_if(
            $student->class->teacher->user_id !== auth()->id(),
            403
        );

        $period = ReportPeriod::where('is_active', true)->firstOrFail();

        // cegah double rapor
        $existing = StudentReport::where('student_id', $student->id)
            ->where('report_period_id', $period->id)
            ->first();

        if ($existing) {
            return redirect()
                ->route('teacher.reports.edit', $existing->id);
        }

        return view('teacher.reports.create', compact(
            'student',
            'period'
        ));
    }

    public function store(Request $request, StudentModel $student)
    {
        abort_if(
            $student->class->teacher->user_id !== auth()->id(),
            403
        );

        $period = ReportPeriod::where('is_active', true)->firstOrFail();

        $data = $request->validate([
            'listening_score' => 'required|integer|min:0|max:100',
            'speaking_score' => 'required|integer|min:0|max:100',
            'reading_score' => 'required|integer|min:0|max:100',
            'writing_score' => 'required|integer|min:0|max:100',
            'teacher_note' => 'nullable|string',
        ]);

        $final = round(
            ($data['listening_score']
                + $data['speaking_score']
                + $data['reading_score']
                + $data['writing_score']) / 4
        );

        StudentReport::create([
            'student_id' => $student->id,
            'report_period_id' => $period->id,
            'listening_score' => $data['listening_score'],
            'speaking_score' => $data['speaking_score'],
            'reading_score' => $data['reading_score'],
            'writing_score' => $data['writing_score'],
            'final_score' => $final,
            'teacher_note' => $data['teacher_note'],
        ]);

        return redirect()
            ->route('teacher.classes.show', $student->class_id);
    }

    public function lock(StudentReport $report)
    {
        abort_if($report->is_locked, 403);
        abort_if(
            $report->student->class->teacher->user_id !== auth()->id(),
            403
        );

        $report->update(['is_locked' => true]);

        return redirect()->back();
    }

}

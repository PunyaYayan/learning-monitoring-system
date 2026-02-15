<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\TeacherModel;
use Illuminate\Http\Request;
use App\Models\ReportPeriod;
use App\Models\ClassModel;
use App\Models\StudentModel;
use App\Models\StudentProgressModel;
use App\Models\StudentReport;

class AdminRaporController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $period = ReportPeriod::where('is_active', true)->first();

        if (!$period) {
            return view('admin.rapor.index', compact('period'));
        }

        $classes = ClassModel::withCount('students')
            ->withCount([
                'students as reported_students_count' => function ($q) use ($period) {
                    $q->whereHas('reports', function ($r) use ($period) {
                        $r->where('report_period_id', $period->id);
                    });
                }
            ])->get();

        return view('admin.rapor.index', compact('period', 'classes'));
    }

    public function students(ClassModel $class)
    {
        $period = ReportPeriod::where('is_active', true)->firstOrFail();

        $students = StudentModel::with([
            'reports' => function ($q) use ($period) {
                $q->where('report_period_id', $period->id);
            }
        ])
            ->where('class_id', $class->id)
            ->get();

        return view('admin.rapor.students', compact('class', 'students', 'period'));
    }

    public function print(StudentModel $student)
    {
        $period = ReportPeriod::where('is_active', true)->firstOrFail();

        $report = StudentReport::where('student_id', $student->id)
            ->where('report_period_id', $period->id)
            ->firstOrFail();

        $progresses = StudentProgressModel::with('meeting.class.teacher.user')
            ->where('student_id', $student->id)
            ->get();

        return view('admin.rapor.print', compact(
            'student',
            'report',
            'progresses',
            'period'
        ));
    }

    public function show(StudentModel $student)
    {
        $period = ReportPeriod::where('is_active', true)->firstOrFail();

        $report = StudentReport::where('student_id', $student->id)
            ->where('report_period_id', $period->id)
            ->first();

        $progresses = StudentProgressModel::with('meeting')
            ->where('student_id', $student->id)
            ->get();

        return view('admin.rapor.show', compact(
            'student',
            'report',
            'progresses',
            'period'
        ));
    }

}
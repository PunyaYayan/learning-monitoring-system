<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StudentProgressModel;
use Illuminate\Http\Request;

class AdminStudentProgressController extends Controller
{
    public function index()
    {
        $progresses = StudentProgressModel::with(['student.class','meeting'])->latest()->paginate(10);

        return view('admin.student-progress.index', compact('progresses'));
    }

    public function show(StudentProgressModel $progress)
    {
        $progress->load(['student.class','meeting']);

        return view('admin.student-progress.show', compact('progress'));
    }
}

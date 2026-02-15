<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MeetingModel;
use App\Models\ClassModel;
use App\Models\StudentProgressModel;
use Illuminate\Http\Request;

class AdminMeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = MeetingModel::with(['class', 'teacher']);

        if ($request->filled('class_id')) {
            $query->where('class_id', $request->class_id);
        }
        if ($request->filled('date')) {
            $query->where('meeting_date', $request->date);
        }
        $meetings = $query->orderBy('meeting_date', 'desc')->paginate(10);

        $classes = ClassModel::orderBy('name')->get();

        return view('admin.meetings.index', compact('meetings', 'classes'));
    }

    public function show(MeetingModel $meeting)
    {
        $meeting->load(['class', 'teacher.user']);

        $progresses = StudentProgressModel::with('student')
            ->where('meeting_id', $meeting->id)
            ->orderBy('student_id')
            ->get();

        return view('admin.meetings.show', compact(
            'meeting',
            'progresses'
        ));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'class_id' => 'required|exists:classes,id',
            'teacher_id' => 'required|exists:teachers,id',
            'meeting_date' => 'required|date',
            'material' => 'required|string|max:255',
            'note' => 'nullable|string',
        ]);

        MeetingModel::create($data);

        return redirect()
            ->route('admin.meetings.index')
            ->with('success', 'Pertemuan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

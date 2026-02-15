<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\MeetingModel;
use App\Models\TeacherModel;
use Illuminate\Http\Request;

class TeacherMeetingController extends Controller
{
    public function create(ClassModel $class)
    {
        return view('teacher.meetings.create', compact('class'));
    }

    public function store(Request $request, ClassModel $class)
    {
        $validated = $request->validate([
            'meeting_date' => ['required', 'date'],
            'material' => ['required', 'string'],
            'note' => ['nullable', 'string'],
        ]);
        $teacherId = TeacherModel::where('user_id', auth()->id())->value('id');
        MeetingModel::create([
            'class_id' => $class->id,
            'teacher_id' => $teacherId,
            'meeting_date' => $validated['meeting_date'],
            'material' => $validated['material'],
            'note' => $validated['note'] ?? null,
        ]);

        return redirect()
            ->route('teacher.classes.show', $class)
            ->with('success', 'Meeting berhasil ditambahkan.');
    }

    public function show(ClassModel $class, MeetingModel $meeting)
    {
        $meeting->load(['progresses']);
        return view('teacher.meetings.show', compact('class', 'meeting'));
    }

    public function edit(ClassModel $class, MeetingModel $meeting)
    {
        return view('teacher.meetings.edit', compact('class', 'meeting'));
    }

    public function update(Request $request, ClassModel $class, MeetingModel $meeting)
    {
        $validated = $request->validate([
            'meeting_date' => ['required', 'date'],
            'material' => ['required', 'string'],
            'note' => ['nullable', 'string'],
        ]);

        $meeting->update($validated);

        return redirect()
            ->route('teacher.classes.show', $class)
            ->with('success', 'Meeting berhasil diperbarui.');
    }

    public function destroy(ClassModel $class, MeetingModel $meeting)
    {
        $meeting->delete();

        return redirect()
            ->route('teacher.classes.show', $class)
            ->with('success', 'Meeting berhasil dihapus.');
    }
}
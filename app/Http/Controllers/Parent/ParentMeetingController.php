<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\ParentModel;
use App\Models\MeetingModel;
use App\Models\StudentModel;
use Illuminate\Http\Request;

class ParentMeetingController extends Controller
{
    public function show(StudentModel $student, MeetingModel $meeting)
    {
        $parent = ParentModel::where('user_id', auth()->id())->firstOrFail();

        abort_if($student->parent_id !== $parent->id, 403);
        abort_if($meeting->class_id !== $student->class_id, 403);

        $meeting->load([
            'progresses' => fn($q) =>
                $q->where('student_id', $student->id),
        ]);

        return view('parent.meetings.show', compact('student', 'meeting'));
    }


}


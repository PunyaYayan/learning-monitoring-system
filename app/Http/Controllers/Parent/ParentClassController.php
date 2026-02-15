<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\ParentModel;
use App\Models\ClassModel;

use Illuminate\Http\Request;

class ParentClassController extends Controller
{
    public function show(ClassModel $class)
    {
        $parent = ParentModel::where('user_id', auth()->id())->firstOrFail();

        abort_if(
            !$class->students()->where('parent_id', $parent->id)->exists(),
            403
        );

        // Load siswa saja
        $class->load([
            'students' => fn($q) => $q->where('parent_id', $parent->id),
        ]);

        // Paginate meetings
        $meetings = $class->meetings()
            ->latest('meeting_date')
            ->paginate(10);

        return view('parent.classes.show', compact('class', 'meetings'));
    }

}

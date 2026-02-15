<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use Illuminate\Http\Request;

class TeacherClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ClassModel $class)
    {
        abort_if($class->teacher->user->id !== auth()->id(), 403);

        $class->load('students');

        $meetings = $class->meetings()
            ->with('progresses')
            ->orderByDesc('meeting_date')
            ->paginate(10);

        $meetings->getCollection()->transform(function ($meeting) {
            $meeting->hadir_count = $meeting->progresses
                ->where('progress_value', '>', 0)
                ->count();

            return $meeting;
        });

        return view('teacher.classes.show', compact('class', 'meetings'));
    }



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

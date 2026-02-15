<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ClassModel;
use App\Models\TeacherModel;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class AdminClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = ClassModel::with('teacher.user')->orderBy('name')->paginate(10);

        return view('admin.classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = TeacherModel::with('user')->orderBy('id')->get();
        return view('admin.classes.create', compact('teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:classes,name'],
            'level' => ['nullable', 'string', 'max:255'],
            'schedule_note' => ['nullable', 'string', 'max:255'],
            'teacher_id' => ['nullable', 'exists:teachers,id'],
        ]);

        ClassModel::create($validated);

        return redirect()->route('admin.classes.index')
            ->with('success', 'Kelas berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClassModel $class)
    {
        $teachers = TeacherModel::with('user')->get();

        return view('admin.classes.edit', compact('class', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    // Kalau mau parameter pakai id = $class = ClassModel::findOrFail($id);
    public function update(Request $request, ClassModel $class)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'level' => ['required', 'string', 'max:255'],
            'schedule_note' => ['nullable', 'string', 'max:255'],
            'teacher_id' => ['required', 'exists:teachers,id'],
        ]);

        $class->update($validated);

        return redirect()->route('admin.classes.index')
            ->with('success', 'Kelas berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ClassModel $class)
    {
        $class->delete();

        return redirect()->route('admin.classes.index')
            ->with('success', 'Kelas berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TeacherModel;
use App\Models\User;
use Illuminate\Http\Request;

class AdminTeacherController extends Controller
{
    public function index()
    {
        $teachers = TeacherModel::with('user')->get();
        return view('admin.teachers.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.teachers.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:users,phone',
            'email' => 'nullable|email|unique:users,email',
            'bio' => 'nullable|string',
        ]);

        // buat akun user (identitas & login)
        $user = User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'] ?? null,
            'password' => bcrypt('password123'),
            'role' => 'guru',
        ]);

        // buat data guru (fungsional)
        TeacherModel::create([
            'user_id' => $user->id,
            'phone' => $data['phone'], // boleh sama, boleh beda
            'bio' => $data['bio'] ?? null,
        ]);

        return redirect()
            ->route('admin.teachers.index')
            ->with('success', 'Data guru berhasil ditambahkan.');
    }


    public function show(TeacherModel $teacher)
    {
        $teacher->load([
            'user',
            'classes',
            'meetings',
        ]);
        return view('admin.teachers.show', compact('teacher'));
    }


    public function edit(TeacherModel $teacher)
    {
        //        return view('admin.classes.edit', compact('class'));
        return view('admin.teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TeacherModel $teacher)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:users,phone,' . $teacher->user_id,
            'email' => 'nullable|email|unique:users,email,' . $teacher->user_id,
            'bio' => 'nullable|string',
        ]);

        // update user
        $teacher->user->update([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'] ?? null,
        ]);

        // update teacher
        $teacher->update([
            'bio' => $data['bio'] ?? null,
        ]);

        return redirect()
            ->route('admin.teachers.index')
            ->with('success', 'Data guru berhasil diperbarui.');
    }

    public function destroy(TeacherModel $teacher)
    {
        $user = $teacher->user;

        $teacher->delete();

        if ($user && $user->role === 'guru') {
            $user->delete();
        }

        return redirect()
            ->route('admin.teachers.index')
            ->with('success', 'Data guru berhasil dihapus.');
    }

}

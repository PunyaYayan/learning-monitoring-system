<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ClassModel;
use App\Models\ParentModel;
use App\Models\StudentModel;
use \App\Models\User;

class AdminStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = StudentModel::with(['class', 'parent'])
            ->latest()
            ->get();

        return view('admin.students.index', compact('students'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = ClassModel::all();
        return view('admin.students.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            // student
            'fullname' => 'required|string|max:255',
            'school' => 'nullable|string|max:255',
            'birthdate' => 'nullable|string|max:255',
            'gender' => 'required|in:male,female',
            'student_phone' => 'nullable|string|max:20',
            'student_email' => 'nullable|email|max:255',
            'address' => 'required|string',
            'class_id' => 'required|exists:classes,id',

            // parent
            'parent_name' => 'nullable|string|max:255',
            'parent_phone' => 'nullable|string|max:20',
            'parent_email' => 'nullable|email|max:255',
        ]);

        /*
        |--------------------------------------------------------------------------
        | VALIDASI INTI
        |--------------------------------------------------------------------------
        */
        // minimal satu nomor HP
        if (empty($data['student_phone']) && empty($data['parent_phone'])) {
            return back()
                ->withErrors(['phone' => 'Minimal satu nomor HP siswa atau orang tua wajib diisi.'])
                ->withInput();
        }

        /*
        |--------------------------------------------------------------------------
        | STUDENT USER (jika ada HP)
        |--------------------------------------------------------------------------
        */
        $studentUserId = null;

        if (!empty($data['student_phone'])) {

            $studentUser = User::firstOrCreate(

                [
                    'name' => $data['fullname'],
                    'email' => $data['student_email'] ?? null,
                    'phone' => $data['student_phone'],
                    'password' => bcrypt('password123'),
                    'role' => 'student',
                ]
            );


            $studentUserId = $studentUser->id;
        }

        /*
        |--------------------------------------------------------------------------
        | PARENT + USER (jika ada HP)
        |--------------------------------------------------------------------------
        */
        $parentId = null;

        if (!empty($data['parent_name']) && !empty($data['parent_phone'])) {

            $parentUser = User::firstOrCreate(
                ['phone' => $data['parent_phone']],
                [
                    'name' => $data['parent_name'],
                    'email' => $data['parent_email'] ?? null,
                    'password' => bcrypt('password123'),
                    'role' => 'ortu',
                ]
            );

            $parent = ParentModel::create([
                'user_id' => $parentUser->id,
                'name' => $data['parent_name'],
                'phone' => $data['parent_phone'],
                'email' => $data['parent_email'] ?? null,
            ]);

            $parentId = $parent->id;
        }

        /*
        |--------------------------------------------------------------------------
        | CREATE STUDENT
        |--------------------------------------------------------------------------
        */
        StudentModel::create([
            'user_id' => $studentUserId,   // boleh null jika student tidak login
            'parent_id' => $parentId,         // boleh null
            'fullname' => $data['fullname'],
            'school' => $data['school'] ?? null,
            'birthdate' => $data['birthdate'] ?? null,
            'gender' => $data['gender'],
            'phone' => $data['student_phone'] ?? null,
            'address' => $data['address'],
            'class_id' => $data['class_id'],
            'status_siswa' => 'active',
        ]);
        //         'fullname',
        // 'birthdate',
        // 'gender',
        // 'school',
        // 'phone',
        // 'address',
        // 'parent_id',
        // 'class_id',
        // 'status_siswa',

        return redirect()->route('students.index');
    }



    /**
     * Display the specified resource.
     */
    public function show(StudentModel $student)
    {
        $student->load(['user', 'parent', 'class', 'meetings']);

        return view('admin.students.show', compact('student'));
    }

    public function edit(StudentModel $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudentModel $student)
    {
        $validated = $request->validate([
            'fullname' => 'required|string',
            'birthdate' => 'required|date',
            'gender' => 'nullable|in:male,female',
            'school' => 'nullable|string',
            'address' => 'nullable|string',
        ]);

        $student->update($validated);
        // BUAT USER JIKA BELUM ADA
        if ($request->filled('login_phone') && is_null($student->user_id)) {

            $user = User::create([
                'name' => $student->fullname,
                'phone' => $request->login_phone,
                'role' => 'student',
                'password' => bcrypt(Str::random(12)),
            ]);

            $student->update([
                'user_id' => $user->id,
            ]);
        }

        return redirect()->route('students.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentModel $student)
    {

        $studentUser = $student->user;
        $parent = $student->parent;

        $student->delete();
        // hapus akun user student
        if ($studentUser && $studentUser->role === 'student') {
            $studentUser->delete();
        }
        // hapus parent jika tidak terhubung lagi
        if ($parent) {
            $remainingStudents = $parent->students()->count();

            if ($remainingStudents === 0) {
                $parentUser = $parent->user;

                $parent->delete();

                if ($parentUser && $parentUser->role === 'ortu') {
                    $parentUser->delete();
                }
            }
        }

        return redirect()
            ->route('students.index')
            ->with('success', 'Data siswa berhasil dihapus.');
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ParentModel;
use App\Models\StudentModel;
use App\Models\User;
use Illuminate\Validation\Rule;

class AdminParentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parents = ParentModel::withCount('students')->latest()->get();
        return view('admin.parents.index', compact('parents'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.parents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:users,phone',
            'email' => 'nullable|email|unique:users,email',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'] ?? null,
            'password' => bcrypt('Rinardta1441'),
            'role' => 'ortu',
        ]);

        ParentModel::create([
            'user_id' => $user->id,
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'] ?? null,
        ]);

        return redirect()
            ->route('parents.index')
            ->with('success', 'Data orang tua berhasil ditambahkan.');
    }
    /**
     * Display the specified resource.
     */
    public function show(ParentModel $parent)
    {
        $parent->load('user', 'students.class');
        return view('admin.parents.show', compact('parent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ParentModel $parent)
    {
        $parent->load('user');
        $availableStudents = StudentModel::whereNull('parent_id')->get();


        return view('admin.parents.edit', compact('parent', 'availableStudents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ParentModel $parent)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => [
                'required',
                'string',
                'max:20',
                Rule::unique('users', 'phone')->ignore($parent->user_id),
            ],
            'email' => [
                'nullable',
                'email',
                Rule::unique('users', 'email')->ignore($parent->user_id),
            ],
            'student_ids' => 'nullable|array',
            'student_ids.*' => 'exists:students,id',
        ]);

        // update user
        $parent->user->update([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'] ?? null,
        ]);

        // update parent
        $parent->update([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'] ?? null,
        ]);

        // ===== RELASI STUDENT =====

        // lepas semua student lama
        StudentModel::where('parent_id', $parent->id)
            ->update(['parent_id' => null]);

        // assign student baru (jika ada)
        if (!empty($data['student_ids'])) {
            StudentModel::whereIn('id', $data['student_ids'])
                ->update(['parent_id' => $parent->id]);
        }

        return redirect()
            ->route('parents.show', $parent)
            ->with('success', 'Data orang tua berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ParentModel $parent)
    {
        $studentCount = $parent->students()->count();

        // hapus akun user hanya jika parent tidak punya siswa
        if ($studentCount === 0) {
            $parent->user->delete();
            $parent->delete();

            return redirect()
                ->route('parents.index')
                ->with('success', 'Orang tua berhasil dihapus.');
        }

        return redirect()
            ->route('parents.show', $parent)
            ->with('error', 'Tidak dapat menghapus orang tua karena masih terhubung dengan siswa.');
    }

}

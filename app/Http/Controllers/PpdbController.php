<?php

namespace App\Http\Controllers;
use App\Models\PpdbApplication;
use Illuminate\Http\Request;


class PpdbController extends Controller
{

    public function index()
    {

    }
    public function create()
    {
        return view('ppdb.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([

            // siswa
            'fullname' => 'required|string|max:255',
            'birthdate' => 'nullable|date',
            'gender' => 'nullable|in:male,female',
            'school' => 'nullable|string|max:255',
            'student_email' => 'nullable|email|max:255',

            'address' => 'nullable|string',
            'phone' => 'required|string|max:20',

            // ortu
            'parent_name' => 'nullable|string|max:255',
            'parent_phone' => 'nullable|string|max:20',
            'parent_email' => 'nullable|email|max:255',

            // tipe
            'applicant_type' => 'required|in:parent,student,worker',
        ]);

        $ppdb = PpdbApplication::create($validated);

        return redirect()
            ->route('ppdb.confirmation', $ppdb->id);
    }

    public function confirmation(PpdbApplication $ppdb)
    {
        return view('ppdb.confirmation', compact('ppdb'));
    }
}
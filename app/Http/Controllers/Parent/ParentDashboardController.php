<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\ParentModel;
use Illuminate\Http\Request;

class ParentDashboardController extends Controller
{
    public function index()
    {
        $parent = ParentModel::where('user_id', auth()->id())->firstOrFail();

        $students = $parent->students()
            ->with([
                'class.teacher',
                'class.meetings' => fn($q) => $q->latest('meeting_date'),
                'class.meetings.progresses',
            ])
            ->get();
        return view('parent.dashboard', compact('parent', 'students'));
    }

}
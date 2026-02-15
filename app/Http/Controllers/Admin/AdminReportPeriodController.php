<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReportPeriod;

class AdminReportPeriodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $periods = ReportPeriod::orderByDesc('created_at')->get();
        return view('admin.report-periods.index', compact('periods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.report-periods.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
        ]);

        ReportPeriod::create($data);

        return redirect()->route('admin.report-periods.index')
            ->with('success', 'Periode rapor dibuat.');
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
    public function edit(string $id)
    {
        return view('admin.report-periods.edit', compact('reportPeriod'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReportPeriod $reportPeriod)
    {
        $data = $request->validate([
            'name' => ['required', 'string'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        // pastikan hanya satu periode aktif
        if (!empty($data['is_active']) && $data['is_active']) {
            ReportPeriod::where('is_active', true)->update(['is_active' => false]);
        }

        $reportPeriod->update($data);

        return redirect()->route('admin.report-periods.index')
            ->with('success', 'Periode rapor diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReportPeriod $reportPeriod)
    {
        $reportPeriod->delete();

        return redirect()->route('admin.report-periods.index')
            ->with('success', 'Periode rapor dihapus.');
    }
}

<?php

namespace Database\Seeders;

use App\Models\ReportPeriod;
use Illuminate\Database\Seeder;

class AdminReportPeriodSeeder extends Seeder
{
    public function run(): void
    {
        ReportPeriod::create([
            'name' => 'Semester Ganjil 2025/2026',
            'start_date' => now()->subMonths(4),
            'end_date' => now(),
            'is_active' => true,
        ]);
    }
}

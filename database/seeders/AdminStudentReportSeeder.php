<?php

namespace Database\Seeders;

use App\Models\StudentReport;
use App\Models\StudentModel;
use App\Models\ReportPeriod;
use Illuminate\Database\Seeder;

class AdminStudentReportSeeder extends Seeder
{
    public function run(): void
    {
        $period = ReportPeriod::first();

        foreach (StudentModel::all() as $student) {
            StudentReport::create([
                'student_id' => $student->id,
                'class_id' => $student->class_id,
                'report_period_id' => $period->id,
                'listening_score' => rand(60, 95),
                'speaking_score' => rand(60, 95),
                'reading_score' => rand(60, 95),
                'writing_score' => rand(60, 95),
                'final_score' => rand(65, 95),
                'teacher_note' => 'Perkembangan siswa cukup baik.',
                'is_locked' => rand(0, 1),
            ]);
        }
    }
}

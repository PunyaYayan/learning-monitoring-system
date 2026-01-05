<?php

namespace Database\Seeders;

use App\Models\ClassModel;
use App\Models\TeacherModel;
use Illuminate\Database\Seeder;

class AdminClassSeeder extends Seeder
{
    public function run(): void
    {
        $teacher = TeacherModel::first();
        ClassModel::create([
            'teacher_id' => $teacher?->id,
            'name' => 'Pre Intermediate - A',
            'level' => '7',
            'created_at' => '2025-12-20 14:12:54',
            'updated_at' => '2025-12-20 14:12:54',
        ]);
        $teacher = TeacherModel::first();
        ClassModel::create([
            'teacher_id' => $teacher?->id,
            'name' => 'Pre Intermediate - B',
            'level' => '7',
            'created_at' => '2025-12-20 14:12:54',
            'updated_at' => '2025-12-20 14:12:54',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\ClassModel;
use App\Models\TeacherModel;
use Illuminate\Database\Seeder;

class AdminClassSeeder extends Seeder
{
    public function run(): void
    {
        $teachers = TeacherModel::all()->values();
        $teacherCount = $teachers->count();

        // Pola jadwal tetap
        $schedules = [
            'Senin & Kamis',
            'Selasa & Jumat',
            'Rabu & Sabtu',
        ];

        /**
         * name => level
         * level = single source of truth
         */
        $classes = [
            'Pre School A' => 1,
            'Pre Introduction A' => 2,
            'Introduction A' => 3,
            'Beginner A' => 5,
            'Elementary A' => 6,
            'Pre Intermediate A' => 7,
            'Pre Intermediate B' => 7,
            'Conversation For Adult' => 12,
        ];

        $i = 0;

        foreach ($classes as $name => $level) {

            ClassModel::create([
                'name' => $name,
                'level' => $level,

                // rotasi guru
                'teacher_id' => $teachers[$i % $teacherCount]->id,

                // rotasi jadwal
                'schedule_note' => $schedules[$i % count($schedules)],
            ]);

            $i++;
        }
    }
}

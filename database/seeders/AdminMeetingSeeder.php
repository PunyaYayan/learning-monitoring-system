<?php

namespace Database\Seeders;

use App\Models\MeetingModel;
use Illuminate\Database\Seeder;

class AdminMeetingSeeder extends Seeder
{
    public function run(): void
    {
        MeetingModel::create([
            [
                'class_id' => 1,
                'teacher_id' => 1,
                'meeting_date' => '2025-12-20',
                'material' => 'preposition',
                'note' => 'in, on, at, time, position',
            ],
        ]);
    }
}

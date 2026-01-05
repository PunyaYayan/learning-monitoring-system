<?php

namespace Database\Seeders;

use App\Models\TeacherModel;
use Illuminate\Database\Seeder;

class AdminTeacherSeeder extends Seeder
{
    public function run(): void
    {
        TeacherModel::create([
            'user_id' => 2,
            'bio' => 'teawin',
        ]);

        TeacherModel::create([
            'user_id' => 3,
            'bio' => 'dwiastuti',
        ]);

    }
}

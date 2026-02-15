<?php

namespace Database\Seeders;

use App\Models\TeacherModel;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminTeacherSeeder extends Seeder
{
    public function run(): void
    {
        $teachers = User::where('role', 'guru')->get();

        foreach ($teachers as $user) {
            TeacherModel::create([
                'user_id' => $user->id,
                'bio'=> $this->randomBio()
            ]);
        }
    }
    private function randomBio(): ?string
    {
        return collect([
            'Bahasa Inggris Mudah Sekali.',
            'Jangan Takut Salah.',
            'English Everyday Guys',
            null,
        ])->random();
    }
}

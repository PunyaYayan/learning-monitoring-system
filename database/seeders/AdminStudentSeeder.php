<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudentModel;
use App\Models\User;
use App\Models\ParentModel;
use App\Models\ClassModel;

class AdminStudentSeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            ['Ahmad Fikri', 'male'],
            ['Rizky Ramadhan', 'male'],
            ['Daffa Pratama', 'male'],
            ['Fauzan Maulana', 'male'],
            ['Kevin Ardian', 'male'],
            ['Raka Aditya', 'male'],
            ['Iqbal Firmansyah', 'male'],
            ['Haidar Ali', 'male'],
            ['Naufal Azmi', 'male'],
            ['Akbar Setiawan', 'male'],

            ['Alya Putri', 'female'],
            ['Zahra Aulia', 'female'],
            ['Nisa Khairunnisa', 'female'],
            ['Salsabila Rahma', 'female'],
            ['Amelia Putri', 'female'],
            ['Nadya Safitri', 'female'],
            ['Cindy Oktavia', 'female'],
            ['Anisa Rahma', 'female'],
            ['Rani Kusuma', 'female'],
            ['Putri Maharani', 'female'],

            ['Bagas Saputra', 'male'],
            ['Reno Kurniawan', 'male'],
            ['Dion Prakoso', 'male'],
            ['Arman Hidayat', 'male'],
            ['Fikri Alamsyah', 'male'],
            ['Rizal Akbar', 'male'],
            ['Ilman Hakim', 'male'],
            ['Zidan Arif', 'male'],
            ['Farrel Nugraha', 'male'],
            ['Rafi Alvaro', 'male'],

            ['Syifa Nabila', 'female'],
            ['Hana Zahira', 'female'],
            ['Keysha Anindya', 'female'],
            ['Salma Azzahra', 'female'],
            ['Nayla Khadijah', 'female'],
            ['Aira Humaira', 'female'],
            ['Kayla Safira', 'female'],
            ['Zara Amalia', 'female'],
            ['Nabila Salsabila', 'female'],
            ['Azka Rahman', 'male'],
        ];

        $studentUsers = User::where('role', 'student')->get();
        $parents = ParentModel::all();
        $classes = ClassModel::all();

        foreach ($names as $i => $name) {
            StudentModel::create([
                'fullname' => $name[0],
                'birthdate' => now()->subYears(rand(10, 15))->toDateString(),
                'gender' => $name[1],
                'school' => 'SMP Negeri ' . rand(1, 5),
                'email' => strtolower(str_replace(' ', '.', $name[0])) . '@mail.test',
                'address' => 'Jl. Ahmad Yani No. ' . rand(1, 200),
                'user_id' => $studentUsers[$i]->id ?? null,
                'parent_id' => $parents->random()->id,
                'class_id' => $classes->random()->id, // TIDAK BOLEH NULL
                'status_siswa' => 'active',
            ]);
        }

    }
}
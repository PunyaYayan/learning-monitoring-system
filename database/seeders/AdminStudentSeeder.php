<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StudentModel;

class AdminStudentSeeder extends Seeder
{
    public function run(): void
    {
        StudentModel::create([
            'fullname' => 'Tegar',
            'birthdate' => '2003-06-02',
            'gender' => 'male',
            'school' => 'SMK Telkom',
            'address' => 'Dersalam',
            'parent_id' => 1, // parents.id (Bapaknya Tegar)
            'class_id' => 1,
            'status_siswa' => 'active',
            'user_id' => 4,   // users.id (student)
        ]);

        StudentModel::create([
            'fullname' => 'Yayan',
            'birthdate' => '2004-10-21',
            'gender' => 'male',
            'school' => 'SMK RUS',
            'address' => 'Wergu Kulon',
            'parent_id' => null,
            'class_id' => 2,
            'status_siswa' => 'active',
            'user_id' => 6,
        ]);

        StudentModel::create([
            'fullname' => 'Apip',
            'birthdate' => '2004-12-12',
            'gender' => 'male',
            'school' => 'SMK 2 Kudus',
            'address' => 'Desa Desus',
            'parent_id' => 2, // parents.id (Bapaknya Apip)
            'class_id' => 2,
            'status_siswa' => 'active',
            'user_id' => null,
        ]);

        StudentModel::create([
            'fullname' => 'Dalief',
            'birthdate' => '2002-02-01',
            'gender' => 'male',
            'school' => 'SMK Bandung',
            'address' => 'Desa Desus',
            'parent_id' => 1, // SAMA dengan Tegar
            'class_id' => 1,
            'status_siswa' => 'active',
            'user_id' => null,
        ]);
    }
}

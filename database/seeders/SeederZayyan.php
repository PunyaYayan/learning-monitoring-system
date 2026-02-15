<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\StudentModel;
use App\Models\ParentModel;
use App\Models\TeacherModel;
use App\Models\ClassModel;

class SeederZayyan extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'phone' => '0800000000',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $fitria = User::create([
            'name' => 'Miss Fitria',
            'email' => 'fitria@gmail.com',
            'phone' => '089876787899',
            'password' => bcrypt('password'),
            'role' => 'guru',
        ]);

        $missDwi = User::create([
            'name' => 'Miss Dwi',
            'email' => 'dwia@gmail.com',
            'phone' => '089876787699',
            'password' => bcrypt('password'),
            'role' => 'guru',
        ]);

        $fitriaTeacher = TeacherModel::create([
            'user_id' => $fitria->id,
            'bio' => 'teawin',
        ]);

        TeacherModel::create([
            'user_id' => $missDwi->id,
            'bio' => 'dwiastuti',
        ]);

        $kelasKato = ClassModel::create([
            'name' => 'Intermediate A',
            'level' => 8,
            'teacher_id' => $fitriaTeacher->id,
        ]);



        // ORTU TEGAR
        $ortuTegar = User::create([
            'name' => 'Kato',
            'email' => 'tegar@ar.com',
            'phone' => '088888777789',
            'password' => bcrypt('password'),
            'role' => 'ortu',
        ]);
        $ortuTegarParent = ParentModel::create([
            'user_id' => $ortuTegar->id,   // users.id (student)
            'name' => 'Kato',
            'email' => 'tegar@ar.com',
        ]);


        // ORTU APIP
        $ortuApip = User::create([
            'name' => 'Rizkian Syah',
            'email' => null,
            'phone' => '085432215619',
            'password' => bcrypt('password'),
            'role' => 'ortu',
        ]);

        $ortuApipParent = ParentModel::create([
            'user_id' => $ortuApip->id,
            'name' => 'Rizkian Syah',
            'email' => null,
        ]);



        $astuti = User::create([
            'name' => 'Tea Astuti',
            'email' => 'astutii@gmail.com',
            'phone' => '080001230043',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);

        StudentModel::create([
            'fullname' => 'Tea Astuti',
            'birthdate' => '2003-06-02',
            'gender' => 'male',
            'school' => 'SMK UMK',
            'address' => 'Dersalam',
            'user_id' => $astuti->id,   // users.id (student)
            'parent_id' => null,
            'class_id' => $kelasKato->id,
            'status_siswa' => 'active',
        ]);
        StudentModel::create([
            'fullname' => 'Apip Rizki',
            'birthdate' => '2004-12-12',
            'gender' => 'male',
            'school' => 'SMK 2 Kudus',
            'address' => 'Desa Desus',
            'parent_id' => $ortuApipParent->id, // parents.id (Bapaknya Apip)
            'class_id' => $kelasKato->id,
            'status_siswa' => 'active',
            'user_id' => null,
        ]);
        // STUDENT
        $tegar = User::create([
            'name' => 'Tegar Mohammad',
            'email' => null,
            'phone' => '088888777777',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);
        StudentModel::create([
            'fullname' => 'Tegar Mohammad',
            'birthdate' => '2003-06-02',
            'gender' => 'male',
            'school' => 'SMK Telkom',
            'address' => 'Dersalam',
            'user_id' => $tegar->id,   // users.id (student)
            'parent_id' => $ortuTegarParent->id,
            'class_id' => $kelasKato->id,
            'status_siswa' => 'active',
        ]);

        StudentModel::create([
            'fullname' => 'Ilham Dwi',
            'birthdate' => '2003-08-17',
            'gender' => 'male',
            'school' => 'SMK Bae',
            'address' => 'Desa Desus',
            'parent_id' => $ortuTegarParent->id, // SAMA dengan Tegar
            'class_id' => $kelasKato->id,
            'status_siswa' => 'active',
            'user_id' => null,
        ]);
        StudentModel::create([
            'fullname' => 'Rifki Zakaria',
            'birthdate' => '2003-03-09',
            'gender' => 'male',
            'school' => 'SMK Mayong',
            'address' => 'Desa Desus',
            'parent_id' => $ortuTegarParent->id, // SAMA dengan Tegar
            'class_id' => $kelasKato->id,
            'status_siswa' => 'active',
            'user_id' => null,
        ]);
        StudentModel::create([
            'fullname' => 'Mahir Mahendra',
            'birthdate' => '1999-04-29',
            'gender' => 'male',
            'school' => 'SMA Kesambi',
            'address' => 'Desa Desus',
            'parent_id' => $ortuTegarParent->id, // SAMA dengan Tegar
            'class_id' => $kelasKato->id,
            'status_siswa' => 'active',
            'user_id' => null,
        ]);
        StudentModel::create([
            'fullname' => 'Nazhat Zain',
            'birthdate' => '2004-06-19',
            'gender' => 'male',
            'school' => 'SMA 1 Jekulo',
            'address' => 'Desa Jekulo',
            'parent_id' => $ortuTegarParent->id, // SAMA dengan Tegar
            'class_id' => $kelasKato->id,
            'status_siswa' => 'active',
            'user_id' => null,
        ]);
        StudentModel::create([
            'fullname' => 'Zulfikar Alex',
            'birthdate' => '2002-02-17',
            'gender' => 'male',
            'school' => 'SMA Pati',
            'address' => 'Desa Sukolilo',
            'parent_id' => $ortuTegarParent->id, // SAMA dengan Tegar
            'class_id' => $kelasKato->id,
            'status_siswa' => 'active',
            'user_id' => null,
        ]);
        StudentModel::create([
            'fullname' => 'Galih Mukti',
            'birthdate' => '2003-12-29',
            'gender' => 'male',
            'school' => 'SMA Pati',
            'address' => 'Desa Sukolilo',
            'parent_id' => $ortuTegarParent->id, // SAMA dengan Tegar
            'class_id' => $kelasKato->id,
            'status_siswa' => 'active',
            'user_id' => null,
        ]);
        StudentModel::create([
            'fullname' => 'Dalief Alfuad',
            'birthdate' => '2002-02-01',
            'gender' => 'male',
            'school' => 'SMK Bandung',
            'address' => 'Desa Desus',
            'parent_id' => $ortuTegarParent->id, // SAMA dengan Tegar
            'class_id' => $kelasKato->id,
            'status_siswa' => 'active',
            'user_id' => null,
        ]);


        // STUDENT
        $ortu = User::create([
            'name' => 'Rusichan Atik',
            'email' => 'roesichan@gmail.com',
            'phone' => '085876146389',
            'password' => bcrypt('password'),
            'role' => 'ortu',
        ]);

        $ortuYayanIma = ParentModel::create([
            'user_id' => $ortu->id,   // users.id (student)
            'name' => 'Rusichan Atik',
            'email' => 'roesichan@gmail.com',
        ]);
        // STUDENT
        $yayan = User::create([
            'name' => 'Zayyan Cahya',
            'email' => 'zayyan@gmail.com',
            'phone' => '085156415753',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);

        StudentModel::create([
            'fullname' => 'Zayyan Cahya',
            'birthdate' => '2004-10-21',
            'gender' => 'male',
            'school' => 'SMK RUS Kudus',
            'address' => 'Wergu Kulon',
            'parent_id' => $ortuYayanIma->id,
            'class_id' => 2,
            'status_siswa' => 'active',
            'user_id' => $yayan->id,
        ]);
        $halimah = User::create([
            'name' => 'Halimah Assabadiyyah',
            'email' => 'zayyan@gmail.com',
            'phone' => '085115552355',
            'password' => bcrypt('password'),
            'role' => 'student',
        ]);

        StudentModel::create([
            'fullname' => 'Halimah Assabadiyyah',
            'birthdate' => '2006-11-25',
            'gender' => 'female',
            'school' => 'SMK 1 Kudus',
            'address' => 'Wergu Kulon',
            'parent_id' => $ortuYayanIma->id,
            'class_id' => 2,
            'status_siswa' => 'active',
            'user_id' => $halimah->id,
        ]);


    }
}

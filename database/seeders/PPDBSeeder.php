<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PpdbApplication;
use Carbon\Carbon;

class PPDBSeeder extends Seeder
{
    public function run(): void
    {
        // ================= DATA REAL PPDB KUDUS =================

        PpdbApplication::create([
            'fullname' => 'Ahmad Fauzan',
            'birthdate' => '2010-03-12',
            'gender' => 'male',

            'school' => 'SMP Negeri 1 Kudus',
            'student_email' => 'ahmadfauzan@gmail.com',

            'address' => 'Jl. Jenderal Sudirman No. 21, Kudus',
            'phone' => '081232308987',

            'parent_name' => 'Hadi Santoso',
            'parent_phone' => '081298760001',
            'parent_email' => 'hadi@gmail.com',

            'applicant_type' => 'student',

            'status' => 'approved',
            'validated_at' => Carbon::now()->subDays(14),
            'validated_by' => 1,

            'admin_note' => 'Berkas lengkap dan valid',
        ]);

        PpdbApplication::create([
            'fullname' => 'Siti Rahmawati',
            'birthdate' => '2010-07-25',
            'gender' => 'female',

            'school' => 'SMP NU Banat Kudus',
            'student_email' => 'sitirahma@gmail.com',

            'address' => 'Jl. Sunan Kudus No. 45, Kudus',
            'phone' => '088876565677',

            'parent_name' => 'Abdul Rahman',
            'parent_phone' => '081298760002',
            'parent_email' => 'rahman@gmail.com',

            'applicant_type' => 'student',

            'status' => 'approved',
            'validated_at' => Carbon::now()->subDays(10),
            'validated_by' => 1,

            'admin_note' => 'Prestasi akademik baik',
        ]);

        PpdbApplication::create([
            'fullname' => 'Dimas Prakoso',
            'birthdate' => '2011-01-18',
            'gender' => 'male',

            'school' => 'SMP Negeri 3 Kudus',
            'student_email' => 'dimasprakoso@gmail.com',

            'address' => 'Jl. Ahmad Yani No. 78, Kudus',
            'phone' => '089383757677',

            'parent_name' => 'Sutrisno',
            'parent_phone' => '089856378988',
            'parent_email' => 'sutrisno@gmail.com',

            'applicant_type' => 'student',

            'status' => 'submitted',
            'validated_at' => null,
            'validated_by' => null,

            'admin_note' => null,
        ]);

        PpdbApplication::create([
            'fullname' => 'Ratna Wulandari',
            'birthdate' => '2009-11-05',
            'gender' => 'female',

            'school' => 'SMP Negeri 2 Kudus',
            'student_email' => 'rinaw@gmail.com',

            'address' => 'Jl. Pemuda No. 19, Kudus',
            'phone' => '08777765678',

            'parent_name' => 'Sri Wulandari',
            'parent_phone' => '081298760004',
            'parent_email' => 'sri@gmail.com',

            'applicant_type' => 'student',

            'status' => 'approved',
            'validated_at' => Carbon::now()->subDays(7),
            'validated_by' => 1,

            'admin_note' => 'Lolos seleksi zonasi',
        ]);

        PpdbApplication::create([
            'fullname' => 'Bagus Setiawan',
            'birthdate' => '2008-09-14',
            'gender' => 'male',

            'school' => 'SMK Negeri 2 Kudus',
            'student_email' => 'bagusset@gmail.com',

            'address' => 'Jl. Gatot Subroto No. 52, Kudus',
            'phone' => '088765365459',

            'parent_name' => 'Setyo Nugroho',
            'parent_phone' => '081298760005',
            'parent_email' => 'setyo@gmail.com',

            'applicant_type' => 'college_student',

            'status' => 'approved',
            'validated_at' => Carbon::now()->subDays(5),
            'validated_by' => 1,

            'admin_note' => 'Pindahan dari SMK',
        ]);

        PpdbApplication::create([
            'fullname' => 'Fajar Hidayat',
            'birthdate' => '2007-02-20',
            'gender' => 'male',

            'school' => 'SMK Muhammadiyah Kudus',
            'student_email' => 'fajarh@gmail.com',

            'address' => 'Jl. Lingkar Timur No. 88, Kudus',
            'phone' => '083123674635',

            'parent_name' => 'Hidayatullah',
            'parent_phone' => '081298760006',
            'parent_email' => 'hidayat@gmail.com',

            'applicant_type' => 'worker',

            'status' => 'rejected',
            'validated_at' => Carbon::now()->subDays(3),
            'validated_by' => 1,

            'admin_note' => 'Berkas tidak lengkap',
        ]);

        PpdbApplication::create([
            'fullname' => 'Nadia Putri Lestari',
            'birthdate' => '2010-05-30',
            'gender' => 'female',

            'school' => 'SMP Negeri 5 Kudus',
            'student_email' => 'nadiaputri@gmail.com',

            'address' => 'Jl. AKBP R Agil Kusumadya No. 12, Kudus',
            'phone' => '089898678767',

            'parent_name' => 'Dwi Lestari',
            'parent_phone' => '081298760007',
            'parent_email' => 'dwi@gmail.com',

            'applicant_type' => 'student',

            'status' => 'submitted',
            'validated_at' => null,
            'validated_by' => null,

            'admin_note' => null,
        ]);

        PpdbApplication::create([
            'fullname' => 'Arif Maulana',
            'birthdate' => '2009-12-08',
            'gender' => 'male',

            'school' => 'SMP Kristen 1 Kudus',
            'student_email' => 'arifm@gmail.com',

            'address' => 'Jl. Kudus - Jepara No. 64, Kudus',
            'phone' => '083123254757',

            'parent_name' => 'Maulana Hasan',
            'parent_phone' => '081298760008',
            'parent_email' => 'maulana@gmail.com',

            'applicant_type' => 'student',

            'status' => 'approved',
            'validated_at' => Carbon::now()->subDays(6),
            'validated_by' => 1,

            'admin_note' => 'Nilai raport memenuhi',
        ]);

        PpdbApplication::create([
            'fullname' => 'Rizki Ananda',
            'birthdate' => '2008-04-17',
            'gender' => 'female',

            'school' => 'SMP Negeri 4 Kudus',
            'student_email' => 'rizkian@gmail.com',

            'address' => 'Jl. Sunan Kudus No. 99, Kudus',
            'phone' => '08776523456',

            'parent_name' => 'Yanto',
            'parent_phone' => '081298760009',
            'parent_email' => 'yanto@gmail.com',

            'applicant_type' => 'college_student',

            'status' => 'submitted',
            'validated_at' => null,
            'validated_by' => null,

            'admin_note' => null,
        ]);

        PpdbApplication::create([
            'fullname' => 'Yoga Pratama',
            'birthdate' => '2007-06-11',
            'gender' => 'male',

            'school' => 'SMK Negeri 1 Kudus',
            'student_email' => 'yogap@gmail.com',

            'address' => 'Jl. Pemuda No. 33, Kudus',
            'phone' => '083231334876',

            'parent_name' => 'Pratama Wijaya',
            'parent_phone' => '081298760010',
            'parent_email' => 'wijaya@gmail.com',

            'applicant_type' => 'worker',

            'status' => 'approved',
            'validated_at' => Carbon::now()->subDays(4),
            'validated_by' => 1,

            'admin_note' => 'Pekerja aktif, memenuhi syarat',
        ]);
    }
}

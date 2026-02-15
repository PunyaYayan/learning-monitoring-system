<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        $guruNames = [
            'Ahmad Fauzi',
            'Budi Santoso',
            'Dimas Saputra',
            'Rizky Ramadhan',
            'Andi Pratama',
        ];

        $ortuNames = [
            'Siti Aisyah',
            'Nurul Hidayah',
            'Putri Ayu',
            'Dewi Lestari',
            'Intan Permata',
            'Nabila Zahra',
            'Fitri Handayani',
            'Sarah Amelia',
            'Lina Marlina',
            'Sri Wahyuni',
            'Ratna Sari',
            'Maya Puspita',
            'Desi Anggraini',
            'Yuliana Putri',
            'Citra Dewi',
            'Novi Rahmawati',
            'Ayu Kartika',
            'Melati Indah',
            'Yuliana Sari',
            'Rina Oktavia',
        ];

        $siswaNames = [
            'Ahmad Fikri',
            'Rizky Ramadhan',
            'Daffa Pratama',
            'Fauzan Maulana',
            'Kevin Ardian',
            'Raka Aditya',
            'Iqbal Firmansyah',
            'Haidar Ali',
            'Naufal Azmi',
            'Akbar Setiawan',
            'Alya Putri',
            'Zahra Aulia',
            'Nisa Khairunnisa',
            'Salsabila Rahma',
            'Amelia Putri',
            'Nadya Safitri',
            'Cindy Oktavia',
            'Anisa Rahma',
            'Rani Kusuma',
            'Putri Maharani',
            'Bagas Saputra',
            'Reno Kurniawan',
            'Dion Prakoso',
            'Arman Hidayat',
            'Fikri Alamsyah',
            'Rizal Akbar',
            'Ilman Hakim',
            'Zidan Arif',
            'Farrel Nugraha',
            'Rafi Alvaro',
            'Syifa Nabila',
            'Hana Zahira',
            'Keysha Anindya',
            'Salma Azzahra',
            'Nayla Khadijah',
            'Aira Humaira',
            'Kayla Safira',
            'Zara Amalia',
            'Nabila Salsabila',
            'Azka Rahman',
        ];
        // GURU
        foreach ($guruNames as $i) {
            User::create([
                'name' => array_shift($guruNames),
                'email' => strtolower(str_replace(' ', '.', 'guru' . $i)) . '@mail.test',
                'password' => bcrypt('password'),
                'phone' => '08' . rand(1000000000, 9999999999),
                'role' => 'guru',
            ]);
        }

        // ORANG TUA
        foreach (range(1, 20) as $i) {
            User::create([
                'name' => array_shift($ortuNames),
                'email' => strtolower(str_replace(' ', '.', 'ortu' . $i)) . '@mail.test',
                'password' => bcrypt('password'),
                'phone' => '08' . rand(1000000000, 9999999999),
                'role' => 'ortu',
            ]);
        }

        // SISWA LOGIN (20 dari 40 siswa)
        foreach (range(1, 20) as $i) {
            User::create([
                'name' => array_shift($siswaNames),
                'email' => strtolower(str_replace(' ', '.',$i)) . '@mail.test',
                'password' => bcrypt('password'),
                'phone' => '08' . rand(1000000000, 9999999999),
                'role' => 'student',
            ]);
        }
    }
}

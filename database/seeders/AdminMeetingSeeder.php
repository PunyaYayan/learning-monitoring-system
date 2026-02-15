<?php

namespace Database\Seeders;

use App\Models\MeetingModel;
use App\Models\ClassModel;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class AdminMeetingSeeder extends Seeder
{
    public function run(): void
    {
        /* ===============================
           BANK MATERI PER LEVEL
        ================================ */

        $basic = [
            'Alphabet & Phonics',
            'Basic Vocabulary',
            'Greetings Practice',
            'Simple Songs',
            'Daily Words',
            'Basic Conversation',
        ];

        $beginner = [
            'Sentence Structure',
            'Present Tense',
            'Describing People',
            'Daily Routine',
            'Role Play',
            'Listening Exercise',
        ];

        $intermediate = [
            'Past Experience',
            'Discussion Practice',
            'Formal Speaking',
            'Essay Writing',
            'Listening Advanced',
            'Presentation Skill',
        ];

        // Level 10–12
        $advanced = [
            'Public Speaking',
            'Business English',
            'Interview Simulation',
            'Debate Practice',
            'Academic Writing',
            'Negotiation Skill',
            'Mock Test',
            'Professional Presentation',
        ];

        /* ===============================
           CATATAN RANDOM
        ================================ */

        $notes = [
            'Siswa aktif dalam diskusi.',
            'Latihan speaking berjalan baik.',
            'Perlu peningkatan listening.',
            'Diskusi kelompok efektif.',
            'Evaluasi materi sebelumnya.',
            'Partisipasi meningkat.',
        ];

        /* ===============================
           POLA JADWAL (2x SEMINGGU)
        ================================ */

        $schedules = [
            [1, 4], // Senin - Kamis
            [2, 5], // Selasa - Jumat
            [3, 6], // Rabu - Sabtu
        ];

        /* ===============================
           LOOP PER KELAS
        ================================ */

        foreach (ClassModel::all() as $class) {

            $level = $class->level;

            /* ===============================
               PILIH MATERI BERDASARKAN LEVEL
            ================================ */

            if ($level >= 1 && $level <= 3) {
                $materials = $basic;
            } elseif ($level >= 4 && $level <= 6) {
                $materials = $beginner;
            } elseif ($level >= 7 && $level <= 9) {
                $materials = $intermediate;
            } else {
                $materials = $advanced;
            }

            /* ===============================
               PILIH JADWAL KELAS
            ================================ */

            $schedule = $schedules[array_rand($schedules)];

            /* ===============================
               SETUP WAKTU
            ================================ */

            $startDate = now()->subWeeks(6); // mulai 6 minggu lalu

            $current = $startDate->copy();

            $maxMeeting = 12; // ± 1.5 bulan (2x / minggu)

            $meetingIndex = 0;

            /* ===============================
               BUAT MEETING (FOR LOOP)
            ================================ */

            for ($i = 0; $i < $maxMeeting; $i++) {

                // Tentukan hari (bergantian)
                $day = $schedule[$i % 2];

                // Cari tanggal berikutnya sesuai hari
                $date = $current->copy()->next($day);

                // Ambil materi (muter kalau habis)
                $material = $materials[
                    $meetingIndex % count($materials)
                ];

                MeetingModel::create([
                    'class_id' => $class->id,
                    'teacher_id' => $class->teacher_id,

                    'meeting_date' => $date,

                    'material' => $material,

                    'note' => $notes[array_rand($notes)],
                ]);

                $meetingIndex++;

                // Pindah minggu tiap 2 meeting
                if ($i % 2 == 1) {
                    $current->addWeek();
                }
            }
        }
    }
}

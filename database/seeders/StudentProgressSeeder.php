<?php

namespace Database\Seeders;

use App\Models\StudentProgressModel;
use App\Models\MeetingModel;
use Illuminate\Database\Seeder;

class StudentProgressSeeder extends Seeder
{
    public function run(): void
    {
        foreach (MeetingModel::with('class.students')->get() as $meeting) {
            foreach ($meeting->class->students as $student) {
                $progress_value = 0;
                if (rand(0, 0.5) === 0) {
                    $progress_value = rand(60, 100);
                } else {
                    $progress_value = 0;
                }
                // if (rand(0, 1) === 0) {
                //     $progress_value = 0;
                // } else {
                //     $progress_value = rand(60, 100);
                // }

                StudentProgressModel::updateOrCreate(
                    [
                        'meeting_id' => $meeting->id,
                        'student_id' => $student->id,
                    ],
                    [
                        'progress_value' => $progress_value,
                        'progress_note' => $this->randomNote($progress_value),
                    ]
                );
            }
        }
    }
    private function randomNote(int $progress_value): ?string
    {
        $randomValue = [];
        if ($progress_value == 0) {
            $messages = [
                'Izin',
                'Sakit',
                'Alpha',
            ];
        } elseif ($progress_value < 40) {
            $messages = [
                'Pemahaman materi masih sangat terbatas.',
                'Membutuhkan pendampingan intensif dan pengulangan materi.',
                'Belum mampu mengikuti alur pembelajaran secara mandiri.',
                'Perlu latihan dasar yang lebih terstruktur.',
                'Kesulitan memahami konsep inti pembelajaran.',
            ];
        } elseif ($progress_value < 60) {
            $messages = [
                'Pemahaman materi masih perlu ditingkatkan.',
                'Mulai memahami konsep dasar namun belum konsisten.',
                'Perlu penguatan khusus pada aspek speaking.',
                'Mampu mengikuti pembelajaran dengan bantuan.',
                'Masih memerlukan bimbingan tambahan secara berkala.',
            ];
        } elseif ($progress_value < 80) {
            $messages = [
                'Pemahaman materi sudah cukup baik.',
                'Mampu mengikuti pembelajaran dengan lancar.',
                'Mulai aktif berpartisipasi dalam kelas.',
                'Menunjukkan perkembangan yang stabil.',
                'Dapat menerapkan materi dalam latihan.',
            ];
        } else {
            $messages = [
                'Sangat memahami materi yang diajarkan.',
                'Aktif bertanya dan berdiskusi selama pembelajaran.',
                'Menunjukkan kemandirian dan kepercayaan diri.',
                'Mampu menerapkan materi secara konsisten.',
                'Perkembangan belajar sangat baik.',
            ];
        }

        $randomValue = $messages[array_rand($messages)];

        return $randomValue;
    }
}

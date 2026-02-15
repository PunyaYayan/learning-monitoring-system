<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentProgressModel extends Model
{
    protected $table = 'student_progress';

    protected $fillable = [
        'meeting_id',
        'student_id',
        'progress_note',
        'progress_value',
    ];

    public function getProgressLabelAttribute(): string
    {
        $value = $this->progress_value;

        return match (true) {
            $value === null => 'Belum Dinilai',
            $value === 0 => 'Tidak Hadir',
            $value < 60 => 'Penguasaan Dasar',
            $value < 80 => 'Penguasaan Cukup',
            default => 'Penguasaan Baik',
        };
    }


    public function meeting()
    {
        return $this->belongsTo(MeetingModel::class);
    }

    public function student()
    {
        return $this->belongsTo(StudentModel::class);
    }
}

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
        'status',
    ];

    public function meeting()
    {
        return $this->belongsTo(MeetingModel::class);
    }

    public function student()
    {
        return $this->belongsTo(StudentModel::class);
    }
}

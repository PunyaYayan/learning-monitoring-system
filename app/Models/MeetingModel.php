<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeetingModel extends Model
{
    protected $table = 'meetings';

    protected $fillable = [
        'class_id',
        'teacher_id',
        'meeting_date',
        'material',
        'note',
    ];

    public function class()
    {
        return $this->belongsTo(ClassModel::class);
    }

    public function teacher()
    {
        return $this->belongsTo(TeacherModel::class);
    }

    public function progresses()
    {
        return $this->hasMany(StudentProgressModel::class);
    }
}


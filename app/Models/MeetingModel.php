<?php

namespace App\Models;
use App\Models\StudentProgressModel;

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
    protected $casts = [
        'meeting_date' => 'date',
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
        return $this->hasMany(
            StudentProgressModel::class,
            'meeting_id',
            'id'
        );
    }
}


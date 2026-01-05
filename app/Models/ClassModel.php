<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    // Karena tabelnya  'classes' dan modelnya 'ClassModel'
    protected $table = 'classes';
    protected $fillable = [
        'name',
        'level',
        'schedule_note',
        'teacher_id'
    ];

    public const LEVELS = [
        1 => 'Pre School Level',
        2 => 'Pre Introduction Level',
        3 => 'Introduction Level',
        4 => 'Pre Beginner Level',
        5 => 'Beginner Level',
        6 => 'Elementary Level',
        7 => 'Pre Intermediate Level',
        8 => 'Intermediate Level',
        9 => 'Higher Intermediate Level',
        10 => 'Advanced Level',
        11 => 'Conversation For School',
        12 => 'Conversation For Adult',
    ];
    public function students()
    {
        return $this->hasMany(StudentModel::class, 'class_id');
    }

    public function teacher()
    {
        return $this->belongsTo(TeacherModel::class, 'teacher_id');
    }
    public function meetings()
    {
        return $this->hasMany(MeetingModel::class, 'class_id');
    }
    public function getLevelLabelAttribute()
    {
        return self::LEVELS[$this->level] ?? '-';
    }
}
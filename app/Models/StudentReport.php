<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentReport extends Model
{
    protected $fillable = [
        'student_id',
        'class_id',
        'report_period_id',
        'listening_score',
        'speaking_score',
        'reading_score',
        'writing_score',
        'final_score',
        'teacher_note',
        'is_locked',
    ];
    
    public function student()
    {
        return $this->belongsTo(StudentModel::class, 'student_id');
    }

    public function period()
    {
        return $this->belongsTo(ReportPeriod::class, 'report_period_id');
    }

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }
}
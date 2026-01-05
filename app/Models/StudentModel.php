<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentModel extends Model
{
    // Karena tabelnya  'students' dan modelnya 'StudentModel'
    protected $table = 'students';
    protected $fillable = [
        'fullname',
        'birthdate',
        'gender',
        'school',
        'address',
        'parent_id',
        'user_id',
        'class_id',
        'status_siswa',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(ParentModel::class, 'parent_id');
    }
    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }
    public function meetings()
    {
        return $this->belongsToMany(MeetingModel::class, 'student_progress', 'student_id', 'meeting_id')->withPivot(['progress_note', 'status'])->withTimestamps();
    }

}

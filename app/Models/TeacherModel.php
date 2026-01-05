<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherModel extends Model
{
    // Karena tabelnya  'teachers' dan modelnya 'TeacherModel'
    protected $table = 'teachers';
    protected $fillable = [
        'user_id',
        'bio',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // Guru mengajar banyak kelas
    public function classes()
    {
        return $this->hasMany(ClassModel::class, 'teacher_id');
    }

    // Guru melakukan banyak pertemuan
    public function meetings()
    {
        return $this->hasMany(MeetingModel::class, 'teacher_id');
    }
}

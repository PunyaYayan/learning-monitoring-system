<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
        // Karena tabelnya  'classes' dan modelnya 'ClassModel'
    protected $table = 'classes';
    protected $fillable = ['name', 'level', 'schedule_note'];

    public function students(){
        return $this->hasMany(StudentModel::class, 'class_id');
    }
}
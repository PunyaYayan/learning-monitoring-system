<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentModel extends Model
{
    // Karena tabelnya  'students' dan modelnya 'StudentModel'
    protected $table = 'students';

    public function parent()
    {
        return $this->belongsTo(ParentModel::class, 'parent_id');
    }
    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }
}

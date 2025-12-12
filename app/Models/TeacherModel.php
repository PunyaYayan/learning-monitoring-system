<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherModel extends Model
{
    // Karena tabelnya  'teachers' dan modelnya 'TeacherModel'
    protected $table = 'teachers';

    public function user(){
        return $this->belongsTo(User::class);
    }
}

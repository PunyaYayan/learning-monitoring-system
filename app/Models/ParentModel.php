<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParentModel extends Model
{
    // Karena tabelnya  'parents' dan modelnya 'ParentModel'
    protected $table = 'parents';
    protected $fillable = [
        'user_id',
        'name',
        'email',
    ];

    public function students()
    {
        return $this->hasMany(StudentModel::class, 'parent_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
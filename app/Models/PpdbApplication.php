<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PpdbApplication extends Model
{
    protected $fillable = [
        'fullname',
        'birthdate',
        'gender',
        'school',
        'student_email',
        'address',
        'phone',

        'parent_name',
        'parent_phone',
        'parent_email',

        'applicant_type',

        'status',
        'validated_at',
        'validated_by',
        'admin_note',
    ];

    protected $casts = [
        'validated_at' => 'date',
    ];
    public function validator()
    {
        return $this->belongsTo(User::class, 'validated_by');
    }
    // Accessor: untuk tampil di UI
    public function getApplicantTypeLabelAttribute(): string
    {
        return match ($this->applicant_type) {
            'student' => 'Student',
            'college_student' => 'College Student',
            'worker' => 'Worker',
            default => ucfirst($this->applicant_type),
        };
    }

}

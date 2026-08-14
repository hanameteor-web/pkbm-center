<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Student;
use App\Models\SchoolClass;

class Attendance extends Model
{
    protected $fillable = [
        'student_id',
        'school_class_id',
        'date',
        'status',
        'note',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function schoolClass()
    {
        return $this->belongsTo(
            SchoolClass::class,
            'school_class_id'
        );
    }
}
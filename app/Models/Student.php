<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name',
        'nis',
        'class_id',
        'address',
        'photo',
    ];


    public function schoolClass()
    {
        return $this->belongsTo(
            SchoolClass::class,
            'class_id'
        );
    }


    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}
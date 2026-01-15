<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    protected $fillable = [
        'class_name','academic_session','board','medium','sections',
        'total_students','boys','girls','expected_admissions',
        'subjects','publisher','syllabus'
    ];
}

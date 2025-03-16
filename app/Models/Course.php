<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_name', 'description', 'duration', 'fee', 'tutor_id', 'status','student_id'
    ];

    public function tutor()
    {
        return $this->belongsTo(Tutor::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}

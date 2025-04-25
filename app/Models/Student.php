<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'city',
        'state',
        'country',
        'pincode',
        'phone',
        'guardian_name',
        'guardian_phone',
        'dob',
        'gender',
        'address',
        'education_level',
        'subjects',
        'achievements',
        'school_name',
        'resources',
        'skills',
        'interests',
    ];


    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tutors()
    {
        return $this->belongsToMany(Tutor::class, 'student_tutor');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'student_tutor', 'student_id', 'course_id')->withTimestamps();
    }

    public function enrollments()
    {
        return $this->belongsToMany(Enrollment::class, 'enrollments');
    }

    
}

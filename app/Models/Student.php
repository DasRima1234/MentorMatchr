<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
    use HasFactory,Notifiable;

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
}

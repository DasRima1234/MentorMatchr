<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'phone', 'gender', 'dob', 'qualification',
        'subject_specialization', 'experience', 'bio', 'profile_picture',
        'status', 'hourly_rate', 'availability', 'address',
        'city', 'state', 'country'];

        protected $casts = [
            'availability' => 'array',
            'dob' => 'date',
        ];

}

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
        public function user()
        {
            return $this->belongsTo(User::class);
        }
    
        public function students()
        {
            return $this->belongsToMany(Student::class, 'student_tutor');
        }
}

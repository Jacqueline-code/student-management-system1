<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'student_number',
        'first_name',
        'last_name',
        'email',
        'phone',
        'programme',
        'year_of_study',
        'status',
    ];

    // A student belongs to one user account.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A student can have many course registrations.
    public function registrations()
    {
        return $this->hasMany(CourseRegistration::class);
    }

    // Combines first and last name.
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_code',
        'course_name',
        'description',
        'credit_units',
        'lecturer_id',
        'is_open',
    ];

    protected function casts(): array
    {
        return [
            'is_open' => 'boolean',
        ];
    }

    // A course belongs to one lecturer.
    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }

    // A course can have many registrations.
    public function registrations()
    {
        return $this->hasMany(CourseRegistration::class);
    }
}
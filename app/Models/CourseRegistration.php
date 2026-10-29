<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'course_id',
        'academic_year',
        'semester',
        'status',
    ];

    // Registration belongs to one student.
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Registration belongs to one course.
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
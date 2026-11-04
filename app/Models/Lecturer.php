<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'staff_number',
        'first_name',
        'last_name',
        'email',
        'department',
        'phone',
    ];

    // A lecturer belongs to one user account.
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // A lecturer can teach many courses.
    public function courses()
    {
        return $this->hasMany(Course::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}

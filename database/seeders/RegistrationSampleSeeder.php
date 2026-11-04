<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Lecturer;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class RegistrationSampleSeeder extends Seeder
{
    // Safe to run again: it updates records instead of duplicating them.
    public function run(): void
    {
        $lecturerUser = User::where('email', 'lecturer@campus.test')->firstOrFail();
        $studentUser = User::where('email', 'student@campus.test')->firstOrFail();

        // Lecturer 1: linked to the lecturer login.
        $lecturer = Lecturer::where('user_id', $lecturerUser->id)->first()
            ?? Lecturer::updateOrCreate(
                ['staff_number' => 'LEC001'],
                [
                    'user_id' => $lecturerUser->id,
                    'first_name' => 'Test',
                    'last_name' => 'Lecturer',
                    'email' => 'lecturer@campus.test',
                    'department' => 'Business Computing',
                    'phone' => '0700000001',
                ]
            );

        // Lecturer 2: no login, used to test that lecturers cannot see each other's classes.
        $otherLecturer = Lecturer::updateOrCreate(
            ['staff_number' => 'LEC002'],
            [
                'user_id' => null,
                'first_name' => 'Other',
                'last_name' => 'Lecturer',
                'email' => 'other.lecturer@campus.test',
                'department' => 'Information Technology',
                'phone' => '0700000002',
            ]
        );

        // Five students. The first one is linked to the student login.
        $students = [
            ['STU001', 'Test', 'Student', 'student@campus.test', $studentUser->id],
            ['STU002', 'Mary', 'Nabirye', 'mary@campus.test', null],
            ['STU003', 'Peter', 'Mugisha', 'peter@campus.test', null],
            ['STU004', 'Sarah', 'Atim', 'sarah@campus.test', null],
            ['STU005', 'David', 'Ssemanda', 'david@campus.test', null],
        ];

        foreach ($students as [$number, $first, $last, $email, $userId]) {
            if ($userId && Student::where('user_id', $userId)->exists()) {
                continue; // that login already has a student record
            }

            Student::updateOrCreate(
                ['student_number' => $number],
                [
                    'user_id' => $userId,
                    'first_name' => $first,
                    'last_name' => $last,
                    'email' => $email,
                    'programme' => 'Bachelor of Business Computing',
                    'year_of_study' => 3,
                    'status' => 'active',
                ]
            );
        }

        // Courses: four for Lecturer 1, one for Lecturer 2, one closed course.
        $courses = [
            ['BUC3130', 'Mobile Application Development', 4, true, $lecturer->id],
            ['BUC3131', 'Advanced Web Application Development', 4, true, $lecturer->id],
            ['BUC3132', 'Database Management Systems', 3, true, $lecturer->id],
            ['BUC3133', 'Systems Analysis and Design', 3, true, $lecturer->id],
            ['BUC3134', 'Closed Sample Course', 3, false, $lecturer->id],
            ['BUC3135', 'Sample Course of Another Lecturer', 3, true, $otherLecturer->id],
        ];

        foreach ($courses as [$code, $name, $units, $open, $lecturerId]) {
            Course::updateOrCreate(
                ['course_code' => $code],
                [
                    'course_name' => $name,
                    'description' => 'Sample course for testing.',
                    'credit_units' => $units,
                    'lecturer_id' => $lecturerId,
                    'is_open' => $open,
                ]
            );
        }

        // Sample registrations.
        $registrations = [
            ['STU002', 'BUC3130'],
            ['STU002', 'BUC3131'],
            ['STU003', 'BUC3132'],
            ['STU004', 'BUC3133'],
            ['STU005', 'BUC3131'],
            ['STU005', 'BUC3135'],
        ];

        foreach ($registrations as [$number, $code]) {
            $student = Student::where('student_number', $number)->first();
            $course = Course::where('course_code', $code)->first();

            if (! $student || ! $course) {
                continue;
            }

            CourseRegistration::updateOrCreate(
                [
                    'student_id' => $student->id,
                    'course_id' => $course->id,
                    'academic_year' => '2026/2027',
                    'semester' => '1',
                ],
                ['status' => 'registered']
            );
        }
    }
}

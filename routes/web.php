<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseRegistrationController;

// Public home page
Route::get('/', function () {
    return view('home');
})->name('home');

// Login page
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'loginSubmit'])
        ->name('login.submit');

});

// Routes accessible only after signing in
Route::middleware('auth')->group(function () {

    // Administrator dashboard
    Route::get('/admin/dashboard', function () {
        abort_unless(auth()->user()->role === 'admin', 403);

        return view('dashboards.admin');
    })->name('admin.dashboard');

    // Lecturer dashboard
    Route::get('/lecturer/dashboard', function () {
        abort_unless(auth()->user()->role === 'lecturer', 403);

        return view('dashboards.lecturer');
    })->name('lecturer.dashboard');

    // Student dashboard
    Route::get('/student/dashboard', function () {
        abort_unless(auth()->user()->role === 'student', 403);

        return view('dashboards.student');
    })->name('student.dashboard');

    // General dashboard redirect
    Route::get('/dashboard', function () {

        $role = strtolower(trim(auth()->user()->role ?? ''));

        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($role === 'lecturer') {
            return redirect()->route('lecturer.dashboard');
        }

        if ($role === 'student') {
            return redirect()->route('student.dashboard');
        }

        abort(403, 'Your account does not have a valid role.');

    })->name('dashboard');

    // Administrator: manage student records
    Route::middleware('role:admin')->group(function () {

        Route::resource('students', StudentController::class);

    });

    // Student: course registration
    Route::middleware('role:student')->group(function () {

        Route::get('/student/courses', [CourseRegistrationController::class, 'availableCourses'])
            ->name('student.courses');

        Route::post('/student/register-course', [CourseRegistrationController::class, 'store'])
            ->name('student.register-course');

        Route::get('/student/my-registrations', [CourseRegistrationController::class, 'myRegistrations'])
            ->name('student.my-registrations');

    });

    // Lecturer: assigned courses and registered students
    Route::middleware('role:lecturer')->group(function () {

        Route::get('/lecturer/my-courses', [CourseRegistrationController::class, 'lecturerCourses'])
            ->name('lecturer.my-courses');

        Route::get('/lecturer/courses/{course}/students', [CourseRegistrationController::class, 'lecturerStudents'])
            ->name('lecturer.course-students');

    });

    // Administrator: manage course registrations
    Route::middleware('role:admin')->group(function () {

        Route::get('/admin/registrations', [CourseRegistrationController::class, 'adminIndex'])
            ->name('admin.registrations');

        Route::delete('/admin/registrations/{registration}', [CourseRegistrationController::class, 'destroy'])
            ->name('admin.registrations.destroy');

    });

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LecturerController;

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

    // General dashboard URL: redirect to the correct role dashboard.
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

    // Only administrators can manage student records.
    Route::middleware('role:admin')->group(function () {
        Route::resource('students', StudentController::class);
    });

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

});


// Course listing: administrators and lecturers
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Administrator course management
    Route::resource('courses', CourseController::class)
        ->except(['index', 'show']);

    // Lecturer management
    Route::resource('lecturers', LecturerController::class);
});


// Course list and details for authenticated administrators and lecturers
Route::middleware('auth')->group(function () {

    Route::get('/courses', [CourseController::class, 'index'])
        ->name('courses.index');

    Route::get('/courses/{course}', [CourseController::class, 'show'])
        ->name('courses.show');

});
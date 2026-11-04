<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseRegistration;
use App\Models\Lecturer;
use App\Models\Student;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CourseRegistrationController extends Controller
{
    // The student linked to the logged-in account (by user_id only).
    private function currentStudent(): Student
    {
        $student = Student::where('user_id', auth()->id())->first();

        abort_unless(
            $student,
            403,
            'Your login account is not linked to a student record. Please contact the administrator.'
        );

        return $student;
    }

    // The lecturer linked to the logged-in account (by user_id only).
    private function currentLecturer(): Lecturer
    {
        $lecturer = Lecturer::where('user_id', auth()->id())->first();

        abort_unless(
            $lecturer,
            403,
            'Your login account is not linked to a lecturer record. Please contact the administrator.'
        );

        return $lecturer;
    }

    /* ------------------------------ STUDENT ------------------------------ */

    // Show open courses with a search box.
    public function availableCourses(Request $request)
    {
        $this->currentStudent();

        $search = $request->input('search');

        $courses = Course::with('lecturer')
            ->where('is_open', true)
            ->when($search, function ($query, $search) {
                $query->where(function ($sub) use ($search) {
                    $sub->where('course_code', 'like', "%{$search}%")
                        ->orWhere('course_name', 'like', "%{$search}%");
                });
            })
            ->orderBy('course_code')
            ->paginate(10)
            ->withQueryString();

        return view('registrations.available', compact('courses'));
    }

    // Register the logged-in student for an open course.
    public function store(Request $request)
    {
        $student = $this->currentStudent();

        $validated = $request->validate([
            'course_id' => ['required', 'integer', 'exists:courses,id'],

            'academic_year' => [
                'bail',
                'required',
                'regex:/^\d{4}\/\d{4}$/',
                function ($attribute, $value, $fail) {
                    [$from, $to] = explode('/', $value);

                    if ((int) $to !== (int) $from + 1) {
                        $fail('The academic year must use consecutive years, for example 2026/2027.');
                    }
                },
            ],

            'semester' => ['required', Rule::in(['1', '2'])],
        ]);

        $course = Course::findOrFail($validated['course_id']);

        if (! $course->is_open) {
            return back()->with('error', 'This course is closed for registration.');
        }

        // Duplicate check: same student, course, year and semester.
        $alreadyRegistered = CourseRegistration::where('student_id', $student->id)
            ->where('course_id', $course->id)
            ->where('academic_year', $validated['academic_year'])
            ->where('semester', $validated['semester'])
            ->exists();

        if ($alreadyRegistered) {
            return back()->with(
                'error',
                'You have already registered for this course in the selected semester.'
            );
        }

        try {
            CourseRegistration::create([
                'student_id' => $student->id, // from the login, never from the form
                'course_id' => $course->id,
                'academic_year' => $validated['academic_year'],
                'semester' => $validated['semester'],
                'status' => 'registered',
            ]);
        } catch (QueryException $e) {
            // The database unique key also blocks double clicks.
            if ($e->getCode() === '23000') {
                return back()->with('error', 'This registration already exists.');
            }

            throw $e;
        }

        return redirect()
            ->route('student.my-registrations')
            ->with('success', 'You have registered for ' . $course->course_code . ' successfully.');
    }

    // Show only the logged-in student's own registrations.
    public function myRegistrations()
    {
        $student = $this->currentStudent();

        $registrations = CourseRegistration::with('course')
            ->where('student_id', $student->id)
            ->latest()
            ->paginate(10);

        return view('registrations.mine', compact('registrations'));
    }

    /* ------------------------------- ADMIN ------------------------------- */

    // Show all registrations.
    public function adminIndex()
    {
        $registrations = CourseRegistration::with(['student', 'course'])
            ->latest()
            ->paginate(15);

        return view('registrations.index', compact('registrations'));
    }

    // Remove a registration.
    public function destroy(CourseRegistration $registration)
    {
        $registration->delete();

        return redirect()
            ->route('admin.registrations')
            ->with('success', 'Registration removed successfully.');
    }

    /* ------------------------------ LECTURER ----------------------------- */

    // List the courses assigned to the logged-in lecturer.
    public function lecturerCourses()
    {
        $lecturer = $this->currentLecturer();

        $courses = $lecturer->courses()
            ->withCount('registrations')
            ->orderBy('course_code')
            ->get();

        return view('registrations.lecturer-courses', compact('lecturer', 'courses'));
    }

    // List the students registered for one of the lecturer's own courses.
    public function lecturerStudents(Course $course)
    {
        $lecturer = $this->currentLecturer();

        // A lecturer must never see another lecturer's class list.
        abort_unless((int) $course->lecturer_id === (int) $lecturer->id, 403);

        $registrations = CourseRegistration::with('student')
            ->where('course_id', $course->id)
            ->orderBy('academic_year')
            ->orderBy('semester')
            ->paginate(15);

        return view('registrations.lecturer', compact('course', 'registrations'));
    }
}

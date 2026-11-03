<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lecturer;
use Illuminate\Http\Request;

// Display courses, Administrators see all courses and Lecturers see only their assigned courses.
class CourseController extends Controller
{
   public function index(Request $request) {
    $user = auth()->user();
    $query = Course::with('lecturer');

    if (strtolower($user->role) === 'lecturer'){
        $lecturer = Lecturer::where('user_id', $user->id)
        ->orWhere('email', $user->email)-> first();

        if ($lecturer) {
            $query->where('lecturer_id', $lecturer->id);
        } else{
            $query->whereRaw('1=0');
        }
    }
    $search = $request->input('search');

    $courses = $query->when($search, function ($query, $search){
        $query->where(function($subQuery)use ($search){
            $subQuery->where('course_code', 'like', "%{$search}%")
            ->orWhere('course_name', 'like', "%{$search}%")
            ->orWhere('description', 'like', "%{$search}%");
        });
    })
    ->latest()
    ->paginate(10)
    ->withQueryString();
    return view('courses.index', compact('courses'));
   }

   public function show(Course $course)
{
    $this->authorizeCourseAccess($course);
    $course->load('lecturer');
    return view('courses.show', compact('course'));
}

public function edit(Course $course)
{
    $this->authorizeCourseAccess($course);
    $lecturers = Lecturer::orderBy('first_name')->get();
    return view('courses.edit', compact('course', 'lecturers'));
}

   //Show the form for creating a course
   public function create(){
    $lecturers = Lecturer::orderBy('first_name')-> get();
    return view('courses.create', compact('lecturers'));
   }

// Store a new course
public function store(Request $request)
{
    $validated = $request->validate([
        'course_code' => [
            'required',
            'string',
            'max:50',
            'unique:courses,course_code'
        ],

        'course_name' => [
            'required',
            'string',
            'max:255',
        ],

        'description' => [
            'nullable',
            'string',
        ],

        'credit_units' => [
            'required',
            'integer',
            'min:1',
            'max:20',
        ],

        'lecturer_id' => [
            'nullable',
            'exists:lecturers,id',
        ],

        'is_open' => [
            'required',
            'boolean',
        ],
    ]);

    Course::create($validated);

    return redirect()
        ->route('courses.index')
        ->with('success', 'Course created successfully.');
}

   //Delete a course
   public function destroy(Course $course)
{
    if ($course->registrations()->exists()) {
        return redirect()
            ->route('courses.index')
            ->with('error', 'This course has student registrations. It cannot be deleted until those registrations are handled.');
    }

    $course->delete();

    return redirect()
        ->route('courses.index')
        ->with('success', 'Course deleted successfully.');
}


   //Ensure lecturers can only view their own courses
   private function authorizeCourseAccess(Course $course):void{
    $user = auth()->user();
    if (strtolower($user->role) === 'admin'){
        return;
    }
    if (strtolower($user->role) === 'lecturer') {
        $lecturer = Lecturer::where('user_id', $user->id)
        ->orWhere('email', $user->email)->first();
        abort_unless($lecturer && $course->lecturer_id === $lecturer->id, 403);
        return;
    }
    abort(403);
   }

}

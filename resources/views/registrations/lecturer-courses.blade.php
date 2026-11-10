@extends('layouts.app')

@section('title', 'My Class Lists')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-6">
        <p class="text-sm font-semibold text-blue-600 mb-2">Lecturer Portal</p>
        <h2 class="text-2xl font-bold">My Class Lists</h2>
        <p class="text-sm text-slate-500 mt-2">
            Courses assigned to {{ $lecturer->full_name }}. Open a course to see its registered students.
        </p>
    </div>

    <div class="page-card overflow-x-auto">
        <table class="w-full min-w-[600px]">
            <thead>
                <tr>
                    <th class="table-heading">Course Code</th>
                    <th class="table-heading">Course Name</th>
                    <th class="table-heading">Registered Students</th>
                    <th class="table-heading">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($courses as $course)
                    <tr>
                        <td class="table-cell font-semibold">{{ $course->course_code }}</td>
                        <td class="table-cell">{{ $course->course_name }}</td>
                        <td class="table-cell">{{ $course->registrations_count }}</td>
                        <td class="table-cell">
                            <a href="{{ route('lecturer.course-students', $course) }}"
                               class="text-blue-600 font-semibold hover:underline">
                                View students
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="table-cell text-center">No courses are assigned to you yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection

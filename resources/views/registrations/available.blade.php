@extends('layouts.app')

@section('title', 'Available Courses')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-6">
        <p class="text-sm font-semibold text-blue-600 mb-2">Student Portal</p>
        <h2 class="text-2xl font-bold">Available Courses</h2>
        <p class="text-sm text-slate-500 mt-2">Browse courses currently open for registration.</p>
    </div>

    <div class="page-card mb-6">
        <form method="GET" action="{{ route('student.courses') }}" class="flex gap-2">
            <input name="search" value="{{ request('search') }}" class="form-input" placeholder="Search by course code or name">
            <button class="btn-secondary" type="submit">Search</button>
        </form>
    </div>

    <div class="page-card overflow-x-auto">
        <table class="w-full min-w-[750px]">
            <thead>
                <tr>
                    <th class="table-heading">Course Code</th>
                    <th class="table-heading">Course Name</th>
                    <th class="table-heading">Credit Units</th>
                    <th class="table-heading">Lecturer</th>
                    <th class="table-heading">Registration</th>
                </tr>
            </thead>
            <tbody>
                @forelse($courses as $course)
                    <tr>
                        <td class="table-cell font-semibold">{{ $course->course_code }}</td>
                        <td class="table-cell">{{ $course->course_name }}</td>
                        <td class="table-cell">{{ $course->credit_units }}</td>
                        <td class="table-cell">{{ $course->lecturer?->full_name ?? 'Not assigned' }}</td>
                        <td class="table-cell">
                            <form method="POST" action="{{ route('student.register-course') }}" class="space-y-2">
                                @csrf
                                <input type="hidden" name="course_id" value="{{ $course->id }}">
                                <input name="academic_year" class="form-input" placeholder="2026/2027" pattern="[0-9]{4}/[0-9]{4}" required>
                                <select name="semester" class="form-input" required>
                                    <option value="">Select semester</option>
                                    <option value="1">Semester 1</option>
                                    <option value="2">Semester 2</option>
                                </select>
                                <button class="btn-primary" type="submit">Register</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="table-cell text-center">No open courses found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-5">{{ $courses->links() }}</div>
    </div>

    <div class="mt-5">
        <a href="{{ route('student.my-registrations') }}" class="btn-secondary">View My Registrations</a>
    </div>
</div>
@endsection

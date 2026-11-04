@extends('layouts.app')

@section('title', 'My Registrations')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-6">
        <p class="text-sm font-semibold text-blue-600 mb-2">Student Portal</p>
        <h2 class="text-2xl font-bold">My Course Registrations</h2>
        <p class="text-sm text-slate-500 mt-2">Your registered courses and academic periods.</p>
    </div>

    <div class="page-card overflow-x-auto">
        <table class="w-full min-w-[700px]">
            <thead>
                <tr>
                    <th class="table-heading">Course Code</th>
                    <th class="table-heading">Course Name</th>
                    <th class="table-heading">Academic Year</th>
                    <th class="table-heading">Semester</th>
                    <th class="table-heading">Status</th>
                    <th class="table-heading">Registered On</th>
                </tr>
            </thead>
            <tbody>
                @forelse($registrations as $registration)
                    <tr>
                        <td class="table-cell font-semibold">{{ $registration->course->course_code }}</td>
                        <td class="table-cell">{{ $registration->course->course_name }}</td>
                        <td class="table-cell">{{ $registration->academic_year }}</td>
                        <td class="table-cell">Semester {{ $registration->semester }}</td>
                        <td class="table-cell">{{ ucfirst($registration->status) }}</td>
                        <td class="table-cell">{{ $registration->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="table-cell text-center">You have not registered for any courses yet.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-5">{{ $registrations->links() }}</div>
    </div>

    <div class="mt-5">
        <a href="{{ route('student.courses') }}" class="btn-primary">Browse Available Courses</a>
    </div>
</div>
@endsection

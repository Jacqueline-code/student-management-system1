 @extends('layouts.app')

@section('title', 'Registered Students')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-6">
        <p class="text-sm font-semibold text-blue-600 mb-2">Lecturer Portal</p>
        <h2 class="text-2xl font-bold">Registered Students</h2>
        <p class="text-sm text-slate-500 mt-2">
            {{ $course->course_code }} — {{ $course->course_name }}
        </p>
    </div>

    <div class="page-card overflow-x-auto">
        <table class="w-full min-w-[650px]">
            <thead>
                <tr>
                    <th class="table-heading">Student Number</th>
                    <th class="table-heading">Student Name</th>
                    <th class="table-heading">Programme</th>
                    <th class="table-heading">Academic Year</th>
                    <th class="table-heading">Semester</th>
                    <th class="table-heading">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($registrations as $registration)
                    <tr>
                        <td class="table-cell">{{ $registration->student->student_number }}</td>
                        <td class="table-cell">{{ $registration->student->full_name }}</td>
                        <td class="table-cell">{{ $registration->student->programme }}</td>
                        <td class="table-cell">{{ $registration->academic_year }}</td>
                        <td class="table-cell">Semester {{ $registration->semester }}</td>
                        <td class="table-cell">{{ ucfirst($registration->status) }}</td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="table-cell text-center">No students have registered for this course yet.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-5">{{ $registrations->links() }}</div>
    </div>
</div>
@endsection

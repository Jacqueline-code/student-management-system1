@extends('layouts.app')

@section('title', 'Manage Registrations')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-6">
        <p class="text-sm font-semibold text-blue-600 mb-2">Administration</p>
        <h2 class="text-2xl font-bold">Course Registrations</h2>
        <p class="text-sm text-slate-500 mt-2">View and manage student course registrations.</p>
    </div>

    <div class="page-card overflow-x-auto">
        <table class="w-full min-w-[850px]">
            <thead>
                <tr>
                    <th class="table-heading">Student</th>
                    <th class="table-heading">Student Number</th>
                    <th class="table-heading">Course</th>
                    <th class="table-heading">Academic Year</th>
                    <th class="table-heading">Semester</th>
                    <th class="table-heading">Status</th>
                    <th class="table-heading">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($registrations as $registration)
                    <tr>
                        <td class="table-cell">{{ $registration->student->full_name }}</td>
                        <td class="table-cell">{{ $registration->student->student_number }}</td>
                        <td class="table-cell">{{ $registration->course->course_code }} — {{ $registration->course->course_name }}</td>
                        <td class="table-cell">{{ $registration->academic_year }}</td>
                        <td class="table-cell">Semester {{ $registration->semester }}</td>
                        <td class="table-cell">{{ ucfirst($registration->status) }}</td>
                        <td class="table-cell">
                            <form method="POST" action="{{ route('admin.registrations.destroy', $registration) }}" onsubmit="return confirm('Remove this registration?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 font-semibold hover:underline" type="submit">Remove</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="7" class="table-cell text-center">No registrations have been recorded.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="mt-5">{{ $registrations->links() }}</div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Lecturer Details')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="mb-8">
        <a href="{{ route('lecturers.index') }}"
           class="text-sm text-blue-600 hover:underline">
            ← Back to Lecturers
        </a>

        <h2 class="text-2xl font-bold text-slate-900 mt-4">
            Lecturer Details
        </h2>
    </div>


    <div class="page-card">

        <div class="flex items-center gap-4 mb-6">

            <div class="w-14 h-14 rounded-full bg-blue-100
                        text-blue-700 flex items-center justify-center">
                <i data-lucide="graduation-cap" class="w-7 h-7"></i>
            </div>

            <div>
                <h3 class="text-xl font-bold text-slate-900">
                    {{ $lecturer->full_name }}
                </h3>

                <p class="text-sm text-slate-500">
                    {{ $lecturer->staff_number }}
                </p>
            </div>

        </div>


        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6
                    border-t border-slate-100 pt-6">

            <div>
                <p class="text-sm text-slate-500">First Name</p>
                <p class="font-semibold mt-1">
                    {{ $lecturer->first_name }}
                </p>
            </div>

            <div>
                <p class="text-sm text-slate-500">Last Name</p>
                <p class="font-semibold mt-1">
                    {{ $lecturer->last_name }}
                </p>
            </div>

            <div>
                <p class="text-sm text-slate-500">Email</p>
                <p class="font-semibold mt-1">
                    {{ $lecturer->email }}
                </p>
            </div>

            <div>
                <p class="text-sm text-slate-500">Phone</p>
                <p class="font-semibold mt-1">
                    {{ $lecturer->phone ?: 'Not provided' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-slate-500">Department</p>
                <p class="font-semibold mt-1">
                    {{ $lecturer->department }}
                </p>
            </div>

            <div>
                <p class="text-sm text-slate-500">Linked Login Account</p>
                <p class="font-semibold mt-1">
                    {{ $lecturer->user?->email ?? 'No account linked' }}
                </p>
            </div>

        </div>


        <div class="mt-8 pt-6 border-t border-slate-100">

            <h3 class="font-bold text-slate-900 mb-4">
                Assigned Courses
            </h3>

            @forelse($lecturer->courses as $course)

                <div class="flex flex-col sm:flex-row sm:items-center
                            sm:justify-between gap-2 py-3 border-b border-slate-100">

                    <div>
                        <p class="font-semibold text-slate-800">
                            {{ $course->course_code }} — {{ $course->course_name }}
                        </p>

                        <p class="text-xs text-slate-500 mt-1">
                            {{ $course->credit_units }} credit units
                        </p>
                    </div>

                    <span class="text-xs font-semibold
                                 {{ $course->is_open ? 'text-green-700' : 'text-red-700' }}">
                        {{ $course->is_open ? 'Open' : 'Closed' }}
                    </span>

                </div>

            @empty

                <p class="text-sm text-slate-500">
                    No courses have been assigned to this lecturer yet.
                </p>

            @endforelse

        </div>


        <div class="flex gap-3 mt-8">

            <a href="{{ route('lecturers.edit', $lecturer) }}"
               class="btn-primary">
                <i data-lucide="pencil" class="w-4 h-4"></i>
                Edit Lecturer
            </a>

            <a href="{{ route('lecturers.index') }}" class="btn-secondary">
                Back
            </a>

        </div>

    </div>

</div>

@endsection
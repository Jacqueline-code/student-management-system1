@extends('layouts.app')

@section('title', 'Course Details')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="mb-8">
        <a href="{{ route('courses.index') }}"
           class="text-sm text-blue-600 hover:underline">
            ← Back to Courses
        </a>

        <h2 class="text-2xl font-bold text-slate-900 mt-4">
            Course Details
        </h2>
    </div>


    <div class="page-card">

        <div class="flex flex-col sm:flex-row sm:items-center
                    sm:justify-between gap-4 mb-6">

            <div>
                <p class="text-sm text-slate-500">Course Code</p>

                <h3 class="text-2xl font-bold text-slate-900 mt-1">
                    {{ $course->course_code }}
                </h3>

                <p class="text-slate-600 mt-1">
                    {{ $course->course_name }}
                </p>
            </div>

            @if($course->is_open)
                <span class="px-4 py-2 rounded-full text-sm font-semibold
                             bg-green-100 text-green-700">
                    Open for Registration
                </span>
            @else
                <span class="px-4 py-2 rounded-full text-sm font-semibold
                             bg-red-100 text-red-700">
                    Closed
                </span>
            @endif

        </div>


        <div class="border-t border-slate-100 pt-6
                    grid grid-cols-1 sm:grid-cols-2 gap-6">

            <div>
                <p class="text-sm text-slate-500">Course Name</p>
                <p class="font-semibold text-slate-800 mt-1">
                    {{ $course->course_name }}
                </p>
            </div>

            <div>
                <p class="text-sm text-slate-500">Credit Units</p>
                <p class="font-semibold text-slate-800 mt-1">
                    {{ $course->credit_units }}
                </p>
            </div>

            <div>
                <p class="text-sm text-slate-500">Assigned Lecturer</p>
                <p class="font-semibold text-slate-800 mt-1">
                    {{ $course->lecturer?->full_name ?? 'Not assigned' }}
                </p>
            </div>

            <div>
                <p class="text-sm text-slate-500">Course Status</p>
                <p class="font-semibold text-slate-800 mt-1">
                    {{ $course->is_open ? 'Open' : 'Closed' }}
                </p>
            </div>

            <div class="sm:col-span-2">
                <p class="text-sm text-slate-500">Description</p>
                <p class="text-slate-700 mt-1">
                    {{ $course->description ?: 'No description provided.' }}
                </p>
            </div>

        </div>


        @if(auth()->user()->role === 'admin')

            <div class="flex gap-3 mt-8 pt-6 border-t border-slate-100">

                <a href="{{ route('courses.edit', $course) }}"
                   class="btn-primary">
                    <i data-lucide="pencil" class="w-4 h-4"></i>
                    Edit Course
                </a>

                <a href="{{ route('courses.index') }}"
                   class="btn-secondary">
                    Back
                </a>

            </div>

        @endif

    </div>

</div>

@endsection
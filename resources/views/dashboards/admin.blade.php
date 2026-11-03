@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- Page heading -->
    <div class="mb-8">
        <p class="text-sm text-blue-600 font-semibold mb-2">
            Administration
        </p>

        <h2 class="text-2xl font-bold text-slate-900">
            Administrator Dashboard
        </h2>

        <p class="text-sm text-slate-500 mt-2">
            Manage students, courses and academic information from one place.
        </p>
    </div>


    <!-- Welcome card -->
    <div class="bg-blue-700 rounded-xl p-6 sm:p-8 text-white mb-8">
        <h3 class="text-xl font-bold">
            Welcome, {{ auth()->user()->name }}!
        </h3>

        <p class="text-blue-100 text-sm mt-2">
            You are logged in as an administrator.
            Use the available tools to manage the student management system.
        </p>
    </div>


    <!-- Management cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">

        <!-- Student management -->
        <div class="page-card">
            <div class="w-12 h-12 rounded-lg bg-blue-100 text-blue-700
                        flex items-center justify-center mb-5">
                <i data-lucide="users" class="w-6 h-6"></i>
            </div>

            <h3 class="font-bold text-slate-900 text-lg">
                Student Management
            </h3>

            <p class="text-sm text-slate-500 mt-2 mb-5">
                Add new students, view student records, update details
                and remove student records.
            </p>

            <a href="{{ route('students.index') }}" class="btn-primary">
                Manage Students
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>


        <!-- Course management -->
        <div class="page-card">
            <div class="w-12 h-12 rounded-lg bg-purple-100 text-purple-700
                        flex items-center justify-center mb-5">
                <i data-lucide="book-open" class="w-6 h-6"></i>
            </div>

            <h3 class="font-bold text-slate-900 text-lg">
                Course Management
            </h3>

            <p class="text-sm text-slate-500 mt-2 mb-5">
                Access course information and manage academic courses.
            </p>

            @if(Route::has('courses.index'))
                <a href="{{ route('courses.index') }}" class="btn-secondary">
                    Manage Courses
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            @else
                <span class="text-xs text-slate-400">
                    Course management is not yet available.
                </span>
            @endif
        </div>


        <!-- Lecturer management -->
        <div class="page-card">
            <div class="w-12 h-12 rounded-lg bg-green-100 text-green-700
                        flex items-center justify-center mb-5">
                <i data-lucide="graduation-cap" class="w-6 h-6"></i>
            </div>

            <h3 class="font-bold text-slate-900 text-lg">
                Lecturer Management
            </h3>

            <p class="text-sm text-slate-500 mt-2 mb-5">
                Access lecturer records and academic staff information.
            </p>

            @if(Route::has('lecturers.index'))
                <a href="{{ route('lecturers.index') }}" class="btn-secondary">
                    Manage Lecturers
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            @else
                <span class="text-xs text-slate-400">
                    Lecturer management is not yet available.
                </span>
            @endif
        </div>

    </div>


    <!-- Account information -->
    <div class="page-card mt-8">
        <h3 class="font-bold text-slate-900 mb-4">
            Account Information
        </h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 text-sm">

            <div>
                <p class="text-slate-500">Full Name</p>
                <p class="font-semibold text-slate-800 mt-1">
                    {{ auth()->user()->name }}
                </p>
            </div>

            <div>
                <p class="text-slate-500">Email Address</p>
                <p class="font-semibold text-slate-800 mt-1">
                    {{ auth()->user()->email }}
                </p>
            </div>

            <div>
                <p class="text-slate-500">Account Role</p>
                <p class="font-semibold text-slate-800 mt-1 capitalize">
                    {{ auth()->user()->role }}
                </p>
            </div>

        </div>
    </div>

</div>

@endsection
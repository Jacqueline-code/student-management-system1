
@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')

<div class="max-w-7xl mx-auto">

    {{-- Page heading --}}
    <div class="mb-8">
        <p class="text-sm text-blue-600 font-semibold mb-2">
            Student Portal
        </p>

        <h2 class="text-2xl font-bold text-slate-900">
            Student Dashboard
        </h2>

        <p class="text-sm text-slate-500 mt-2">
            Browse available courses and manage your academic registrations.
        </p>
    </div>

    {{-- Welcome card --}}
    <div class="bg-blue-700 rounded-xl p-6 sm:p-8 text-white mb-8">
        <h3 class="text-xl font-bold">
            Welcome, {{ auth()->user()->name }}!
        </h3>

        <p class="text-blue-100 text-sm mt-2">
            You are logged in as a student.
            Use the available tools to manage your course registrations.
        </p>
    </div>

    {{-- Student action cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

        {{-- Browse available courses --}}
        <div class="page-card">
            <div class="w-12 h-12 rounded-lg bg-blue-100 text-blue-700 flex items-center justify-center mb-5">
                <i data-lucide="book-open" class="w-6 h-6"></i>
            </div>

            <h3 class="font-bold text-slate-900 text-lg">
                Available Courses
            </h3>

            <p class="text-sm text-slate-500 mt-2 mb-5">
                Browse available courses and register for your selected semester.
            </p>

            <a href="{{ route('student.courses') }}" class="btn-primary">
                Browse Courses
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>

        {{-- View personal registrations --}}
        <div class="page-card">
            <div class="w-12 h-12 rounded-lg bg-green-100 text-green-700 flex items-center justify-center mb-5">
                <i data-lucide="clipboard-list" class="w-6 h-6"></i>
            </div>

            <h3 class="font-bold text-slate-900 text-lg">
                My Registrations
            </h3>

            <p class="text-sm text-slate-500 mt-2 mb-5">
                View your registered courses, academic years and semesters.
            </p>

            <a href="{{ route('student.my-registrations') }}" class="btn-secondary">
                View My Registrations
                <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
        </div>

    </div>

    {{-- Account information --}}
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

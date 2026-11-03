@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="mb-8">
        <p class="text-sm text-blue-600 font-semibold mb-2">
            Student Portal
        </p>

        <h2 class="text-2xl font-bold text-slate-900">
            Student Dashboard
        </h2>

        <p class="text-sm text-slate-500 mt-2">
            Welcome to your academic portal.
        </p>
    </div>


    <div class="bg-blue-700 rounded-xl p-6 sm:p-8 text-white mb-8">
        <h3 class="text-xl font-bold">
            Welcome, {{ auth()->user()->name }}!
        </h3>

        <p class="text-blue-100 text-sm mt-2">
            You are logged in to the student portal.
            Your academic information and registered courses will
            be accessible here as those features are implemented.
        </p>
    </div>


    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

        <div class="page-card">
            <div class="w-12 h-12 rounded-lg bg-purple-100 text-purple-700
                        flex items-center justify-center mb-5">
                <i data-lucide="book-open" class="w-6 h-6"></i>
            </div>

            <h3 class="font-bold text-slate-900 text-lg">
                My Courses
            </h3>

            <p class="text-sm text-slate-500 mt-2 mb-5">
                View your registered courses and academic information.
            </p>

            @if(Route::has('student.courses'))
                <a href="{{ route('student.courses') }}" class="btn-primary">
                    View My Courses
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            @else
                <span class="text-xs text-slate-400">
                    Course registration features are not yet available.
                </span>
            @endif
        </div>


        <div class="page-card">
            <div class="w-12 h-12 rounded-lg bg-green-100 text-green-700
                        flex items-center justify-center mb-5">
                <i data-lucide="user-round" class="w-6 h-6"></i>
            </div>

            <h3 class="font-bold text-slate-900 text-lg">
                My Account
            </h3>

            <p class="text-sm text-slate-500 mt-2">
                Your account information is displayed below.
            </p>

            <div class="mt-4 space-y-2 text-sm">
                <p>
                    <span class="text-slate-500">Name:</span>
                    <span class="font-semibold text-slate-800">
                        {{ auth()->user()->name }}
                    </span>
                </p>

                <p>
                    <span class="text-slate-500">Email:</span>
                    <span class="font-semibold text-slate-800">
                        {{ auth()->user()->email }}
                    </span>
                </p>
            </div>
        </div>

    </div>

</div>

@endsection
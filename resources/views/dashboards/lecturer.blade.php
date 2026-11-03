@extends('layouts.app')

@section('title', 'Lecturer Dashboard')

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="mb-8">
        <p class="text-sm text-blue-600 font-semibold mb-2">
            Teaching Portal
        </p>

        <h2 class="text-2xl font-bold text-slate-900">
            Lecturer Dashboard
        </h2>

        <p class="text-sm text-slate-500 mt-2">
            Access your teaching and academic management functions.
        </p>
    </div>


    <div class="bg-blue-700 rounded-xl p-6 sm:p-8 text-white mb-8">
        <h3 class="text-xl font-bold">
            Welcome, {{ auth()->user()->name }}!
        </h3>

        <p class="text-blue-100 text-sm mt-2">
            This is your lecturer portal. You can access your courses
            and related academic activities here.
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
                Access the courses assigned to you and manage
                relevant course information.
            </p>

            @if(Route::has('courses.index'))
                <a href="{{ route('courses.index') }}" class="btn-primary">
                    View Courses
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            @else
                <span class="text-xs text-slate-400">
                    Course management is not yet available.
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

            <p class="text-sm text-slate-500 mt-2 mb-5">
                View the details associated with your lecturer account.
            </p>

            <p class="text-sm font-semibold text-slate-700">
                {{ auth()->user()->name }}
            </p>

            <p class="text-xs text-slate-500 mt-1">
                {{ auth()->user()->email }}
            </p>
        </div>

    </div>

</div>

@endsection
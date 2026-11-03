@extends('layouts.app')

@section('title', 'Student Management System')

@section('content')
<header class="border-b border-slate-200 bg-white">
    <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <img
                src="{{ asset('assets/img/logo.png') }}"
                alt="University"
                class="h-11 w-11"
            >
            <span class="font-semibold">Student Management System</span>
        </a>

        <a
            href="{{ route('login') }}"
            class="px-5 py-2.5 rounded-lg text-white bg-[#2563eb] hover:bg-[#1d4ed8]"
        >
            Sign in
        </a>
    </div>
</header>

<main class="max-w-7xl mx-auto px-6 py-20">
    <section class="max-w-3xl">
        <p class="text-sm font-semibold text-blue-700 mb-4">
            UNIVERSITY MANAGEMENT
        </p>

        <h1 class="text-4xl sm:text-5xl font-bold leading-tight">
            Student Management System
        </h1>

        <p class="mt-6 text-lg text-slate-500 leading-relaxed">
            A central platform for managing student records, courses,
            lecturers and course registrations.
        </p>

        <div class="mt-8 flex gap-4 flex-wrap">
            <a
                href="{{ route('login') }}"
                class="px-6 py-3 rounded-xl bg-[#2563eb] text-white font-semibold"
            >
                Access the system
            </a>
        </div>
    </section>
</main>
@endsection
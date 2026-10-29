@extends('layouts.app')

@section('title', 'Sign in — Student Management System')

@section('content')
<div class="flex-1 flex items-center justify-center p-4 bg-white min-h-screen">
    <div class="w-full max-w-md">

        <div class="flex justify-center mb-8">
            <a href="{{ route('home') }}"
               class="inline-flex flex-col items-center gap-3">
                <img
                    src="{{ asset('assets/img/logo.png') }}"
                    alt="Student Management System"
                    class="h-16 w-16"
                >
                <span class="text-sm font-semibold text-slate-900">
                    Student Management System
                </span>
            </a>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-6 sm:p-8">

            <div class="mb-6">
                <h1 class="text-xl font-bold text-slate-900">Sign in</h1>
                <p class="mt-1 text-sm text-slate-500">
                    Sign in to access your university account.
                </p>
            </div>

            @if($errors->any())
                <div class="mb-5 rounded-lg bg-red-50 border border-red-200 p-3 text-sm text-red-700">
                    {{ $errors->first() }}
            </div>
        @endif

            @if(session('status'))
                <div class="mb-5 rounded-lg bg-green-50 border border-green-200 p-3 text-sm text-green-700">
                    {{ session('status') }}
                </div>
            @endif

            <form action="{{ route('login.submit') }}"
                  method="POST"
                  class="space-y-5">

            @csrf

                <div>
                    <label for="email"
                           class="block text-sm font-medium text-slate-600 mb-2">
                        University email
                    </label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter your email"
                    required
                    autofocus
                        autocomplete="username"
                        placeholder="you@university.ac.ug"
                        class="input-field"
                >

                @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

                <div>
                    <label for="password"
                           class="block text-sm font-medium text-slate-600 mb-2">
                        Password
                    </label>

                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                        autocomplete="current-password"
                        class="input-field"
                >

                @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

                <label class="flex items-center gap-2 cursor-pointer">
                <input
                    type="checkbox"
                    name="remember"
                    id="remember"
                    value="1"
                        class="h-4 w-4 rounded border-slate-300 text-blue-600"
                    >
                    <span class="text-sm text-slate-500">Remember me</span>
                </label>

                <button
                    type="submit"
                    class="w-full py-3 px-4 rounded-xl text-sm font-semibold text-white bg-[#2563eb] hover:bg-[#1d4ed8]"
                >
                    Sign in
                </button>
        </form>

            <p class="mt-6 text-center text-xs text-slate-500">
                Student Management System · Academic Year 2026/2027
            </p>
        </div>

    </div>
</div>
@endsection
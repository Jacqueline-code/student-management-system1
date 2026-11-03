@extends('layouts.app')

@section('title', 'Add Course')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="mb-8">
        <a href="{{ route('courses.index') }}"
           class="text-sm text-blue-600 hover:underline">
            ← Back to Courses
        </a>

        <h2 class="text-2xl font-bold text-slate-900 mt-4">
            Add New Course
        </h2>

        <p class="text-sm text-slate-500 mt-2">
            Enter the details of the new academic course.
        </p>
    </div>


    <div class="page-card">

        <form action="{{ route('courses.store') }}" method="POST">

            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                <div>
                    <label class="form-label">Course Code *</label>
                    <input type="text" name="course_code"
                           value="{{ old('course_code') }}"
                           class="form-input"
                           placeholder="e.g. BUC3130"
                           required>
                    @error('course_code')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="form-label">Course Name *</label>
                    <input type="text" name="course_name"
                           value="{{ old('course_name') }}"
                           class="form-input"
                           placeholder="Enter course name"
                           required>
                    @error('course_name')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="form-label">Credit Units *</label>
                    <input type="number" name="credit_units"
                           value="{{ old('credit_units', 3) }}"
                           min="1" max="20"
                           class="form-input" required>
                    @error('credit_units')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="form-label">Assign Lecturer</label>

                    <select name="lecturer_id" class="form-input">
                        <option value="">Select lecturer</option>

                        @foreach($lecturers as $lecturer)
                            <option value="{{ $lecturer->id }}"
                                {{ old('lecturer_id') == $lecturer->id ? 'selected' : '' }}>
                                {{ $lecturer->full_name }}
                            </option>
                        @endforeach

                    </select>

                    @error('lecturer_id')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="sm:col-span-2">
                    <label class="form-label">Course Description</label>

                    <textarea name="description" rows="4"
                              class="form-input"
                              placeholder="Enter a short course description">{{ old('description') }}</textarea>

                    @error('description')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="sm:col-span-2">
                    <label class="form-label">Course Status *</label>

                    <select name="is_open" class="form-input" required>
                        <option value="1"
                            {{ old('is_open', '1') == '1' ? 'selected' : '' }}>
                            Open
                        </option>

                        <option value="0"
                            {{ old('is_open') === '0' ? 'selected' : '' }}>
                            Closed
                        </option>
                    </select>
                </div>

            </div>


            <div class="flex flex-col sm:flex-row gap-3 mt-8">

                <button type="submit" class="btn-primary">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    Save Course
                </button>

                <a href="{{ route('courses.index') }}" class="btn-secondary">
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

@endsection
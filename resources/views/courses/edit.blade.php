@extends('layouts.app')

@section('title', 'Edit Course')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="mb-8">
        <a href="{{ route('courses.index') }}"
           class="text-sm text-blue-600 hover:underline">
            ← Back to Courses
        </a>

        <h2 class="text-2xl font-bold text-slate-900 mt-4">
            Edit Course
        </h2>

        <p class="text-sm text-slate-500 mt-2">
            Update the information for {{ $course->course_code }}.
        </p>
    </div>


    <div class="page-card">

        <form action="{{ route('courses.update', $course) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                <div>
                    <label class="form-label">Course Code *</label>
                    <input type="text" name="course_code"
                           value="{{ old('course_code', $course->course_code) }}"
                           class="form-input" required>
                    @error('course_code')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="form-label">Course Name *</label>
                    <input type="text" name="course_name"
                           value="{{ old('course_name', $course->course_name) }}"
                           class="form-input" required>
                    @error('course_name')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="form-label">Credit Units *</label>
                    <input type="number" name="credit_units"
                           value="{{ old('credit_units', $course->credit_units) }}"
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
                                {{ old('lecturer_id', $course->lecturer_id) == $lecturer->id ? 'selected' : '' }}>
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
                              class="form-input">{{ old('description', $course->description) }}</textarea>
                </div>

                <div class="sm:col-span-2">
                    <label class="form-label">Course Status *</label>

                    <select name="is_open" class="form-input" required>
                        <option value="1"
                            {{ old('is_open', $course->is_open ? '1' : '0') == '1' ? 'selected' : '' }}>
                            Open
                        </option>

                        <option value="0"
                            {{ old('is_open', $course->is_open ? '1' : '0') == '0' ? 'selected' : '' }}>
                            Closed
                        </option>
                    </select>
                </div>

            </div>


            <div class="flex flex-col sm:flex-row gap-3 mt-8">

                <button type="submit" class="btn-primary">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    Update Course
                </button>

                <a href="{{ route('courses.index') }}" class="btn-secondary">
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

@endsection
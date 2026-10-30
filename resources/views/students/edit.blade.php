@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">Edit Student Details</h2>

    <form action="{{ route('students.update', $student->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Student Number</label>
            <input type="text" name="student_number"
                   class="form-control"
                   value="{{ old('student_number', $student->student_number) }}"
                   required>
            @error('student_number')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>First Name</label>
            <input type="text" name="first_name"
                   class="form-control"
                   value="{{ old('first_name', $student->first_name) }}"
                   required>
            @error('first_name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Last Name</label>
            <input type="text" name="last_name"
                   class="form-control"
                   value="{{ old('last_name', $student->last_name) }}"
                   required>
            @error('last_name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Email Address</label>
            <input type="email" name="email"
                   class="form-control"
                   value="{{ old('email', $student->email) }}"
                   required>
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Phone Number</label>
            <input type="text" name="phone"
                   class="form-control"
                   value="{{ old('phone', $student->phone) }}">
            @error('phone')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Programme</label>
            <input type="text" name="programme"
                   class="form-control"
                   value="{{ old('programme', $student->programme) }}"
                   required>
            @error('programme')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Year of Study</label>
            <select name="year_of_study" class="form-control" required>
                @for($year = 1; $year <= 7; $year++)
                    <option value="{{ $year }}"
                        {{ old('year_of_study', $student->year_of_study) == $year ? 'selected' : '' }}>
                        Year {{ $year }}
                    </option>
                @endfor
            </select>
            @error('year_of_study')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Status</label>
            <select name="status" class="form-control" required>
                <option value="active"
                    {{ old('status', $student->status) == 'active' ? 'selected' : '' }}>
                    Active
                </option>

                <option value="inactive"
                    {{ old('status', $student->status) == 'inactive' ? 'selected' : '' }}>
                    Inactive
                </option>
            </select>
            @error('status')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            Update Student
        </button>

        <a href="{{ route('students.index') }}" class="btn btn-secondary">
            Cancel
        </a>

    </form>

</div>

@endsection
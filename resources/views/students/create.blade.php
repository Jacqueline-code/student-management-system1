@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">Register New Student</h2>

    <form action="{{ route('students.store') }}" method="POST">

        @csrf

        <div class="mb-3">
            <label>Student Number</label>
            <input type="text" name="student_number"
                   class="form-control"
                   value="{{ old('student_number') }}" required>
            @error('student_number')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>First Name</label>
            <input type="text" name="first_name"
                   class="form-control"
                   value="{{ old('first_name') }}" required>
            @error('first_name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Last Name</label>
            <input type="text" name="last_name"
                   class="form-control"
                   value="{{ old('last_name') }}" required>
            @error('last_name')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Email Address</label>
            <input type="email" name="email"
                   class="form-control"
                   value="{{ old('email') }}" required>
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Phone Number</label>
            <input type="text" name="phone"
                   class="form-control"
                   value="{{ old('phone') }}">
            @error('phone')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Programme</label>
            <input type="text" name="programme"
                   class="form-control"
                   value="{{ old('programme') }}" required>
            @error('programme')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Year of Study</label>
            <select name="year_of_study" class="form-control" required>
                <option value="">Select Year</option>
                @for($year = 1; $year <= 7; $year++)
                    <option value="{{ $year }}"
                        {{ old('year_of_study') == $year ? 'selected' : '' }}>
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
                    {{ old('status', 'active') == 'active' ? 'selected' : '' }}>
                    Active
                </option>

                <option value="inactive"
                    {{ old('status') == 'inactive' ? 'selected' : '' }}>
                    Inactive
                </option>
            </select>
            @error('status')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">
            Save Student
        </button>

        <a href="{{ route('students.index') }}" class="btn btn-secondary">
            Cancel
        </a>

    </form>

</div>

@endsection
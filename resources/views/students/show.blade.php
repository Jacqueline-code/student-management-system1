@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">Student Profile</h2>

    <div class="card">
        <div class="card-body">

            <h4>
                {{ $student->first_name }} {{ $student->last_name }}
            </h4>

            <hr>

            <p><strong>Student Number:</strong>
                {{ $student->student_number }}</p>

            <p><strong>Email:</strong>
                {{ $student->email }}</p>

            <p><strong>Phone:</strong>
                {{ $student->phone ?? 'Not provided' }}</p>

            <p><strong>Programme:</strong>
                {{ $student->programme }}</p>

            <p><strong>Year of Study:</strong>
                {{ $student->year_of_study }}</p>

            <p><strong>Status:</strong>
                {{ ucfirst($student->status) }}</p>

            <a href="{{ route('students.edit', $student->id) }}"
               class="btn btn-warning">
                Edit Student
            </a>

            <a href="{{ route('students.index') }}"
               class="btn btn-secondary">
                Back to Students
            </a>

        </div>
    </div>

</div>

@endsection
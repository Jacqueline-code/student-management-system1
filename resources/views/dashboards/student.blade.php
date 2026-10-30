@extends('layouts.app')

@section('title', 'Student Dashboard')

@section('content')

<div class="container">

    <div class="mb-4">
        <h2>Student Dashboard</h2>

        <p>
            Welcome, {{ Auth::user()->name }}.
            You are signed in as a student.
        </p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">

        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5>My Academic Information</h5>

                    <p>
                        Your programme, year of study and student
                        registration details will appear here once
                        your student record is linked to your account.
                    </p>

                    <span class="text-muted">
                        Academic profile not yet connected.
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5>My Account</h5>

                    <p>Name: {{ Auth::user()->name }}</p>
                    <p>Email: {{ Auth::user()->email }}</p>
                    <p>Role: Student</p>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5>Sign Out</h5>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf

                        <button type="submit" class="btn btn-danger">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
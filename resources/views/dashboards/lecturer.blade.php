@extends('layouts.app')

@section('title', 'Lecturer Dashboard')

@section('content')

<div class="container">

    <div class="mb-4">
        <h2>Lecturer Dashboard</h2>

        <p>
            Welcome, {{ Auth::user()->name }}.
            You are signed in as a lecturer.
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
                    <h5>My Courses</h5>

                    <p>
                        Your assigned courses and course information
                        will appear here when course management is connected.
                    </p>

                    <span class="text-muted">
                        Course management not yet available.
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
                    <p>Role: Lecturer</p>
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
@extends('layouts.app')

@section('title', 'Administrator Dashboard')

@section('content')

<div class="container">

    <div class="mb-4">
        <h2>Administrator Dashboard</h2>

        <p>
            Welcome, {{ Auth::user()->name }}.
            You are signed in as an administrator.
        </p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">

        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5>Student Management</h5>

                    <p>Register, view, update and manage student records.</p>

                    <a href="{{ route('students.index') }}"
                       class="btn btn-primary">
                        Manage Students
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5>My Account</h5>

                    <p>Name: {{ Auth::user()->name }}</p>
                    <p>Email: {{ Auth::user()->email }}</p>
                    <p>Role: Administrator</p>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5>Sign Out</h5>

                    <p>End your current session securely.</p>

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
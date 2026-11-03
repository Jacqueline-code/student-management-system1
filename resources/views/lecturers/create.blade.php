@extends('layouts.app')

@section('title', 'Add Lecturer')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="mb-8">
        <a href="{{ route('lecturers.index') }}"
           class="text-sm text-blue-600 hover:underline">
            ← Back to Lecturers
        </a>

        <h2 class="text-2xl font-bold text-slate-900 mt-4">
            Add New Lecturer
        </h2>

        <p class="text-sm text-slate-500 mt-2">
            Enter the lecturer's staff and contact information.
        </p>
    </div>


    <div class="page-card">

        <form action="{{ route('lecturers.store') }}" method="POST">

            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                <div class="sm:col-span-2">
                    <label class="form-label">Linked Login Account</label>

                    <select name="user_id" class="form-input">
                        <option value="">No account linked</option>

                        @foreach($users as $user)
                            <option value="{{ $user->id }}"
                                {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                {{ $user->name }} — {{ $user->email }}
                            </option>
                        @endforeach

                    </select>

                    <p class="text-xs text-slate-500 mt-1">
                        Select an existing account with the lecturer role, if available.
                    </p>

                    @error('user_id')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <div>
                    <label class="form-label">Staff Number *</label>
                    <input type="text" name="staff_number"
                           value="{{ old('staff_number') }}"
                           class="form-input"
                           placeholder="e.g. STF001"
                           required>
                    @error('staff_number')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <div>
                    <label class="form-label">Department *</label>
                    <input type="text" name="department"
                           value="{{ old('department') }}"
                           class="form-input"
                           placeholder="Enter department"
                           required>
                    @error('department')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <div>
                    <label class="form-label">First Name *</label>
                    <input type="text" name="first_name"
                           value="{{ old('first_name') }}"
                           class="form-input" required>
                    @error('first_name')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <div>
                    <label class="form-label">Last Name *</label>
                    <input type="text" name="last_name"
                           value="{{ old('last_name') }}"
                           class="form-input" required>
                    @error('last_name')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <div>
                    <label class="form-label">Email Address *</label>
                    <input type="email" name="email"
                           value="{{ old('email') }}"
                           class="form-input" required>
                    @error('email')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <div>
                    <label class="form-label">Phone Number</label>
                    <input type="text" name="phone"
                           value="{{ old('phone') }}"
                           class="form-input">
                    @error('phone')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>


            <div class="flex flex-col sm:flex-row gap-3 mt-8">

                <button type="submit" class="btn-primary">
                    <i data-lucide="save" class="w-4 h-4"></i>
                    Save Lecturer
                </button>

                <a href="{{ route('lecturers.index') }}" class="btn-secondary">
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

@endsection
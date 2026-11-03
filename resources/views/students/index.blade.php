@extends('layouts.app')

@section('title', 'Manage Students')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- PAGE HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center
                sm:justify-between gap-4 mb-8">

        <div>
            <p class="text-sm font-semibold text-blue-600 mb-2">
                Administration
            </p>

            <h2 class="text-2xl font-bold text-slate-900">
                Student Management
            </h2>

            <p class="text-sm text-slate-500 mt-2">
                View, add, update and manage student records.
            </p>
        </div>

        <a href="{{ route('students.create') }}"
           class="btn-primary">

            <i data-lucide="plus" class="w-4 h-4"></i>
            Add New Student

        </a>

    </div>


    <!-- STUDENT SUMMARY -->
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">

        <div class="page-card">
            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-slate-500">
                        Total Students
                    </p>

                    <h3 class="text-2xl font-bold text-slate-900 mt-2">
                        {{ $students->total() }}
                    </h3>
                </div>

                <div class="w-11 h-11 rounded-lg bg-blue-100
                            text-blue-700 flex items-center justify-center">
                    <i data-lucide="users" class="w-5 h-5"></i>
                </div>

            </div>
        </div>


        <div class="page-card">
            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-slate-500">
                        Active Students
                    </p>

                    <h3 class="text-2xl font-bold text-green-600 mt-2">
                        {{ \App\Models\Student::where('status', 'active')->count() }}
                    </h3>
                </div>

                <div class="w-11 h-11 rounded-lg bg-green-100
                            text-green-700 flex items-center justify-center">
                    <i data-lucide="user-check" class="w-5 h-5"></i>
                </div>

            </div>
        </div>


        <div class="page-card">
            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm text-slate-500">
                        Inactive Students
                    </p>

                    <h3 class="text-2xl font-bold text-red-600 mt-2">
                        {{ \App\Models\Student::where('status', 'inactive')->count() }}
                    </h3>
                </div>

                <div class="w-11 h-11 rounded-lg bg-red-100
                            text-red-700 flex items-center justify-center">
                    <i data-lucide="user-x" class="w-5 h-5"></i>
                </div>

            </div>
        </div>

    </div>


    <!-- STUDENT RECORDS TABLE -->
    <div class="page-card">

        <!-- Table heading and search -->
        <div class="flex flex-col sm:flex-row sm:items-center
                    sm:justify-between gap-4 mb-6">

            <div>
                <h3 class="text-lg font-bold text-slate-900">
                    Student Records
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    A list of registered students in the system.
                </p>
            </div>

            <!-- Search form -->
            <form method="GET"
                  action="{{ route('students.index') }}"
                  class="flex gap-2">

                <div class="relative">
                    <i data-lucide="search"
                       class="w-4 h-4 absolute left-3 top-1/2
                              -translate-y-1/2 text-slate-400"></i>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Search students..."
                        class="form-input pl-9 w-full sm:w-64"
                    >
                </div>

                <button type="submit" class="btn-secondary">
                    Search
                </button>

            </form>

        </div>


        <!-- Table -->
        <div class="overflow-x-auto">

            <table class="w-full min-w-[900px] border-collapse">

                <thead>
                    <tr>
                        <th class="table-heading">#</th>
                        <th class="table-heading">Student Number</th>
                        <th class="table-heading">Student Name</th>
                        <th class="table-heading">Email Address</th>
                        <th class="table-heading">Programme</th>
                        <th class="table-heading">Year</th>
                        <th class="table-heading">Status</th>
                        <th class="table-heading text-center">Actions</th>
                    </tr>
                </thead>


                <tbody>

                    @forelse($students as $student)

                        <tr class="hover:bg-slate-50 transition">

                            <!-- Row number -->
                            <td class="table-cell">
                                {{ $students->firstItem() + $loop->index }}
                            </td>


                            <!-- Student number -->
                            <td class="table-cell font-semibold text-slate-800">
                                {{ $student->student_number }}
                            </td>


                            <!-- Student name -->
                            <td class="table-cell">
                                <div class="font-semibold text-slate-800">
                                    {{ $student->first_name }}
                                    {{ $student->last_name }}
                                </div>
                            </td>


                            <!-- Email -->
                            <td class="table-cell">
                                {{ $student->email }}
                            </td>


                            <!-- Programme -->
                            <td class="table-cell">
                                {{ $student->programme }}
                            </td>


                            <!-- Year of study -->
                            <td class="table-cell">
                                Year {{ $student->year_of_study }}
                            </td>


                            <!-- Status -->
                            <td class="table-cell">

                                @if($student->status === 'active')

                                    <span class="inline-flex items-center px-3 py-1
                                                 rounded-full text-xs font-semibold
                                                 bg-green-100 text-green-700">
                                        Active
                                    </span>

                                @else

                                    <span class="inline-flex items-center px-3 py-1
                                                 rounded-full text-xs font-semibold
                                                 bg-red-100 text-red-700">
                                        Inactive
                                    </span>

                                @endif

                            </td>


                            <!-- ACTION BUTTONS -->
                            <td class="table-cell">

                                <div class="flex items-center justify-center gap-2">

                                    <!-- View student -->
                                    <a href="{{ route('students.show', $student) }}"
                                       title="View Student"
                                       class="p-2 rounded-lg text-blue-600
                                              hover:bg-blue-50 transition">

                                        <i data-lucide="eye"
                                           class="w-4 h-4"></i>

                                    </a>


                                    <!-- Edit student -->
                                    <a href="{{ route('students.edit', $student) }}"
                                       title="Edit Student"
                                       class="p-2 rounded-lg text-amber-600
                                              hover:bg-amber-50 transition">

                                        <i data-lucide="pencil"
                                           class="w-4 h-4"></i>

                                    </a>


                                    <!-- Delete student -->
                                    <form
                                        action="{{ route('students.destroy', $student) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this student record?');"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            title="Delete Student"
                                            class="p-2 rounded-lg text-red-600
                                                   hover:bg-red-50 transition"
                                        >

                                            <i data-lucide="trash-2"
                                               class="w-4 h-4"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="8" class="text-center py-12">

                                <div class="flex flex-col items-center">

                                    <i data-lucide="users"
                                       class="w-10 h-10 text-slate-300 mb-3"></i>

                                    <p class="font-semibold text-slate-700">
                                        No student records found.
                                    </p>

                                    <p class="text-sm text-slate-500 mt-1">
                                        Add a student to get started.
                                    </p>

                                    <a href="{{ route('students.create') }}"
                                       class="btn-primary mt-4">

                                        <i data-lucide="plus" class="w-4 h-4"></i>
                                        Add Student

                                    </a>

                                </div>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <!-- PAGINATION -->
        @if($students->hasPages())

            <div class="flex flex-col sm:flex-row sm:items-center
                        sm:justify-between gap-4 mt-6 pt-5
                        border-t border-slate-100">

                <p class="text-sm text-slate-500">
                    Showing
                    <span class="font-semibold text-slate-800">
                        {{ $students->firstItem() ?? 0 }}
                    </span>
                    to
                    <span class="font-semibold text-slate-800">
                        {{ $students->lastItem() ?? 0 }}
                    </span>
                    of
                    <span class="font-semibold text-slate-800">
                        {{ $students->total() }}
                    </span>
                    students
                </p>

                <div>
                    {{ $students->withQueryString()->links() }}
                </div>

            </div>

        @endif

    </div>

</div>

@endsection
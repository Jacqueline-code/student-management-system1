@extends('layouts.app')

@section('title', 'Lecturer Management')

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="flex flex-col sm:flex-row sm:items-center
                sm:justify-between gap-4 mb-8">

        <div>
            <p class="text-sm text-blue-600 font-semibold mb-2">
                Academic Administration
            </p>

            <h2 class="text-2xl font-bold text-slate-900">
                Lecturer Management
            </h2>

            <p class="text-sm text-slate-500 mt-2">
                Manage lecturer profiles and teaching assignments.
            </p>
        </div>

        <a href="{{ route('lecturers.create') }}" class="btn-primary">
            <i data-lucide="plus" class="w-4 h-4"></i>
            Add Lecturer
        </a>

    </div>


    <div class="page-card">

        <div class="flex flex-col sm:flex-row sm:items-center
                    sm:justify-between gap-4 mb-6">

            <div>
                <h3 class="text-lg font-bold text-slate-900">
                    Lecturer Records
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    {{ $lecturers->total() }} lecturer(s) found.
                </p>
            </div>

            <form method="GET" action="{{ route('lecturers.index') }}"
                  class="flex gap-2">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search lecturers..."
                    class="form-input sm:w-64"
                >

                <button type="submit" class="btn-secondary">
                    Search
                </button>

            </form>

        </div>


        <div class="overflow-x-auto">

            <table class="w-full min-w-[850px] border-collapse">

                <thead>
                    <tr>
                        <th class="table-heading">#</th>
                        <th class="table-heading">Staff Number</th>
                        <th class="table-heading">Lecturer Name</th>
                        <th class="table-heading">Email</th>
                        <th class="table-heading">Department</th>
                        <th class="table-heading">Courses</th>
                        <th class="table-heading text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($lecturers as $lecturer)

                        <tr class="hover:bg-slate-50">

                            <td class="table-cell">
                                {{ $lecturers->firstItem() + $loop->index }}
                            </td>

                            <td class="table-cell font-semibold text-slate-800">
                                {{ $lecturer->staff_number }}
                            </td>

                            <td class="table-cell font-medium text-slate-800">
                                {{ $lecturer->full_name }}
                            </td>

                            <td class="table-cell">
                                {{ $lecturer->email }}
                            </td>

                            <td class="table-cell">
                                {{ $lecturer->department }}
                            </td>

                            <td class="table-cell">
                                {{ $lecturer->courses_count }}
                            </td>

                            <td class="table-cell">

                                <div class="flex items-center justify-center gap-2">

                                    <a href="{{ route('lecturers.show', $lecturer) }}"
                                       title="View lecturer"
                                       class="p-2 rounded-lg text-blue-600 hover:bg-blue-50">
                                        <i data-lucide="eye" class="w-4 h-4"></i>
                                    </a>

                                    <a href="{{ route('lecturers.edit', $lecturer) }}"
                                       title="Edit lecturer"
                                       class="p-2 rounded-lg text-amber-600 hover:bg-amber-50">
                                        <i data-lucide="pencil" class="w-4 h-4"></i>
                                    </a>

                                    <form action="{{ route('lecturers.destroy', $lecturer) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete this lecturer?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                title="Delete lecturer"
                                                class="p-2 rounded-lg text-red-600 hover:bg-red-50">
                                            <i data-lucide="trash-2" class="w-4 h-4"></i>
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="text-center py-12">

                                <i data-lucide="graduation-cap"
                                   class="w-10 h-10 text-slate-300 mx-auto mb-3"></i>

                                <p class="font-semibold text-slate-700">
                                    No lecturer records found.
                                </p>

                                <p class="text-sm text-slate-500 mt-1">
                                    Add a lecturer to get started.
                                </p>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        @if($lecturers->hasPages())
            <div class="mt-6 pt-5 border-t border-slate-100">
                {{ $lecturers->links() }}
            </div>
        @endif

    </div>

</div>

@endsection
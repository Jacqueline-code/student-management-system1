@extends('layouts.app')

@section('title', 'Course Management')

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="flex flex-col sm:flex-row sm:items-center
                sm:justify-between gap-4 mb-8">

        <div>
            <p class="text-sm text-blue-600 font-semibold mb-2">
                Academic Administration
            </p>

            <h2 class="text-2xl font-bold text-slate-900">
                Course Management
            </h2>

            <p class="text-sm text-slate-500 mt-2">
                View and manage academic courses.
            </p>
        </div>

        @if(auth()->user()->role === 'admin')
            <a href="{{ route('courses.create') }}" class="btn-primary">
                <i data-lucide="plus" class="w-4 h-4"></i>
                Add Course
            </a>
        @endif

    </div>


    <div class="page-card">

        <div class="flex flex-col sm:flex-row sm:items-center
                    sm:justify-between gap-4 mb-6">

            <div>
                <h3 class="text-lg font-bold text-slate-900">
                    Course Records
                </h3>

                <p class="text-sm text-slate-500 mt-1">
                    {{ $courses->total() }} course(s) found.
                </p>
            </div>

            <form method="GET" action="{{ route('courses.index') }}"
                  class="flex gap-2">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search courses..."
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
                        <th class="table-heading">Course Code</th>
                        <th class="table-heading">Course Name</th>
                        <th class="table-heading">Credit Units</th>
                        <th class="table-heading">Lecturer</th>
                        <th class="table-heading">Status</th>
                        <th class="table-heading text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($courses as $course)

                        <tr class="hover:bg-slate-50">

                            <td class="table-cell">
                                {{ $courses->firstItem() + $loop->index }}
                            </td>

                            <td class="table-cell font-semibold text-slate-800">
                                {{ $course->course_code }}
                            </td>

                            <td class="table-cell font-medium text-slate-800">
                                {{ $course->course_name }}
                            </td>

                            <td class="table-cell">
                                {{ $course->credit_units }}
                            </td>

                            <td class="table-cell">
                                {{ $course->lecturer?->full_name ?? 'Not assigned' }}
                            </td>

                            <td class="table-cell">
                                @if($course->is_open)
                                    <span class="px-3 py-1 rounded-full text-xs
                                                 font-semibold bg-green-100 text-green-700">
                                        Open
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-xs
                                                 font-semibold bg-red-100 text-red-700">
                                        Closed
                                    </span>
                                @endif
                            </td>

                            <td class="table-cell">

                                <div class="flex items-center justify-center gap-2">

                                    <a href="{{ route('courses.show', $course) }}"
                                       title="View course"
                                       class="p-2 rounded-lg text-blue-600 hover:bg-blue-50">
                                        <i data-lucide="eye" class="w-4 h-4"></i>
                                    </a>

                                    @if(auth()->user()->role === 'admin')

                                        <a href="{{ route('courses.edit', $course) }}"
                                           title="Edit course"
                                           class="p-2 rounded-lg text-amber-600 hover:bg-amber-50">
                                            <i data-lucide="pencil" class="w-4 h-4"></i>
                                        </a>

                                        <form action="{{ route('courses.destroy', $course) }}"
                                              method="POST"
                                              onsubmit="return confirm('Delete this course?');">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    title="Delete course"
                                                    class="p-2 rounded-lg text-red-600 hover:bg-red-50">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>

                                        </form>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="text-center py-12">

                                <i data-lucide="book-open"
                                   class="w-10 h-10 text-slate-300 mx-auto mb-3"></i>

                                <p class="font-semibold text-slate-700">
                                    No courses found.
                                </p>

                                <p class="text-sm text-slate-500 mt-1">
                                    Courses will appear here once they are added.
                                </p>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        @if($courses->hasPages())
            <div class="mt-6 pt-5 border-t border-slate-100">
                {{ $courses->links() }}
            </div>
        @endif

    </div>

</div>

@endsection
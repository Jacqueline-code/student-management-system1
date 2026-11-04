<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Student Management System')</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif']
                    },
                    colors: {
                        brand: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a'
                        }
                    }
                }
            }
        };
    </script>

    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">

    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            border-radius: 9px;
            color: #64748b;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .sidebar-link:hover {
            background: #f1f5f9;
            color: #1d4ed8;
        }

        .sidebar-link.active {
            background: #eff6ff;
            color: #1d4ed8;
            font-weight: 600;
        }

        .mobile-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 12px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            color: #64748b;
            white-space: nowrap;
        }

        .mobile-link.active {
            background: #eff6ff;
            color: #1d4ed8;
        }

        .page-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 22px;
            box-shadow: 0 1px 2px rgba(15, 23, 42, 0.04);
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: 8px;
            background: #2563eb;
            color: white;
            font-size: 14px;
            font-weight: 600;
            transition: background 0.2s ease;
        }

        .btn-primary:hover {
            background: #1d4ed8;
        }

        .btn-secondary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            background: white;
            color: #334155;
            font-size: 14px;
            font-weight: 600;
        }

        .btn-secondary:hover {
            background: #f8fafc;
        }

        .form-input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            outline: none;
            font-size: 14px;
            background: white;
        }

        .form-input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.12);
        }

        .form-label {
            display: block;
            margin-bottom: 6px;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
        }

        .table-heading {
            padding: 13px 16px;
            background: #f8fafc;
            color: #64748b;
            text-align: left;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .table-cell {
            padding: 14px 16px;
            border-top: 1px solid #f1f5f9;
            font-size: 13px;
            color: #475569;
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-900 font-sans antialiased min-h-screen">

    @auth

        @php
            $currentRole = strtolower(auth()->user()->role ?? 'student');
        @endphp

        <div class="min-h-screen flex flex-col">

            <!-- TOP HEADER -->
            <header class="bg-white border-b border-slate-200 sticky top-0 z-40">
                <div class="max-w-screen-2xl mx-auto px-4 sm:px-6">
                    <div class="h-16 flex items-center justify-between">

                        <!-- Logo and system name -->
                        <a href="{{ route('dashboard') }}"
                           class="flex items-center gap-3">

                            <img
                                src="{{ asset('assets/img/logo.png') }}"
                                alt="System logo"
                                class="w-10 h-10 object-contain"
                            >

                            <div>
                                <h1 class="text-base sm:text-lg font-bold text-slate-900">
                                    Student Management System
                                </h1>
                                <p class="text-xs text-slate-500 hidden sm:block">
                                    Campus Academic Portal
                                </p>
                            </div>
                        </a>

                        <!-- User details and logout -->
                        <div class="flex items-center gap-3">

                            <div class="hidden sm:block text-right">
                                <p class="text-sm font-semibold text-slate-800">
                                    {{ auth()->user()->name }}
                                </p>

                                <p class="text-xs text-slate-500 capitalize">
                                    {{ $currentRole }}
                                </p>
                            </div>

                            <div class="w-9 h-9 rounded-full bg-blue-100 text-blue-700
                                        flex items-center justify-center font-bold text-sm">
                                {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                            </div>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit"
                                    class="hidden sm:inline-flex items-center gap-2
                                           text-sm font-medium text-slate-600
                                           hover:text-red-600 transition">

                                    <i data-lucide="log-out" class="w-4 h-4"></i>
                                    Logout
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            </header>


            <!-- MOBILE NAVIGATION -->
            <nav class="md:hidden bg-white border-b border-slate-200 px-3 py-2
                        overflow-x-auto">

                <div class="flex items-center gap-2">

                    @if(Route::has('dashboard'))
                        <a href="{{ route('dashboard') }}"
                           class="mobile-link {{ request()->routeIs('dashboard', 'admin.dashboard', 'lecturer.dashboard', 'student.dashboard') ? 'active' : '' }}">
                            <i data-lucide="layout-dashboard" class="w-4 h-4"></i>
                            Dashboard
                        </a>
                    @endif

                    @if($currentRole === 'admin' && Route::has('students.index'))
                        <a href="{{ route('students.index') }}"
                           class="mobile-link {{ request()->routeIs('students.*') ? 'active' : '' }}">
                            <i data-lucide="users" class="w-4 h-4"></i>
                            Students
                        </a>
                    @endif

                    @if($currentRole === 'admin' && Route::has('admin.registrations'))
                        <a href="{{ route('admin.registrations') }}"
                           class="mobile-link {{ request()->routeIs('admin.registrations*') ? 'active' : '' }}">
                            <i data-lucide="clipboard-list" class="w-4 h-4"></i>
                            Registrations
                        </a>
                    @endif

                    @if($currentRole === 'lecturer' && Route::has('courses.index'))
                        <a href="{{ route('courses.index') }}"
                           class="mobile-link {{ request()->routeIs('courses.*') ? 'active' : '' }}">
                            <i data-lucide="book-open" class="w-4 h-4"></i>
                            Courses
                        </a>
                    @endif

                    @if($currentRole === 'lecturer' && Route::has('lecturer.my-courses'))
                        <a href="{{ route('lecturer.my-courses') }}"
                           class="mobile-link {{ request()->routeIs('lecturer.my-courses', 'lecturer.course-students') ? 'active' : '' }}">
                            <i data-lucide="users" class="w-4 h-4"></i>
                            Class Lists
                        </a>
                    @endif

                    @if($currentRole === 'student' && Route::has('student.courses'))
                        <a href="{{ route('student.courses') }}"
                           class="mobile-link {{ request()->routeIs('student.courses') ? 'active' : '' }}">
                            <i data-lucide="book-open" class="w-4 h-4"></i>
                            Courses
                        </a>
                    @endif

                    @if($currentRole === 'student' && Route::has('student.my-registrations'))
                        <a href="{{ route('student.my-registrations') }}"
                           class="mobile-link {{ request()->routeIs('student.my-registrations') ? 'active' : '' }}">
                            <i data-lucide="clipboard-list" class="w-4 h-4"></i>
                            My Registrations
                        </a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="mobile-link">
                            <i data-lucide="log-out" class="w-4 h-4"></i>
                            Logout
                        </button>
                    </form>

                </div>
            </nav>


            <!-- MAIN APPLICATION AREA -->
            <div class="flex flex-1 max-w-screen-2xl w-full mx-auto">

                <!-- DESKTOP SIDEBAR -->
                <aside class="hidden md:flex flex-col w-64 shrink-0
                              bg-white border-r border-slate-200 min-h-[calc(100vh-64px)]">

                    <div class="px-5 pt-7 pb-3">
                        <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">
                            Main Menu
                        </p>
                    </div>

                    <nav class="px-3 space-y-1">

                        <a href="{{ route('dashboard') }}"
                           class="sidebar-link {{ request()->routeIs('dashboard', 'admin.dashboard', 'lecturer.dashboard', 'student.dashboard') ? 'active' : '' }}">
                            <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                            Dashboard
                        </a>


                        @if($currentRole === 'admin')

                            <p class="px-3 pt-6 pb-2 text-xs font-semibold
                                      text-slate-400 uppercase tracking-wider">
                                Administration
                            </p>

                            @if(Route::has('students.index'))
                                <a href="{{ route('students.index') }}"
                                   class="sidebar-link {{ request()->routeIs('students.*') ? 'active' : '' }}">
                                    <i data-lucide="users" class="w-5 h-5"></i>
                                    Manage Students
                                </a>
                            @endif

                            @if(Route::has('courses.index'))
                                <a href="{{ route('courses.index') }}"
                                   class="sidebar-link {{ request()->routeIs('courses.*') ? 'active' : '' }}">
                                    <i data-lucide="book-open" class="w-5 h-5"></i>
                                    Manage Courses
                                </a>
                            @endif

                            @if(Route::has('lecturers.index'))
                                <a href="{{ route('lecturers.index') }}"
                                   class="sidebar-link {{ request()->routeIs('lecturers.*') ? 'active' : '' }}">
                                    <i data-lucide="graduation-cap" class="w-5 h-5"></i>
                                    Manage Lecturers
                                </a>
                            @endif

                            @if(Route::has('admin.registrations'))
                                <a href="{{ route('admin.registrations') }}"
                                   class="sidebar-link {{ request()->routeIs('admin.registrations*') ? 'active' : '' }}">
                                    <i data-lucide="clipboard-list" class="w-5 h-5"></i>
                                    Manage Registrations
                                </a>
                            @endif

                        @elseif($currentRole === 'lecturer')

                            <p class="px-3 pt-6 pb-2 text-xs font-semibold
                                      text-slate-400 uppercase tracking-wider">
                                Teaching
                            </p>

                            @if(Route::has('courses.index'))
                                <a href="{{ route('courses.index') }}"
                                   class="sidebar-link {{ request()->routeIs('courses.*') ? 'active' : '' }}">
                                    <i data-lucide="book-open" class="w-5 h-5"></i>
                                    My Courses
                                </a>
                            @endif

                            @if(Route::has('lecturer.my-courses'))
                                <a href="{{ route('lecturer.my-courses') }}"
                                   class="sidebar-link {{ request()->routeIs('lecturer.my-courses', 'lecturer.course-students') ? 'active' : '' }}">
                                    <i data-lucide="users" class="w-5 h-5"></i>
                                    Class Lists
                                </a>
                            @endif

                        @elseif($currentRole === 'student')

                            <p class="px-3 pt-6 pb-2 text-xs font-semibold
                                      text-slate-400 uppercase tracking-wider">
                                Academics
                            </p>

                            @if(Route::has('student.courses'))
                                <a href="{{ route('student.courses') }}"
                                   class="sidebar-link {{ request()->routeIs('student.courses') ? 'active' : '' }}">
                                    <i data-lucide="book-open" class="w-5 h-5"></i>
                                    Browse Courses
                                </a>
                            @endif

                            @if(Route::has('student.my-registrations'))
                                <a href="{{ route('student.my-registrations') }}"
                                   class="sidebar-link {{ request()->routeIs('student.my-registrations') ? 'active' : '' }}">
                                    <i data-lucide="clipboard-list" class="w-5 h-5"></i>
                                    My Registrations
                                </a>
                            @endif

                        @endif

                    </nav>

                    <!-- Sidebar footer -->
                    <div class="mt-auto p-4 border-t border-slate-100">
                        <div class="rounded-xl bg-blue-50 p-4">
                            <p class="text-sm font-semibold text-blue-900">
                                Student Management System
                            </p>
                            <p class="text-xs text-blue-700 mt-1">
                                Academic administration portal
                            </p>
                        </div>
                    </div>

                </aside>


                <!-- PAGE CONTENT -->
                <main class="flex-1 min-w-0 p-4 sm:p-6 lg:p-8">

                    @if(session('success'))
                        <div class="mb-5 p-4 rounded-lg bg-green-50 border border-green-200
                                    text-green-700 text-sm flex items-center gap-2">
                            <i data-lucide="check-circle" class="w-5 h-5"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-5 p-4 rounded-lg bg-red-50 border border-red-200
                                    text-red-700 text-sm">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-5 p-4 rounded-lg bg-red-50 border border-red-200
                                    text-red-700 text-sm">
                            <p class="font-semibold mb-2">
                                Please correct the following errors:
                            </p>

                            <ul class="list-disc pl-5 space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @yield('content')

                </main>

            </div>


            <!-- FOOTER -->
            <footer class="bg-white border-t border-slate-200 px-6 py-5">
                <div class="max-w-screen-2xl mx-auto flex flex-col sm:flex-row
                            items-center justify-between gap-2">

                    <p class="text-xs text-slate-500">
                        &copy; {{ date('Y') }} Student Management System. All rights reserved.
                    </p>

                    <p class="text-xs text-slate-500">
                        Campus Academic Portal
                    </p>

                </div>
            </footer>

        </div>

    @else

        <!-- PUBLIC PAGES, INCLUDING LOGIN -->
        @yield('content')

    @endauth


    <!-- ICON INITIALISATION -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (window.lucide) {
                lucide.createIcons();
            }
        });
    </script>

</body>
</html>

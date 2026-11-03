<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Display the login page
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectToRoleDashboard();
        }

        // IMPORTANT: The login file is inside the auth folder.
        return view('auth.login');
    }

    // Process login details
    public function loginSubmit(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (!Auth::attempt(
            $credentials,
            $request->boolean('remember')
        )) {
            return back()
                ->withErrors([
                    'email' => 'The email or password you entered is incorrect.',
                ])
                ->onlyInput('email');
        }

        // Prevent session fixation after successful login.
        $request->session()->regenerate();

        // Send the user to the dashboard for their role.
        return $this->redirectToRoleDashboard()
            ->with('success', 'Welcome! You have successfully signed in.');
    }

    // Redirect according to the user's role.
    private function redirectToRoleDashboard()
    {
        $role = strtolower(trim(Auth::user()->role ?? ''));

        if ($role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        if ($role === 'lecturer') {
            return redirect()->route('lecturer.dashboard');
        }

        if ($role === 'student') {
            return redirect()->route('student.dashboard');
        }

        // An account without a recognized role should not enter the system.
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->withErrors([
                'email' => 'Your account has no valid role. Please contact the administrator.',
            ]);
    }

    // Log out
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'You have successfully logged out.');
    }
}
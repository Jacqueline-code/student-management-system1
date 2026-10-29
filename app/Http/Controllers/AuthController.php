<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display the login page.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.login');
    }

    /**
     * Process login submission.
     */
    public function loginSubmit(Request $request)
    {
        // Validate the submitted details
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt authentication
        if (Auth::attempt($credentials, $request->boolean('remember'))) {

            // Regenerate session for security
            $request->session()->regenerate();

            // Redirect to home page
            return redirect()->intended(route('home'));
        }

        // Return error if credentials are incorrect
        return back()
            ->withErrors([
                'email' => 'The email or password you entered is incorrect.',
            ])
            ->onlyInput('email');
    }

    /**
     * Log the user out.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
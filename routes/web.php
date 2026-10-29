<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Home page
Route::get('/', function () {
    return view('home');
})->name('home');

// Login page
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

// Login form submission
Route::post('/login', [AuthController::class, 'loginSubmit'])
    ->name('login.submit');

// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Protected dashboard/home page (optional)
Route::get('/dashboard', function () {
    return view('home');
})->middleware('auth')->name('dashboard');
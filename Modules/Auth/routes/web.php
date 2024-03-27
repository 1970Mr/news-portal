<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\App\Http\Controllers\LoginController;
use Modules\Auth\App\Http\Controllers\LogoutController;
use Modules\Auth\App\Http\Controllers\PasswordResetController;
use Modules\Auth\App\Http\Controllers\RegisterController;
use Modules\Auth\App\Http\Controllers\VerifyEmailController;

// Login
Route::get('/login', [LoginController::class, 'view'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');

// Register
Route::get('/register', [RegisterController::class, 'view'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');

// Verify Email
Route::controller(VerifyEmailController::class)->prefix('/email')->name('verification.')->middleware(['auth', 'not.verified'])
    ->group(function () {
        Route::get('/verify', 'view')->name('notice');
        Route::get('/verify/{id}/{hash}', 'verify')->name('verify')->middleware('signed');
        Route::post('/verification-notification', 'send')->name('send')->middleware('throttle:5,1');
    });

// Password Reset
Route::controller(PasswordResetController::class)->name('password.')->middleware(['guest'])
    ->group(function () {
        Route::get('/forgot-password', 'showForgotForm')->name('request');
        Route::post('/forgot-password', 'sendResetLink')->name('email')->middleware('throttle:5,1');
        Route::get('/reset-password/{token}', 'showResetForm')->name('reset');
        Route::post('/reset-password', 'update')->name('update')->middleware('throttle:5,1');
    });

// Logout
Route::post('/logout', LogoutController::class)->name('logout')->middleware('auth');

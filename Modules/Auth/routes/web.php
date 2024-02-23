<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\App\Http\Controllers\LoginController;
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

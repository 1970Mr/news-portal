<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\App\Http\Controllers\LoginController;
use Modules\Auth\App\Http\Controllers\RegisterController;

// Login
Route::get('/login', [LoginController::class, 'view'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');

// Register
Route::get('/register', [RegisterController::class, 'view'])->name('register')->middleware('guest');
Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');

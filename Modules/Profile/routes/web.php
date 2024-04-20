<?php

use Illuminate\Support\Facades\Route;
use Modules\Profile\App\Http\Controllers\ProfileController;

Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('profile/edit', [ProfileController::class, 'update']);

Route::get('profile/email/change', [ProfileController::class, 'changeEmailView'])->name('profile.email.change');
Route::patch('profile/email/change', [ProfileController::class, 'sendChangeEmailVerification']);
Route::get('profile/email/change/verify', [ProfileController::class, 'verifyChangeEmail'])->name('profile.email.change.verify')->middleware('signed');

Route::get('profile/password/change', [ProfileController::class, 'changePasswordView'])->name('profile.password.change');
Route::patch('profile/password/change', [ProfileController::class, 'changePassword']);

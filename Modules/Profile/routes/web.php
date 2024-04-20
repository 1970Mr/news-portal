<?php

use Illuminate\Support\Facades\Route;
use Modules\Profile\App\Http\Controllers\ChangeEmailController;
use Modules\Profile\App\Http\Controllers\ChangePasswordController;
use Modules\Profile\App\Http\Controllers\ProfileController;

Route::group([], function () {
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile/edit', [ProfileController::class, 'update']);

    Route::get('profile/email/change', [ChangeEmailController::class, 'changeEmailView'])->name('profile.email.change');
    Route::patch('profile/email/change', [ChangeEmailController::class, 'sendChangeEmailVerification']);
    Route::get('profile/email/change/verify', [ChangeEmailController::class, 'verifyChangeEmail'])->name('profile.email.change.verify')->middleware('signed');

    Route::get('profile/password/change', [ChangePasswordController::class, 'changePasswordView'])->name('profile.password.change');
    Route::patch('profile/password/change', [ChangePasswordController::class, 'changePassword']);
});

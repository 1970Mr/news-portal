<?php

use Illuminate\Support\Facades\Route;
use Modules\Profile\App\Http\Controllers\ChangeEmailController;
use Modules\Profile\App\Http\Controllers\ChangePasswordController;
use Modules\Profile\App\Http\Controllers\ProfileController;

Route::prefix('profile')->name('profile.')->group(function () {
    Route::prefix('edit')->name('edit')->controller(ProfileController::class)->group(function () {
        Route::get('/', 'edit');
        Route::patch('/', 'update');
    })->middleware('can:' . config('permissions_list.PROFILE_EDIT'));

    Route::get('email/change', [ChangeEmailController::class, 'changeEmailView'])->name('email.change');
    Route::patch('email/change', [ChangeEmailController::class, 'sendChangeEmailVerification']);
    Route::get('email/change/verify', [ChangeEmailController::class, 'verifyChangeEmail'])->name('email.change.verify')->middleware('signed');

    Route::get('password/change', [ChangePasswordController::class, 'changePasswordView'])->name('password.change');
    Route::patch('password/change', [ChangePasswordController::class, 'changePassword']);
});

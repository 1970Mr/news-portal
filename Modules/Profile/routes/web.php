<?php

use Illuminate\Support\Facades\Route;
use Modules\Profile\App\Http\Controllers\ChangeEmailController;
use Modules\Profile\App\Http\Controllers\ChangePasswordController;
use Modules\Profile\App\Http\Controllers\ProfileController;
use Modules\Profile\App\Http\Controllers\SocialNetworkController;

Route::prefix(config('app.panel_prefix', 'panel') . '/profile')->name(config('app.panel_prefix', 'panel') . '.profile.')->group(function () {

    Route::prefix('')->name('edit')->controller(ProfileController::class)->group(function () {
        Route::get('/', 'edit');
        Route::patch('/', 'update');
    });

    Route::prefix('email/change')->name('email.change')->controller(ChangeEmailController::class)->group(function () {
        Route::get('/', 'changeEmailView');
        Route::patch('/', 'sendChangeEmailVerification');
        Route::get('/verify', 'verifyChangeEmail')->name('.verify')->middleware('signed');
    });

    Route::prefix('password/change')->name('password.change')->controller(ChangePasswordController::class)->group(function () {
        Route::get('/', 'changePasswordView');
        Route::patch('/', 'changePassword');
    });

    Route::prefix('social-networks')->name('social-networks.edit')->controller(SocialNetworkController::class)->group(function () {
        Route::get('/', 'edit');
        Route::put('/', 'update');
    });
});

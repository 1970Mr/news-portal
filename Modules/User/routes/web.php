<?php

use Illuminate\Support\Facades\Route;
use Modules\User\App\Http\Controllers\UserController;

Route::group([], function () {
    Route::resource('users', UserController::class)->names('users')->except(['show']);
});

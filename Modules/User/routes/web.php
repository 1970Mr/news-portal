<?php

use Illuminate\Support\Facades\Route;
use Modules\User\App\Http\Controllers\UserController;

Route::group([], function () {
    Route::resource('user', UserController::class)->names('user')->except(['show']);
});

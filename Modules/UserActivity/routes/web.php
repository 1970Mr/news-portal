<?php

use Illuminate\Support\Facades\Route;
use Modules\UserActivity\App\Http\Controllers\UserTrackController;

Route::prefix(config('app.panel_prefix', 'panel'))
    ->name(config('app.panel_prefix', 'panel') . '.')
    ->group(function () {
    Route::resource('user-tracks', UserTrackController::class)->names('user-tracks')->only(['index', 'destroy']);
});

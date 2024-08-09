<?php

use Illuminate\Support\Facades\Route;
use Modules\UserActivity\App\Http\Controllers\RequestTrackController;
use Modules\UserActivity\App\Http\Controllers\UserTrackController;

Route::prefix(config('app.panel_prefix', 'panel'))
    ->name(config('app.panel_prefix', 'panel').'.')
    ->group(function () {
        Route::resource('users-track', UserTrackController::class)->names('users-track')->only(['index', 'destroy']);

        Route::resource('requests-track', RequestTrackController::class)->names('requests-track')->only(['index', 'destroy']);
        Route::get('requests-track/visits-stats', [RequestTrackController::class, 'visitsStats'])->name('requests-track.visits-stats');
    });

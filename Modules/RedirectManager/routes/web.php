<?php

use Illuminate\Support\Facades\Route;
use Modules\RedirectManager\App\Http\Controllers\RedirectController;

Route::prefix(config('app.panel_prefix', 'panel'))
    ->name(config('app.panel_prefix', 'panel').'.')
    ->group(function () {
        Route::resource('redirects', RedirectController::class)->names('redirects')->except(['show']);
    });

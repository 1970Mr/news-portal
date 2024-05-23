<?php

use Illuminate\Support\Facades\Route;
use Modules\AdManager\App\Http\Controllers\AdController;

Route::prefix(config('app.panel_prefix', 'panel'))
    ->name(config('app.panel_prefix', 'panel') . '.')->group(function () {
    Route::resource('/ads', AdController::class)->except('show');
});

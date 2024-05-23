<?php

use Illuminate\Support\Facades\Route;
use Modules\AdManager\App\Http\Controllers\AdController;

Route::prefix(config('app.panel_prefix', 'panel') . '/ads')
    ->name(config('app.panel_prefix', 'panel') . '.ads.')->group(function () {
    Route::resource('', AdController::class);
});

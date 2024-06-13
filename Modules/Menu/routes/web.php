<?php

use Illuminate\Support\Facades\Route;
use Modules\Menu\App\Http\Controllers\MenuController;

Route::prefix(config('app.panel_prefix', 'panel'))
    ->name(config('app.panel_prefix', 'panel') . '.')
    ->group(function () {
    Route::resource('menu', MenuController::class)->names('menu');
});

<?php

use Illuminate\Support\Facades\Route;
use Modules\Panel\App\Http\Controllers\PanelController;

Route::prefix(config('app.panel_prefix', 'panel'))->name(config('app.panel_prefix', 'panel') . '.')->group(function () {
    Route::name('index')->get('/', PanelController::class);
});

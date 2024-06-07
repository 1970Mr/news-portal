<?php

use Illuminate\Support\Facades\Route;
use Modules\SEOManager\App\Http\Controllers\SEOController;


Route::prefix(config('app.panel_prefix', 'panel'))
    ->name(config('app.panel_prefix', 'panel') . '.seo-settings.')
    ->group(function () {
        Route::put('/', [SEOController::class, 'adjustSEOSettings'])->name('adjust');
    });

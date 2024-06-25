<?php

use Illuminate\Support\Facades\Route;
use Modules\PageBuilder\App\Http\Controllers\Front\PageController;
use Modules\PageBuilder\App\Http\Controllers\PageBuilderController;

Route::prefix(config('app.panel_prefix', 'panel'))
    ->name(config('app.panel_prefix', 'panel') . '.')
    ->group(function () {
        Route::resource('pages', PageBuilderController::class)->names('pages');
    });

// Front routes
Route::get('pages/{page:slug}', PageController::class)->name('pages.show');

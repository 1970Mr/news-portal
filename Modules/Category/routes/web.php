<?php

use Illuminate\Support\Facades\Route;
use Modules\Category\App\Http\Controllers\CategoryController;

Route::prefix(config('app.panel_prefix', 'panel'))
    ->name(config('app.panel_prefix', 'panel') . '.')
    ->group(function () {
        Route::resource('categories', CategoryController::class)->names('categories')->except(['show']);
        Route::get('categories/seo-settings/{category}', [CategoryController::class, 'SEOSettings'])->name('categories.seo-settings');
    });

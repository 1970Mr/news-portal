<?php

use Illuminate\Support\Facades\Route;
use Modules\Tag\App\Http\Controllers\TagController;

Route::prefix(config('app.panel_prefix', 'panel'))
    ->name(config('app.panel_prefix', 'panel').'.')
    ->group(function () {
        Route::resource('tags', TagController::class)->names('tags')->except(['show']);
        Route::get('tags/seo-settings/{tag}', [TagController::class, 'SEOSettings'])->name('tags.seo-settings');
    });

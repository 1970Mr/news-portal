<?php

use Illuminate\Support\Facades\Route;
use Modules\Article\App\Http\Controllers\ArticleController;
use Spatie\Honeypot\ProtectAgainstSpam;

Route::prefix(config('app.panel_prefix', 'panel'))
    ->name(config('app.panel_prefix', 'panel') . '.')
    ->group(function () {
    Route::resource('articles', ArticleController::class)->names('articles')->middleware('auth');
    Route::get('articles/seo-settings/{article}', [ArticleController::class, 'SEOSettings'])->name('articles.seo-settings');
});

// Front routes
Route::get('news/{category:slug}/{article:slug}', [\Modules\Article\App\Http\Controllers\Front\ArticleController::class, 'show'])->name('news.show');

Route::prefix('news/{article:slug}')
    ->controller(\Modules\Article\App\Http\Controllers\Front\ArticleController::class)
    ->name('news.')
    ->middleware(ProtectAgainstSpam::class)
    ->group(function () {
        Route::patch('/like', 'like')->name('like');
        Route::patch('/unlike', 'unlike')->name('unlike');
    });

Route::feeds();

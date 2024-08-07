<?php

use Illuminate\Support\Facades\Route;
use Modules\Article\App\Http\Controllers\ArticleController;
use Modules\Article\App\Http\Controllers\Front\ArticleController as FrontArticleController;
use Spatie\Honeypot\ProtectAgainstSpam;

Route::prefix(config('app.panel_prefix', 'panel'))
    ->name(config('app.panel_prefix', 'panel').'.')
    ->group(function () {
        Route::resource('articles', ArticleController::class)->names('articles')->middleware('auth');
        Route::get('articles/seo-settings/{article}', [ArticleController::class, 'SEOSettings'])->name('articles.seo-settings');
    });

// Front routes
Route::get('news/{date}/{article:slug}', [FrontArticleController::class, 'showNews'])->name('news.show')
    ->where('date', '[0-9]{4}/[0-9]{2}/[0-9]{2}');
Route::get('articles/{article:slug}', [FrontArticleController::class, 'show'])->name('articles.show');

Route::prefix('news/{article:slug}')
    ->controller(FrontArticleController::class)
    ->name('news.')
    ->middleware(ProtectAgainstSpam::class)
    ->group(function () {
        Route::patch('/like', 'like')->name('like');
        Route::patch('/unlike', 'unlike')->name('unlike');
    });

Route::feeds();

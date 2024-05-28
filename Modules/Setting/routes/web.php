<?php

use Illuminate\Support\Facades\Route;
use Modules\Setting\App\Http\Controllers\AboutUsController;
use Modules\Setting\App\Http\Controllers\CacheController;
use Modules\Setting\App\Http\Controllers\SiteDetailController;
use Modules\Setting\App\Http\Controllers\SocialNetworkController;

Route::prefix(config('app.panel_prefix', 'panel') . '/settings')
    ->name(config('app.panel_prefix', 'panel') . '.settings.')
    ->group(function () {
        Route::prefix('/social-networks')
            ->name('social-networks.')
            ->controller(SocialNetworkController::class)->group(function () {
                Route::get('/', 'edit')->name('edit');
                Route::put('/', 'update');
            });

        Route::prefix('/about-us')
            ->name('about-us.')
            ->controller(AboutUsController::class)->group(function () {
                Route::get('/', 'edit')->name('edit');
                Route::put('/', 'update');
            });

        Route::prefix('/site-details')
            ->name('site-details.')
            ->controller(SiteDetailController::class)->group(function () {
                Route::get('/', 'edit')->name('edit');
                Route::put('/', 'update');
            });

        Route::prefix('/cache-management')
            ->name('cache-management.')
            ->controller(CacheController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::post('/clear-all', 'clearAllCache')->name('clear-all');
                Route::post('/clear-view', 'clearViewCache')->name('clear-view');
                Route::post('/clear-config', 'clearConfigCache')->name('clear-config');
                Route::post('/clear-route', 'clearRouteCache')->name('clear-route');
                Route::post('/clear-application', 'clearApplicationCache')->name('clear-application');
            });

    });

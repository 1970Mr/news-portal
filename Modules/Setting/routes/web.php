<?php

use Illuminate\Support\Facades\Route;
use Modules\Setting\App\Http\Controllers\AboutUsController;
use Modules\Setting\App\Http\Controllers\SocialNetworkController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

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
    });

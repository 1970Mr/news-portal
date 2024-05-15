<?php

use Illuminate\Support\Facades\Route;
use Modules\ContactUs\App\Http\Controllers\ContactInfoController;
use Modules\ContactUs\App\Http\Controllers\UserMessageController;
use Modules\ContactUs\App\Http\Controllers\Front\UserMessageController as FrontUserMessageController;

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

Route::prefix(config('app.panel_prefix', 'panel') . '/contact-us')
    ->name(config('app.panel_prefix', 'panel') . '.contact-us.')
    ->group(function () {
        Route::controller(ContactInfoController::class)->group(function () {
                Route::get('/edit', 'edit')->name('edit');
                Route::put('/update', 'update')->name('update');
            });

        Route::controller(UserMessageController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::put('/show/{userMessage}', 'show')->name('show');
        });
    });

Route::get('contact-us', [FrontUserMessageController::class, 'index'])->name('contact-us.index');


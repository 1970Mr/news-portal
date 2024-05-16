<?php

use Illuminate\Support\Facades\Route;
use Modules\ContactUs\App\Http\Controllers\ContactInfoController;
use Modules\ContactUs\App\Http\Controllers\UserMessageController;
use Modules\ContactUs\App\Http\Controllers\Front\UserMessageController as FrontUserMessageController;

Route::prefix(config('app.panel_prefix', 'panel') . '/contact-us')
    ->name(config('app.panel_prefix', 'panel') . '.contact-us.')
    ->group(function () {
        Route::controller(ContactInfoController::class)->group(function () {
                Route::get('/edit', 'edit')->name('edit');
                Route::put('/update', 'update')->name('update');
            });

        Route::controller(UserMessageController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/show/{userMessage}', 'show')->name('show');
        });
    });

Route::prefix('contact-us')
    ->name('contact-us.')
    ->controller(FrontUserMessageController::class)
    ->group(function () {
        Route::get('/', [FrontUserMessageController::class, 'index'])->name('index');
        Route::post('/message', [FrontUserMessageController::class, 'store'])->name('message');
    });

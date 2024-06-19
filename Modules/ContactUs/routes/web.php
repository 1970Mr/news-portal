<?php

use Illuminate\Support\Facades\Route;
use Modules\ContactUs\App\Http\Controllers\ContactInfoController;
use Modules\ContactUs\App\Http\Controllers\Front\ContactUsController as FrontUserMessageController;
use Modules\ContactUs\App\Http\Controllers\UserMessageController;
use Spatie\Honeypot\ProtectAgainstSpam;

Route::prefix(config('app.panel_prefix', 'panel') . '/contact-us')
    ->name(config('app.panel_prefix', 'panel') . '.contact-us.')
    ->middleware(['web', 'auth', 'verified'])
    ->group(function () {
        Route::prefix('info')
            ->name('info.')
            ->controller(ContactInfoController::class)
            ->group(function () {
                Route::get('/edit', 'edit')->name('edit');
                Route::put('/update', 'update')->name('update');
            });

        Route::prefix('messages')
            ->name('messages.')
            ->controller(UserMessageController::class)
            ->group(function () {
                Route::get('/', 'index')->name('index');
                Route::get('/show/{userMessage}', 'show')->name('show');
                Route::post('/mark-all-seen', 'markAllAsSeen')->name('mark-all-seen');
            });
    });

Route::prefix('contact-us')
    ->name('contact-us.')
    ->controller(FrontUserMessageController::class)
    ->middleware(ProtectAgainstSpam::class)
    ->group(function () {
        Route::get('/', [FrontUserMessageController::class, 'index'])->name('index');
        Route::post('/message', [FrontUserMessageController::class, 'store'])->name('message');
    });

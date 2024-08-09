<?php

use Illuminate\Support\Facades\Route;
use Modules\Newsletter\App\Http\Controllers\Front\NewsletterController as FrontNewsletterController;
use Modules\Newsletter\App\Http\Controllers\NewsletterController;

Route::prefix(config('app.panel_prefix', 'panel').'/newsletters')
    ->name(config('app.panel_prefix', 'panel').'.newsletters.')
    ->controller(NewsletterController::class)
    ->middleware(['web', 'auth', 'verified'])
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::delete('/{newsletter}', 'destroy')->name('destroy');
    });

Route::post('newsletters/subscribe', [FrontNewsletterController::class, 'subscribe'])->name('newsletters.subscribe');

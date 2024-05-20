<?php

use Illuminate\Support\Facades\Route;
use Modules\Newsletter\App\Http\Controllers\NewsletterController;

Route::prefix(config('app.panel_prefix', 'panel') . '/newsletters')
    ->name(config('app.panel_prefix', 'panel') . '.newsletters.')
    ->controller(NewsletterController::class)
    ->group(function () {
       Route::get('/', 'index')->name('index');
       Route::delete('/', 'destroy')->name('destroy');
    });

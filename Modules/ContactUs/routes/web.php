<?php

use Illuminate\Support\Facades\Route;
use Modules\ContactUs\App\Http\Controllers\ContactInfoController;

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
    });

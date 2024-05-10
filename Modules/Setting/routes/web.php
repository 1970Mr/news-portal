<?php

use Illuminate\Support\Facades\Route;
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

Route::prefix(config('app.panel_prefix', 'panel') . '/settings/social-networks')
    ->name(config('app.panel_prefix', 'panel') . '.settings.social-networks.')
    ->controller(SocialNetworkController::class)->group(function () {
    Route::get('/', 'edit')->name('edit');
    Route::put('/', 'update');
});

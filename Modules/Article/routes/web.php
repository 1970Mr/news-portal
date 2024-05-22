<?php

use Illuminate\Support\Facades\Route;
use Modules\Article\App\Http\Controllers\ArticleController;

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

Route::prefix(config('app.panel_prefix', 'panel'))->name(config('app.panel_prefix', 'panel') . '.')->group(function () {
    Route::resource('articles', ArticleController::class)->names('articles')->middleware('auth');
});

// Front routes
Route::get('news/{category:slug}/{article:slug}', [\Modules\Article\App\Http\Controllers\Front\ArticleController::class, 'show'])->name('news.show');
Route::feeds();

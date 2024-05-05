<?php

use Illuminate\Support\Facades\Route;
use Modules\Comment\App\Http\Controllers\CommentController;
use Modules\Comment\App\Http\Controllers\Front\CommentController as FrontCommentController;

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

Route::prefix('comments')->name('comments.')->controller(FrontCommentController::class)->group(function () {
    Route::post('/', 'store')->name('store');
    Route::put('/{comment}', 'update')->name('update');
    Route::delete('/{comment}', 'destroy')->name('destroy');
    Route::post('/{comment}', 'reply')->name('reply');
});

Route::prefix('admin/comments')->name('admin.comments.')->controller(CommentController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::patch('/approve/{comment}', 'approve')->name('approve');
    Route::patch('/reject/{comment}', 'reject')->name('reject');
    Route::delete('/{comment}', 'destroy')->name('destroy');
});

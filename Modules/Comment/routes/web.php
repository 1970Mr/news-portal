<?php

use Illuminate\Support\Facades\Route;
use Modules\Comment\App\Http\Controllers\Front\CommentController;

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

Route::group([], function () {
    Route::post('comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::put('comments/{comment}', [CommentController::class, 'update'])->name('comments.update');
    Route::post('comments/{comment}', [CommentController::class, 'reply'])->name('comments.reply');
});

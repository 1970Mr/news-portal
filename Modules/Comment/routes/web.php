<?php

use Illuminate\Support\Facades\Route;
use Modules\Comment\App\Http\Controllers\CommentController;
use Modules\Comment\App\Http\Controllers\Front\CommentController as FrontCommentController;

Route::prefix(config('app.panel_prefix', 'panel') . '/comments')->name(config('app.panel_prefix', 'panel') . '.comments.')->controller(CommentController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::patch('/approve/{comment}', 'approve')->name('approve');
    Route::post('/approve-all', 'approveAll')->name('approve-all');
    Route::patch('/reject/{comment}', 'reject')->name('reject');
    Route::get('/{comment}', 'show')->name('show');
    Route::delete('/{comment}', 'destroy')->name('destroy');
});

Route::prefix('comments')->name('comments.')->controller(FrontCommentController::class)->group(function () {
    Route::post('/', 'store')->name('store');
    Route::put('/{comment}', 'update')->name('update');
    Route::delete('/{comment}', 'destroy')->name('destroy');
    Route::post('/{comment}', 'reply')->name('reply');
});

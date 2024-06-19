<?php

use Illuminate\Support\Facades\Route;
use Modules\Comment\App\Http\Controllers\CommentController;
use Modules\Comment\App\Http\Controllers\Front\CommentController as FrontCommentController;
use Spatie\Honeypot\ProtectAgainstSpam;

Route::prefix(config('app.panel_prefix', 'panel') . '/comments')
    ->name(config('app.panel_prefix', 'panel') . '.comments.')
    ->controller(CommentController::class)
    ->middleware(['web', 'auth', 'verified'])
    ->group(function () {
        Route::get('/', 'index')->name('index');
        Route::patch('/approve/{comment}', 'approve')->name('approve');
        Route::post('/approve-all', 'approveAll')->name('approve-all');
        Route::patch('/reject/{comment}', 'reject')->name('reject');
        Route::get('/{comment}', 'show')->name('show');
        Route::delete('/{comment}', 'destroy')->name('destroy');
    });

Route::prefix('comments')
    ->name('comments.')
    ->controller(FrontCommentController::class)
    ->middleware(ProtectAgainstSpam::class)
    ->group(function () {
        Route::post('/', 'store')->name('store');
        Route::put('/{comment}', 'update')->name('update');
        Route::delete('/{comment}', 'destroy')->name('destroy');
        Route::post('/{comment}', 'reply')->name('reply');
    });

<?php

use Illuminate\Support\Facades\Route;
use Modules\FileManager\App\Http\Controllers\ImageController;
use Modules\FileManager\App\Http\Controllers\VideoController;

Route::prefix(config('app.panel_prefix', 'panel'))->name(config('app.panel_prefix', 'panel') . '.')->group(function () {
    Route::resource('images', ImageController::class)->names('images')->except(['show', 'store']);
    Route::post('image-upload', [ImageController::class, 'imageUpload'])->name('images.upload');

    Route::resource('videos', VideoController::class)->names('videos')->except(['show']);
    Route::delete('videos/{video}/thumbnail', [VideoController::class, 'deleteThumbnail'])->name('videos.destroy-thumbnail');
});

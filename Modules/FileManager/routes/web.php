<?php

use Illuminate\Support\Facades\Route;
use Modules\FileManager\App\Http\Controllers\ImageController;

Route::prefix(config('app.panel_prefix', 'panel'))->name(config('app.panel_prefix', 'panel') . '.')->group(function () {
    Route::resource('images', ImageController::class)->names('images')->except(['show', 'store']);
    Route::get('image-selector', [ImageController::class, 'imageSelectorData'])->name('images.selector');
    Route::get('image-selector-filters', [ImageController::class, 'imageSelectorFilters'])->name('images.selector.filters');
    Route::post('image-upload', [ImageController::class, 'imageUpload'])->name('images.upload');
});

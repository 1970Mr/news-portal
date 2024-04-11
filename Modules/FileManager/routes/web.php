<?php

use Illuminate\Support\Facades\Route;
use Modules\FileManager\App\Http\Controllers\ImageController;

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
    Route::resource('image', ImageController::class)->names('image');
    Route::get('image-selector', [ImageController::class, 'imageSelectorData'])->name('image.selector');
    Route::get('image-selector-filters', [ImageController::class, 'imageSelectorFilters'])->name('image.selector.filters');
    Route::post('image-upload', [ImageController::class, 'imageUpload'])->name('image.upload');
});

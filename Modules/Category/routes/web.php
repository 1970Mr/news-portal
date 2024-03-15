<?php

use Illuminate\Support\Facades\Route;
use Modules\Category\App\Http\Controllers\CategoryController;

Route::group([], function () {
    Route::resource('category', CategoryController::class)->names('category')->except(['show']);
});

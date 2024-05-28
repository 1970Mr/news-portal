<?php

use Illuminate\Support\Facades\Route;
use Modules\Home\App\Http\Controllers\HomeController;

Route::name('home.')->group(function () {
    Route::get('/', HomeController::class)->name('index');
});

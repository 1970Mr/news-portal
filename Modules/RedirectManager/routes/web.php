<?php

use Illuminate\Support\Facades\Route;
use Modules\RedirectManager\App\Http\Controllers\RedirectManagerController;

Route::group([], function () {
    Route::resource('redirectmanager', RedirectManagerController::class)->names('redirectmanager');
});

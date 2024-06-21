<?php

use Illuminate\Support\Facades\Route;
use Modules\PageBuilder\App\Http\Controllers\PageBuilderController;

Route::group([], function () {
    Route::resource('pagebuilder', PageBuilderController::class)->names('pagebuilder');
});

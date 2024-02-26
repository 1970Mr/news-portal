<?php

use Illuminate\Support\Facades\Route;
use Modules\Panel\App\Http\Controllers\PanelController;

Route::group([], function () {
    Route::name('panel.index')->get('panel', PanelController::class);
});

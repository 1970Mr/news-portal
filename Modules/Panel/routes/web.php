<?php

use Illuminate\Support\Facades\Route;
use Modules\Panel\App\Http\Controllers\PanelController;

Route::group([], function () {
    Route::get('panel', PanelController::class)->name('panel.index');
});

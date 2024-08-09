<?php

use Illuminate\Support\Facades\Route;
use Modules\Role\App\Http\Controllers\RoleController;

Route::prefix(config('app.panel_prefix', 'panel'))->name(config('app.panel_prefix', 'panel').'.')->group(function () {
    Route::resource('roles', RoleController::class)->names('roles');
});

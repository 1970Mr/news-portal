<?php

use Illuminate\Support\Facades\Route;
use Modules\User\App\Http\Controllers\RoleAssignmentController;
use Modules\User\App\Http\Controllers\UserController;

Route::prefix(config('app.panel_prefix', 'panel'))->name(config('app.panel_prefix', 'panel') . '.')->group(function () {
    Route::resource('users', UserController::class)->names('users')->except(['show']);
    Route::get('users/role-assignment/{user}', [RoleAssignmentController::class, 'edit'])->name('users.role-assignment');
    Route::put('users/role-assignment/{user}', [RoleAssignmentController::class, 'update']);
    Route::get('users/seo-settings/{user}', [UserController::class, 'SEOSettings'])->name('users.seo-settings');
});

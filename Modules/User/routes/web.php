<?php

use Illuminate\Support\Facades\Route;
use Modules\User\App\Http\Controllers\RoleAssignmentController;
use Modules\User\App\Http\Controllers\UserController;

Route::group([], function () {
    Route::resource('user', UserController::class)->names('user')->except(['show']);
    Route::get('role-assignment/{user}', [RoleAssignmentController::class, 'edit'])->name('role.assignment');
    Route::put('role-assignment/{user}', [RoleAssignmentController::class, 'update']);
});

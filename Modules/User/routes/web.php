<?php

use Illuminate\Support\Facades\Route;
use Modules\User\App\Http\Controllers\RoleAssignmentController;
use Modules\User\App\Http\Controllers\UserController;

Route::group([], function () {
    Route::resource('user', UserController::class)->names('user')->except(['show']);
    Route::get('user/role-assignment/{user}', [RoleAssignmentController::class, 'edit'])->name('user.role-assignment');
    Route::put('user/role-assignment/{user}', [RoleAssignmentController::class, 'update']);
});

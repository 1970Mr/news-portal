<?php

use Illuminate\Support\Facades\Route;
use Modules\Profile\App\Http\Controllers\ProfileController;

Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('profile/edit', [ProfileController::class, 'update']);

<?php

use Illuminate\Support\Facades\Route;
use Modules\Front\App\Http\Controllers\AuthorController;
use Modules\Front\App\Http\Controllers\CategoryController;

Route::get('author/{user:username}', [AuthorController::class, 'index'])->name('author.index');

Route::get('categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

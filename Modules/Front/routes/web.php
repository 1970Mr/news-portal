<?php

use Illuminate\Support\Facades\Route;
use Modules\Front\App\Http\Controllers\AuthorController;
use Modules\Front\App\Http\Controllers\CategoryController;
use Modules\Front\App\Http\Controllers\SearchController;
use Modules\Front\App\Http\Controllers\TagController;

Route::get('author/{user:username}', [AuthorController::class, 'index'])->name('author.index');

Route::get('categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

Route::get('tags/{tag:slug}', [TagController::class, 'show'])->name('tags.show');

Route::get('search', SearchController::class)->name('search.index');

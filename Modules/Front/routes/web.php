<?php

use Illuminate\Support\Facades\Route;
use Modules\Front\App\Http\Controllers\AuthorController;

Route::get('author/{user:username}', [AuthorController::class, 'index'])->name('author.index');

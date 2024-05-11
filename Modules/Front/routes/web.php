<?php

use Illuminate\Support\Facades\Route;
use Modules\Front\App\Http\Controllers\AuthorController;

Route::get('author/{user}', [AuthorController::class, 'index'])->name('author.index');

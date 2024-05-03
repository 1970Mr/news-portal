<?php

use Illuminate\Support\Facades\Route;
use Modules\Front\App\Http\Controllers\ArticleController;

Route::get('news/{category:slug}/{article:slug}', [ArticleController::class, 'show'])->name('news.show');

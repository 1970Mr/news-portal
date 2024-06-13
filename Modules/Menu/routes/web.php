<?php

use Illuminate\Support\Facades\Route;
use Modules\Menu\App\Http\Controllers\CategoryMenuController;
use Modules\Menu\App\Http\Controllers\MenuController;

Route::prefix(config('app.panel_prefix', 'panel'))
    ->name(config('app.panel_prefix', 'panel') . '.')
    ->group(function () {
    Route::resource('menus', MenuController::class)->names('menus')
        ->except('show');

    Route::resource('menus/category-menu', CategoryMenuController::class)
        ->names('menus.category-menu')
        ->except(['index', 'show', 'destroy'])
        ->parameters(['category-menu' => 'menu']);
    });

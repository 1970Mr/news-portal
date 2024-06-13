<?php

use Illuminate\Support\Facades\Route;
use Modules\Menu\App\Http\Controllers\MenuController;

Route::prefix(config('app.panel_prefix', 'panel'))
    ->name(config('app.panel_prefix', 'panel') . '.')
    ->group(function () {
    Route::resource('menus', MenuController::class)->names('menus');

    Route::get('menus/category-menu/create', [MenuController::class, 'createCategoryMenu'])->name('menus.category-menu.create');
    Route::post('menus/category-menu', [MenuController::class, 'storeCategoryMenu'])->name('menus.category-menu.store');
    Route::get('menus/category-menu/{menu}/edit', [MenuController::class, 'editCategoryMenu'])->name('menus.category-menu.edit');
    Route::put('menus/category-menu/{menu}', [MenuController::class, 'storeCategoryMenu'])->name('menus.category-menu.update');
    Route::delete('menus/category-menu/{menu}', [MenuController::class, 'storeCategoryMenu'])->name('menus.category-menu.destroy');
});

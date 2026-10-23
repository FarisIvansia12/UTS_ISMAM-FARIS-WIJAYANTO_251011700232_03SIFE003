<?php

use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [RecipeController::class, 'index'])->name('recipes.index');
Route::get('/resep/{recipe}', [RecipeController::class, 'show'])
    ->whereNumber('recipe')
    ->name('recipes.show');

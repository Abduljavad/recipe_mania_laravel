<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\SavedItemController;
use App\Http\Controllers\UserController;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::controller(CategoryController::class)->group(function () {
    Route::get('category/{category}', 'show')->name('recipe.category');
});

Route::controller(RecipeController::class)->group(function () {
    Route::get('recipe/{recipe}', 'show')->name('recipe.show');
    Route::get('recipes/personal', 'personalRecipe')->name('recipe.personal');
    Route::get('/create/recipe', 'create')->name('recipe.create');
    Route::post('/recipe', 'store')->name('recipe.store');
    Route::post('/recipe/publish/{recipe}', 'publish')->name('recipe.publish');
});



Route::post('/recipes/ratings', [RatingController::class, 'store'])->name('ratings.store');
Route::put('/recipes/{recipe}/ratings/{rating}', [RatingController::class, 'update']);
Route::delete('/recipes/{recipe}/ratings/{rating}', [RatingController::class, 'destroy']);

Route::post('/follow/{userId}', [UserController::class, 'follow'])->name('follow');
Route::post('/unfollow/{userId}', [UserController::class, 'unfollow'])->name('unfollow');
Route::put('/profile/update', [UserController::class, 'profileUpdate'])->name('profile.update');
Route::get('/profile/edit', [UserController::class, 'profileEdit'])->name('profile.edit');


Route::get('/saved-items', [SavedItemController::class, 'index'])->name('saved-items');
Route::post('/save/{recipe}', [SavedItemController::class, 'store'])->name('save-recipe');
Route::delete('/unsave/{recipe}', [SavedItemController::class, 'destroy'])->name('unsave-recipe');

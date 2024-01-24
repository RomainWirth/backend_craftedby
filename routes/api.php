<?php

use App\Http\Controllers\Api\ArtisanController;
use App\Http\Controllers\Api\CategoryController;
use app\Http\Controllers\Api\ThemeController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * Route::apiResource('users', UserController::class);
 * => give the named routes :
 * Verb          Path                        Action  Route Name
 * GET           /users                      index   users.index
 * POST          /users                      store   users.store
 * GET           /users/{user}               show    users.show
 * PUT|PATCH     /users/{user}               update  users.update
 * DELETE        /users/{user}               destroy users.destroy
 */
Route::apiResource('users', UserController::class);
Route::apiResource('artisans', ArtisanController::class);

Route::apiResource('items', ItemController::class);
Route::apiResource('carts', CartController::class);
Route::apiResource('orders', OrderController::class);
Route::apiResource('reviews', ReviewController::class);

/* Admins */
Route::apiResource('categories', CategoryController::class);
Route::apiResource('sizes', SizeController::class);

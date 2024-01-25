<?php

use App\Http\Controllers\Api\AddressController;
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
//Route::apiResource('users', UserController::class);
// Show all users : for role admin
Route::get('/users', [UserController::class, 'index']);
// Store new user
Route::post('/users', [UserController::class, 'store']);
// Show current user
Route::get('/users/{user}', [UserController::class, 'show']);
// Update current user
Route::put('/users/{user}', [UserController::class, 'update']);
// Delete current user
Route::delete('/users/{user}', [UserController::class, 'destroy']);

Route::get('/address', [AddressController::class, 'index']);
Route::get('/address/{user}', [AddressController::class, 'show']);
Route::post('/address', [AddressController::class, 'store']);


//Route::apiResource('artisans', ArtisanController::class);
// Show all artisans : for role admin
Route::get('/artisans', [ArtisanController::class, 'index']);
// Store new artisan
Route::post('/artisans', [ArtisanController::class, 'store']);
// Show current artisan
Route::get('/artisans/{artisan}', [ArtisanController::class, 'show']);
// Update current artisan
Route::put('/artisans/{artisan}', [ArtisanController::class, 'update']);
// Delete current artisan
Route::delete('/artisans/{artisan}', [ArtisanController::class, 'destroy']);

Route::apiResource('items', ItemController::class);
Route::apiResource('carts', CartController::class);
Route::apiResource('orders', OrderController::class);
Route::apiResource('reviews', ReviewController::class);

/* Admins */
Route::apiResource('categories', CategoryController::class);
Route::apiResource('sizes', SizeController::class);

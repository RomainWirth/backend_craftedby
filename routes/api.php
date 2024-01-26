<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\ArtisanController;
use app\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use app\Http\Controllers\Api\ItemController;
use app\Http\Controllers\Api\OrderController;
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
Route::post('signup', [UserController::class, 'store']);
Route::post('login', [UserController::class, 'login']);
Route::post('logout', [UserController::class, 'logout']);

//Route::apiResource('users', UserController::class);
Route::prefix('users')->group(function() {
    Route::get('/', [UserController::class, 'index']); // Show all users : for role admin
    Route::post('/', [UserController::class, 'store']); // Store new user
    Route::get('/{user}', [UserController::class, 'show']); // Show current user
    Route::put('/{user}', [UserController::class, 'update']); // Update current user
    Route::delete('/{user}', [UserController::class, 'destroy']); // Delete current user
});

//Route::get('/address', [AddressController::class, 'index']);
Route::prefix('address')->group(function() {
    Route::get('/{address}', [AddressController::class, 'show']); // show current address for a user : usefull for artisan location
    Route::post('/', [AddressController::class, 'store']); // insert address
    Route::put('/{address}', [AddressController::class, 'update']); // show current user address, need user_id match
    Route::delete('/{address}', [AddressController::class, 'destroy']); // delete address, need user_id match
});

//Route::apiResource('artisans', ArtisanController::class);
Route::prefix('artisans')->group(function() {
    Route::get('/', [ArtisanController::class, 'index']); // Show all artisans
    Route::post('/', [ArtisanController::class, 'store']); // Store new artisan
    Route::get('/{artisan}', [ArtisanController::class, 'show']); // Show current artisan
    Route::put('/{artisan}', [ArtisanController::class, 'update']); // Update current artisan, need user_id match
    Route::delete('/{artisan}', [ArtisanController::class, 'destroy']); // Delete current artisan, need user_id match

});

//Route::apiResource('items', ItemController::class);
Route::prefix('items')->group(function() {
    Route::get('/', [ItemController::class, 'index']); // all items
    Route::get('/{item}', [ItemController::class, 'show']); // one specific item
    Route::get('/{userId}', [ItemController::class, 'showUserItems']); // show current item with from specific user
    Route::post('/', [ItemController::class, 'store']); // insert new item
    Route::put('/{item}', [ItemController::class, 'update']); // modify one item : need artisan_id
    Route::delete('/{item}', [ItemController::class, 'destroy']); // delete one item : need artisan_id
});

//Route::apiResource('carts', CartController::class);
Route::prefix('carts')->group(function() {
    Route::get('/', [CartController::class, 'index']); // for role admin
    Route::get('/{cart}', [CartController::class, 'show']);
    Route::post('/', [CartController::class, 'store']); // To save current cart
    Route::put('/{cart}', [CartController::class, 'update']);
    Route::delete('/{cart}', [CartController::class, 'destroy']);
});

//Route::apiResource('orders', OrderController::class);
Route::prefix('orders')->group(function() {
    Route::get('/', [OrderController::class, 'index']); // method will get all orders
    Route::get('/{user}', [OrderController::class, 'showUserOrders']); // show all orders for one user
    Route::get('/{}', [OrderController::class, 'show']); // show current order
    Route::post('/', [OrderController::class, 'store']); // Create new order and store it when cart is saved
    Route::put('/', [OrderController::class, 'update']); // Update order : only when cart is updated or to update sendStatus
    // No destroy route
});

//Route::apiResource('reviews', ReviewController::class);
Route::prefix('reviews')->group(function() {

});

/* Admins */
Route::apiResource('categories', CategoryController::class);
Route::apiResource('sizes', SizeController::class);

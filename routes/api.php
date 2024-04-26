<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\ArtisanController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ColorController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\SizeController;
use App\Http\Controllers\Api\SpecialtyController;
use App\Http\Controllers\Api\ThemeController;
use App\Http\Controllers\Api\UserController;
//use App\Http\Controllers\Auth\LoginRegisterController;
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

Route::group(['middleware'=>'auth:sanctum'], function () {
    Route::post('/logout', [UserController::class, 'logout']);

//    Route::apiResource('user', UserController::class);
    Route::prefix('/users')->group(function() {
        Route::get('/', [UserController::class, 'index']); // Show all users : for role admin
        Route::get('/{id}', [UserController::class, 'show']); // Show current user
        Route::put('/{id}', [UserController::class, 'update']); // Update current user
        Route::delete('/{id}', [UserController::class, 'destroy']); // Delete current user
    });

    Route::get('/address', [AddressController::class, 'index']);
//    Route::prefix('address')->group(function() {
//        Route::get('/{address}', [AddressController::class, 'show']); // show current address for a user : usefull for artisan location
//        Route::post('/', [AddressController::class, 'store']); // insert address
//        Route::put('/{address}', [AddressController::class, 'update']); // show current user address, need user_id match
//        Route::delete('/{address}', [AddressController::class, 'destroy']); // delete address, need user_id match
//    });

//    Route::apiResource('artisans', ArtisanController::class);
    Route::prefix('/artisans')->group(function() {
        Route::post('/', [ArtisanController::class, 'store']); // Store new artisan
        Route::put('/{artisan}', [ArtisanController::class, 'update']); // Update current artisan, need user_id match
        Route::delete('/{artisan}', [ArtisanController::class, 'destroy']); // Delete current artisan, need user_id match
    });

    //Route::apiResource('items', ItemController::class);
    Route::prefix('/items')->group(function() {
//        Route::get('/', [ItemController::class, 'index']); // all items
//        Route::get('/{item}', [ItemController::class, 'show']); // one specific item
//        Route::get('/{userId}', [ItemController::class, 'showUserItems']); // show current item with from specific user
        Route::post('/', [ItemController::class, 'store']); // insert new item
        Route::put('/{item}', [ItemController::class, 'update']); // modify one item : need artisan_id
        Route::delete('/{item}', [ItemController::class, 'destroy']); // delete one item : need artisan_id
    });

//    Route::apiResource('carts', CartController::class);
    Route::prefix('/carts')->group(function() {
        Route::get('/', [CartController::class, 'index']); // for role admin
        Route::get('/{cart}', [CartController::class, 'show']);
        Route::post('/', [CartController::class, 'store']); // To save current cart
        Route::put('/{cart}', [CartController::class, 'update']);
        Route::delete('/{cart}', [CartController::class, 'destroy']);
    });

    /* Admins */
//    Route::apiResource('themes', ThemeController::class);
    Route::prefix('/themes')->group(function() {
        Route::get('/', [ThemeController::class, 'index']);
        Route::get('/{id}', [ThemeController::class, 'show']);
    });
//    Route::apiResource('specialties', SpecialtyController::class);
    Route::prefix('/specialties')->group(function() {
        Route::post('/', [SpecialtyController::class, 'store']);
        Route::put('/{id}', [SpecialtyController::class, 'update']);
        Route::delete('/{id}', [SpecialtyController::class, 'destroy']);
    });
//    Route::apiResource('categories', CategoryController::class);
    Route::prefix('/categories')->group(function() {
//        Route::get('/', [CategoryController::class, 'index']); // get all categories
        Route::post('/', [CategoryController::class, 'store']); // create new category
        Route::put('/{category}', [CategoryController::class, 'update']);
        Route::delete('/{category}', [CategoryController::class, 'destroy']);
    });
//    Route::apiResource('sizes', SizeController::class);
    Route::prefix('/sizes')->group(function() {
//        Route::get('/', [SizeController::class, 'index']); // get all categories
        Route::post('/', [SizeController::class, 'store']); // create new category
        Route::put('/{size}', [SizeController::class, 'update']);
        Route::delete('/{size}', [SizeController::class, 'destroy']);
    });
//    Route::apiResource('colors', ColorController::class);
    Route::prefix('/colors')->group(function() {
//        Route::get('/', [ColorController::class, 'index']); // get all categories
        Route::post('/', [ColorController::class, 'store']); // create new category
        Route::put('/{color}', [ColorController::class, 'update']);
        Route::delete('/{color}', [ColorController::class, 'destroy']);
    });
});

Route::controller(UserController::class)->group(function(){
    Route::post('/register', 'register');
    Route::post('/login', 'login')->name('login');
});

Route::prefix('/artisans')->group(function() {
    Route::get('/', [ArtisanController::class, 'index']); // Show all artisans
    Route::get('/{id}', [ArtisanController::class, 'show']); // Show current artisan
});
Route::prefix('/items')->group(function() {
    Route::get('/', [ItemController::class, 'index']); // all items
    Route::get('/{id}', [ItemController::class, 'show']); // one specific item
    Route::get('/artisan/{artisanId}', [ItemController::class, 'showArtisanItems']); // show current item with from specific user
    Route::get('/category/{categoryId}', [ItemController::class, 'showCategoryItems']); // show items from a category
});
Route::prefix('/specialties')->group(function() {
    Route::get('/', [SpecialtyController::class, 'index']);
    Route::get('/{id}', [SpecialtyController::class, 'show']);
});
Route::prefix('/categories')->group(function() {
    Route::get('/', [CategoryController::class, 'index']); // get all categories
});
Route::prefix('/sizes')->group(function() {
    Route::get('/', [SizeController::class, 'index']); // get all categories
});
Route::prefix('/colors')->group(function() {
    Route::get('/', [ColorController::class, 'index']); // get all categories
});

//Route::post('register', [UserController::class, 'store']);
//Route::post('login', [UserController::class, 'login']);
//Route::post('logout', [UserController::class, 'logout']);

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
//Route::post('signup', [UserController::class, 'store']);
//Route::post('login', [UserController::class, 'login']);
//Route::post('logout', [UserController::class, 'logout']);

//Route::prefix('/users')->group(function() {
//    Route::get('/', [UserController::class, 'index']); // Show all users : for role admin
//    Route::post('/', [UserController::class, 'store']); // Store new user
//    Route::get('/{id}', [UserController::class, 'show']); // Show current user
//    Route::put('/{user}', [UserController::class, 'update']); // Update current user
//    Route::delete('/{user}', [UserController::class, 'destroy']); // Delete current user
//});

//Route::get('/address', [AddressController::class, 'index']);
//Route::prefix('address')->group(function() {
//    Route::get('/{address}', [AddressController::class, 'show']); // show current address for a user : usefull for artisan location
//    Route::post('/', [AddressController::class, 'store']); // insert address
//    Route::put('/{address}', [AddressController::class, 'update']); // show current user address, need user_id match
//    Route::delete('/{address}', [AddressController::class, 'destroy']); // delete address, need user_id match
//});

////Route::apiResource('artisans', ArtisanController::class);
//Route::prefix('artisans')->group(function() {
//    Route::get('/', [ArtisanController::class, 'index']); // Show all artisans
//    Route::post('/', [ArtisanController::class, 'store']); // Store new artisan
//    Route::get('/{artisan}', [ArtisanController::class, 'show']); // Show current artisan
//    Route::put('/{artisan}', [ArtisanController::class, 'update']); // Update current artisan, need user_id match
//    Route::delete('/{artisan}', [ArtisanController::class, 'destroy']); // Delete current artisan, need user_id match
//});

////Route::apiResource('items', ItemController::class);
//Route::prefix('items')->group(function() {
//    Route::get('/', [ItemController::class, 'index']); // all items
//    Route::get('/{item}', [ItemController::class, 'show']); // one specific item
//    Route::get('/{userId}', [ItemController::class, 'showUserItems']); // show current item with from specific user
//    Route::post('/', [ItemController::class, 'store']); // insert new item
//    Route::put('/{item}', [ItemController::class, 'update']); // modify one item : need artisan_id
//    Route::delete('/{item}', [ItemController::class, 'destroy']); // delete one item : need artisan_id
//});

////Route::apiResource('carts', CartController::class);
//Route::prefix('carts')->group(function() {
//    Route::get('/', [CartController::class, 'index']); // for role admin
//    Route::get('/{cart}', [CartController::class, 'show']);
//    Route::post('/', [CartController::class, 'store']); // To save current cart
//    Route::put('/{cart}', [CartController::class, 'update']);
//    Route::delete('/{cart}', [CartController::class, 'destroy']);
//});

////Route::apiResource('orders', OrderController::class);
//Route::prefix('orders')->group(function() {
//    Route::get('/', [OrderController::class, 'index']); // method will get all orders
//    Route::get('/{user}', [OrderController::class, 'showUserOrders']); // show all orders for one user
//    Route::get('/{order}', [OrderController::class, 'show']); // show current order
//    Route::post('/', [OrderController::class, 'store']); // Create new order and store it when cart is saved
//    Route::put('/', [OrderController::class, 'update']); // Update order : only when cart is updated or to update sendStatus
//    // No destroy route
//});

//Route::apiResource('reviews', ReviewController::class);
//Route::prefix('reviews')->group(function() {
//    Route::get('/', [ReviewController::class, 'index']); // allow to view all reviews
//});

///* Admins */
////Route::apiResource('themes', ThemeController::class);
//Route::prefix('themes')->group(function() {
//    Route::get('/', [ThemeController::class, 'index']);
//    Route::post('/', [ThemeController::class, 'store']);
//    Route::put('/{theme}', [ThemeController::class, 'update']);
//    Route::delete('/{theme}', [ThemeController::class, 'destroy']);
//});
////Route::apiResource('specialties', SpecialtyController::class);
//Route::prefix('specialties')->group(function() {
//    Route::get('/', [SpecialtyController::class, 'index']);
//    Route::post('/', [SpecialtyController::class, 'store']);
//    Route::put('/{specialty}', [SpecialtyController::class, 'update']);
//    Route::delete('/{specialty}', [SpecialtyController::class, 'destroy']);
//});
////Route::apiResource('categories', CategoryController::class);
//Route::prefix('categories')->group(function() {
//    Route::get('/', [CategoryController::class, 'index']); // get all categories
//    Route::post('/', [CategoryController::class, 'store']); // create new category
//    Route::put('/{category}', [CategoryController::class, 'update']);
//    Route::delete('/{category}', [CategoryController::class, 'destroy']);
//});
////Route::apiResource('sizes', SizeController::class);
//Route::prefix('sizes')->group(function() {
//    Route::get('/', [SizeController::class, 'index']); // get all categories
//    Route::post('/', [SizeController::class, 'store']); // create new category
//    Route::put('/{size}', [SizeController::class, 'update']);
//    Route::delete('/{size}', [SizeController::class, 'destroy']);
//});
////Route::apiResource('colors', ColorController::class);
//Route::prefix('colors')->group(function() {
//    Route::get('/', [ColorController::class, 'index']); // get all categories
//    Route::post('/', [ColorController::class, 'store']); // create new category
//    Route::put('/{color}', [ColorController::class, 'update']);
//    Route::delete('/{color}', [ColorController::class, 'destroy']);
//});

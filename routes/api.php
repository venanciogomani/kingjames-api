<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EmployeesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Get all categories
Route::get('categories', [CategoriesController::class, 'index']);
// Get Specic category detail
Route::get('categories/{id}', [CategoriesController::class, 'show']);
// Add category
Route::post('categories/create', [CategoriesController::class, 'store']);
// Update category
Route::put('categories/{id}', [CategoriesController::class, 'update']);
// Delete category
Route::delete('categories/{id}', [CategoriesController::class, 'destroy']);


// Get all product
Route::get('product', [ProductsController::class, 'index']);
// Get Specic category detail
Route::get('product/{id}', [ProductsController::class, 'show']);
// Add category
Route::post('product/create', [ProductsController::class, 'store']);
// Update category
Route::put('product/{id}', [ProductsController::class, 'update']);
// Delete category
Route::delete('product/{id}', [ProductsController::class, 'destroy']);


// Get all user
Route::get('user', [UsersController::class, 'index']);
// Get Specic user detail
Route::get('user/{id}', [UsersController::class, 'show']);
// Add user
Route::post('user/create', [UsersController::class, 'store']);
// Update user
Route::put('user/{id}', [UsersController::class, 'update']);
// Delete user
Route::delete('user/{id}', [UsersController::class, 'destroy']);


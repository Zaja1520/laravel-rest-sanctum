<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AuthController;

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

//public routes
// show all products
Route::get('/products', [ProductController::class, 'allProducts']);
//product info
Route::get('/products/{id}', [ProductController::class, 'productInfo']);
//search product
Route::get('/products/search/{name}', [ProductController::class, 'searchProduct']);
//register products
Route::post('/register', [AuthController::class,'registerUser']);
//login
Route::post('/login', [AuthController::class, 'login']);


 //protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    //create product
    Route::post('/products/create', [ProductController::class, 'createProduct']);
    //update product
    Route::put('/products/update/{id}', [ProductController::class, 'updateProduct']);
    //delete product
    Route::post('/products/delete/{id}', [ProductController::class, 'deleteProduct']);
    //logout route
    Route::get('/logout', [AuthController::class, 'logout']);
});
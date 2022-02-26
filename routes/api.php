<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AdminAuth;
use App\Http\Controllers\ApartementController;
use App\Http\Controllers\RentApartmentController;

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

Route::get('/rent', [RentApartmentController::class, 'index']);
Route::get('/rent/{id}', [RentApartmentController::class, 'show']);
Route::post('/rent', [RentApartmentController::class, 'store']);
Route::delete('/rent/{id}', [RentApartmentController::class, 'destroy']);
Route::put('/rent/{id}', [RentApartmentController::class, 'edit']);

//Public Routes Of Apartements

//List All Apartements
Route::get('/apartements',[ApartementController::class,'index']);


//Global search
//Takes gender or max price or min price
Route::get('/apartement/search',[ApartementController::class,'search']);

///Private Routes Of Apartements

Route::post('/apartements/',[ApartementController::class,'store']);

Route::group(['middleware'=>['auth:sanctum']], function () {

    Route::put('/apartements/{id}',[ApartementController::class,'update']);


    Route::delete('/apartements/{id}',[ProductController::class,'destroy']);

});

Route::group(['middleware'=>['auth:sanctum','admin_auth']], function () {

    Route::put('/apartements/{id}',[ApartementController::class,'approve']);

});

//Public routes
Route::post('/login',[AuthController::class,'login']);
Route::post('/register',[AuthController::class,'register']);

Route::get('/products',[ProductController::class,'index']);
Route::get('/product/{id}',[ProductController::class,'show']);
Route::get('/products/search/{name}/{price}',[ProductController::class,'search']);
//////////////////////////////////////////////////////////////
//Tests
Route::get('/products/search_product',[ProductController::class,'search_product']);

Route::get('/products/backend',[ProductController::class,'index']);



Route::post('/products',[ProductController::class,'store']);

// Protected routes
Route::group(['middleware'=>['auth:sanctum']], function () {
    Route::put('/products/{id}',[ProductController::class,'update']);
    Route::delete('/products/{id}',[ProductController::class,'destroy']);
    Route::post('/logout',[AuthController::class,'logout']);
});



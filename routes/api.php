<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\API\ContactController;
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


//Public routes
Route::post('/login',[AuthController::class,'login']);
Route::post('/register',[AuthController::class,'register']);




/////////////////////////////////////////////////////////
////////////////////////// contact us  //////////////////
/////////////////////////////////////////////////////////

Route::get('/contact-us',[ContactController::class,'index']);
Route::post('/contact-us/store',[ContactController::class,'store']);







//////////////////////////////////////////////////////////////
//Tests
Route::get('/products',[ProductController::class,'index']);
Route::get('/product/{id}',[ProductController::class,'show']);
Route::get('/products/search_product',[ProductController::class,'search_product']);
Route::post('/products',[ProductController::class,'store']);
// Protected routes
Route::group(['middleware'=>['auth:sanctum']], function () {
    Route::put('/products/{id}',[ProductController::class,'update']);
    Route::delete('/products/{id}',[ProductController::class,'destroy']);
    Route::post('/logout',[AuthController::class,'logout']);
});



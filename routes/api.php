<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AdminAuth;
use App\Http\Controllers\API\ApartementController;
use App\Http\Controllers\API\CityController;

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

//Public Routes Of Apartements

//List All Apartements
Route::get('/apartements/',[ApartementController::class,'index']);


//List One Apartement By ID
Route::get('/apartements/{id}',[ApartementController::class,'show']);


//Global search

Route::get('/apartement/search',[ApartementController::class,'search']);

///Private Routes Of Apartements

Route::group(['middleware'=>['auth:sanctum']], function () {

    Route::put('/apartements/{id}',[ApartementController::class,'update']);

    Route::post('/apartements/',[ApartementController::class,'store']);

    Route::delete('/apartements/{id}',[ProductController::class,'destroy']);

});

Route::group(['middleware'=>['auth:sanctum','admin_auth']], function () {

    Route::put('/apartements/{id}',[ApartementController::class,'approve']);

});

//Route::resource('products',ProductController::class);

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

//Multi Search  test
//Route::get('/products/search/{name}/{price}',[ProductController::class,'search']);
/*
Route::get('/products/backend/{data}', function(){
    $data = request();
    dd($data);
    //    return App::call('App\Http\Controllers\ProductController@index' , ['data' => $data]);
});
*/

//
//

//Public Routes Of cities

//List All cities
Route::get('/cities/',[CityController::class,'index']);

//List One city By ID
Route::get('/cities/{id}',[CityController::class,'show']);

//Global search
Route::get('/city/search',[CityController::class,'search']);

///Private Routes Of cities
Route::group(['middleware'=>['auth:sanctum']], function () {

    Route::put('/cities/{id}',[CityController::class,'update']);

    Route::post('/cities/',[CityController::class,'store']);

    Route::delete('/cities/{id}',[CityController::class,'destroy']);

});

Route::group(['middleware'=>['auth:sanctum','admin_auth']], function () {

    Route::put('/cities/{id}',[CityController::class,'approve']);

});



// Protected routes
Route::group(['middleware'=>['auth:sanctum']], function () {
    Route::post('/products',[ProductController::class,'store']);
    Route::put('/products/{id}',[ProductController::class,'update']);
    Route::delete('/products/{id}',[ProductController::class,'destroy']);
    Route::post('/logout',[AuthController::class,'logout']);
});



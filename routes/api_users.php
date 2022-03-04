<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ApartementController;


Route::get('/apart/{id}', [UserController::class, 'getApartement']);
Route::get('/owner/{id}', [ApartementController::class, 'getOwner']);

Route::get('/user/{id}', [UserController::class, 'show']);


Route::group(['middleware'=>['auth:sanctum']], function () {

    Route::post('/user/changepassword', [AuthController::class, 'changepassword']);

});
Route::group(['middleware'=>['auth:sanctum','admin_auth']], function () {

    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::put('/user/{id}', [UserController::class, 'update']);
    Route::delete('/user/{id}', [UserController::class, 'destroy']);


});
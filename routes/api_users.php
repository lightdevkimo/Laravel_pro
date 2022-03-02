<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ApartementController;
use App\Http\Middleware\AdminAuth;
use App\Http\Middleware\VenderAuth;

Route::get('/apart/{id}', [UserController::class, 'getApartement']);
Route::get('/owner/{id}', [ApartementController::class, 'getOwner']);



Route::group(['middleware'=>['auth:sanctum','vender_auth']], function () {
    Route::get('/users', [UserController::class, 'index']);

    Route::post('/user/changepassword', [AuthController::class, 'changepassword']);

});
Route::group(['middleware'=>['auth:sanctum','admin_auth']], function () {

    Route::post('/users', [UserController::class, 'store']);
    Route::put('/user/{id}', [UserController::class, 'update']);
    Route::delete('/user/{id}', [UserController::class, 'destroy']);
    Route::get('/user/{id}', [UserController::class, 'show']);


});
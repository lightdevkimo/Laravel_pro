<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApartementController;
use App\Http\Controllers\API\UserController;

Route::group(['middleware'=>['auth:sanctum','admin_auth']], function () {

    Route::get('/users', [UserController::class, 'index']);

});
//Public Routes Of Apartements

//List All Apartements
Route::get('/apartements',[ApartementController::class,'index']);

//List All One Apartement

Route::get('/apartements/{id}',[ApartementController::class,'show']);

//Global search

//Takes gender or max price or min price
Route::get('/apartement/search',[ApartementController::class,'search']);



///Private Routes Of Apartements
Route::group(['middleware'=>['auth:sanctum']], function () {

    Route::post('/apartements',[ApartementController::class,'store']);
    Route::put('/apartements/{id}',[ApartementController::class,'update']);
    Route::delete('/apartements/{id}',[ApartementController::class,'destroy']);

});

///Admin Routes Only
Route::group(['middleware'=>['auth:sanctum','admin_auth']], function () {

    Route::put('/apartements/approve/{id}',[ApartementController::class,'approve']);

});

//List The City Of Apartement

Route::get('/apartement/city/{id}',[ApartementController::class,'ApartementOfCity']);

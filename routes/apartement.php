<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AdminAuth;
use App\Http\Controllers\ApartementController;


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

    Route::post('/apartements/',[ApartementController::class,'store']);
    Route::put('/apartements/{id}',[ApartementController::class,'update']);
    Route::delete('/apartements/{id}',[ProductController::class,'destroy']);

});

///Admin Routes Only
Route::group(['middleware'=>['auth:sanctum','admin_auth']], function () {
    Route::put('/apartements/{id}',[ApartementController::class,'approve']);
});

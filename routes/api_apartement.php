<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApartementController;



//Public Routes Of Apartements



//Global search

//Takes gender or max price or min price
//Find
Route::get('/apartement/search',[ApartementController::class,'search']);

//List  One Apartement (Details)

Route::get('/apartements/{id}',[ApartementController::class,'show']);


///Private Routes Of Apartements
Route::group(['middleware'=>['auth:sanctum','vender_auth']], function () {

    Route::get('/apartement/requested/',[ApartementController::class,'requested_apart']);
    Route::get('/apartement/approved/',[ApartementController::class,'approved_apart']);
    Route::put('/apartements/{id}',[ApartementController::class,'update']);
    Route::post('/apartements',[ApartementController::class,'store']);
    Route::delete('/apartements/{id}',[ApartementController::class,'destroy']);

});

///Admin Routes Only
Route::group(['middleware'=>['auth:sanctum','admin_auth']], function () {
    //list all in Admin Panel
    Route::get('/apartements',[ApartementController::class,'index']);

    Route::post('/apartements/approve/{id}',[ApartementController::class,'approve']);

    Route::post('/apartements/reject/{id}',[ApartementController::class,'reject']);

});

//List The City Of Apartement

Route::get('/apartement/city/{id}',[ApartementController::class,'ApartementOfCity']);


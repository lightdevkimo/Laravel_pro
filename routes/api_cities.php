<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CityController;




//Public Routes Of cities

//List One city By ID
Route::get('/city/{id}', [CityController::class, 'show']);

Route::post('/cities', [CityController::class, 'store']);

///Private Routes Of cities
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::put('/cities/{id}', [CityController::class, 'update']);
    Route::delete('/cities/{id}', [CityController::class, 'destroy']);
});

//Get City For Search Engine
//
//Get Gov For Search Engine

Route::get('/findcities/{gov}', [CityController::class, 'findcity']);

//List All cities
Route::get('/cities', [CityController::class, 'index']);

//

Route::get('/governates', [CityController::class, 'governorate']);

//list All Apartement In This City

Route::get('/city/apartement/{id}', [CityController::class, 'CityOfApartement']);

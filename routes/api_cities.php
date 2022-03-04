<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CityController;




//Public Routes Of cities

//List One city By ID
Route::get('/city/{id}', [CityController::class, 'show']);


///Private Routes Of cities
Route::group(['middleware' => ['auth:sanctum','admin_auth']], function () {

    Route::post('/cities', [CityController::class, 'store']);
    Route::delete('/cities/{id}', [CityController::class, 'destroy']);
});


//Get Gov For Search Engine

Route::get('/findcities/{gov}', [CityController::class, 'findcity']);

//List All cities
Route::get('/cities', [CityController::class, 'index']);

//

Route::get('/governates', [CityController::class, 'governorate']);

//list All Apartement In This City

Route::get('/city/apartement/{id}', [CityController::class, 'CityOfApartement']);

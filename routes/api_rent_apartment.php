<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\RentApartmentController;



Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::get('/rent', [RentApartmentController::class, 'index']);

    Route::get('/rent/{id}', [RentApartmentController::class, 'show']);

    Route::post('/rent', [RentApartmentController::class, 'store']);

    Route::delete('/rent/{id}', [RentApartmentController::class, 'destroy']);

    Route::put('/rent/{id}', [RentApartmentController::class, 'edit']);



    Route::post('/comment', [CommentController::class, 'store']);

});

Route::get('/comment', [CommentController::class, 'index']);
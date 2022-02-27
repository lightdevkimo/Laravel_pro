<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RentApartmentController;

/* Route::post('/rent', [RentApartmentController::class, 'store']);

Route::get('/rent',function(){
    return 'hi';
}); */

Route::get('/rent', [RentApartmentController::class, 'index']);
Route::get('/rent/{id}', [RentApartmentController::class, 'show']);
Route::post('/rent', [RentApartmentController::class, 'store']);
Route::delete('/rent/{id}', [RentApartmentController::class, 'destroy']);
Route::put('/rent/{id}', [RentApartmentController::class, 'edit']);

Route::get('/comment', [CommentController::class, 'index']);
Route::post('/comment', [CommentController::class, 'store']);
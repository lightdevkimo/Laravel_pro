<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\RentApartmentController;


Route::get('/rent', [RentApartmentController::class, 'index']);

Route::get('/rent/{id}', [RentApartmentController::class, 'show']);

Route::post('/rent', [RentApartmentController::class, 'store']);

Route::delete('/rent/{id}', [RentApartmentController::class, 'destroy']);

Route::put('/rent/{id}', [RentApartmentController::class, 'edit']);

Route::get('/comment', [CommentController::class, 'index']);

Route::post('/comment', [CommentController::class, 'store']);

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AdminAuth;
use App\Http\Controllers\ApartementController;
use App\Http\Controllers\ProductController;


Route::get('/cities',[ProductController::class,'city']);
Route::get('/findcities/{gov}',[ProductController::class,'findcity']);


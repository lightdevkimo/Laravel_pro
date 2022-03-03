<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\StatisticsController;



Route::group(['middleware'=>['auth:sanctum','admin_auth']], function () {


    Route::get('/statistics/approved_apartements',[StatisticsController::class,'count_approved_apartements']);
    Route::get('/statistics/requested_apartements',[StatisticsController::class,'count_requested_apartements']);
    Route::get('/statistics/admins',[StatisticsController::class,'count_admins']);
    Route::get('/statistics/users',[StatisticsController::class,'count_users']);
    Route::get('/statistics/owners',[StatisticsController::class,'count_owners']);
    Route::get('/statistics/total_users',[StatisticsController::class,'count_total_users']);
    Route::get('/statistics/count_messages',[StatisticsController::class,'count_messages']);

});
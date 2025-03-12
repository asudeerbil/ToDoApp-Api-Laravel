<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\TodoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::prefix('auth')->group(function(){
    Route::post('/register',[UserController::class,'register']);
    Route::post('/login',[UserController::class,'login']);
    Route::get('/logout',[UserController::class,'logout']);
    
});

//middleware('auth:api'):config/auth.php'deki api kismini calistirir. postmane tokenimizi girmezsek herhangi bir listeleme vs islemi yapamayiz. bir nevi bunu sagliyor.
Route::middleware('auth:api')->group(function () {
    Route::apiResource('todo', TodoController::class);
    Route::get('/auth/myprofile',[UserController::class,'myProfile']);
    
});


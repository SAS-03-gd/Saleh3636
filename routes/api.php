<?php

use App\Http\Controllers\authcontroller;
use App\Http\Controllers\coursecontroller;
use App\Http\Controllers\studentController;
use App\Http\Controllers\studentcourseController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

route::post('login',[authcontroller::class,'login']);
route::post('register',[authcontroller::class,'register']);


route::middleware('auth:user')->group(function(){
        route::get('course',[coursecontroller::class,'index']);
        route::get('course/{id}',[coursecontroller::class,'show']);
        route::post('course',[coursecontroller::class,'store']);
        route::put('course',[coursecontroller::class,'update']);
        route::delete('course',[coursecontroller::class,'destroy'])->Middleware('auth:user');

        route::apiResource('student',studentController::class);
        route::delete('/student/gr',[studentController::class,'graduted']);
        route::apiResource('studentcourseresourcce',studentcourseController::class);


        route::post('logout',[authcontroller::class,'logout']);
        route::post('profile',[authcontroller::class,'profile']);

})


?>
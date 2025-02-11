<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\v1\CategoryController;
use App\Http\Controllers\API\v1\ProductController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//User can make 100 requests per minute
Route::middleware('throttle:100,1')->group(function () {
    Route::prefix("v1")->group(function(){
        Route::apiResource('products', ProductController::class);
        Route::apiResource('categories', CategoryController::class)->only("index");
    });
});

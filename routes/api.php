<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CustomerAllController;
use App\Http\Controllers\API\CustomerStoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// ROUTES AUTENTICATION FOR TESTING TDD
Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/customers', CustomerAllController::class);
    Route::post('/customers/store', CustomerStoreController::class);

});

// AUTH
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});




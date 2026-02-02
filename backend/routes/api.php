<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\InventarisController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post("/login", [AuthController::class, 'login']);

// User Route
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users/create', [UserController::class, 'store']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
});

// Inventaris Route
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/inventaris', [InventarisController::class, 'index']);
    Route::post('/inventaris/create', [InventarisController::class, 'store']);
    Route::put('/inventaris/{id}', [InventarisController::class, 'update']);
    Route::delete('/inventaris/{id}', [InventarisController::class, 'destroy']);
});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;

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

// 🔹 RUTA PÚBLICA: login
Route::post('/login', [AuthController::class, 'login']);

// 🔹 RUTAS PROTEGIDAS CON SANCTUM
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // CRUD de productos
    Route::get('/products/top-sold', [ProductController::class, 'topSold']);
    Route::apiResource('products', ProductController::class);

    // Órdenes
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/users/{userId}/orders', [OrderController::class, 'getOrdersByUser']);
});

<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category_id}', [CategoryController::class, 'show']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::put('/categories/{category_id}', [CategoryController::class, 'update']);
Route::delete('/categories/{category_id}', [CategoryController::class, 'destroy']);

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product_id}', [ProductController::class, 'show']);
Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{product_id}', [ProductController::class, 'update']);
Route::delete('/products/{product_id}', [ProductController::class, 'destroy']);

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{username}', [UserController::class, 'show']);
Route::post('/users', [UserController::class, 'store']);
Route::put('/users/{username}', [UserController::class, 'update']);
Route::delete('/users/{username}', [UserController::class, 'destroy']);

Route::get('orders', [OrderController::class, 'index']);
Route::get('orders/{order_id}', [OrderController::class, 'show']);
Route::post('orders', [OrderController::class, 'store']);
Route::put('orders/{order_id}', [OrderController::class, 'update']);
Route::delete('orders/{order_id}', [OrderController::class, 'destroy']);

Route::get('order-products', [OrderProductController::class, 'index']);
Route::get('order-products/{order_product_id}', [OrderProductController::class, 'show']);
Route::get('order-products/total/{order_id}', [OrderProductController::class, 'getTotalPrice']);
Route::get('order-products/order/{order_id}', [OrderProductController::class, 'getOrderProductByOrderId']);
Route::post('order-products', [OrderProductController::class, 'store']);
Route::put('order-products/{order_product_id}', [OrderProductController::class, 'update']);
Route::delete('order-products/{order_product_id}', [OrderProductController::class, 'destroy']);

Route::get('/images', [ImageController::class, 'getAllImages']);
Route::get('/images/{name}', [ImageController::class, 'getImage']);
Route::post('/images', [ImageController::class, 'upload']);
Route::delete('/images/{name}', [ImageController::class, 'deleteImage']);

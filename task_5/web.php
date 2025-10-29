<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get("/products", [ProductController::class, 'index']);
Route::post("/products", [ProductController::class, 'store']);
Route::put("/products/{product}", [ProductController::class, 'update']);
Route::delete("/products/{product}", [ProductController::class, 'destroy']);

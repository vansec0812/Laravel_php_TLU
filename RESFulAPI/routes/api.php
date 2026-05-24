<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProdTypeController;

Route::apiResource('products', ProductController::class);
Route::apiResource('prodtypes', ProdTypeController::class);
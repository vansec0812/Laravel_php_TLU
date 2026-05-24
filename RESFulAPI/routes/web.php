<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/prodtypes', function () {
    return view('prodtypes.index');
});

Route::get('/products', function () {
    return view('products.index');
});

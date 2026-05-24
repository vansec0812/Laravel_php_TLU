<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DocController;


Route::get('/', function () {
    return view('welcome');
});
Route::resource('docs', DocController::class);

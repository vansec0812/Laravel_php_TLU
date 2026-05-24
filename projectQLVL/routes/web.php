<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CNXDController;
Route::get('/', function () {
    return view('welcome');
});
Route::resource('cnxds', CNXDController::class);

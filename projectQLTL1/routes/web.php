<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NguoidungController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('nguoidungs', NguoidungController::class);

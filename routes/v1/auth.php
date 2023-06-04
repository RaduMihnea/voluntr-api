<?php


use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\RegisterController;

Route::post('register', RegisterController::class);
Route::post('login', LoginController::class);

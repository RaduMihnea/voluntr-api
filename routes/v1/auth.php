<?php

use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\RegisterOrganizationController;
use App\Http\Controllers\Authentication\RegisterVolunteerController;

Route::post('register', RegisterVolunteerController::class);
Route::post('register-organization', RegisterOrganizationController::class);
Route::post('login', LoginController::class);

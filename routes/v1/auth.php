<?php

use App\Http\Controllers\Authentication\ForgotPasswordController;
use App\Http\Controllers\Authentication\LoginController;
use App\Http\Controllers\Authentication\RegisterOrganizationController;
use App\Http\Controllers\Authentication\RegisterVolunteerController;
use App\Http\Controllers\Authentication\ResetPasswordController;

Route::post('register', RegisterVolunteerController::class);
Route::post('register-organization', RegisterOrganizationController::class);
Route::post('login', LoginController::class);
Route::post('forgot-password', ForgotPasswordController::class);
Route::post('reset-password', ResetPasswordController::class);

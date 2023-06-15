<?php

use App\Http\Controllers\Regions\CityController;
use App\Http\Controllers\Regions\CountryController;

Route::apiResource('countries', CountryController::class)->only(['index']);
Route::apiResource('cities', CityController::class)->only(['index']);

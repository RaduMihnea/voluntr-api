<?php

use App\Http\Controllers\Volunteer\VolunteerController;
use App\Http\Controllers\Volunteer\VolunteerPublicProfileController;
use App\Http\Controllers\Volunteer\VolunteerUploadProfileController;

Route::get('volunteers/{volunteer:slug}/public-profile', VolunteerPublicProfileController::class);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('volunteers', VolunteerController::class)
        ->except(['store', 'destroy']);
    Route::post('volunteers/{volunteer}/avatar', VolunteerUploadProfileController::class);
});

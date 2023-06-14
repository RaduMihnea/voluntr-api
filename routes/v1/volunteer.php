<?php

use App\Http\Controllers\Volunteer\VolunteerController;
use App\Http\Controllers\Volunteer\VolunteerUploadProfileController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('volunteers', VolunteerController::class)
        ->except(['store', 'destroy']);
    Route::patch('volunteers/{volunteer}/avatar', VolunteerUploadProfileController::class);
});

<?php

use App\Http\Controllers\Organization\OrganizationController;
use App\Http\Controllers\Organization\OrganizationUploadProfileController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('organizations', OrganizationController::class)
        ->except(['store', 'destroy']);
    Route::post('organizations/{organization}/avatar', OrganizationUploadProfileController::class);
});

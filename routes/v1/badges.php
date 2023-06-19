<?php

use App\Http\Controllers\Badges\BadgeController;

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('badges', BadgeController::class)->only('index');
});

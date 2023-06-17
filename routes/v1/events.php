<?php

use App\Http\Controllers\Events\EventController;
use App\Http\Controllers\Events\EventTypesController;

Route::apiResource('event-types', EventTypesController::class)->only(['index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('events', EventController::class)->only('index', 'store', 'destroy');

    Route::post('events/{event}', [EventController::class, 'update']);
});

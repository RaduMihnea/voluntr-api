<?php

use App\Http\Controllers\Events\EnrollmentChangeStateController;
use App\Http\Controllers\Events\EnrollmentController;
use App\Http\Controllers\Events\EventController;
use App\Http\Controllers\Events\EventEnrollController;
use App\Http\Controllers\Events\EventEnrollmentsController;
use App\Http\Controllers\Events\EventTypesController;

Route::apiResource('event-types', EventTypesController::class)->only(['index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('events', EventController::class)->only('index', 'store', 'destroy');
    Route::post('events/{event}', [EventController::class, 'update']);
    Route::post('events/{event}/enroll', EventEnrollController::class);
    Route::get('events/{event}/enrollments', EventEnrollmentsController::class);

    Route::apiResource('enrollments', EnrollmentController::class)->only('index', 'store', 'destroy');
    Route::patch('enrollments/{enrollment}/change-state', EnrollmentChangeStateController::class);
});

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')
    ->name('api.v1.')
    ->group(function () {
        require base_path('routes/v1/auth.php');
        require base_path('routes/v1/volunteer.php');
        require base_path('routes/v1/organization.php');
        require base_path('routes/v1/regions.php');
    });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

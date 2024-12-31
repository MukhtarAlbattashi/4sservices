<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CarApiController;
use App\Http\Controllers\Api\CarBrandApiController;
use App\Http\Controllers\Api\CarModelApiController;
use App\Http\Controllers\Api\CustomersApiController;
use App\Http\Controllers\Api\JobCardApiController;
use App\Http\Controllers\Api\JopStatusApiController;
use App\Http\Controllers\Api\RegistrationTypeApiController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
});
//->middleware('auth:sanctum')
Route::prefix('v1')->group(function () {
    Route::apiResource('customers', CustomersApiController::class);

    Route::apiResource('registration-types', RegistrationTypeApiController::class);
    Route::apiResource('car-models', CarModelApiController::class);
    Route::apiResource('car-brands', CarBrandApiController::class);
    Route::apiResource('cars', CarApiController::class);
    Route::apiResource('jop-statuses', JopStatusApiController::class);
    Route::apiResource('job-card', JobCardApiController::class);
});

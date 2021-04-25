<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\Vehicle;
use App\Http\Controllers\VehicleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/vehicles', [VehicleController::class, 'index']);
Route::post('/vehicles', [VehicleController::class, 'store']);
Route::get('/vehicles/{id}', [VehicleController::class, 'show']);
Route::put('/vehicles/{id}', [VehicleController::class, 'update']);
Route::delete('/vehicles/{id}', [VehicleController::class, 'destroy']);
Route::get('/vehicles/search/make/{make}', [VehicleController::class, 'searchMake']);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

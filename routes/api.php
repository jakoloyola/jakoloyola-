<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FacilityController;

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
Route::post('login', [UserController::class, 'login']);

Route::get('users', [UserController::class, 'index'])->middleware('auth:sanctum');
Route::post('users/store', [UserController::class, 'store'])->middleware('auth:sanctum');
Route::put('users/update/{userId}', [UserController::class, 'update'])->middleware('auth:sanctum');
Route::get('users/show/{userId}', [UserController::class, 'show'])->middleware('auth:sanctum');
Route::delete('users/destroy/{userId}', [UserController::class, 'destroy'])->middleware('auth:sanctum');


Route::get('facilities', [FacilityController::class, 'index'])->middleware('auth:sanctum');
Route::post('facilities/store', [FacilityController::class, 'store'])->middleware('auth:sanctum');
Route::put('facilities/update/{facilityId}', [FacilityController::class, 'update'])->middleware('auth:sanctum');
Route::get('facilities/show/{facilityId}', [FacilityController::class, 'show'])->middleware('auth:sanctum');
Route::delete('facilities/destroy/{facilityId}', [FacilityController::class, 'destroy'])->middleware('auth:sanctum');
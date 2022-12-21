<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\RoleController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('users', [UserController::class, 'index']);
Route::post('users/store', [UserController::class, 'store']);
Route::put('users/update/{userId}', [UserController::class, 'update']);
Route::get('users/show/{userId}', [UserController::class, 'show']);
Route::delete('users/destroy/{userId}', [UserController::class, 'destroy']);

Route::get('facilities', [FacilityController::class, 'index']);
Route::post('facilities/store', [FacilityController::class, 'store']);
Route::put('facilities/update/{facilityId}', [FacilityController::class, 'update']);
Route::get('facilities/show/{facilityId}', [FacilityController::class, 'show']);
Route::delete('facilities/destroy/{facilityId}', [FacilityController::class, 'destroy']);

Route::get('roles', [RoleController::class, 'index']);
Route::post('roles/store', [RoleController::class, 'store']);
Route::put('roles/update/{facilityId}', [RoleController::class, 'update']);
Route::get('roles/show/{facilityId}', [RoleController::class, 'show']);
Route::delete('roles/destroy/{facilityId}', [RoleController::class, 'destroy']);

Route::get('/', function () {
    return view('layout');
});

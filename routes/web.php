<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('users', [UserController::class, 'index'])->middleware('auth:sanctum');
Route::post('users/store', [UserController::class, 'store'])->middleware('auth:sanctum');
Route::put('users/update/{userId}', [UserController::class, 'update'])->middleware('auth:sanctum');
Route::get('users/show/{userId}', [UserController::class, 'show'])->middleware('auth:sanctum');
Route::delete('users/destroy/{userId}', [UserController::class, 'destroy'])->middleware('auth:sanctum');

Route::get('/', function () {
    return view('layout');
});

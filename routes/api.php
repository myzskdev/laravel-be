<?php

use App\Http\Controllers\API\APIController;
use App\Http\Controllers\API\ClientController;
use App\Http\Controllers\API\MasterController;
use App\Http\Controllers\API\MenuController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\RoleMenuController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\VehicleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->group(function(){
    Route::get('user', [UserController::class, 'fetch']);
    Route::post('user', [UserController::class, 'updateProfile']);
    Route::post('user/photo', [UserController::class, 'updatePhoto']);
    Route::post('logout', [UserController::class, 'logout']);
    Route::get('vehicles', [APIController::class, 'get_vehicles']);
});

Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);

Route::get('master', [MasterController::class, 'all']);
Route::get('client', [ClientController::class, 'all']);
Route::get('menu', [MenuController::class, 'all']);
Route::get('role', [RoleController::class, 'all']);
Route::get('role-menu', [RoleMenuController::class, 'all']);
Route::get('vehicle', [VehicleController::class, 'all']);
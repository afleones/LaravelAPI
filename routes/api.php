<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\TeamsController;
use App\Http\Controllers\StockController;

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

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);
    Route::post('refresh', [AuthController::class, 'refresh']);

    //D & C Comunicaciones
        Route::post('StoreArticle', [StockController::class, 'StoreArticle']);
    //D & C Comunicaciones

    Route::post('user', [AuthController::class, 'getAuthenticatedUser']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::get('teams', [TeamsController::class, 'index']);
    Route::post('createTeam', [TeamsController::class, 'create']);
    Route::post('updateTeam', [TeamsController::class, 'update']);
    Route::post('deleteTeam', [TeamsController::class, 'delete']);


});


Route::post('register', [AuthController::class, 'register']); /* Registrarse */

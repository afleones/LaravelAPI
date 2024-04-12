<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeopleController;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get("/users", [PeopleController::class, 'index']);

Route::post("/create/people", [PeopleController::class, 'create']);

Route::put("/create/people/{id}", [PeopleController::class, 'update']);

Route::delete("/create/people/{id}", [PeopleController::class, 'destroy']);
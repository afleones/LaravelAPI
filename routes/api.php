<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\SizesController;
use App\Http\Controllers\FormsController;
use App\Http\Controllers\DesignsController;
use App\Http\Controllers\AdditionsController;
use App\Http\Controllers\FillingsController;
use App\Http\Controllers\FlavorsController;

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
    Route::post('user', [AuthController::class, 'getAuthenticatedUser']);
    Route::post('logout', [AuthController::class, 'logout']);

    /* <! -------  Orders  ------- !> */
    Route::post('storeOrder', [OrdersController::class, 'store']);
    Route::get('orders', [OrdersController::class, 'index']);
    Route::get('order', [OrdersController::class, 'show']);
    /* <! -------  Orders  ------- !> */

// -------------------------------------------------------------------------

    /* <! -------  Sizes  ------- !> */
    Route::get('sizes', [SizesController::class, 'index']);
    /* <! -------  Sizes  ------- !> */

// -------------------------------------------------------------------------

    /* <! -------  Forms  ------- !> */
    Route::get('forms', [FormsController::class, 'index']);
    /* <! -------  Forms  ------- !> */
       
// -------------------------------------------------------------------------

    /* <! -------  Designs  ------- !> */
    Route::get('designs', [DesignsController::class, 'index']);
    /* <! -------  Designs  ------- !> */
       
// -------------------------------------------------------------------------

    /* <! -------  Additions  ------- !> */
    Route::get('additions', [AdditionsController::class, 'index']);
    /* <! -------  Additions  ------- !> */

       
// -------------------------------------------------------------------------

    /* <! -------  Fillings  ------- !> */
    Route::get('fillings', [FillingsController::class, 'index']);
    /* <! -------  Fillings  ------- !> */


// -------------------------------------------------------------------------

    /* <! -------  Flavors  ------- !> */
    Route::get('flavors', [FlavorsController::class, 'index']);
    /* <! -------  Flavors  ------- !> */

});

Route::post('register', [AuthController::class, 'register']); /* Registrarse */
Route::post('registerCustomer', [UsersController::class, 'store']); /* Registrarse */

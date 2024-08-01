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
use App\Http\Controllers\TypesOfDocumentsIdentificationsController;
use App\Http\Controllers\PaymentsController;

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

    /* <! -------  User Routes  ------- !> */
    Route::post('logout', [AuthController::class, 'logout']);
    Route::get('me', [AuthController::class, 'me']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('user', [AuthController::class, 'getAuthenticatedUser']);
    Route::post('logout', [AuthController::class, 'logout']);
    /* <! -------  User Routes  ------- !> */

    /* <! -------  Orders  ------- !> */
    Route::post('storeOrder', [OrdersController::class, 'store']);
    Route::get('orders', [OrdersController::class, 'index']);
    Route::get('ordersByUser', [OrdersController::class, 'show']);
    Route::get('showOrder', [OrdersController::class, 'showOrder']);
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

    /* <! -------  CategorieArticles  ------- !> */
    Route::get('showCategorieArticles', [OrdersController::class, 'showCategorieArticles']);
    /* <! -------  CategorieArticles  ------- !> */

    Route::post('pay', [PaymentsController::class, 'pay']);

});

/* <! -------  Type of Documents  ------- !> */
Route::get('typesOfDocumentsIdentification', [TypesOfDocumentsIdentificationsController::class, 'index']);
/* <! -------  Type of Documents  ------- !> */

/* <! -------  Register  ------- !> */
Route::post('register', [AuthController::class, 'register']);
/* <! -------  Register  ------- !> */


/* <! -------  Register Customer  ------- !> */
Route::post('registerCustomer', [UsersController::class, 'store']); /* Registrarse */
/* <! -------  Register Customer  ------- !> */
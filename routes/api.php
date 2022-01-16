<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Se rutea las funciones para poder ser llamadas en el postman
Route::post("products-create", [ApiController::class, "ProductsCreate"]);
Route::post("products-get", [ApiController::class, "ProductsGet"]);
Route::post("invoice-post", [ApiController::class, "InvoicePOST"]);
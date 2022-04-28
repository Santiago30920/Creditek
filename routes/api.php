<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\product;
use App\Http\Controllers\Api\user;

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
//funcion para llamar al controlador de productos
Route::post("products-create", [product::class, "ProductsCreate"]);
Route::get("products-get", [product::class, "ProductsGet"]);
Route::post("products-update", [product::class, "productUpdate"]);
//funcion que me permite llamar a la funcion market
Route::post("invoice-post", [user::class, "InvoicePOST"]);
//Rutas para llamar usuarios
Route::post("user-create", [user::class, "UserCreate"]);
Route::get("user-get", [user::class, "UsersGet"]);
Route::post("user-update", [user::class, "productUpdate"]);
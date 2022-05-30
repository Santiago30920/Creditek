<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\product;
use App\Http\Controllers\Api\user;
use App\Http\Controllers\Api\market;
use App\Http\Controllers\Api\login;

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

//Se rutea las funciones para poder ser llamadas en el postman
//funcion para llamar al controlador de productos
Route::post("products-create", [product::class, "ProductsCreate"]);
Route::get("products-get", [product::class, "ProductsGet"]);
Route::post("products-update", [product::class, "productUpdate"]);
Route::get("products-list", [product::class, "ProductsGetTrue"]);
//funcion que me permite llamar a la funcion market
Route::post("invoice-post", [market::class, "InvoicePOST"]);
//Rutas para llamar usuarios
Route::post("user-create", [user::class, "UserCreate"]);
Route::get("user-get", [user::class, "UserGet"]);
Route::post("user-update", [user::class, "productUpdate"]);
//Login para poder ingresar al sistema
Route::post("login", [login::class, "LoginSearch"]);
Route::post("changePassword", [login::class, "changePassword"]);
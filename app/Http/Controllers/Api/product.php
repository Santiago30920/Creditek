<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Invoice;
use Exception;


class product extends Controller
{
    
    /**
     * Funcion que me permite persistir un producto
     * @param Request recibe un objeto json, mandado por postman
     */
    public function ProductsCreate(Request $request)
    {
        try{
            $datacreate = new Products();
            $datacreate->id_product = $request->id_product;
            $datacreate->name = $request->name;
            $datacreate->description = $request->description;
            $datacreate->urlImage = $request->urlImage;
            $datacreate->price = $request->price;
            $datacreate->available = $request->available;
            $datacreate->status = $request->status;
            if(Products::where("id_product", $request->id_product)->exists()){
                return response()->json([
                    "status" => 200,
                    "message" => "el codigo del producto ya existe",
                    "code" => 0
                ],200);
            }else{
                $datacreate->save();
                return response()->json([
                    "status" => 200,
                    "message" => "productos-create succesfully",
                    "code" => 1
                ],200);
    
            }
        }catch(Exception $e){
            return response()->json([
                "status" => 500,
                "message" => "Ha ocurrido un error",
                "messageLog" => $e->getMessage(),
            ],500);
        }
    }
    /**
     * Funcion que me permite traer todos los datos de productos en el base de datos
     * en un objeto json
     */
    public function ProductsGet()
    {
        $productResponse = Products::get();
        return response()->json([
            "status" => 200,
            "message" => "productos-get succesfully",
            "data" => $productResponse
        ],200);
    }
    /**
     * Funcion que me permite traer todos los datos de productos en el base de datos que se encuentren activos
     * en un objeto json
     */
    public function ProductsGetTrue()
    {
        $productResponse = Products::get();
        if($productResponse){
            return response()->json([
                "status" => 200,
                "message" => "productos-get succesfully",
                "data" => $productResponse
            ],200);
        }else{
            return response()->json([
                "status" => 200,
                "message" => "No existe ningun dado",
            ],200);
        }
    }
    /**
     * Function for edit the product
     */
    public function productUpdate(Request $request){
        try{
            $response = Products::where('id_product', '=', $request->id_product)->update([
                'name' => $request->name,
                'description' => $request->description, 
                'urlImage' => $request->urlImage, 
                'price' => $request->price,
                'available' => $request->available,
                'status' => $request->status
            ]);
            if($response === 1){
                return response()->json([
                    "status" => 200,
                    "message" => "Se actualizo correctamente", 
                    "code" => 1
                ],200);
            }
        }catch(Exception $e){
            return response()->json([
                "status" => 500,
                "message" => "Ha ocurrido un error",
                "messageLog" => $e->getMessage(),
            ],500);
        }
    }
}

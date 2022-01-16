<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Invoice;

class ApiController extends Controller
{
    /**
     * Funcion que me permite persistir un producto
     * @param Request recibe un objeto json, mandado por postman
     */
    public function ProductsCreate(Request $request)
    {
        $datacreate = new Products();
        $datacreate->id_product = $request->id_product;
        $datacreate->name = $request->name;
        $datacreate->description = $request->description;
        $datacreate->price = $request->price;
        $datacreate->available = $request->available;
        $datacreate->save();
        return response()->json([
            "status" => 1,
            "message" => "productos-create succesfully"
        ]);
    }
    /**
     * Funcion que me permite traer todos los datos de productos en el base de datos
     * en un objeto json
     */
    public function ProductsGet()
    {
        $productResponse = Products::get();
        return response()->json([
            "status" => 1,
            "message" => "productos-get succesfully",
            "data" => $productResponse
        ]);
    }
    /**
     * Funcion que me crea una factura
     * @param Request recibe un obejto json, mandado por postman
     */
    public function InvoicePOST(Request $request)
    {
        //Llamos el modelo de invoice, en data create
        $datacreate = new Invoice();
        $idProduct = $request->ids;
        $amount = $request->amount;
        //Parar crear una fecha actual se utiliza  date("Y-m-d H:i:s")
        $datacreate->purchaseDate = date("Y-m-d H:i:s");
        $datacreate->email = $request->email;
        $datacreate->phoneNumber = $request->phoneNumber;
        //Traemos toda la informacion de products
        $productResponse = Products::get();
        //Creamos un ciclo donde me recorra toda lista de productos
        for ($i = 0; $i < count($productResponse); $i++) {
            //Colocamos un if, donde miramos que el productos seleccionado coincida con un producto existente
            if ($productResponse[$i]->id_product == $idProduct) {
                $datacreate->ids = $idProduct;
                $datacreate->amount = $amount;
                //sacamos el valor total
                $datacreate->totalPrice = $amount * $productResponse[$i]->price;
                //obtenemos la cantidad restante
                $reamingAmount = $productResponse[$i]->available - $amount;
                //editamos la cantidad restante en la tabla de products
                Products::where("id_product", $idProduct)->update(['available' => $reamingAmount]);
                //finalizamos en mandar todos los datos
                $datacreate->save();
                return response()->json([
                    "status" => 1,
                    "message" => "Se guardo la compra"
                ]);
                break;
            }
        };
    }
}

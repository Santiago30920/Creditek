<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Invoice;
use Exception;

class market extends Controller
{
        /**
     * Funcion que me crea una factura
     * @param Request recibe un obejto json, mandado por postman
     */
    public function InvoicePOST(Request $request)
    {
        //Llamos el modelo de invoice, en data create
        $datacreate = new Invoice();
        $idProduct = $request->id_product;
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
                //Condicion donde miramos que el stock este vacio, o que el usuario no pueda comprar mas de lo necesario
                if($productResponse[$i]->available > 0 && $productResponse[$i]->available >= $amount){
                    $datacreate->id_product = $idProduct;
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
                        "status" => 200,
                        "message" => "Su compra fue exitosas"
                    ]);
                    break;
                }else{
                    roducts::where("id_product", $idProduct)->update(['status' => false]);
                    return response()->json([
                        "status" => 200,
                        "message" => "No se puede comprar este producto, ya que no hay stock disponible"
                    ]);
                    break;
                }
            }
        };
    }
}

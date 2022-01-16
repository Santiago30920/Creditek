<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\producto;
use App\Models\compras;

class ApiController extends Controller
{
    //Función que me permite registrar un producto 
    public function productosCreate(Request $request)
    {
        $datacreate = new producto;
        $datacreate->id_producto = $request->id_producto;
        $datacreate->nombre = $request->nombre;
        $datacreate->descripcion = $request->descripcion;
        $datacreate->valor = $request->valor;
        $datacreate->disponibles = $request->disponibles;
        $datacreate->save();
        return response()->json([
            "status" => 1,
            "message" => "productos-create succesfully"
        ]);
    }
    //Funcion que me retorna un lista de productos
    public function productosGet()
    {
        $productoRespuesta = producto::get();
        return response()->json([
            "status" => 1,
            "message" => "productos-get succesfully",
            "data" => $productoRespuesta
        ]);
    }
    public function comprasPOST(Request $request)
    {
        $datacreate = new compras;
        $idProducto = $request->ids;
        $cantidadP = $request->cantidad;
        $datacreate->fechaCompra = date("Y-m-d H:i:s");
        $datacreate->correoElectronico = $request->correoElectronico;
        $datacreate->numeroCelular = $request->numeroCelular;
        $productoRespuesta = producto::get();
        for ($i = 0; $i < count($productoRespuesta); $i++) {
            if ($productoRespuesta[$i]->id_producto == $idProducto) {
                $datacreate->ids = $idProducto;
                $datacreate->cantidad = $cantidadP;
                $datacreate->valorTotal = $cantidadP * $productoRespuesta[$i]->valor;
                $cantidadRestante = $productoRespuesta[$i]->disponibles - $cantidadP;
                producto::where("id_producto", $idProducto)->update(['disponibles' => $cantidadRestante]);
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

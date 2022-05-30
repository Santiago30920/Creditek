<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Users;
use Exception;
use Illuminate\Support\Facades\Mail;
use App\Http\Services\email;

class user extends Controller
{
    /**
     * Funcion que me permite persistir un producto
     * @param Request recibe un objeto json, mandado por postman
     */
    public function UserCreate(Request $request)
    {
        try{
            $datacreate = new Users();
            $datacreate->name = $request->name;
            $datacreate->last_name = $request->last_name;
            $datacreate->email = $request->email;
            $password = Str::random(6);
            $datacreate->password = hash('sha256',$password);
            $datacreate->rol = $request->rol;
            $datacreate->tidentifi = $request->tidentifi;
            $datacreate->nidentifi = $request->nidentifi;
            $datacreate->state = $request->state;
            $email = New email();
                //dd($datacreate->password, $password);
                if(Users::where("nidentifi", $request->nidentifi)->exists()){
                    return response()->json([
                        "status" => 200,
                        "message" => "Este usuario ya se ecnuentra registrado",
                        "code" => 0,
                    ],200);
                }else{
                    $response = $email->email($datacreate->email,$password);
                    if($response){
                        $datacreate->save();
                        return response()->json([
                            "status" => 200,
                            "message" => "El usuario fue creado correctamente",
                            "code" => 1
                        ],200);
                    }else{
                        return response()->json([
                            "status" => 200,
                            "message" => "El usuario no pudo ser creado intente nueva mente",
                            "code" => 0,
                        ],200);
                    }
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
    public function UserGet()
    {
        $userResponse = Users::get();
        return response()->json([
            "status" => 200,
            "message" => "user-get succesfully",
            "data" => $userResponse
        ],200);
    }
    /**
     * Function for edit the product
     */
    public function productUpdate(Request $request){
        try{
            $response = Users::where('nidentifi', '=', $request->nidentifi)->update([
                'name' => $request->name,
                'last_name' => $request->last_name,
                'tidentifi' => $request->tidentifi,
                'state' => $request->state,
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

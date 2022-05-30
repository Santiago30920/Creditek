<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Exception;
use App\Http\Services\verifyLogin;

class login extends Controller
{
    public function LoginSearch(Request $request){
        try{
            $verify= new verifyLogin();
            $password = hash('sha256', $request->password);
            $responseVerify = $verify->verifyLogin($request->email, $password);
            switch($responseVerify){
                case 1:
                    return response()->json([
                        "status" => 200,
                        "message" => "User no change password",
                        "code" => 2,
                    ],200);
                    break;
                case 2:
                    $userVerify = Users::where('email', $request->email)->where('password', $password)->first();
                    if($userVerify){
                        return response()->json([
                            "status" => 200,
                            "message" => "login success",
                            "code" => 1,
                        ],200);
                    }else{
                        return response()->json([
                            "status" => 200,
                            "message" => "El usuario no se encontro",
                            "code" => 0,
                        ],200);
                    }
                    break;
                case 3:
                    return response()->json([
                        "status" => 200,
                        "message" => "User no change password",
                        "code" => 2,
                    ],200);
                    break;
            }
        }catch(Exception $e){
            return response()->json([
                "status" => 500,
                "message" => "Ha ocurrido un error",
                "messageLog" => $e->getMessage(),
            ],500);
        }
    }
    public function changePassword(Request $request){
        try{
            if($request->password == $request->repeatPassword){
                $password = hash('sha256',$request->password);
                Users::where('email', '=', $request->email)->update([
                    'password' => $password
                ]);
                return response()->json([
                    "status" => 200,
                    "message" => "Se actualizo correctamente", 
                    "code" => 1
                ],200);
            }else{
                return response()->json([
                    "status" => 200,
                    "message" => "Las contraseñas no son iguales", 
                    "code" => 0
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

<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;
use App\Models\Users;
use App\Models\Login;

class verifyLogin
{
    public function verifyLogin($email, $password){
        try{
            $login = new Login();
            $responseLogin = $login->where('email', $email)->first();
            if($responseLogin){
                $user = new Users();
                $responseUser = $user->where('email', $email)->first();
                if($responseUser->password == $responseLogin->password){
                    return 1;
                }else{
                    return 2;
                }
            }else{
                $login->email = $email;
                $login->password = $password;
                $login->save();
                return 3;
            }

        }catch(Exception $e){

        }
    }
}
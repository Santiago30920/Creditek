<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail;

class email
{
    public function email($email ,$password){
        $details = [
            'title' => 'Usuario creado',
            'body' => 'El usuario se creo de manera exitosa. <br> Su contraseña es: '.$password,
        ];
        Mail::to($email)->send(new TestMail($details));
        return "Email succes send";
    }

    public function listProduct($email ,$product, $value){
        $details = [
            'title' => 'Compra exitosa',
            'body' => 'La compra fue exitosa, su compra fue: '.$product.' El precio total es: $'.$value,
        ];
        Mail::to($email)->send(new TestMail($details));
        return "Email succes send";
    }

}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class login extends Model
{
    use HasFactory;
    //Llamamos una sola vez la tabla de products
    protected $table = "login";

    protected $fillable = [
        'email',
        'password',
    ];
    public $timestamps = false;
}

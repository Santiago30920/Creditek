<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    //Llamamos una sola vez la tabla de products
    protected $table = "user";

    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'rol',
        'tidentifi',
        'nidentifi',
        'state'
    ];
    public $timestamps = false;
}

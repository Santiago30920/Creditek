<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    //Llamamos una sola vez la tabla de products
    protected $table = "products";
    //Se llama todas la variables de tabla de products, donde podemos utilizar en la api
    protected $fillable = [
        'id_product',
        'name',
        'description',
        'price',
        'available',
        'status',
    ];
    public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    //Llamamos una sola vez la tabla de invoice
    protected $table = "invoice";
    //Modelo nos sirver para llamar todas las variables que se encuentran en la vase de datos
    protected $fillable = [
        'ids',
        'amount',
        'purchaseDate',
        'email',
        'phoneNumber',
        'totalPrice',
    ];

    public $timestamps = false;
}

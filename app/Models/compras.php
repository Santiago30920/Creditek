<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class compras extends Model
{
    use HasFactory;
    protected $table = "compras";

    protected $fillable = [
        'ids',
        'cantidad',
        'fechaCompra',
        'correoElectronico',
        'numeroCelular',
        'valorTotal'
    ];

    public $timestamps = false;
}

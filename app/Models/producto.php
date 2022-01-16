<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class producto extends Model
{
    use HasFactory;

    protected $table = "productos";

    protected $fillable = [
        "id_producto",
        "nombre",
        "descripcion",
        "valor",
        "disponibles"
    ];
    public $timestamps = false;
}

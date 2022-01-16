<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Compras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compras', function(Blueprint $table){
            $table->id();
            $table->string('ids');
            $table->string('cantidad');
            $table->date('fechaCompra');
            $table->string('correoElectronico');
            $table->integer('numeroCelular');
            $table->integer('valorTotal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('compras');
    }
}

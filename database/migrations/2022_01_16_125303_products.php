<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Metodo que me permite crear y editar la base de datos
        Schema::create('products', function(Blueprint $table){
            $table->string('id_product');
            $table->string('name');
            $table->string('description');
            $table->integer('price');
            $table->integer('available');
            $table->boolean('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}

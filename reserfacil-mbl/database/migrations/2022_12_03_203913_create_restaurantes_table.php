<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('restaurantes', function (Blueprint $table) {
            $table->id('codigoRestaurante');
            $table->unsignedBigInteger('id');
            $table->string('nombre');
            $table->string('carta'); 
            $table->string('foto'); 
            $table->string('banner'); 
            $table->string('direccion'); 
            $table->string('descripcion'); 
            $table->string('telefono', 12); //Equivalente a int
            $table->foreign('id')->references('id')->on('users');
            $table->timestamps();
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('restaurante');
    }
};

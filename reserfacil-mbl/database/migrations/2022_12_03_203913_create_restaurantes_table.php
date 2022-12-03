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
             // $table->id();
            //poner codigo gerente
            $table->id('codigoRestaurante');
            $table->unsignedBigInteger('Id');
            $table->string('nombre');
            $table->binary('carta'); //Equivalente a BLOB
            $table->binary('foto'); //Equivalente a BLOB
            $table->binary('banner'); //Equivalente a BLOB
            $table->string('direccion'); 
            $table->string('descripcion'); 
            $table->string('telefono', 12); //Equivalente a int
             $table->foreign('Id')->references('Id')->on('users');

            $table->timestamps();
            //$table->primary('codigoRestaurante');
            // $table->dropPrimary('Telefono');
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

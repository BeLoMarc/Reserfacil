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
        Schema::create('restaurante_users', function (Blueprint $table) {
            $table->unsignedBigInteger('codigoRes');
            $table->unsignedBigInteger('id');
            $table->date('fecha');
            //https://stackoverflow.com/questions/36171186/how-to-insert-the-value-entered-in-input-type-time-into-database
            $table->string('hora');//$variableConversionInsertar = date('h:i A', strtotime($variableRecogidaInputTime));
            $table->integer('personas');
            $table->string('nombreRestaurante');
            $table->primary(array('codigoRes', 'id','fecha','hora'));//ultimo cambio añadir hora
            $table->foreign('codigoRes')->references('codigoRestaurante')->on('restaurantes');
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
        Schema::dropIfExists('restaurante_users');
    }
};

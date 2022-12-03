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
        Schema::create('restaurante_localidad', function (Blueprint $table) {
            $table->unsignedBigInteger('codigoRes');
            $table->unsignedBigInteger('codigoLoc');
          //  $table->string('nombreLoc', 30);
            $table->primary(array('codigoRes', 'codigoLoc'));
            $table->foreign('codigoRes')->references('codigoRestaurante')->on('restaurantes');
            $table->foreign('codigoLoc')->references('codigoLocalidad')->on('localidad');
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
        Schema::dropIfExists('restaurante_localidad');
    }
};

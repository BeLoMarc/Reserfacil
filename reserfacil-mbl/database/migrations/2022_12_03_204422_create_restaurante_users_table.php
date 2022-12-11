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
            $table->string('hora');
            $table->integer('personas');
            $table->string('nombreRestaurante');//El nombre del Restaurante no es necesario pero evito dar demasiadas vueltas para sacarlo
            $table->primary(array('codigoRes', 'id','fecha','hora'));
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

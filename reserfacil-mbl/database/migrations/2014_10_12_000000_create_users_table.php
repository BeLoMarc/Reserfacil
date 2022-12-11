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
        Schema::create('users', function (Blueprint $table) {    
            $table->id('id');// ambos tipos
            $table->string('nombre');// ambos tipos
            $table->string('apellido1')->nullable();// solo gerente
            $table->string('apellido2')->nullable();// solo gerente
            $table->string('DNI',9)->unique()->nullable();// solo gerente
            $table->string('email')->unique();// ambos tipos
            $table->string('password');// ambos tipos
            $table->string('direccion')->nullable();// solo gerente
            $table->string('telefono',12);// ambos tipos
            $table->integer('isAdmin')->default(0);// ambos tipos
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};

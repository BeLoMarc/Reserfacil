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
        Schema::create('restaurante_categorias', function (Blueprint $table) {
            $table->unsignedBigInteger('codigoRes');
            $table->unsignedBigInteger('codigoCat');
       //     $table->string('nombreCat',30);
            $table->primary(array('codigoRes','codigoCat'));
            $table->foreign('codigoRes')->references('codigoRestaurante')->on('restaurantes');
            $table->foreign('codigoCat')->references('codigoCategoria')->on('categorias');
          //  $table->rememberToken();
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
        Schema::dropIfExists('restaurante_categorias');
    }
};

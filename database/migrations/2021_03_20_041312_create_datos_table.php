<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDatosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 100);
            $table->text('contenido');
            $table->string('url_mas_info', 255);
            $table->string('url_imagen', 255);
            $table->integer('estado')->comment('0 => rechazado, 1 => aceptado, 2 => en proceso');
            $table->unsignedBigInteger('categoria_key');
            $table->foreign('categoria_key')->references('id')->on('categorias');
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
        Schema::dropIfExists('datos');
    }
}

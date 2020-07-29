<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTarjetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tarjetas', function (Blueprint $table) {
            $table->id();
            $table->string('numero_tarjeta');
            $table->string('cvv');
            $table->string('mes');
            $table->string('anio');
            $table->string('tipo');   //-debito  -credito
            $table->unsignedBigInteger('id_banco');
            $table->foreign('id_banco')->references('id')->on('bancos');
            $table->string('id_usuario');
            $table->foreign('id_usuario')->references('email')->on('users');
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
        Schema::dropIfExists('tarjetas');
    }
}

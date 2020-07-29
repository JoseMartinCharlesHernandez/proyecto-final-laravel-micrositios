<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo',30);
            $table->string('descripcion',255);
            $table->float('monto',8,2);
            $table->unsignedBigInteger('id_tipo');
            $table->string('id_usuario');
            $table->unsignedBigInteger('id_micrositio');
            $table->foreign('id_tipo')->references('id')->on('tipo_pagos');
            $table->foreign('id_usuario')->references('email')->on('users');
            $table->foreign('id_micrositio')->references('id')->on('micrositios');
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
        Schema::dropIfExists('pagos');
    }
}

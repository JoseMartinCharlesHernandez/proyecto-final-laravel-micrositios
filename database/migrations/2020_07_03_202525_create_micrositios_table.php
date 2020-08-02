<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMicrositiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('micrositios', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->longText('direccion');
            $table->string('descripcion',255);
            $table->float('lat', 8, 6)->nullable();
            $table->float('lng', 8, 6)->nullable();	
            $table->string('logo_url',255)->nullable();  
            $table->unsignedBigInteger('id_empresario')->unique();
            $table->foreign('id_empresario')->references('id')->on('users');
            $table->unsignedBigInteger('id_estado')->nullable();
            $table->foreign('id_estado')->references('id')->on('estados');
            $table->unsignedBigInteger('id_municipio')->nullable();
            $table->foreign('id_municipio')->references('id')->on('municipios');
            $table->unsignedBigInteger('id_estatus')->nullable();
            $table->foreign('id_estatus')->references('id')->on('estatus');
            $table->unsignedBigInteger('id_categoria')->nullable();
            $table->foreign('id_categoria')->references('id')->on('categorias');
            
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
        Schema::dropIfExists('micrositios');
    }
}

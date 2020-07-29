<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable=["nombre","precio","imagen_url","id_micrositio","id_estatus"];
}

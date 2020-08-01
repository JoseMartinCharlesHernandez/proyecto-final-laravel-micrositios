<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $fillable = ['producto','cantidad','total','id_producto','id_empresario','id_micrositio','id_estatus'];

   // protected $table = 'ventas';
}


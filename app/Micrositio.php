<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micrositio extends Model
{
    //

    protected $fillable = ['nombre','direccion','descripcion','id_estado','id_categoria','id_empresario','lat','lng','logo_url','id_municipio','id_estado','id_estatus','banner_url'];

    protected $table = 'micrositios';
}

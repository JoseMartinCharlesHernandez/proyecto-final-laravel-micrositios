<?php

use Illuminate\Database\Seeder;
use App\Micrositio;
class MicrositiosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Micrositio::create([
            "nombre" => 'Taqueria El Champion',
            "direccion" => "Avenida la Paz",
            "id_categoria" => 1,
            "id_estado" => 29,
            "id_municipio" => 2025,
            "descripcion" => 'vendemos de todo',
            "id_estatus" =>1,
            "id_empresario" => 2,
            "lat"=>23.740001,
            "lng"=>-99.115028,
            "logo_url" =>"/logos/taco.jpg"
        ]);

        Micrositio::create([
            "nombre" => 'Ferreteria la Torre',
            "direccion" => "Colonia Tamatán",
            "id_categoria" => 2,
            "id_estado" => 29,
            "id_municipio" => 2025,
            "descripcion" => 'vendemos de todo',
            "id_estatus" =>1,
            "id_empresario" => 3,
            "lat"=>23.712613,
            "lng"=>-99.176246,
            "logo_url" =>"/logos/martillo.png"
        ]);


        Micrositio::create([
            "nombre" => 'Soriana',
            "direccion" => "Centro",
            "id_categoria" => 3,
            "id_estado" => 29,
            "id_municipio" => 2025,
            "descripcion" => 'Tenemos todo lo que buscas',
            "id_estatus" =>1,
            "id_empresario" => 4,
            "lat"=>23.728208,
            "lng"=>-99.14456,
            "logo_url" =>"/logos/soriana.png"
        ]);
    }
}

<?php

use Illuminate\Database\Seeder;
use App\Servicio;
class ServiciosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
 /*       //Plomeria
        Servicio::create([
            "nombre"=>'instalación de ...', 
            "precio"=>1500, 
            "imagen_url"=> "/servicios/default.png", 
            "id_estatus"=>1,
            "id_micrositio"=>1,
        ]);
*/
        //fereteria

        Servicio::create([
            "nombre"=>'instalación de tinaco', 
            "precio"=>800, 
            "imagen_url"=> "/servicios/default.png", 
            "id_estatus"=>1,
            "id_micrositio"=>2,
        ]);

        Servicio::create([
            "nombre"=>'instalación de puertas', 
            "precio"=>700, 
            "imagen_url"=> "/servicios/default.png", 
            "id_estatus"=>1,
            "id_micrositio"=>2,
        ]);

        Servicio::create([
            "nombre"=>'instalación de luz', 
            "precio"=>2300, 
            "imagen_url"=> "/servicios/default.png", 
            "id_estatus"=>1,
            "id_micrositio"=>2,
        ]);




    }
}

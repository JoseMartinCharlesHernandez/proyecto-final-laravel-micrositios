<?php

use Illuminate\Database\Seeder;
use App\Producto;
class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //comida
        Producto::create([
            "nombre"=>'cocacola', 
            "precio"=>15, 
            "imagen_url"=> "/productos/cocacola.jpg", 
            "id_estatus"=>1,
            "id_micrositio"=>1,
        ]);

        
        Producto::create([
            "nombre"=>'migada', 
            "precio"=>40, 
            "imagen_url"=> "/productos/migada.jpg", 
            "id_estatus"=>1,
            "id_micrositio"=>1,
        ]);
        
        Producto::create([
            "nombre"=>'orden de tacos', 
            "precio"=>30, 
            "imagen_url"=> "/productos/orden_tacos.jpg", 
            "id_estatus"=>1,
            "id_micrositio"=>1,
        ]);
        
        Producto::create([
            "nombre"=>'quesadillas', 
            "precio"=>45, 
            "imagen_url"=> "/productos/quesadillas.jpg", 
            "id_estatus"=>1,
            "id_micrositio"=>1,
        ]);


        //fereteria

        
        Producto::create([
            "nombre"=>'martillo', 
            "precio"=>50, 
            "imagen_url"=> "/productos/martillo.jpg", 
            "id_estatus"=>1,
            "id_micrositio"=>2,
        ]);

        Producto::create([
            "nombre"=>'pintura en aerosol', 
            "precio"=>35, 
            "imagen_url"=> "/productos/pintura_lata.png", 
            "id_estatus"=>1,
            "id_micrositio"=>2,
        ]);

        Producto::create([
            "nombre"=>'tinaco rotoplas', 
            "precio"=>2300, 
            "imagen_url"=> "/productos/tinaco_rotoplas.jpg", 
            "id_estatus"=>1,
            "id_micrositio"=>2,
        ]);




    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorias = array('comida','ferreteria','abarrotes','limpieza','plomeria','dulceria',
                            'comida rapida','muebleria','zapateria','papeleria','snacks');

        foreach ($categorias as $categoria) {         
            DB::table('categorias')->insert([
                'nombre' => $categoria
            ]);
        }
        
    }
}

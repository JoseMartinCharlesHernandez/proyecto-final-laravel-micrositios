<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TiposUsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos_usuarios')->insert([
            'tipo' => 'Administrador',
        ]);
        DB::table('tipos_usuarios')->insert([
            'tipo' => 'Empresario',
        ]);
        DB::table('tipos_usuarios')->insert([
            'tipo' => 'Usuario',
        ]);
        
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class EstatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estatus = array('activo','inactivo','suspendido','rechazado','aceptado');
        
        foreach ($estatus as $e) {
            DB::table('estatus')->insert([
                'nombre' => $e
            ]);
        }
    }
}
    
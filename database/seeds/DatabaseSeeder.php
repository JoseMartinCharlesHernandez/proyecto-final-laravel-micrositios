<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(EstadosSeeder::class);
         $this->call(MunicipiosSeeder::class);
         $this->call(TiposUsuariosSeeder::class);
         $this->call(EstatusSeeder::class);
         $this->call(CategoriasSeeder::class);
         $this->call(UserSeeder::class);
         $this->call(MicrositiosSeeder::class);
         $this->call(ProductosSeeder::class);
         $this->call(ServiciosSeeder::class);
    }
}

<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'email' => 'proyecto.final.laravel@gmail.com',
            'password' => Hash::make('password'),
            'id_estatus' =>'1',
            'type' => 1,
        ]);
        DB::table('users')->insert([
            'name' => 'empresario',
            'email' => 'empresario@empresario.com',
            'password' => Hash::make('password'),
            'id_estatus' =>'1',
            'type' => 2,
        ]);

        DB::table('users')->insert([
            'name' => 'empresario2',
            'email' => 'empresario2@empresario2.com',
            'password' => Hash::make('password'),
            'id_estatus' =>'1',
            'type' => 2,
        ]);

        DB::table('users')->insert([
            'name' => 'empresario3',
            'email' => 'empresario3@empresario3.com',
            'password' => Hash::make('password'),
            'id_estatus' =>'1',
            'type' => 2,
        ]);

        DB::table('users')->insert([
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => Hash::make('password'),
            'id_estatus' =>'1',
            'type' => 3,
        ]);

        //creando usuarios random    
        $respuesta = Http::get('https://randomuser.me/api/?inc=name,email,login,picture&page=3&results=30');
        $usuarios = $respuesta->json();
            foreach ($usuarios["results"] as $item) {
          User::create([  
            'name'=> $item["name"]["first"]." ".$item["name"]["last"],
            'email'=>$item["email"],
            'password'=>$item["login"]["password"],
            'avatar_url'=> $item["picture"]["large"],
            'id_estatus'=>Arr::random([1,2]),
            'type'=>Arr::random([2.3]),
          ]);

        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Micrositio;
use App\pedido;
use App\User;
use App\Venta;
use App\Categoria;
use App\Producto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //conteo de datos
        $ventas      = Venta::all()->count();
        $micrositios = Micrositio::all()->count();
        $usuarios    = User::all()->count();  
        $productos     = Producto::all()->count();  
        $conteo      = array("ventas"=>$ventas, "micrositios"=>$micrositios, "usuarios" => $usuarios, "productos"=>$productos);
        
        $micrositios = Micrositio::all();
        $categorias  = Categoria::all();
        //dd($conteo);
        return view('home',['conteo'=>$conteo,'categorias'=>$categorias,'micrositios'=>$micrositios]);
    }

    public function welcome(){
                //conteo de datos
                $ventas      = Venta::all()->count();
                $micrositios = Micrositio::all()->count();
                $usuarios    = User::all()->count();  
                $productos     = Producto::all()->count();  
                $conteo      = array("ventas"=>$ventas, "micrositios"=>$micrositios, "usuarios" => $usuarios, "productos"=>$productos);
                
                $micrositios = Micrositio::all();
                $categorias  = Categoria::all();
                //dd($conteo);
                return view('welcome',['conteo'=>$conteo,'categorias'=>$categorias,'micrositios'=>$micrositios]);
    }
}

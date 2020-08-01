<?php

namespace App\Http\Controllers;

use App\Micrositio;
use App\Producto;
use App\Venta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class VentasController extends Controller
{

    public function index()
    {   //se valida si el usuario es admin para retornar todas las ventas
        if (Auth::user()->type == 1) {
            $ventas = DB::table('ventas as v')
                      ->join('micrositios as m','m.id','v.id_micrositio')
                      ->select('v.*','m.nombre as micrositio')->get();
        } else {
          //si el usuario es empresario, solo se le muestran sus ventas  
            $ventas = DB::table('ventas as v')
            ->join('micrositios as m','m.id','v.id_micrositio')
            ->where('id_empresario',Auth::user()->id)
            ->select('v.*','m.nombre as micrositio')->get();
        }
        return view('ventas.listar',compact('ventas'));
    }

    function create($id)
    { //se carga la ventana de venta del producto
      $producto = Producto::find(1);
      $micrositio = Micrositio::find($producto->id_micrositio);
      return view('ventas.create',compact('producto','micrositio'));
    }


    public function store()
    {   // se almacena el producto 
        Venta::create(['producto'=>Request('nombre'),
                       'cantidad'=>Request('cantidad'),
                       'total'=> Request('precio') * Request('cantidad'),
                       'id_producto'=>Request('id_producto'),
                       'id_empresario'=> Request('id_empresario'),
                       'id_micrositio'=> Request('id_micrositio'),
                       'id_estatus'=> 1 ] );

        return  redirect()->route('home');               
        
    }

    public function destroy($id)
    {   //se cambia el estatus de la venta a inahbilitada
        $v = Venta::find($id);
        $v->id_estatus= 2;
        $v->save();

        return redirect()->route('ventas.listar');
    }

    public function restore($id)
    {   //se restaura un registro de venta
        $v = Venta::find($id);
        $v->id_estatus= 1;
        $v->save();

        return redirect()->route('ventas.listar');
    }
}

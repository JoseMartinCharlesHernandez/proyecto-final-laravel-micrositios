<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\estado;
use App\Micrositio;
use App\Producto;
use App\municipio;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Laravel\Ui\Presets\React;

class MicrositiosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
 
       $micrositio =  DB::table('micrositios')
                ->where('id_empresario','=',Auth::user()->id)
                ->join('categorias as c','c.id','micrositios.id_categoria')
                ->join('estados as e','e.id','micrositios.id_estado')
                ->join('municipios as m','m.id','micrositios.id_municipio')
                ->select('micrositios.*','c.nombre as categoria','e.nombre as estado','m.municipio')

                ->get();


       //se valida si existe un micrositio actualmente         
        $existe = sizeof($micrositio)==0 ? false : true ;
        
        //si el micrositio existe se obtienen los productos
        $productos = Producto::where([['id_micrositio',$micrositio[0]->id],
                                      ['id_estatus',1]
                                        ])->get(); 

        
        $estados = Estado::all();
        $categorias = Categoria::all();


   
        return view('micrositios.index',compact('micrositio','existe','estados','categorias','productos'));
    }

    public function listar(){
        $micrositios = DB::select("select m.*, u.name as empresario, c.nombre as categoria 
                                             from micrositios as m 
                                             inner join users as u on u.id = m.id_empresario
                                             inner join categorias as c on c.id = m.id_categoria");
        //dd($micrositios);
        return view ('micrositios.listar',compact('micrositios'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

       if(Request()->hasFile('logo')){
            $file = Request()->file('logo');
            $name = $file->getClientOriginalName();
            $file->move(public_path().'/logos/',$name);
         
        }else{
            $name ="default.png";
       }

     //  dd(Request('lat'));

       Micrositio::create([
        "nombre" => Request('nombre'),
        "direccion" => Request('direccion'),
        "id_categoria" => Request('categoria'),
        "id_estado" => Request('estado'),
        "id_municipio" => Request('municipio'),
        "descripcion" => Request('descripcion'),
        "id_estatus" =>1,
        "id_empresario" => Auth::user()->id,
        "lat"=>Request('lat'),
        "lng"=>Request('lng'),
        "logo_url" =>"/logos/".$name
    ]);
        return  redirect()->route('micrositios.index');


    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //si el micrositio existe se obtienen los productos
        $productos = Producto::where([['id_micrositio',$id],['id_estatus',1]])->get(); 

        return view('micrositios.show',compact('productos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $micrositio = Micrositio::find($id);
        $categorias = Categoria::all();
        $estados = Estado::all();
        $municipios = municipio::all();
        return view('micrositios.modificar',compact('micrositio','categorias','estados','municipios'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {

        $v = Request()->validate([
            "nombre"  => "required|max:100",
            "direccion"  =>"required| max:130",
            "descripcion" =>"required|:max:255"
        ],[
            "nombre.required"=>"Es necesario el nombre del establecimiento.",
            "nombre.max:100"=>"El nombre solo puede tener 100 caracteres como maximo.",
            "direccion.required"=>"Es necesario el nombre del establecimiento.",
            "direccion.max:130"=>"La dirección solo puede tener 130 caracteres como maximo.",
            "descripcion.required"=>"Es necesaria la descripción del establecimiento.",
            "descripcion.max:1255"=>"La descripción solo puede tener 255 caracteres como maximo.",

        ]);


        if(Request()->hasFile('logo')){
            $file = Request()->file('logo');
            $name = $file->getClientOriginalName();
            $file->move(public_path().'/logos/',$name);
         
        }else{
            $name = "default.png";
        }


             // dd(Request('lat'));

       $micrositio = Micrositio::find($id);
       // dd($micrositio);
        $micrositio->nombre = Request('nombre');
        $micrositio->direccion = Request('direccion');
        $micrositio->id_categoria = Request('categoria');
        $micrositio->id_estado = Request('estado');
        $micrositio->id_municipio = Request('municipio');
        $micrositio->descripcion = Request('descripcion');
        $micrositio->id_estatus =1;
        $micrositio->id_empresario = Request('listar') == 1 ? $micrositio->id_empresario :  Auth::user()->id;
        $micrositio->lat=Request('lat');
        $micrositio->lng=Request('lng');
        //si el logo ha cambiado se actualizará    
        if($name!="default.png")
             $micrositio->logo_url ="/logos/".$name;    

        $micrositio->save();

        if(Request('listar') ==1){
            return  redirect()->route('micrositios.listar');
        }else{
             return  redirect()->route('micrositios.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $micrositio = Micrositio::find($id);
        $micrositio->id_estatus = 2;
        $micrositio->save();

        //se deshabilitan todos los productos del micrositio 
        Producto::where('id_micrositio', $id)
        ->update(['id_estatus' => 2]);

        return redirect()->route('micrositios.listar');
    }

    public function restore($id)
    {
        $micrositio = Micrositio::find($id);
        $micrositio->id_estatus = 1;
        $micrositio->save();

        //se habilitan todos los productos del micrositio
        Producto::where('id_micrositio', $id)
          ->update(['id_estatus' => 1]);

        return redirect()->route('micrositios.listar');
    }

}
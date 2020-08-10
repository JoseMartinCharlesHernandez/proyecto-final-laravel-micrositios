<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\estado;
use App\Micrositio;
use App\Producto;
use App\municipio;
use App\Estatus;
use App\Venta;
use App\Servicio;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MicrositiosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       //se valida si existe un micrositio actualmente         
       $existe = Micrositio::where('id_empresario',Auth::user()->id)->get()->count() == 0 ? false : true ;

       $p=0;$s=0;$v=0;
       $productos= array();
       $micrositio = null; 
        //si es la primera vez que se accede a la vista de "mi micrositio" se genera el registro del micrositio 
        if(!$existe){
            Micrositio::create([
                "nombre" => '',
                "direccion" => "",
                "id_categoria" => 1,
                "id_estado" => 1,
                "id_municipio" => 1,
                "descripcion" => '',
                "id_estatus" =>6,
                "id_empresario" => Auth::user()->id,
                "lat"=>0,
                "lng"=>0,
                "logo_url" =>"/logos/default.png"
            ]);   
        }


        $id_micrositio = Micrositio::where('id_empresario',Auth::user()->id)->first()->id;

        $micrositio =  DB::table('micrositios')
        ->where('id_empresario','=',Auth::user()->id)
        ->join('categorias as c','c.id','micrositios.id_categoria')
        ->join('estados as e','e.id','micrositios.id_estado')
        ->join('municipios as m','m.id','micrositios.id_municipio')
        ->select('micrositios.*','c.nombre as categoria','e.nombre as estado','m.municipio')
        ->get()[0];

       // dd($micrositio);
        //si el micrositio existe se obtienen los productos
        $productos = Producto::where([['id_micrositio',$id_micrositio],
                                    ['id_estatus',1]] )->get(); 
                                        
        // se contabilizan los registros
        $p = Producto::where([['id_estatus',1],['id_micrositio',$id_micrositio]])->count();
        $s = Servicio::where([['id_estatus',1],['id_micrositio',$id_micrositio]])->count();
        $v = Venta::where([['id_estatus',1],['id_empresario',Auth::user()->id]])->count();


        //se almacenan en un arreglo
        $contadores = array($p,$s,$v);

        //se obtienten los datos de estados y  categorias
        $estados = Estado::all();
        $categorias = Categoria::all();

        return view('micrositios.index',compact('micrositio','estados','categorias','productos','contadores'));
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


       $v =  Request()->validate([
            "nombre"  => "required|max:100",
            "direccion"  =>"required| max:130",
            "descripcion" =>"required|:max:255",
            "lat" => 'required',
            "lng"  =>'required'
        ],[
            "nombre.required"=>"Es necesario el nombre del establecimiento.",
            "nombre.max:100"=>"El nombre solo puede tener 100 caracteres como maximo.",
            "direccion.required"=>"Es necesario el nombre del establecimiento.",
            "direccion.max:130"=>"La dirección solo puede tener 130 caracteres como maximo.",
            "descripcion.required"=>"Es necesaria la descripción del establecimiento.",
            "descripcion.max:1255"=>"La descripción solo puede tener 255 caracteres como maximo.",
            "lat.required" => "debes de elegir una ubicación",
            "lng.required" => "Debes de elegir una ubicación"
        ]);


       if(Request()->hasFile('logo')){
            $file = Request()->file('logo');
            $name = $file->getClientOriginalName();
            $file->move(public_path().'/logos/',$name);
         
        }else{
            $name ="default.png";
       }

       if(Request()->hasFile('banner')){
        $file = Request()->file('banner');
        $name_banner = $file->getClientOriginalName();
        $file->move(public_path().'/banners/',$name_banner);
     
        }else{
                $name_banner ="default.jpg";
        }
    

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
        "logo_url" =>"/logos/".$name,
        "banner_url" =>"/banners/".$name_banner
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
        $banner_url = Micrositio::find($id)->banner_url;
        return view('micrositios.show',compact('productos','banner_url'));
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
        $estatus = Estatus::all();
        return view('micrositios.modificar',compact('micrositio','categorias','estados','municipios','estatus'));
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

        Request()->validate([
            "nombre"  => "required|max:100",
            "direccion"  =>"required| max:130",
            "descripcion" =>"required|:max:255",
            "lat" => 'required',
            "lng"  =>'required'
        ],[
            "nombre.required"=>"Es necesario el nombre del establecimiento.",
            "nombre.max:100"=>"El nombre solo puede tener 100 caracteres como maximo.",
            "direccion.required"=>"Es necesario el nombre del establecimiento.",
            "direccion.max:130"=>"La dirección solo puede tener 130 caracteres como maximo.",
            "descripcion.required"=>"Es necesaria la descripción del establecimiento.",
            "descripcion.max:1255"=>"La descripción solo puede tener 255 caracteres como maximo.",
            "lat.required" => "debes de elegir una ubicación",
            "lng.required" => "Debes de elegir una ubicación"
        ]);

         
        if(Request()->hasFile('logo')){
            $file = Request()->file('logo');
            $name = $file->getClientOriginalName();
            $file->move(public_path().'/logos/',$name);
         
        }else{
            $name = "default.png";
        }


        if(Request()->hasFile('banner')){
            $file = Request()->file('banner');
            $name_banner = $file->getClientOriginalName();
            $file->move(public_path().'/banners/',$name_banner);
        
        }else{
                $name_banner ="default.jpg";
        }
    

       $micrositio = Micrositio::find($id);
       // dd($micrositio);
        $micrositio->nombre = Request('nombre');
        $micrositio->direccion = Request('direccion');
        $micrositio->id_categoria = Request('categoria');
        $micrositio->id_estado = Request('estado');
        $micrositio->id_municipio = Request('municipio');
        $micrositio->descripcion = Request('descripcion');
        $micrositio->id_estatus = Auth::user()->type==1 ? Request('id_estatus') : $micrositio->id_estatus;
        $micrositio->id_empresario = Request('listar') == 1 ? $micrositio->id_empresario :  Auth::user()->id;
        $micrositio->lat=Request('lat');
        $micrositio->lng=Request('lng');
        //si el logo ha cambiado se actualizará    
        if($name!="default.png")
             $micrositio->logo_url ="/logos/".$name;    
        if($name_banner!="default.jpg")
             $micrositio->banner_url ="/banners/".$name_banner;    

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

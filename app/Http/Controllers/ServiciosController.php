<?php

namespace App\Http\Controllers;

use App\Estatus;
use Illuminate\Http\Request;
use App\Servicio;
use App\Micrositio;
use GeneaLabs\LaravelMaps\Providers\Service;
use Illuminate\Support\Facades\Auth;
class ServiciosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->type==1)
          $servicios = Servicio::
          join('micrositios as mi','mi.id','=','servicios.id_micrositio')
          ->select('mi.nombre as micrositio','servicios.*')
          ->get();

        else{
          $id_micrositio = Micrositio::where('id_empresario',Auth::user()->id)->first()->id;
          $servicios = Servicio::where([ ['id_micrositio',$id_micrositio],
                                         ['id_estatus',1]   //estatus activo del Servicio
                                        ])->get();
        }
         
        
        //dd($servicios);
        return view('servicios.listar',compact('servicios'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if(Auth::user()->type==1){
            $micrositios = Micrositio::all();
            return view('servicios.crear',['micrositios'=>$micrositios]);
        }else{
            return view('servicios.crear');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

        $v = Request()->validate([
            "nombre"  => "required|max:100",
            "precio"  =>"required|digits_between:1,1000000",
        ],[
            "nombre.required"=>"Es necesario el nombre del servicio.",
            "nombre.max:100"=>"El nombre solo puede tener 100 caracteres como maximo.",
            "precio.required" => "Es necesario el precio del servicio.",
            "precio.digits_between"=>"el precio debe de estar entre un rango de 1 a 1000000 valido",
        ]);



        if(Request()->hasFile("imagen")){
            $file = Request()->file("imagen");
            $nombre_imagen = $file->getClientOriginalName();
            $file->move(public_path().'/servicios/',$nombre_imagen);
        }else{
              $nombre_imagen = "default.png";  
        }

        if(Auth::user()->type==1){
            $id_micrositio = Request('micrositio');   
        }else{
            $id_micrositio = Micrositio::where('id_empresario','=',Auth::user()->id)->first()->id;   
        }
            
        Servicio::create([
            "nombre"=>Request("nombre"), 
            "precio"=>Request("precio"), 
            "imagen_url"=> "/servicios/".$nombre_imagen, 
            "id_estatus"=>1,
            "id_micrositio"=>$id_micrositio,
        ]);

        return redirect()->route('servicios.listar');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $servicio = Servicio::find($id);
       
      if(Auth::user()->type==1){
        $micrositios = Micrositio::where('id_estatus',1)->get();  
        $estatus = Estatus::where('id','=',1)->orwhere('id','=',2)->get();
        return view('servicios.modificar',['servicio'=>$servicio,'micrositios'=>$micrositios,'estatus'=>$estatus]);
      }
    
        return view('servicios.modificar',['servicio'=>$servicio]); 
        
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
            "precio"  =>"required|digits_between:1,1000000",
        ],[
            "nombre.required"=>"Es necesario el nombre del servicio.",
            "nombre.max:100"=>"El nombre solo puede tener 100 caracteres como maximo.",
            "precio.required" => "Es necesario el precio del servicio.",
            "precio.digits_between"=>"el precio debe de estar entre un rango de 1 a 1000000 valido",
        ]);
        
        if(Request()->hasFile("imagen")){
            $file = Request()->file("imagen");
            $nombre_imagen = $file->getClientOriginalName();
            $file->move(public_path().'/servicios/',$nombre_imagen);
        }else{
              $nombre_imagen = "default.png";  
        }
            

       $s = Servicio::find($id);     
       $s->nombre = Request('nombre');
       $s->precio = Request('precio');
       $s->imagen_url= "/servicios/".$nombre_imagen;  
       if(Auth::user()->type==1){
          $s->id_estatus = Request('id_estatus');
          $s->id_micrositio =  Request('id_micrositio');
       }
       $s->save();

       return redirect()->route('servicios.listar');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $servicio = Servicio::find($id);
        $servicio->id_estatus= 2;
        $servicio->save(); 

        return redirect()->route('servicios.listar');
    }

    public function restore($id)
    {
        $servicio = Servicio::find($id);
        $servicio->id_estatus= 1;
        $servicio->save(); 

        return redirect()->route('servicios.listar');
    }

}

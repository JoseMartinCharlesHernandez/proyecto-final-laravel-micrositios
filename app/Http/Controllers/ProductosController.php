<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Micrositio;
use App\Producto;
use App\Estatus;
use Illuminate\Http\Request;
class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->type==1)
          $productos = Producto::
          join('micrositios as mi','mi.id','=','productos.id_micrositio')
          ->select('mi.nombre as micrositio','productos.*')
          ->get();

        else{
          $id_micrositio = Micrositio::where('id_empresario',Auth::user()->id)->first()->id;
          $productos = Producto::where([ ['id_micrositio',$id_micrositio],
                                         ['id_estatus',1]   //estatus activo del producto
                                        ])->get();
        }
         
        
        //dd($productos);
        return view('productos.listar',compact('productos'));
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
            return view('productos.crear',['micrositios'=>$micrositios]);
        }else{
            return view('productos.crear');
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

        Request()->validate([
            "nombre"  => "required|max:100",
            "precio"  =>"required|digits_between:1,1000000",
        ],[
            "nombre.required"=>"Es necesario el nombre del producto.",
            "nombre.max:100"=>"El nombre solo puede tener 100 caracteres como maximo.",
            "precio.required" => "Es necesario el precio del producto.",
            "precio.digits_between"=>"el precio debe de estar entre un rango de 1 a 1000000 valido",
        ]);



        if(Request()->hasFile("imagen")){
            $file = Request()->file("imagen");
            $nombre_imagen = $file->getClientOriginalName();
            $file->move(public_path().'/productos/',$nombre_imagen);
        }else{
              $nombre_imagen = "default.png";  
        }

        if(Auth::user()->type==1){
            $id_micrositio = Request('micrositio');   
        }else{
            $id_micrositio = Micrositio::where('id_empresario','=',Auth::user()->id)->first()->id;   
        }
            
        Producto::create([
            "nombre"=>Request("nombre"), 
            "precio"=>Request("precio"), 
            "imagen_url"=> "/productos/".$nombre_imagen, 
            "id_estatus"=>1,
            "id_micrositio"=>$id_micrositio,
        ]);

        return redirect()->route('productos.listar');

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
      $producto = Producto::find($id);
       
      if(Auth::user()->type==1){
        $micrositios = Micrositio::all();  
        $estatus = Estatus::where('id','=',1)->orwhere('id','=',2)->get();
        return view('productos.modificar',['producto'=>$producto,'micrositios'=>$micrositios,'estatus'=>$estatus]);
      }
    
        return view('productos.modificar',['producto'=>$producto]); 
        
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
            "nombre.required"=>"Es necesario el nombre del producto.",
            "nombre.max:100"=>"El nombre solo puede tener 100 caracteres como maximo.",
            "precio.required" => "Es necesario el precio del producto.",
            "precio.digits_between"=>"el precio debe de estar entre un rango de 1 a 1000000 valido",
        ]);


        if(Request()->hasFile("imagen")){
            $file = Request()->file("imagen");
            $nombre_imagen = $file->getClientOriginalName();
            $file->move(public_path().'/productos/',$nombre_imagen);
        }else{
              $nombre_imagen = "default.png";  
        }

        $p = Producto::find($id);    
        $p->nombre = Request('nombre');
        $p->precio = Request('precio');
        $p->imagen_url ="/productos/".$nombre_imagen;
        if(Auth::user()->type==1){
            $p->id_estatus = Request('id_estatus');
            $p->id_micrositio = Request('id_micrositio');   
        }

        $p->save();

        return redirect()->route('productos.listar');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $producto = Producto::find($id);
        $producto->id_estatus= 2;
        $producto->save(); 

        return redirect()->route('productos.listar');
    }

    public function restore($id)
    {
        $producto = Producto::find($id);
        $producto->id_estatus= 1;
        $producto->save(); 

        return redirect()->route('productos.listar');
    }

}

<?php

namespace App\Http\Controllers;

use App\Categoria;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categoria::all();
       // dd($categorias);
        return view ('categorias.listar',compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorias.crear');
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
        ],[
            "nombre.required"=>"Es necesario el nombre de la categoria.",
            "nombre.max:100"=>"El nombre solo puede tener 100 caracteres como maximo.",
        ]);
            
        Categoria::create([
            "nombre"=>Request("nombre"), 
            "id_estatus"=>1,
        ]);

        return redirect()->route('categorias.listar');

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
      $categoria = Categoria::find($id);
       
    
        return view('categorias.modificar',['categoria'=>$categoria]); 
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Request()->validate([
            "nombre"  => "required|max:100",
        ],[
            "nombre.required"=>"Es necesario el nombre de la categoria.",
            "nombre.max:100"=>"El nombre solo puede tener 100 caracteres como maximo.",
        ]);
            
        $c = Categoria::find($id);
        $c->nombre = Request('nombre');
        $c->save();

        return redirect()->route('categorias.listar');
  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoria = Categoria::find($id);
        $categoria->id_estatus= 2;
        $categoria->save(); 

        return redirect()->route('categorias.listar');
    }

    public function restore($id)
    {
        $categoria = Categoria::find($id);
        $categoria->id_estatus= 1;
        $categoria->save(); 

        return redirect()->route('categorias.listar');
    }

}

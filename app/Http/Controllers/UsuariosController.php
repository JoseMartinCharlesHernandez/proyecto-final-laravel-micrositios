<?php

namespace App\Http\Controllers;

use App\TiposUsuario;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserCreateRequest;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Request;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = DB::table('users')
            ->join('estatus', 'id_estatus', '=', 'estatus.id')
            ->join('tipos_usuarios','tipos_usuarios.id','=','users.type')
            ->select('users.*', 'estatus.nombre as estatus','tipos_usuarios.tipo')
            ->get();

         // dd($usuarios);  
        return view('usuarios.listar',compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipos = TiposUsuario::all();
        return view('usuarios.crear',['tipos'=>$tipos]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {

        //Almacenando la imagen del alumno
        // $path=$request->file('avatar_url')->store('/public/users');
        // $avatar_url = 'storage/users/'.$request->file('avatar_url')->hashName();
        $avatar_url = 'img';

        User::create([
            'name'=> $request->name,
            'email' => $request->email,
            'password' =>Hash::make($request->password),
            'type' => $request->type,
            'avatar_url' =>$avatar_url, 
            'id_estatus' =>1
        ]);
        return redirect()->route('usuarios.listar');
        
  }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

       // dd('dentro de show');
         $usuario = DB::table('users')
                ->join('estatus', 'id_estatus', '=', 'estatus.id')
                ->join('tipos_usuarios','tipos_usuarios.id','=','users.type')
                ->select('users.*', 'estatus.nombre as estatus','tipos_usuarios.tipo')
                ->where('users.id',$id)
                ->get()[0];

        //dd($usuario);

        return view('usuarios.mostrar',['usuario'=>$usuario]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::find($id);
        $tipos = TiposUsuario::all();

        return view('usuarios.modificar',['usuario'=>$usuario,'tipos'=>$tipos]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( Request $request, $id)
    {

       $request->validate([
        'name'=>'required|max:200',
        'password' =>'required|max:80',
        'type' => 'required',
       ],[
        'name.required' => 'el nombre es obligatorio',
        'name.max:200' =>'el :nombre debe tener un maximo de 200 caracteres',
        'password.required'=>'la contraseña es obligatoria',
        'password.max:80'=>'la contraseña debe tener maximo 80 caracteres',
        'type.required' =>'debes seleccionar un tipo'
       ]);

        $user = User::find($id);
            
        $user->name = $request->name;
        $user->password = Hash::make($request->password);
        $user->type = $request->type;
        $user->save();

        return redirect()->route('usuarios.listar');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // se cambia el estatus del usuario a inactivo
        $user = User::find($id);
        $user->id_estatus = 2;
        $user->save();
        return redirect()->route('usuarios.listar');
    }

    public function restore($id)
    {
        // se cambia el estatus del usuario a activo
        $user = User::find($id);
        $user->id_estatus = 1;
        $user->save();
        return redirect()->route('usuarios.listar');
    }
}

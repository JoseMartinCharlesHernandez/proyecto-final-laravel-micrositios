<?php

namespace App\Http\Controllers;

use App\Mail\MensajeCotizacion;
use App\Mail\MensajeRecivido;
use App\Micrositio;
use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\User;
use Illuminate\Support\Facades\Auth;
class MensajeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $data  = "datos";

        Mail::to('proyecto.final.laravel@gmail.com')->queue(new MensajeRecivido($data));

      //  return new MensajeRecivido($data);
        return 'mensaje enviado';
    }


    public function resetPassword(User $user,$password){
  
        Mail::to($user->mail)->queue(new MensajeRecivido($user,$password));
      //  return new MensajeRecivido($data);
        return 'mensaje enviado';
        
    }

    public function sendQuotation(){
        $producto =  Producto::find(Request("id_producto"));
        $micrositio = Micrositio::find(Request("id_micrositio"));
        $usuario = User::find(Auth::user()->id);
        Mail::to($usuario->email)->queue(new MensajeCotizacion($producto,$usuario,$micrositio));
      //  return new MensajeRecivido($data);

       return json_encode(' al correo: '.$usuario->email);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

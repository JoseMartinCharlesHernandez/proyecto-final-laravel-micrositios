<?php

namespace App\Http\Controllers;

use App\Mail\MensajeRecivido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\User;
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
  
        Mail::to('proyecto.final.laravel@gmail.com')->queue(new MensajeRecivido($user,$password));
      //  return new MensajeRecivido($data);
        return 'mensaje enviado';
        
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

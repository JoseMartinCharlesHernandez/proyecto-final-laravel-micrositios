<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MensajeCotizacion extends Mailable
{
    use Queueable, SerializesModels;

    public $subject= "Cotización de Productos";
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($producto,$usuario,$micrositio)
    {
        $this->producto = $producto;
        $this->usuario =$usuario; 
        $this->micrositio = $micrositio;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('correo.mensaje-cotizacion');
    }
}

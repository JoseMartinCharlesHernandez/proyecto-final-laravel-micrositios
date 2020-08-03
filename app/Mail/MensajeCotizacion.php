<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MensajeCotizacion extends Mailable
{
    use Queueable, SerializesModels;

    public $subject= "Cotización de Productos";
    public $producto;
    public $usuario;
    public $micrositio;
    public $total;
    public $cantidad;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($producto,$usuario,$micrositio,$total,$cantidad)
    {
        $this->producto = $producto;
        $this->usuario =$usuario; 
        $this->micrositio = $micrositio;
        $this->total = $total;
        $this->cantidad = $cantidad;
        
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

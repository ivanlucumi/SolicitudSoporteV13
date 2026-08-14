<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificacionEntregaAlmacen extends Mailable
{

   use Queueable, SerializesModels;

    public $elementos;
    public $nombreDespacho;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($elementos, $nombreDespacho,$observaciones)
    {
        $this->elementos = $elementos;
        $this->nombreDespacho = $nombreDespacho;
        $this->observaciones = $observaciones;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this->markdown('emails.Almacen.NotificacionEntrega')
                    ->with([
                        'elementos' => $this->elementos,
                        'nombreDespacho' => $this->nombreDespacho,
                        'observaciones'=>$this->observaciones,
                    ])
                    ->from('informacion@disajcali.gov.co', 'SIRISCALI')
                    ->subject('Respuesta a la Solicitud de Elementos al Almacén')
                    ->priority(1); // Alta prioridad
                    
    }
}

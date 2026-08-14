<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotificacionSolicitudAlmacen extends Mailable
{

   use Queueable, SerializesModels;

    public $elementos;
    public $nombreDespacho;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($elementos, $nombreDespacho)
    {
        $this->elementos = $elementos;
        $this->nombreDespacho = $nombreDespacho;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         return $this->markdown('emails.Almacen.NotificacionSolicitud')
                    ->with([
                        'elementos' => $this->elementos,
                        'nombreDespacho' => $this->nombreDespacho,
                    ])
                    ->from('informacion@disajcali.gov.co', 'SIRISCALI')
                    ->subject('Solicitud a Almacén');
        
    }
}

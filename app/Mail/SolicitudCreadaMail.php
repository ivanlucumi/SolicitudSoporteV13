<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\SolicitudServicio;

class SolicitudCreadaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $solicitud;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(SolicitudServicio $solicitud)
    {
        $this->solicitud = $solicitud;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTOS INFORMATICOS – DISAJ CALI')
                    ->subject('Notificación de Registro: ' . $this->solicitud->numero_solicitud)
                    ->view('emails.solicitudes.creada');
    }
}

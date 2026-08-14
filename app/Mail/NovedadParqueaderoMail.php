<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NovedadParqueaderoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $registro;
    public $novedades;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($registro, $novedades)
    {
        $this->registro = $registro;
        $this->novedades = $novedades;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.monitoreo.novedad_parqueadero')
                    ->with([
                        'registro'  => $this->registro,
                        'novedades' => $this->novedades,
                    ])
                    ->from('informacion@disajcali.gov.co', 'SIRISCALI')
                    ->subject(' Novedad Parqueadero - ' . strtoupper($this->registro->placa ?? 'S/P') . ' · ' . now()->format('H:i'));
    }
}

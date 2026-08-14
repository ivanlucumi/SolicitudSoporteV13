<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerificacionCodigoConsulta extends Mailable
{
    use Queueable, SerializesModels;

    public $code;
    public $tempUrl;

    public function __construct($code,$tempUrl)
    {
        $this->code = $code;
        $this->urlTemp = $tempUrl;
    }

    public function build()
    {
        return $this->view('emails.Teletrabajo.CodigoVerificacion')
                    ->with(['code' => $this->code,
                        'urlTemp' => $this->urlTemp])
                        ->from('informacion@disajcali.gov.co', 'SIRISCALI')
                    ->subject('Registro Teletrabajo');;
    }
}

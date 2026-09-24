<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\EncuestaTrabajoCasa;

class FormatoTrabajoCasaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $encuesta;

    public function __construct(EncuestaTrabajoCasa $encuesta)
    {
        $this->encuesta = $encuesta;
    }

    public function build()
    {
        return $this->subject('Formato Elementos Trabajo en Casa - Acuerdo XXX-00022')
                    ->view('emails.formato_trabajo_casa');
    }
}

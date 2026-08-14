<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailsInformativo extends Mailable
{

    public $user;
    public $requerimiento;
    public $descripcion;


    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $requerimiento, $descripcion)
    {
        //
        $this->user = $user;
        $this->requerimiento = $requerimiento;
        $this->descripcion = $descripcion;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.informacion');
    }
}

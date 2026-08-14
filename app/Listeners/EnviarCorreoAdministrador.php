<?php

namespace App\Listeners;

use App\Events\SolicitudEnviada;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use App\Listeners\EnviarCorreoAdministrador;

use App\Mail\MailsInformativo;
//use Mail;

class EnviarCorreoAdministrador
{
   

    /**
     * Handle the event.
     *
     * @param  SolicitudEnviada  $event
     * @return void
     */
    public function handle(SolicitudEnviada $event)
    {
        //dd($event->user, $event->requerimiento, $event->descripcion);

        Mail::to('Mfernandp@cendoj.ramajudicial.gov.co')->send(
            new MailsInformativo($event->user, $event->requerimiento, $event->descripcion)
        );
        
    }
}
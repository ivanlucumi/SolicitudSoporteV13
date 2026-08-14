<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FichaPreliminarReparto extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $body;
    public $attachments;

    public function __construct($subject, $body, $attachments = [])
    {
        $this->subject = $subject;
        $this->body = $body;
        $this->attachments = $attachments;
    }

    public function build()
    {
        $email = $this->view('emails.ficha.CorreoFichaReparto')
                      ->subject($this->subject)
                      ->with(['body' => $this->body])
                      ->priority(1) // Alta prioridad
                      ->withSwiftMessage(function ($message) {
                          $message->getHeaders()->addTextHeader('X-Priority', '1');
                          $message->getHeaders()->addTextHeader('X-MSMail-Priority', 'High');
                         // $message->getHeaders()->addTextHeader('Disposition-Notification-To', 'tu_correo@tudominio.com');
                         // $message->getHeaders()->addTextHeader('Return-Receipt-To', 'tu_correo@tudominio.com');
                      });

        foreach ($this->attachments as $filePath) {
            $email->attach($filePath);
        }

        return $email;
    }
}

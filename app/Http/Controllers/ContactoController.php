<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Mail; 
use Illuminate\Support\Facades\Session;

class ContactoController extends Controller
{
    //

    public function store(Request $request)
    {

    }

    public function contacto(Request $request){
    	
        if (isset($_POST['contacto'])) {
            $data = array(
                    'nombre'   =>     $request->nombre,
                    'email'    =>     $request->email,
                    'asunto'   =>     $request->asunto,
                    'msg'      =>     $request->msg,
            );

            $fromEmail = 'Mfernandp@cendoj.ramajudicial.gov.co';
            $fromName  = 'Administrador';

            Mail::send('emails.contacto', $data, function($message) use ($fromName, $fromEmail)
            {
                $message->to($fromEmail, $fromName);
                $message->from($fromEmail, $fromName);
                $message->subject('Nueva Solicitud');
            });
            
        }
        Session::flash('message', 'Mensaje Enviado con Exito');
            //$mensaje = '<div class="text-info">Mensaje Enviado con Exito</div>';
            //return view('contactenos');
             return Redirect::to('/contactenos');
    }
    
    
    public function create()
    {
        return view('Pqrsdf.Create');
    }

    public function storePqrsdf(Request $request)
    {
        // VALIDACIÓN
        $data = $request->validate([
            'tipo'              => 'required|string',
            'nombres'           => 'required|string|max:100',
            'tipo_documento'    => 'required|string',
            'numero_documento'  => 'required|string|max:50',
            'correo'            => 'required|email',
            'telefono'          => 'nullable|string|max:20',
            'direccion'         => 'nullable|string|max:150',
            'asunto'            => 'required|string|max:150',
            'mensaje'           => 'required|string',
            'anexo'             => 'nullable|file|max:2048', // 2 MB
            'correo_confirmacion' => 'required|same:correo',
            'g-recaptcha-response' => 'required|captcha',
        ]);

        // ENVÍO DE CORREO DIRECTO
        Mail::send('emails.pqrsdf', ['data' => $data], function ($message) use ($request, $data) {

            $message->to('gmstdesajvalle3@cendoj.ramajudicial.gov.co')
                    ->subject('Nueva PQRSDF - ' . $data['tipo']);

            // Copia opcional al ciudadano
            $message->replyTo($data['correo'], $data['nombres']);

            // Adjuntar archivo SOLO al correo (NO se guarda)
            if ($request->hasFile('anexo')) {
                $archivo = $request->file('anexo');

                $message->attach(
                    $archivo->getRealPath(),
                    [
                        'as'   => $archivo->getClientOriginalName(),
                        'mime' => $archivo->getMimeType(),
                    ]
                );
            }
        });

        return redirect()->back()->with(
            'success',
            'Su PQRSDF fue enviada correctamente. Recibirá respuesta al correo registrado 📧'
        );
    }
    
    

}

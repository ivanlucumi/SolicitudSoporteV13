<?php

namespace App\Http\Controllers\Teletrabajo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;

use Illuminate\Support\Str;

use App\Mail\VerificacionCodigoConsulta;


use Maatwebsite\Excel\Facades\Excel;

use App\Models\VerificationCode;
use App\Models\TeletrabajoPasto;
use App\Models\TeletrabajoPastoInforme;


class ConsultaPastoController extends Controller
{
   
   
   public function showEmailForm()
    {
        return view('TeletrabajoPasto.PastoTeletrabajo');
    }
    
     public function sendCode(Request $request)
    {
        
        //dd($request->all());
        
        // Validar el correo electrónico
        $request->validate([
            'email' => 'required|email|regex:/@cendoj.ramajudicial.gov.co$/'
        ]);

        // Generar el código y guardarlo en la base de datos, asociado con el email
        $code = rand(100000, 999999);
        
        // Generar una clave única basada en la fecha y el email
        $date = now()->format('Y-m-d');
        $email = $request->email;
        $uniqueKey = Str::random(12);

        // Almacenar o actualizar la contraseña temporal
        VerificationCode::updateOrCreate(
            ['email' => $email, 'fecha_disponible' => $date],
            ['codigo' => $uniqueKey, 'is_valid' => true, 
            'ip'=>$request->ip()]
        );
        
         // Generar la URL temporal, válida hasta el final del día
        $tempUrl = URL::temporarySignedRoute(
            'validacion.teletrabajo.publico',
            now()->endOfDay(),
            ['email' => $email, 'key' => $uniqueKey]
        );
        
        
        //dd($tempUrl,$uniqueKey,$email);

        // Enviar el código al correo (se omiten detalles de Mail)
        
        Mail::to($request->email)->send(new VerificacionCodigoConsulta($uniqueKey,$tempUrl));

        Session::flash('message', 'Correo Enviado');
        return Redirect::back();
    }

    public function verifyCode(Request $request)
    {
        // Validar el código
        $request->validate([
            'email' => 'required',
            'key' => 'required'
        ]);

        // Verificar el código en la base de datos
        $verification = VerificationCode::where([
            ['email', $request->email],
            ['codigo', $request->key],
            ['is_valid', true]
        ])->first();

        if ($verification) {
            
                $ip = $request->ip();
                $fecha=Carbon::Now();
                $fecha_act=$fecha->toDateString();
                $dia_semana=$fecha->dayOfWeek;
                //dd($dia_semana);
                $dia =array('LUNES','MARTES','MIERCOLES','JUEVES','VIERNES');
                
                $dia_semana=$dia[$dia_semana-1];
                //dd($dia_semana1,$dia_semana);
                
                $despacho  =  null;
                
                //dd($despacho,$dia_semana);
                return view('TeletrabajoPasto.Resultado',compact('despacho','dia_semana','fecha_act','ip'));
                }
        $verification->update(['is_valid' => false]);
        Session::flash('message', 'Código inválido o expirado.');
        return Redirect::back();
    }
    
    public function Teletrabajo(Request $request){
        
        // Validar el código
        $request->validate([
            'email' => 'required',
            'key' => 'required'
        ]);
        
        $date = now()->format('Y-m-d');

        // Verificar el código en la base de datos
        $verification = VerificationCode::where([
            ['email', $request->email],
            ['codigo', $request->key],
            ['fecha_disponible', $date],
            ['is_valid', true]
        ])->first();

        if ($verification) {
            
                $ip = $request->ip();
                $fecha=Carbon::Now();
                $fecha_act=$fecha->toDateString();
                $dia_semana=$fecha->dayOfWeek;
                //dd($dia_semana);
                $dia =array('LUNES','MARTES','MIERCOLES','JUEVES','VIERNES');
                
                $dia_semana=$dia[$dia_semana-1];
                //dd($dia_semana1,$dia_semana);
                
                $despacho  =  TeletrabajoPasto::where('dias_teletrabajo',"like",'%'.$dia_semana.'%')
                ->get();
                
                //dd($despacho[0],$dia_semana);
                return view('TeletrabajoPasto.Resultado',compact('despacho','dia_semana','fecha_act','ip'));
                }
        
        Session::flash('error', 'Código inválido o expirado.');
        return redirect()->route('email.form');
        
    }
   
  
}



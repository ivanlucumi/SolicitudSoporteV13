<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller\Administrador;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\UsuarioAdministradorCreateRequest;
use App\Http\Requests\UsuarioAdministradorUpdateRequest;
use Illuminate\Support\Facades\Mail;


use App\Models\User;
use App\Models\RoL;
use App\Models\Banner;
use App\Models\Especial;
use App\Models\Noticias;
use App\Models\SolicitudUsuario;
use Hash;

class UserController extends Controller
{
     public function __construct(){
        $this->middleware('auth');
        $this->middleware('checarsesion');
        
        $this->middleware('administrador');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::todoUsers();
        //dd($users);
        $roles = RoL::pluck('id','rol');
        $actualizarN = Noticias::actualizarEstadoN();
        $actualizarB = Banner::actualizarEstadoB();
        $actualizarE = Especial::actualizarEstadoE();

        return view('administrador.user.index', compact('users','roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = RoL::pluck('rol','id');
        return view('administrador.user.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsuarioAdministradorCreateRequest $request)
    {
        //
         User::create([
            'cedula'         => $request['cedula'],
            'name'           => $request['name'],     
            'lastname'       => $request['lastname'], 
            'email'          => $request['email'], 
            'password'       => $request['password'],
            'rol'            => $request['rol']  

                   
        ]);
        
        Session::flash('message','Usuario Creado Correctamente');
        return Redirect::to('/administrador/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    
    public function ResetContrasenha($id){
        
        $user = User::findOrFail($id);
        
        $nombre=$user->name;
        $email = $user->email;
        
        $email =str_replace(' ', '', $email);
        
        $data =  json_decode(json_encode($user), true);
        //dd($user);
        
        $user->email = $email;
        $user->cambiopassword= 0;
        //$user->password= Hash::make(123456);
        $user->password= 123456;
        
        $user->save();
        
        //dd($user->save());
        
        
        Mail::send('emails.resetPassword', $data, function ($message) use ($user,$email) {
                        $message->from('informacion@disajcali.gov.co', 'SISTEMA DE REGISTRO DE REQUERIMIENTO INFORMATICOS - DISAJ CALI');
                        $message->to($email, $user->name);
                        $message->subject('Restablecimiento de Contraseña Siris');
                        
                    }); 
        Session::flash('message','Se ha enviado correo con la nueva clave');
            return redirect()->back();
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
         $user = User::findOrFail($id);
         //dd($user);
         $roles = RoL::pluck('rol','id');
         
         $certificoP = array('0' => 'Sin Certificar' , '1' => 'Empleados Certificados'  );

                        
          return view('administrador.user.edit', compact('user','roles','certificoP'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsuarioAdministradorUpdateRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $data = $request->all();
        
        // Remove password from data if it wasn't provided, so it doesn't get updated to empty
        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->fill($data);
        $user->save();
       
        Session::flash('message', 'Usuario actualizado correctamente');
        return Redirect::to('/administrador/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $comprobar = 0;
        $comprobar1 = 0;
        $comprobar2 = 0;
        
        $dato   =   SolicitudUsuario::All();
        $variable = User::comprobarAdministrador($id);
        foreach ($dato as $dt) {
            if($id == $dt->idUser){
                $comprobar =  $comprobar + 1;
               
            }
        }

        foreach ($dato as $dt) {
            if($id == $dt->tecnico ){
                $comprobar1 =  $comprobar1 + 1;
            }
        }

  
        //dd($variable);
        
        if($comprobar == 0 && $comprobar1 == 0){
            if($variable  ==  true){
                Session::flash('message','No se puede eliminar Usuario, Es el Administrador del Sistema ');
                return Redirect::to('/administrador/user');
            }else{
                $user = User::destroy($id);
                Session::flash('message','Eliminado Correctamente');
                return Redirect::to('/administrador/user');
            }   
            
        }else{
            Session::flash('message','No se puede eliminar Usuario, está siendo utilizado en Solicitud Usuario ');
            return Redirect::to('/administrador/user');
        } 
       
            

         
    }
}

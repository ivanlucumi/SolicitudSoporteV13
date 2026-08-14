<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CambioPasswordController extends Controller
{
    public function __construct()
    {
       // $this->middleware('auth');
    }


    
public function showChangePasswordForm(){
	
        
        return view('auth.changepassword');
    }


    public function changePassword(Request $request){

		if (!(Hash::check($request->get('current-password'),  auth()->user()->password))) {
		// The passwords matches
		return redirect()->back()->with("error","Su contraseña actual no coincide con la contraseña que proporcionó. Inténtalo de nuevo.");
		}
		if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
		//Current password and new password are same
		return redirect()->back()->with("error","
La nueva contraseña no puede ser igual a su contraseña actual. Por favor, elija una contraseña diferente.");
		}
		$validatedData = $request->validate([
		'current-password' => 'required',
		'new-password' => 'required|string|min:6|confirmed',
		]);
		//Change Password
		$user =  auth()->user();
		$user->password = $request->get('new-password');
		//$user->password = Hash::make( $request->get('new-password'));
		$user->cambiopassword = 1;
		$user->save();
		
		return Redirect::to('/administrador')->with("success","Contraseña Cambiada Correctamente !");
}

}

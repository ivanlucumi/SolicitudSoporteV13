<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Support\RoleHome;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    
     
    protected $redirectTo = 'administrador/';
    
    
    protected function authenticated(Request $request, $user)
    {
        if (RoleHome::requiresPasswordChange($user)) {
            return redirect(RoleHome::changePasswordPath());
        }

        return redirect(RoleHome::pathFor($user->rol));
    }

    protected function validateLogin(Request $request)
    {
        //dd($request->all());
    $this->validate($request, [
    //'g-recaptcha-response' => 'required|captcha',
        //$this->loginUsername() => 'required', 'pass' => 'required','g-recaptcha-response' => 'required|captcha',
    ]);
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


     public function logout(){    
        
         auth()->logout();

        return redirect(property_exists($this, 'redirectAfterLogout') ? $this->redirectAfterLogout : '/');
        
    }
}

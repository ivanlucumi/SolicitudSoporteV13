
@extends('layouts.login_reset')

@section('title', __('Recuperar Contraseña'))


<link rel="shortcut icon" href="{{asset('img/icono.png')}}">

@section('content')

  <meta charset="UTF-8">
  <!-- El resto de tu contenido del head -->

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');

    :root {
        --primary-color: #002147;;
        --primary-hover: #002147;;
        --secondary-color: #f8f9fa;
        --text-color: #333;
        --light-gray: #e9ecef;
        --transition: all 0.3s ease;
    }

    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    html, body {
        height: 100%;
        width: 100%;
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        overflow: auto;
    }

    .fixed-container {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
        z-index: 1;
    }

    .login-box {
        width: 100%;
        max-width: 900px;
        min-height: 500px;
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        display: flex;
        transition: var(--transition);
    }

    .login-box:hover {
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }

    .login-image {
        flex: 1;
        min-width: 40%;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        position: relative;
    }

    .login-image::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(0.1, 125, 110, 0.3), rgba(0.1, 125, 110, 0.3));
    }

    .login-form {
        flex: 1;
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        min-width: 60%;
    }

    .login-logo {
        text-align: center;
        margin-bottom: 30px;
    }

    .login-logo h3 {
        color: white;
        background-color: var(--primary-color);
        padding: 15px 30px;
        border-radius: 50px;
        display: inline-block;
        font-weight: 600;
        letter-spacing: 1px;
        box-shadow: 0 4px 15px rgba(0, 125, 110, 0.3);
        font-size: clamp(1.5rem, 2vw, 2rem);
    }

    .form-group {
        margin-bottom: 25px;
        position: relative;
    }

    .form-control {
        width: 100%;
        height: 50px;
        border-radius: 8px;
        border: 1px solid var(--light-gray);
        padding: 10px 15px 10px 45px;
        font-size: 15px;
        transition: var(--transition);
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(0, 125, 110, 0.2);
        outline: none;
    }

    .form-control:hover {
        border-color: var(--primary-color);
    }

    .input-icon {
        position: absolute;
        left: 15px;
        top: 70%;
        transform: translateY(-50%);
        color: var(--primary-color);
        font-size: 18px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: var(--text-color);
        font-size: clamp(0.9rem, 1vw, 1rem);
    }

    .btn-submit {
        background-color: var(--primary-color);
        border: none;
        color: white;
        padding: 15px;
        border-radius: 8px;
        font-weight: 600;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: var(--transition);
        width: 100%;
        font-size: clamp(1rem, 1.2vw, 1.2rem);
        margin-top: 10px;
    }

    .btn-submit:hover {
        background-color: var(--primary-hover);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 125, 110, 0.3);
    }

    .forgot-password {
        text-align: right;
        margin-top: 15px;
    }

    .forgot-password a {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 300;
        transition: var(--transition);
        font-size: clamp(0.8rem, 1vw, 0.9rem);
    }

    .forgot-password a:hover {
        color: var(--primary-hover);
        text-decoration: underline;
    }

    .error-message {
        color: #dc3545;
        font-size: 14px;
        margin-top: 5px;
        display: block;
    }

    .g-recaptcha {
        margin: 20px 0;
        display: flex;
        justify-content: center;
    }

    @media (max-width: 768px) {
        .fixed-container {
            padding: 10px;
            position: relative;
            height: auto;
            min-height: 100vh;
        }

        .login-box {
            flex-direction: column;
            min-height: auto;
        }

        .login-image {
            min-height: 200px;
            width: 100%;
        }

        .login-form {
            padding: 30px 20px;
        }

        .form-control {
            padding: 10px 15px 10px 40px;
        }
    }

    @media (max-width: 480px) {
        .login-form {
            padding: 25px 15px;
        }

        .login-logo h3 {
            padding: 12px 25px;
        }

        .form-control {
            height: 45px;
        }
    }
    
    .background-video {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 0;
    }
    
    .video-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(0.1, 125, 110, 0.3), rgba(0.1, 125, 110, 0.3));
        z-index: 1;
    }
    
    .login-image {
        position: relative;
        overflow: hidden;
        flex: 1;
        min-width: 40%;
    }

    
</style>

<div class="fixed-container">
    	                @if (session('error'))
							<div class="alert alert-danger">
							{{ session('error') }}
							</div>
							@endif
							@if (session('success'))
							<div class="alert alert-success">
							{{ session('success') }}
							</div>
						@endif
    <div class="login-box">
        <div class="login-image" style="background-image: url(/img/opcion_2.jpg);"></div>
        
        <div class="login-form">
            <div class="login-logo">
               <a  href="{!! url('/login')!!}"> <h3>{{ __('SIRISCALI') }}</h3></a>
            </div>
            
            <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Restablecer Contrase&ntilde;a</label>
                    <div class="input-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <input id="email" type="email" placeholder="Correo del Despacho" 
                           class="form-control" name="email" required>
                    
                    @if ($errors->has('email'))
                        <span class="error-message">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                
                
                
                <div class="form-group">
                    <button type="submit" class="btn-submit btn-sm">
                        {{ __('Enviar Correo al Despacho') }}
                    </button>
                </div>
                
                <div class="forgot-password">
                    <a class="btn btn-secundari" href="{{ route('login') }}" style="background-color: gray; color: #fff;">
                        Retornar al Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
@endsection

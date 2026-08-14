@extends('layouts.ensayo1')

@section('title', 'Buscar Solicitud de Ingreso')

@section('content')
<style>
    .card-validador { 
        max-width: 500px; 
        margin: 40px auto; 
        border-radius: 16px; 
        box-shadow: 0 10px 30px rgba(0,0,0,0.08); 
        border: none; 
        overflow: hidden; 
        background-color: white;
    }
    .card-header { 
        background: linear-gradient(135deg, #0a2a4a 0%, #154374 100%); 
        color: white; 
        text-align: center; 
        padding: 30px 20px 20px; 
        border-bottom: none; 
    }
    .logo-img { 
        max-width: 220px; 
        margin-bottom: 20px; 
        background: white; 
        padding: 12px; 
        border-radius: 8px; 
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    }
    .search-section { padding: 40px 30px; text-align: center; }
    .form-control-lg { border-radius: 8px; font-size: 1.1rem; text-align: center; letter-spacing: 1px; height: auto; padding: 10px 16px; border: 1px solid #ccc; width: 100%; box-sizing: border-box; }
    .btn-search { 
        background-color: #0a2a4a; 
        border: none; 
        border-radius: 8px; 
        padding: 12px; 
        font-size: 1.1rem; 
        font-weight: 600; 
        color: white;
        transition: all 0.3s ease;
        display: inline-block;
        width: 100%;
    }
    .btn-search:hover { background-color: #154374; color: white; transform: translateY(-2px); text-decoration: none;}
    .card-footer-custom { background: #f8fafc; border-top: 1px solid #e2e8f0; font-size: 0.85rem; padding: 15px; text-align: center; color: #666;}
    .alert-danger-custom { border-radius: 8px; border: none; background-color: #fef2f2; color: #991b1b; padding: 15px; margin-bottom: 20px; text-align: left;}
</style>

<div class="container px-3" style="padding-top: 40px; padding-bottom: 40px;">
    <div class="card-validador">
        <div class="card-header">
            @php
              $logoPath = public_path('img/logoLargo.png');
              if (file_exists($logoPath)) {
                  $logoUrl = asset('img/logoLargo.png');
              } else {
                  $logoUrl = '';
              }
            @endphp
            @if($logoUrl)
                <img src="{{ $logoUrl }}" alt="Logo" class="logo-img img-responsive mx-auto" style="margin: 0 auto 20px auto; display: block;">
            @else
                <h4 style="margin:0; font-weight: bold;">Sistema de Administración Judicial</h4>
            @endif
            <h5 style="margin-top: 10px; margin-bottom: 0; font-weight: 300; color: rgba(255,255,255,0.8);">Consulta de Autorización de Ingreso</h5>
        </div>
        
        <div class="search-section">
            <h5 style="margin-bottom: 25px; color: #333; font-weight: 600;">Ingrese el Código de Seguimiento</h5>
            
            @if (session('error'))
                <div class="alert-danger-custom">
                    <i class="fa fa-exclamation-circle" style="margin-right: 8px;"></i>{{ session('error') }}
                </div>
            @endif

            <form action="{{ route('solicitud_ingreso.validar_post') }}" method="POST">
                @csrf
                <div style="margin-bottom: 25px;">
                    <input type="text" name="numero_seguimiento" class="form-control-lg" placeholder="Ej: ING-A1B2C3" required autocomplete="off" value="{{ old('numero_seguimiento') }}">
                </div>
                <button type="submit" class="btn-search">
                    <i class="fa fa-search" style="margin-right: 8px;"></i> Consultar Permiso
                </button>
            </form>
        </div>
        
        <div class="card-footer-custom">
            Acceso Público de Verificación
        </div>
    </div>
</div>
@endsection

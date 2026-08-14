@extends('layouts.admin')

@section('title', 'Enviar Certificación')
@section('cabecera', 'Módulo Administrador – Envío de Certificaciones')

@section('content')

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    /* Animación de entrada */
    .fade-in {
        animation: fadeIn 0.8s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    /* Tarjeta */
    .form-card {
        background: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        transition: 0.3s ease;
    }

    .form-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.25);
    }

    .title {
        font-weight: bold;
        margin-bottom: 20px;
    }

    .btn-animate {
        transition: 0.3s ease;
    }

    .btn-animate:hover {
        transform: scale(1.05);
    }
</style>

<div class="container fade-in">

    <div class="col-md-6 col-md-offset-3">
        <div class="form-card">

            <h3 class="text-center title">Solicitud de Certificación Laboral</h3>

            {{-- SweetAlert de error --}}
            @if(session('swal_error'))
                <script>
                    Swal.fire({
                        title: `<span style="font-size:28px; font-weight:700; color:#1e293b;">
                                    {{ session('swal_error') }}
                                </span>`,
                        html: `<span style="font-size:22px; color:#334155;">
                                    Por favor comuníquese al correo:<br><br>
                                    <strong style="font-size:26px;">
                                        {{ session('correo_solicitud') }}
                                    </strong>
                               </span>`,
                        icon: 'error',
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor: '#2563eb',
                        width: '520px',
                        padding: '2.8rem',
                    });
                </script>
            @endif

            {{-- SweetAlert de éxito --}}
            @if(session('success') && session('correo_enviado'))
                <script>
                    Swal.fire({
                        title: '<span style="font-size:28px; font-weight:700; color:#1e293b;">¡Correo enviado!</span>',
                        html: '<span style="font-size:24px; color:#334155;">La certificación fue enviada a:<br><br><strong style="font-size:26px;">{{ session('correo_enviado') }}</strong></span>',
                        icon: 'success',
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor: '#2563eb',
                        width: '520px',
                        padding: '2.8rem',
                    });
                </script>
            @endif


            {{-- FORMULARIO SOLO CON CÉDULA Y CORREO --}}
            <form method="POST" action="{{ route('admin.enviar.certificacion') }}" class="form-horizontal" autocomplete="off">
                @csrf

                {{-- Cédula --}}
                <div class="form-group">
                    <label class="col-sm-4 control-label">Cédula:</label>
                    <div class="col-sm-7">
                        <input type="number" name="identificacion" class="form-control" required placeholder="Ingrese la cédula">
                    </div>
                </div>

                {{-- Correo --}}
                <div class="form-group">
                    <label class="col-sm-4 control-label">Correo electrónico:</label>
                    <div class="col-sm-7">
                        <input type="email" name="correo" class="form-control" required placeholder="ejemplo@correo.com">
                    </div>
                </div>

                {{-- Botón --}}
                <div class="form-group text-center">
                    <button class="btn btn-primary btn-lg btn-animate">
                        Enviar certificación
                    </button>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection

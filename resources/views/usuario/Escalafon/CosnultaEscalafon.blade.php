@extends('layouts.usuarios')

@section('title', 'Consulta Escalafon')
@section('cabecera', 'Consulta y certificacion Escalafon')

@section('content')

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Tarjeta del formulario de búsqueda -->
<div class="container py-4">
    
     {{-- Error personalizado --}}
            @if(session('swal_error'))
            <script>
                Swal.fire({
                    icon: 'error',
                    title: '¡Atención!',
                    html: "{{ session('swal_error') }}",
                    confirmButtonText: 'Aceptar'
                });
            </script>
            @endif
            
           {{-- SweetAlert --}}
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

            
            {{-- SweetAlert --}}
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

<div class="row justify-content-center">

<div class="col-xs-12">

<div class="card card-consulta shadow-lg border-0 rounded-4 animate__animated animate__fadeInDown">

    <!-- HEADER -->
    <div class="card-header header-consulta text-center">

        <h3 class="mb-1">
            <i class="bi bi-search me-2"></i>
            Consulta Escalafón
        </h3>

        <p class="mb-0 small opacity-75">
            Ingrese los datos para consultar su información
        </p>

    </div>

    <!-- BODY -->
        <div class="container-fluid">
            <form method="GET" action="{{ route('consulta.escalafon.form') }}">
                @csrf
    
                <div class="row">
    
                    <!-- Cedula -->
                    <div class="col-md-3">
    
                        <label class="form-label label-form">
                            <i class="bi bi-person-vcard"></i>
                            Número de Cédula
                        </label>
    
                        <div class=" input-group-lg">
    
                            <input 
                            type="number"
                            name="cedula"
                            class="form-control input-form"
                            placeholder="Ingrese su numero"
                            min="1"
                            required>
    
                        </div>
    
                    </div>
    
    
                    <!-- Fecha expedicion -->
                    <div class="col-md-3">
    
                        <label class="form-label label-form">
                            <i class="bi bi-calendar-event"></i>
                            Fecha de Expedición
                        </label>
    
                        <div class=" input-group-lg">
                            
    
                            <input 
                            type="date"
                            name="fecha_expedicion"
                            class="form-control input-form"
                            required>
    
                        </div>
    
                    </div>
    
    
                    <!-- EMAIL NUEVO -->
                    <div class="col-md-6">
    
                        <label class="form-label label-form">
                            <i class="bi bi-envelope"></i>
                            Correo electrónico
                        </label>
    
                        <div class=" input-group-lg">
                            
                            <input 
                            type="email"
                            name="email"
                            class="form-control input-form"
                            placeholder="correo@ejemplo.com">
    
                        </div>
    
                    </div>
    
                </div>
    
    <hr>
                <!-- BOTONES -->
                <div class="d-flex justify-content-center gap-3 mt-5">
    
                    <button type="submit" class="btn btn-consultar px-4">
    
                        <i class="bi bi-search me-2"></i>
                        Consultar
    
                    </button>
    
                    <a href="{{ route('consulta.escalafon.form') }}" class="btn btn-limpiar px-4">
    
                        <i class="bi bi-arrow-clockwise me-2"></i>
                        Limpiar
    
                    </a>
    
                </div>
    
            </form>
            <hr>
        </div>
    

</div>

</div>

</div>

</div>
    
    <hr>

      {{-- RESULTADO --}}
@if(isset($registros) && $registros)

<div class="container py-3 ">

    <div class="row justify-content-center">

        @foreach($registros as $r)

        @php
            if ($r->persona_propietario_id == $empleado->id) {
                $persona = $r->propietario;
                $tipoVinculacion = 'PROPIEDAD';
                $badgeClass = 'bg-success';
            } elseif ($r->persona_provisional_id == $empleado->id) {
                $persona = $r->provisional;
                $tipoVinculacion = 'PROVISIONAL';
                $badgeClass = 'bg-warning text-dark';
            } else {
                $persona = null;
                $tipoVinculacion = '';
                $badgeClass = 'bg-secondary';
            }
        @endphp

        <div class="col-xs-12">


                {{-- HEADER --}}
                <div class="card-header header-escalafon text-center">

                    <h2 class="nombre-funcionario">
                        {{ $persona->nameE ?? '' }} {{ $persona->lastnameE ?? '' }}
                    </h2>

                    <div class="cedula">
                        <i class="bi bi-person-vcard"></i>
                        Cédula: {{ $persona->cedulaE ?? '' }}
                    </div>
                     <div class="text-center">

                            <span class="badge {{ $badgeClass }} badge-vinculacion">
                                {{ $tipoVinculacion }}
                            </span>

                        </div>

                </div>


                {{-- BODY --}}
                <div class="card-body p-5">

                    <div class="row g-4">

                        <div class="col-md-6">
                            <div class="info-item">
                                <i class="bi bi-briefcase"></i>
                                <div>
                                    <label>Cargo</label>
                                    <p>{{ $r->cargo->nombre_cargo ?? '' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-item">
                                <i class="bi bi-star-fill"></i>
                                <div>
                                    <label>Grado</label>
                                    <p>{{ $r->cargo->grado ?? '' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-item">
                                <i class="bi bi-building"></i>
                                <div>
                                    <label>Despacho</label>
                                    <p>{{ $r->cargo->despachoJudicial->nombreDespacho ?? '' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-item">
                                <i class="bi bi-diagram-3"></i>
                                <div>
                                    <label>Circuito</label>
                                    <p>{{ $r->cargo->despachoJudicial->circuito ?? '' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-item">
                                <i class="bi bi-file-text"></i>
                                <div>
                                    <label>Tipo Acto</label>
                                    <p>{{ $r->escalafon->tipo_acto ?? '' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-item">
                                <i class="bi bi-hash"></i>
                                <div>
                                    <label>No. Acto</label>
                                    <p>{{ $r->escalafon->numero_acto ?? '' }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="info-item">
                                <i class="bi bi-calendar-event"></i>
                                <div>
                                    <label>Fecha Acto</label>
                                    <p>{{ optional($r->escalafon->fecha_acto)->format('d/m/Y') }}</p>
                                </div>
                            </div>
                        </div>

                      

                    </div>

                </div>
<hr>

                {{-- FOOTER --}}
                <div class="card-footer text-center bg-white pb-4">

                    <a href="{{ route('certificacion.escalafon.descargar.url', [
                            'cedula' => $persona->cedulaE,
                            'email' => $email
                        ]) }}"
                       class="btn btn-descargar">
                    
                        <i class="bi bi-download"></i>
                        Enviar Certificado
                    
                    </a>

                </div>
<br>
            

        </div>

        @endforeach

    </div>

</div>
@elseif(request()->filled('cedula'))

<script>
document.addEventListener('DOMContentLoaded', function () {

    Swal.fire({
        icon: 'error',
        title: 'Sin resultados',
        text: 'No se encontró información para la cédula ingresada.',
        confirmButtonText: 'Intentar nuevamente',
        confirmButtonColor: '#dc3545',
        background: '#fff',
        color: '#333',
        iconColor: '#dc3545'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = "{{ route('consulta.escalafon.form') }}";
        }
    });

});
</script>

@endif
</div>

<!-- Estilos personalizados y animaciones mejoradas -->
<style>
    
    /* CARD GENERAL */

.card-escalafon{
border-radius:18px;
transition:all .3s ease;
}

.card-escalafon:hover{
transform:translateY(-5px);
box-shadow:0 20px 40px rgba(0,0,0,.15);
}


/* HEADER */

.header-escalafon{
background:#0f2a44;
color:white;
padding:5px 5px;
border-radius:18px 18px 0 0;
}





/* BADGE */

.badge-vinculacion{
font-size:16px;
padding:10px 20px;
border-radius:30px;
}


/* BOTON */

.btn-descargar{
background:#0f2a44;
color:white;
font-size:18px;
padding:12px 30px;
border-radius:40px;
transition:.3s;
}

.btn-descargar:hover{
background:#163a5c;
transform:scale(1.05);
color:white;
}

.card-no-result{
border-radius:18px;
transition:all .3s ease;
}

.card-no-result:hover{
transform:translateY(-4px);
box-shadow:0 20px 40px rgba(0,0,0,.15);
}

.icono-alerta{
font-size:60px;
color:#0f2a44;
}

.titulo-alerta{
font-size:30px;
font-weight:700;
color:#0f2a44;
margin-bottom:10px;
}

.mensaje-alerta{
font-size:18px;
color:#6c757d;
line-height:1.6;
}

.btn-volver{
background:#0f2a44;
color:white;
padding:10px 25px;
border-radius:30px;
font-size:16px;
transition:.3s;
}

.btn-volver:hover{
background:#1a3c5a;
color:white;
transform:scale(1.05);
}





/* CARD */

.card-consulta{
overflow:hidden;
transition:all .3s ease;
}

.card-consulta:hover{
transform:translateY(-3px);
box-shadow:0 20px 40px rgba(0,0,0,.15);
}


/* HEADER */

.header-consulta{
background:#0f2a44;
color:white;
padding:5px;
}



/* BOTONES */

.btn-consultar{
background:#0f2a44;
color:white;
border-radius:30px;
padding:12px 30px;
font-size:17px;
transition:.3s;
}

.btn-consultar:hover{
background:#1a3c5a;
color:white;
transform:scale(1.05);
}

.btn-limpiar{
background:#ffc107;
border-radius:30px;
padding:12px 30px;
font-size:17px;
}

.btn-limpiar:hover{
background:#ffca2c;
transform:scale(1.05);
}
    
</style>



@endsection
@extends('layouts.ensayo')
@section('content')

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"async defer></script>
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
    
    @if(1 != 1)

    <div class="col-md-8 col-md-offset-2">
        <div class="form-card">

            <h3 class="text-center title">Solicitud de Certificación Laboral</h3>

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


            <form method="POST" action="{{ route('certificacion.enviar') }}" class="form-horizontal" autocomplete="off">
                @csrf

                {{-- Cédula --}}
                <div class="form-group">
                    <label class="col-sm-4 control-label">C&Eacute;DULA:</label>
                    <div class="col-sm-7">
                        <input type="number" name="identificacion" class="form-control" required placeholder="Ingrese su cédula">
                    </div>
                </div>

                {{-- EPS --}}
                <div class="form-group">
                    <label class="col-sm-4 control-label">EPS:</label>
                    <div class="col-sm-7">
                        <select name="eps" class="form-control" required>
                            <option value="">SELECCIONE SU EPS</option>
                
                            <option>EPS SURA</option>
                            <option>SANITAS S.A.</option>
                            <option>SALUD TOTAL S.A.</option>
                            <option>SERVICIO OCCIDENTAL DE SALUD S.O.S</option>
                            <option>NUEVA EPS</option>
                            <option>COMFENALCO VALLE EPS.</option>
                            <option>EPS-S EMSANAR</option>
                            <option>COOSALUD EPS</option>
                            <option>FAMISANAR LIMITADA</option>
                            <option>ALIANSALUD EPS S.A.</option>
                            <option>CONSORCIO FISALUD-FOSYGA</option>
                            <option>COMPENSAR</option>
                            <option>AIC EPS ASOCIACION INDIGENA DEL CAUCA</option>
                            <option>ASMET SALUD</option>
                            <option>EPS INDIGENA MALLAMAS</option>
                        </select>
                    </div>
                </div>


                {{-- Fondo de pensión --}}
                <div class="form-group">
                    <label class="col-sm-4 control-label">FONDO DE PENSIONES:</label>
                    <div class="col-sm-7">
                        <select name="pension" class="form-control" required>
                            <option value="">SELECCIONE SU FONDO</option>
                
                            <option>PROTECCION</option>
                            <option>COLPENSIONES</option>
                            <option>PORVENIR</option>
                            <option>COLFONDOS</option>
                            <option>OLD MUTUAL (SKANDIA)</option>
                        </select>
                    </div>
                </div>

                {{-- Correo --}}
                <div class="form-group">
                    <label class="col-sm-4 control-label">CORREO ELECTR&Oacute;NICO:</label>
                    <div class="col-sm-7">
                        <input type="email" name="correo" class="form-control" required placeholder="ejemplo@correo.com">
                    </div>
                </div>
                <hr>
                <div align="center" class="col-xs-12">
                            <div  class="g-recaptcha" data-sitekey="6LcOzHoeAAAAAJIayuDbVH0y1w_-qGb_OiR1om1U"></div>
                            <br>
                        </div>
                        <div align="center" class="col-xs-12">
                            @if ($errors->has('g-recaptcha-response'))
                            <span class="help-block text-danger" role="alert">
                                <strong style="color:red">El campo NO SOY UN ROBOT, es obligatorio <!--{{ $errors->first('g-recaptcha-response') }}--></strong>
                            </span>
                           @endif
                            
                        </div>
                       <hr>

                {{-- Botón --}}
                <div class="form-group text-center">
                    <button class="btn btn-primary btn-lg btn-animate">
                        Enviar certificación
                    </button>
                </div>

            </form>

        </div>
    </div>
    @else
    <div class="col-md-8 col-md-offset-2">
    <div class="panel panel-info" style="border-radius:10px;">
        <div class="panel-heading text-center" style="font-size:20px; font-weight:bold;">
            Solicitud de Certificación Laboral
        </div>

        <div class="panel-body" style="font-size:16px; color:#374151; text-align:center; padding:25px;">
            <p>
                Estimado usuario,
            </p>

            <p style="font-size:17px;">
                La certificación laboral debe ser solicitada directamente a 
                <strong>Recursos Humanos</strong>.
            </p>

            <p style="margin-top:20px; font-size:18px;">
                Por favor enviar su solicitud al correo:
            </p>

            <p style="font-size:22px; font-weight:bold; color:#1e3a8a;">
                cldisajcali@cendoj.ramajudicial.gov.co
            </p>
        </div>
    </div>
</div>
    @endif

</div>

@endsection

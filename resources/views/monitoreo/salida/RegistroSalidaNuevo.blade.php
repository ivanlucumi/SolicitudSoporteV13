@extends('layouts.monitoreo.ingreso')
@section('title', 'Control Registro De ingreso')
@section('cabecera', 'Control Registro De salida Desde Portería')

@section('content') 
<style>
    body {
        background: linear-gradient(135deg, #e3f2fd, #bbdefb);
        font-family: 'Segoe UI', sans-serif;
        color: #2c3e50;
        scroll-behavior: smooth;
    }

    h1, h3 {
        font-weight: 700;
        color: #2c3e50;
    }

    .container {
        max-width: 100%;
        padding: 10px;
    }

    .data-box {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        padding: 20px;
        text-align: right;
        margin-bottom: 15px;
    }

    .data-box label {
        font-size: 1.1rem;
        font-weight: 600;
        margin-right: 10px;
    }

    .data-value {
        font-size: 2rem;
        color: #1565c0;
        font-weight: bold;
    }

    .input-section {
        background: #ffffff;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        text-align: center;
        margin-top: 20px;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }

    .input-section input[type="number"] {
        width: 100%;
        padding: 14px;
        border-radius: 10px;
        border: 1px solid #90caf9;
        font-size: 1.2rem;
        text-align: center;
        outline: none;
        transition: all 0.3s ease;
    }

    .input-section input[type="number"]:focus {
        border-color: #42a5f5;
        box-shadow: 0 0 10px rgba(33,150,243,0.4);
    }

    .btn-custom {
        background: linear-gradient(90deg, #42a5f5, #1976d2);
        color: #fff !important;
        font-weight: 600;
        border: none;
        padding: 12px 20px;
        border-radius: 25px;
        font-size: 1.1rem;
        width: 100%;
        transition: 0.3s;
    }

    .btn-custom:hover {
        background: linear-gradient(90deg, #1976d2, #42a5f5);
        transform: scale(1.03);
    }

    @media (max-width: 768px) {
        h1 { font-size: 1.6rem; }
        .data-value { font-size: 1.6rem; }
        .btn-custom { font-size: 1rem; }
        .input-section { padding: 20px; }
    }

    @media (max-width: 480px) {
        .input-section input[type="number"] {
            font-size: 1rem;
            padding: 10px;
        }
        .btn-custom {
            padding: 10px;
            font-size: 1rem;
        }
    }
</style>

<div class="row">
    <div class="col-12">
        <div class="container">
            <div class="data-box">
                <label><h3><strong>INGRESOS:</strong></h3></label>
                <span id="ingresos" class="data-value">{{isset($ingresos)}}</span><br>
                <label><h3><strong>SALIDAS:</strong></h3></label>
                <span id="salidas" class="data-value">{{isset($salidas)}}</span>
            </div>
        </div>
    </div>
</div>

<div class="text-center mb-4">
    <h1><strong>{!! auth()->user()->name!!}</strong></h1>
</div>

<div class="input-section">
    <form id="formSalida" class="form-inline justify-content-center">
        <input name="cedula" type="number" id="cedulaSalida" placeholder="Escanee o escriba la cédula" min="1" required autofocus>
        <br><br>
        <a href="#">Buscar</a>
    </form>
</div>

<!-- Form invisible para enviar datos -->
<form id="form-registro-salida" action="{{ route('salidap.registar.salida.porteria.cedula',':CEDULA_ID') }}" method="POST">
    @csrf
</form>

@push('scripts')
<script>
$(document).click(function(){
   document.getElementById("cedulaSalida").focus();
});

$(document).ready(function() {
    toastr.options = {
        "positionClass": "toast-top-center",
        "timeOut": "1500"
    };

    $('#BcedulaSalida').click(function(e) {
        e.preventDefault();
        var cedulaSal = $('#cedulaSalida').val();
        if (!cedulaSal) {
            toastr.warning('Debe ingresar una cédula válida');
            return;
        }

        var form = $('#form-registro-salida');
        var url = form.attr('action').replace(':CEDULA_ID', cedulaSal);
        var data = form.serialize();

        $.get(url, data, function(result) {
            $('#ingresos').text(result.INGRESOS || 0);
            $('#salidas').text(result.SALIDAS || 0);

            if(result.codigo === 1){
                toastr.success(result.mensaje, "SALIDA REGISTRADA");
            }else{
                toastr.error(result.mensaje, "ERROR AL REGISTRAR");
            }

            $('#cedulaSalida').val('').focus();
        }).fail(function() {
            toastr.error('Error de conexión con el servidor');
        });
    });

    // Auto focus cíclico
    setInterval(() => document.getElementById("cedulaSalida").focus(), 10000);
});
</script>
@endpush
@endsection

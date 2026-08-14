@extends('layouts.soporte')
@section('title', 'Registro de Asistencia')

@section('cabecera', 'Asistencia')

@section('content') 
<style>
    #lista {
        font-size: 18px;
    }

    #imagen {
        display: flex;
        justify-content: center;
        height: 180px;
    }

    .form-control {
        width: 100%;
    }

    .btn-block {
        width: 100%;
    }
    /* Estilo general para la imagen */
.responsive-image {
    width: 100%;
    height: auto;
}

/* Tamaño de imagen para pantallas pequeñas */
@media (max-width: 600px) {
    .responsive-image {
        width: 250px;
        height: 25px;
    }
}

/* Tamaño de imagen para pantallas medianas */
@media (min-width: 601px) and (max-width: 1024px) {
    .responsive-image {
        width: 60%;
        height: 60%;
    }
}

/* Tamaño de imagen para pantallas grandes */
@media (min-width: 1025px) {
    .responsive-image {
        width: 50%;
        height: 70%;
    }
}
    
</style>
<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">

<div class="container">
    <h1><center><strong>Registro de Asistencia</strong></center></h1>
    <center></center>
    
    <div id="imagen" class="text-center my-1">
        <img src="/img/logoAsistencia.png" id="imagen" class="responsive-image" alt="Logo Asistencia">
    </div>
     @if(isset($ip))
        @php
            $validIps = ['190.217.19.', '190.217.24.', '190.217.80.'];
            $isValidIp = false;
            foreach ($validIps as $validIp) {
                if (strpos($ip, $validIp) === 0) {
                    $isValidIp = true;
                    break;
                }
            }
        @endphp

       @if($isValidIp ||  auth()->user()->tipo_rol == "VIAJERO" ||  auth()->user()->tipo_rol == "COORDINADOR")
           
        
    
     <div class="row">
                <div class="col-xs-12 col-sm-7 offset-sm-3">
                    <form id="asistenciaForm" action="{{ route('tecnico.asistencia.ingreso') }}" method="POST" onsubmit="fillLocationFields(event)">
                        @csrf
                        <div class="form-group">
                            <label for="especialidad">* SEDES:</label>
                            <select class="form-control @error('sede') is-invalid @enderror" autocomplete="off" id="sede" name="sede">
    <option value="">Seleccione Sede</option>
    @foreach($sedesTecnicos+ ['OTRO' => 'OTRO'] as $key => $value)
        <option value="{{ $key }}" @selected(old('sede') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('sede')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                         <div class="form-group hidden" id="otherSedeContainer">
                            <label for="other_sede">* Otra Sede:</label>
                            <input class="form-control @error('other_sede') is-invalid @enderror" placeholder="Ingrese otra sede" autocomplete="off" type="text" name="other_sede" id="other_sede" value="{{ old('other_sede') }}">
@error('other_sede')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                        <div class="form-group">
                            <label for="especialidad">* OBSERVACIONES:</label>
                            <input class="form-control @error('observaciones') is-invalid @enderror" placeholder="Observaciones" autocomplete="off" type="text" name="observaciones" id="observaciones" value="{{ old('observaciones') }}">
@error('observaciones')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        </div>
                        <input type="hidden" name="latitude" id="latitude">
                        <input type="hidden" name="longitude" id="longitude">
                        <div class="form-group row mb-0">
                            <div class="offset-md-3 col-md-9 offset-md-3">
                                <br>
                                <button type="submit" class="btn btn-primary btn-md btn-block">REGISTRAR INGRESO</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-xs-12 col-sm-4 mt-3">
                    <form action="{{ route('tecnico.asistencia.salida') }}" method="POST">
                        @csrf
                        <br>
                        <button type="submit" class="btn btn-danger btn-md btn-block">REGISTRAR SALIDA</button>
                    </form>
                </div>
            </div>
     
    
    
           
           
        @else
            <center>
                <h2>
                    <strong>NO SE PUEDE REALIZAR REGISTRO DE ASISTENCIA POR FUERA DE LA RED DE LA RAMA JUDICIAL</strong>
                </h2>
            </center>
        @endif
    @endif
    <hr>
    <center><h2 class="mt-4">Historial de Asistencia</h2></center>
    <div class="col-xs-12 col-md-12 form-group table-responsive">
        <table id="table9" class="table table-bordered table-striped">
            <thead class="shadow" style="background-color: #004182; color: #fff;">
                <tr> 
                    <td>SEDE</td>
                    <td>FECHA</td>
                    <td>HORA INGRESO</td>
                    <td>HORA SALIDA</td>
                    <td>OBSERVACIONES</td>
                </tr>
            </thead> 
            @if($mi_asistencia != null)
                @foreach($mi_asistencia as $asistencia)
                    <tbody data-id="{!! $asistencia->id !!}">
                        <tr>
                            <td>{{ $asistencia->sede }}</td>
                            <td>{{ $asistencia->fecha_registro }}</td>
                            <td>{{ $asistencia->hora_ingreso }}</td>
                            <td>{{ $asistencia->hora_salida }}</td>
                            <td>{{ $asistencia->observaciones }}</td>
                        </tr>
                    </tbody>
                @endforeach
            @endif 
        </table>
    </div>
</div>

<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/exportTabla/jquery-1.12.4.min.j"></script>
<script src="/js/exportTabla/FileSaver.min.js"></script>
<script src="/js/exportTabla/Blob.min.js"></script>
<script src="/js/exportTabla/xls.core.min.js"></script>
<script src="/js/exportTabla/js/tableexport.js"></script>

<script>
$("table").tableExport({
	formats: ["xlsx"], //Tipo de archivos a exportar ("xlsx","txt", "csv", "xls")
	position: 'top',  // Posicion que se muestran los botones puedes ser: (top, bottom)
	bootstrap: true,//Usar lo estilos de css de bootstrap para los botones (true, false)
	fileName: "Asistencia",    //Nombre del archivo 
});

</script>

<!--script>
    document.addEventListener('DOMContentLoaded', (event) => {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                document.getElementById('latitude').value = position.coords.latitude;
                document.getElementById('longitude').value = position.coords.longitude;
            }, function(error) {
                alert('Error obteniendo la ubicación: ' + error.message);
            });
        } else {
            alert("La geolocalización no es soportada por este navegador.");
        }
    });

    function fillLocationFields(event) {
        event.preventDefault();
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                document.getElementById('latitude').value = position.coords.latitude;
                document.getElementById('longitude').value = position.coords.longitude;
                document.getElementById('asistenciaForm').submit();
            }, function(error) {
                alert('Error obteniendo la ubicación: ' + error.message);
                document.getElementById('asistenciaForm').submit();
            });
        } else {
            alert("La geolocalización no es soportada por este navegador.");
            document.getElementById('asistenciaForm').submit();
        }
    }
    
     document.getElementById('sede').addEventListener('change', function() {
            var otherSedeContainer = document.getElementById('otherSedeContainer');
            if (this.value === 'otro') {
                otherSedeContainer.classList.remove('hidden');
            } else {
                otherSedeContainer.classList.add('hidden');
            }
        });
    
</script-->
@endsection

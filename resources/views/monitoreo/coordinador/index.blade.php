@extends('layouts.monitoreo.coordinador')
<!--ponerle titulo a la paginga-->
@section('title', 'Control Registro De ingreso')
@section('cabecera', 'Control Registro De ingreso')

@section('content') 
    <!--CONTAR USUARIOS -->
    <style> 
        #value {
    width:150px;
    float:right;
    text-align:right;
    padding:10px;
    background-color:#dadada;
    font-size:36px;
}
    </style>
    
    <div>
        <center>
            <p>
                <h1>
                    <strong>
                        {!! auth()->user()->name!!}
                    </strong>
                </h1>
            </p>
        </center>
    </div>
    
   
   @include('monitoreo.include.coordinador')
   

   @include('monitoreo.modalAutorizar')

<!--CONSULTA INGRESO Y ACTUALIZA LA HORA-->
<form id="form-consulta-ingreso" action="{{ route('coordinador.verificacion.ingreso.cedula',':CEDULA_ID') }}" method="POST">
    @csrf
</form>

<!--CONSULTA INGRESO -->
<form id="form-consulta-ingreso-coordinacion" action="{{ route('coordinador.verificacion.coordinacion.ingreso.cedula',':CEDULA_ID') }}" method="POST">
    @csrf
</form>

<!--para temperatua 1-->
<form id="form-consulta-ingreso-vehiculo" action="{{ route('coordinador.verificacion.ingreso.vehiculo',':PLACA_ID') }}" method="POST">
    @csrf
</form>

<!--modal INGRESO DE VEHICULO-->
<form id="form-modal-ingreso" action="{{ route('coordinador.verificacion.ingreso.vehiculo',':PLACA_ID') }}" method="POST">
    @csrf
</form>


<!--autorizacion INGRESO DE VEHICULO-->
<form id="form-autorizar-ingreso" action="{{ route('coordinador.autorizacion.ingreso.vehiculo',':PLACAING_ID') }}" method="POST">
    @csrf
</form>

<!--NEGAR INGRESO DE VEHICULO-->
<form id="form-denegar-ingreso" action="{{ route('coordinador.denegar.ingreso.vehiculo',':PLACAING_ID') }}" method="POST">
    @csrf
</form>


<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>


@push('scripts')
<script src="/js/ingreso/coordinador.js"></script>
<script src="/js/ingreso/autorizacionVehiculo.js"></script>
<script src="/js/tablaMonitoreo.js"></script> 

@endpush
    

 
 
@endsection


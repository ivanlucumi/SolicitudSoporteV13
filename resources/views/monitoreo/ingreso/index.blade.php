@extends('layouts.monitoreo.ingreso')
<!--ponerle titulo a la paginga-->
@section('title', 'Control Registro De ingreso')
@section('cabecera', 'Control Registro De ingreso Desde Portería')

<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">
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
    
 @include('monitoreo.ingreso.ingresos')

 @include('monitoreo.modalRegsitrarVisita')

<!--REGISTRAR INGRESO DE VISITANTES-->
<form id="form-registar-ingreso-visitante" action="{{ route('ingresop.visitantes.registro.cedula',':CEDULA_ID') }}" method="POST">
    @csrf
</form>

<!--CONSULTA INGRESO Y ACTUALIZA LA HORA-->
<form id="form-consulta-ingreso" action="{{ route('ingresop.verificacion.ingreso.cedula',':CEDULA_ID') }}" method="POST">
    @csrf
</form>

<!--CONSULTA INGRESO -->
<form id="form-consulta-ingreso-coordinacion" action="{{ route('ingresop.verificacion.coordinacion.ingreso.cedula',':CEDULA_ID') }}" method="POST">
    @csrf
</form>

<!--para temperatua 1-->
<form id="form-consulta-ingreso-vehiculo" action="{{ route('ingresop.verificacion.ingreso.vehiculo',':PLACA_ID') }}" method="POST">
    @csrf
</form>





@push('scripts')
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/ingreso/ingresoporteriaVisitante.js"></script>
<script src="/js/tablaMonitoreo.js"></script> 
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
	fileName: "Registro ingreso de Visitantes",    //Nombre del archivo 
});

</script>
@endpush
    

 
 
@endsection


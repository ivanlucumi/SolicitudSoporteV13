@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Solicitudes de Servicios')
@section('cabecera', 'Subir Solicitud Teletrabajo')
@section('content') 
@include('../alerts.success')
@include('../alerts.request')

<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">


     
     <div class="col-xs-12 col-md-12  form-group table-responsive">
      <table  id="table9" class="table table-bordered table-striped">
        <thead class="shadow" style="background-color: #004182; color: #fff;">
        	<tr>    
                <td>IDENTIFICACI&Oacute;N</td>
                <td>NOMBRE</td>
                <td>CARGO</td>
                <td>CIUDAD TRABAJO</td>
                <td>TELEFONO</td>
                <td>CORREO</td>
                <td>ADJUNTO</td>
                <td>TIPO VIAJE</td>
                 <td>FECHA VIAJE SALIDA</td>
                 <td>HORA SALIDA</td>
                <td>ORIGEN</td>
                <td>DESTINO</td>
                <td>VALOR ESTIMADO</td>
                <td>FECHA VIAJE REGRESO</td>
                <td>HORA REGRESO</td>
                <td>ORIGEN</td>
                <td>DESTINO</td>
                <td>VALOR ESTIMADO</td>
                <td>REQUIERE HOTEL</td>
                <td>INGRESO HOTEL</td>
                <td>SALIDA HOTEL</td>
                <td>VALOTO TOTAL</td>
                </tr>
            </thead> 
            @if($solicitudes != null)
             @foreach($solicitudes as $radicado)
             
             
                <tbody>
                    <tr >
                     <td>{{$radicado->cedula}}</td>
                     <td>{{$radicado->nombre_completo}} </td>
                     <td>{{$radicado->cargo}}</td>
                     <td>{{$radicado->ciudad_trabajo}}</td>
                     <td>{{$radicado->telefono}}</td>
                     <td>{{$radicado->correo}}</td>
                     <td>{{$radicado->ya_adjunto_cedula}}</td>
                     <td>{{$radicado->tipo_viajes}}</td>
                     <td>{{$radicado->fecha_de_viaje}}</td>
                     <td>{{$radicado->hora_salida}}</td>
                     <td>{{$radicado->de_ciudad}}</td>
                     <td>{{$radicado->a_ciudad}}</td>
                     <td>{{$radicado->valor_estimado}}</td>
                     
                     <td>{{$radicado->fecha_regreso}}</td>
                     <td>{{$radicado->hora_regreso}}</td>
                     <td>{{$radicado->de_ciudad_regreso}}</td>
                     <td>{{$radicado->a_ciudad_regreso}}</td>
                     <td>{{$radicado->valor_estimado_regreso}}</td>
                     
                     <td>{{$radicado->requiere_hotel}}</td>
                     <td>{{$radicado->fecha_llegada_hotel}}</td>
                     <td>{{$radicado->fecha_salida_hotel}}</td>
                     <td>{{$radicado->	valor_total_viajes}}</td>
                    </tr>
                </tbody>
            @endforeach
          @endif 
        </table>
     </div>

   
  <script src="/js/jquery.js"></script>
  <script src="/tablefilter/tablefilter.js"></script>
  <script src="/js/filterRegional.js"></script> 
  
  <!-- Llamar a los complementos javascript-->

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
	fileName: "LISTADO REGISTRO EVENTO REGION CALI",    //Nombre del archivo 
});

</script>
  
   

@endsection
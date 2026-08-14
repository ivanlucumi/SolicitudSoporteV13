
@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Revisados Servisoft')
@section('cabecera', 'Expedientes Novedad Protocolo Dos.')



@section('content') 
<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">
<style>
table{
    table-layout: fixed;
    width: 250px;
}

th, td {
    border: 1px solid blue;
    width: 100px;
    word-wrap: break-word;
}

    th, td {
    border: 1px solid blue;
    
    word-wrap: break-word;
}
table td:nth-child(2) {
  width: 40px;
}
table td:nth-child(3) {
  width: 80px;
}
table td:nth-child(4) {
  width: 80px;
}
table td:nth-child(5) {
  width: 80px;
}
table td:nth-child(6) {
  width: 80px;
}
table td:nth-child(7) {
  width: 80px;
}
</style>

<P><strong><h2><center>PROCESOS POR REVISAR PROTOCOLO 2</center></h2></strong> </P><hr>
<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-2">
            SIN REGISTRO:<h1 style="color:red"> {{$SinR}}</h1>
        </div>
        <div class="col-xs-12 col-sm-2">
            CON OBSERVACIONES <h1 style="color:red">  {{$observa}}</h1>
        </div>
        <div class="col-xs-12 col-sm-2">
            PARA UN TOTAL DE <h1 style="color:red">  {{$cantidad}}</h1>
        </div>
        <div class="col-xs-12 col-sm-2">
           SIN NOVEDADES<h1 style="color:red">  {{$Corregido}}</h1>
        </div>
        <div class="col-xs-12 col-sm-4">
           TOTAL REVISADOS PERSONA APOYO<h1 style="color:red">  {{$TotalRevisadosPDos}}</h1>
        </div>
        
        
    </div>
    
</div>

<hr>
  <div class="col-xs-12 col-md-12  form-group table-responsive">
      <table  id="table9" class="table table-bordered table-striped">
        <thead class="shadow" style="background-color: #004182; color: #fff;">
		    <tr>
		        <td>RADICADO</td>
		        <td>DESPACHO</td>
				<td style="width:10px;">OBSERVACIONES MERCURIO</td>
				<td style="width:10px;">OBSERVACIONES BESTDOC</td>
				<td>FECHA REVISION</td>
		    </tr>
	    </thead>
	    
		    @foreach($digitalizado as $digit)
		    
			<tbody data-id="{!!$digit->id!!}" class="buscar">
			   @if($digit->correcion == null)
				<tr class="table-light" >
					<td >{{$digit->radicacion}}</td>									
					<td >{{$digit->despacho}}</td>	
					<td style="width:10px;">Observaciones Generales: {{$digit->observaciones_generales_m}} <br> Carpetas Mercurio: {{$digit->carpeta_protocolodos_m}} <br> multimedia: {{$digit->observaciones_archivos_multimedia_m}} <br> archivos: {{$digit->observaciones_archivos_m}} </td>
					<td style="width:10px;">Observaciones Generales: {{$digit->observaciones_generales_b}} <br> Caprtetas BestDoc: {{$digit->carpeta_protocolodos_b}} <br> multimedia: {{$digit->observaciones_archivos_multimedia_b}}<br> archivos: {{$digit->observaciones_archivos_b}}</td>
					<td>{{ $digit->fecha_revision }}</td> 
				</tr>
			  @endif
			</tbody>
			@endforeach
	</table>
	
</div>



<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script> 
<script src="/js/Filter8Pdos.js"></script>



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
	fileName: "Reporte Novedades Digitalizacion",    //Nombre del archivo 
});

</script>

@endsection


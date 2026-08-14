
<!DOCTYPE html>
<html lang="es">
<head>
  <title>Consolidado de Personal Activo</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  
  <link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">

</head>
<body>


<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <a class="navbar-brand" href="#">Exportar datos</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
 
</nav>

<div class="container-fluid" style="margin-top:30px">
  <div class="row">
    <div class="col-sm-12">
     <center> <h3>REGISTRO DE TRANSFERENCIAS A BESTDOC</h3>
		<H4>Consulta por Mes</H4></center><br>
      <div class="table-responsive">
                            <table class="table table-striped table-bordered" >
							
							
                                <thead style="background-color: #9AD591; color: #fff;">
                                <tr class="table-primary">
                                    <th scope="col">#</th>
                    		        <th>RADICADO</th>
                    		        <th>DESPACHO</th>
                    		        <th>MUNICIPIO</th>
                    		        <th>ESPECIALIDAD</th>
                    		        <th>TRASLAD&Oacute;</th>
                    		        <th>FECHAS TRASLADO</th>
                    		    </tr>
                                </thead>
                                <tbody>
                                    @foreach($listado ?? '' as $key => $digit)
                            			<tbody data-id="{!!$digit->id!!}" class="buscar">
                            			   
                            				<tr class="table-light"  >
                            				    <th scope="row">{{ $key+1 }}</th>
                            					<th scope="row">{{$digit->radicacion}}</th>									
                            					<th scope="row">{{$digit->despacho}}</th>									
                            					<th scope="row">{{$digit->municipio}}</th>									
                            					<th scope="row">{{$digit->especialidad}}</th>
                                                <td>{{ $digit->reviso }}</td>
                                                <td>{{ $digit->fecha_traslado }}</td>
                            					
                            				</tr>
                            			</tbody>
                            			@endforeach
									
                                </table>
                        </div>
      
      <hr class="d-sm-none">
    </div>
    
  </div>
</div>


</body>
<!-- Llamar a los complementos javascript-->

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
	fileName: "Migracion a Bestdoc",    //Nombre del archivo 
});

</script>
</html>


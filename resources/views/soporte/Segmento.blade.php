@extends('layouts.soporte')
@if( auth()->user()->rol == 1)	
 @section('title', 'Segmento de Red')
@else
 @section('title', 'Segmento de Red')
@endif
<!--ponerle titulo a la paginga-->

@section('cabecera', 'SEGMENTOS DE RED ')

@section('content') 
<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">
    <div class="container-fluid">
        @if( auth()->user()->id ==1958) 
        <div class="row">
            <form action="{{ route('tecnico.soporte.segmento.ip.save') }}" method="POST">
    @csrf
			@if(!empty($Result_segmento))
             <input type="hidden" name="id" id="id" value="{{ $Result_segmento->id }}">
			@endif
             
            <select class="form-group select2 mr-sm-2 shadow  @error('seccional') is-invalid @enderror" aria-label="Search" name="seccional" id="seccional">
    <option value="">Seleccione Seccional</option>
    @foreach($seccional as $key => $value)
        <option value="{{ $key }}" @selected(old('seccional', $Result_segmento->seccional) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('seccional')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
            <select class="form-group select2 mr-sm-2 shadow  @error('municipio') is-invalid @enderror" aria-label="Search" name="municipio" id="municipio">
    <option value="">Seleccione Sede</option>
    @foreach($municipios as $key => $value)
        <option value="{{ $key }}" @selected(old('municipio', $Result_segmento->municipio) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('municipio')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror  
            <select class="form-group select2 mr-sm-2 shadow  @error('sede') is-invalid @enderror" aria-label="Search" name="sede" id="sede">
    <option value="">Seleccione Sede</option>
    @foreach($sedes as $key => $value)
        <option value="{{ $key }}" @selected(old('sede', $Result_segmento->sede) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('sede')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
             <input class="form-group @error('direccion') is-invalid @enderror" placeholder="Registrar Direccion" autocomplete="off" type="text" name="direccion" id="direccion" value="{{ old('direccion', $Result_segmento->direccion) }}">
@error('direccion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
             <input class="form-group @error('piso') is-invalid @enderror" placeholder="Registrar Piso" autocomplete="off" type="text" name="piso" id="piso" value="{{ old('piso', $Result_segmento->piso) }}">
@error('piso')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
             <input class="form-group @error('torre') is-invalid @enderror" placeholder="Registrar Torre" autocomplete="off" type="text" name="torre" id="torre" value="{{ old('torre', $Result_segmento->torre) }}">
@error('torre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
             <input class="form-group @error('vlan') is-invalid @enderror" placeholder="Registrar Vlan" autocomplete="off" type="text" name="vlan" id="vlan" value="{{ old('vlan', $Result_segmento->vlan) }}">
@error('vlan')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
             <input class="form-group @error('direccionamiento_red') is-invalid @enderror" placeholder="Registrar Direccionamiento" autocomplete="off" type="text" name="direccionamiento_red" id="direccionamiento_red" value="{{ old('direccionamiento_red', $Result_segmento->direccionamiento_red) }}">
@error('direccionamiento_red')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
             <input class="form-group @error('observaciones') is-invalid @enderror" placeholder="Observaciones" autocomplete="off" type="text" name="observaciones" id="observaciones" value="{{ old('observaciones', $Result_segmento->observaciones) }}">
@error('observaciones')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
          
          <button class="form-group btn btn-success my-2 my-sm-0 shadow" type="submit">Registrar</button>
      </form>
      </div>
     @endif
    </div>
    
 


           <div class="box-body">
           	<div class="row">
				 <div class="table-responsive">
					 <table id="table9" class="table table-bordered table-striped" >
                        <thead class="shadow" style="background-color: #004182; color: #fff;">
						  <tr>
						      <th>SECCIONAL</th>
						      <th>MUNICIPIO</th>
						  	  <th>SEDE</th>
						      <th>DIRECCION</th>
						      <th>PISO</th>
						      <th>TORRE</th>	
						      <th>VLAN</th>
						      <th>DIRECCIONAMIENTO</th>
						      <th>OBSERVACIONES</th>
						      @if( auth()->user()->id ==1958) 
						      <th>ACCIONES</th>
						      @endif
					      </tr>
						</thead>

						@if(!empty($segmentos))
						@foreach($segmentos as $listad)
							 <tbody data-id="{!!$listad->id!!}" class="buscar">
									 <tr class="table-light">
									     <th scope="row"> {{$listad->seccional}} </th>
									     <th scope="row"> {{$listad->municipio}} </th>
										 <th scope="row"> {{$listad->sede}} </th>
									     <th scope="row"> {{strtoupper($listad->direccion)}} </th>
									     <th scope="row"> {{strtoupper($listad->piso)}} </th>
									     <th scope="row"> {{strtoupper($listad->torre)}} </th>
									     <th scope="row"> {{strtoupper($listad->vlan)}} </th>
									     <th scope="row"> {{$listad->direccionamiento_red}} </th>
									     <th scope="row"> {{strtoupper($listad->observaciones)}} </th>
									     @if( auth()->user()->id ==1958) 
									      <th colspan=2 > 
									      <a href="{{ route('tecnico.soporte.segmento.ip.edit', $listad->id) }}" class="btn btn-primary btn-sm fa fa-pencil" title="Editar Segmento"></a>
									      <a id="eliminarRegistro" class="btn btn-danger bnt-xs fa fa-trash fa-xs eliminarRegistro"></a>
									      </th>
									      
									     @endif 
									 </tr>
								@endforeach	   	                
							 </tbody>
						@else
						<p>NO HAY SEGMENTO REGISTRADO</p>	 
						@endif
							            
				     </table>
				  </div>
				</div>
			 </div>
			 

 <form id="form-eliminar-Segmento" action="{{ route('tecnico.soporte.eliminar.segmento',':IP_ID') }}" method="POST">
    @csrf
    @method('DELETE')
 </form>

<!-- Select2 -->
<script src="/bower_components/select2/dist/js/select2.full.min.js"></script>
  


<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/Segmento.js"></script> 

<script>
 $(function () {            
        
                
                /* setting time */
                $("#timepicker").datetimepicker({
                    format : "HH:mm"
                });
                /* setting time */
                $("#timepicker2").datetimepicker({
                    format : "HH:mm"
                });
                
                 //Initialize Select2 Elements
                $('.select2').select2()
            
                //Initialize Select2 Elements
                $('.select2bs4').select2({
                  theme: 'bootstrap4'
                })
                
              
                
            }); 
            

   $(document).ready(function() {
    $.ajaxSetup({
            headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')}
        });
        
       //BORRRAR DATOS DE PDF
        $('.eliminarRegistro').click(function(e) {       
               e.preventDefault();
        
               var row = $(this).parents('tbody')
               
               //alert(row)
               var id = row.data('id');
               var form = $('#form-eliminar-Segmento');
               var url = form.attr('action').replace(':IP_ID', id);
               var data = form.serialize();
             
             //alert();
               row.fadeOut();
              $.post(url, data, function(result){
                  
                  $("#msj-eliminacion").html("<ul>" + result + "</ul>").fadeIn();
                
                
               });
        
             });
  });            

</script>

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
	fileName: "Inventario Digitalizacion",    //Nombre del archivo 
});

</script>
  
@endsection
@extends('layouts.soporte')
@if( auth()->user()->rol == 1)	
 @section('title', 'Listado de IPS admin')
@else
 @section('title', 'Listado de IP tecnico')
@endif
<!--ponerle titulo a la paginga-->

@section('cabecera', 'IP Usadas')

@section('content') 
<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">
    <div class="container-fluid">
        
         <div class="row">
         <form action="{{ route('tecnico.soporte.registro_ip.save') }}" method="POST">
    @csrf
         
         
            <select class="form-group select2 mr-sm-2 shadow  @error('municipio') is-invalid @enderror" aria-label="Search" name="municipio" id="municipio">
    <option value="">Seleccione Sede</option>
    @foreach($municipios as $key => $value)
        <option value="{{ $key }}" @selected(old('municipio') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('municipio')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror  
        
            
            <select class="form-group select2 mr-sm-2 shadow  @error('sede') is-invalid @enderror" aria-label="Search" name="sede" id="sede">
    <option value="">Seleccione Sede</option>
    @foreach($sedes as $key => $value)
        <option value="{{ $key }}" @selected(old('sede') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('sede')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror  
         
             <select class="form-group select2 " aria-label="Search" name="despacho" required>
                 <option value="">Seleccione Despacho</option>
                 <option  value="OTRO">OTRO</option>
                 @foreach($despachos as $despacho)
                  <option value="{{$despacho->nombreDespacho}}">{{$despacho->nombreDespacho}}</option>
                 @endforeach
            </select>
        
             <input class="form-group @error('oficina') is-invalid @enderror" placeholder="Registrar oficina" autocomplete="off" type="text" name="oficina" id="oficina" value="{{ old('oficina') }}">
@error('oficina')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
        
             <select class="form-group select2 mr-sm-2 shadow  @error('tipo_equipo') is-invalid @enderror" aria-label="Search" name="tipo_equipo" id="tipo_equipo">
    <option value="">Seleccione Tipo Equipo</option>
    @foreach($equipos as $key => $value)
        <option value="{{ $key }}" @selected(old('tipo_equipo') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('tipo_equipo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
         
              <input class="form-group @error('ip') is-invalid @enderror" placeholder="Registrar Ip Equipo " autocomplete="off" id="ip" type="text" name="ip" value="{{ old('ip') }}">
@error('ip')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
         
               <input class="form-group @error('nombre_equipo') is-invalid @enderror" placeholder="Registrar Nombre Equipo" autocomplete="off" type="text" name="nombre_equipo" id="nombre_equipo" value="{{ old('nombre_equipo') }}">
@error('nombre_equipo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            
        

         
          
          <button class="form-group btn btn-success my-2 my-sm-0 shadow" type="submit">Registrar</button>
      </form>
      </div>
    </div>
    <div class="row">
        <p><center> <h2> SELECCIONAR IP POR SEDES Y MUNICIPIOS</h2></center></p>
        <div class="col-xs-12 col-sm-6">
         <form action="{{ route('tecnico.soporte.listado') }}" method="POST">
    @csrf
         
            <select class="form-group select2 mr-sm-2 shadow  @error('municipio') is-invalid @enderror" aria-label="Search" name="municipio" id="municipio">
    <option value="">Seleccione Municipio</option>
    @foreach($municipios as $key => $value)
        <option value="{{ $key }}" @selected(old('municipio') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('municipio')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            <select class="form-group select2 mr-sm-2 shadow  @error('sede') is-invalid @enderror" aria-label="Search" name="sede" id="sede">
    <option value="">Seleccione Sede</option>
    @foreach($sedes as $key => $value)
        <option value="{{ $key }}" @selected(old('sede') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('sede')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
          <button class="form-group btn btn-success my-2 my-sm-0 shadow" type="submit">CONSULTAR</button>
          <input type="hidden" name="ip" id="ip" value="{{ '' }}">
          </form>
         </div>
         <div class="col-xs-12 col-sm-6">
              <form action="{{ route('tecnico.soporte.listado') }}" method="POST">
    @csrf
              
                 <label for="fecha">BUSCAR POR IP :</label>
            <input class="form-group @error('ip') is-invalid @enderror" placeholder="BUSCAR IP REGISTRADA" autocomplete="off" id="ip" type="text" name="ip" value="{{ old('ip') }}">
@error('ip')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
          <button class="form-group btn btn-warning my-2 my-sm-0 shadow" type="submit">CONSULTAR</button>
          
             </form>
        </div>
    </div>
 @php
    // Definir el array de IDs permitidos  1958=pablo
    $allowedIds = ['1952', '1958', '1971', '1972','1990','2023','141','1981'];

@endphp


           <div class="box-body">
           	<div class="row">
				 <div class="table-responsive">
					 <table id="table9" class="table table-bordered table-striped" >
                        <thead class="shadow" style="background-color: #004182; color: #fff;">
						  <tr>
						      <th>MUNICIPIO</th>
						      <th>SEDE</th>
						  	  <th>DESPACHO</th>
						      <th>OFICINA</th>
						      <th>TIPO EQUIPO</th>
						      <th>NOMBRE EQUIPO</th>	
						      <th>IP</th>
						      <th>REGISTRO</th>
						      @if( auth()->user()->tipo_rol =="COORDINADOR"|| in_array( auth()->user()->id, $allowedIds))
						       <th>ACCIONES</th>
						       @endif 
					      </tr>
						</thead>

						@if(!empty($listado))
						@foreach($listado as $listad)
							 <tbody data-id="{!!$listad->id!!}" class="buscar">
									 <tr class="table-light">
									     <th scope="row"> {{$listad->municipio}} </th>
									     <th scope="row"> {{$listad->sede}} </th>
										 <th scope="row"> {{$listad->despacho}} </th>
									     <th scope="row"> {{$listad->oficina}} </th>
									     <th scope="row"> {{$listad->tipo_equipo}} </th>
									     <th scope="row"> {{$listad->nombre_equipo}} </th>
									     <th scope="row"> {{$listad->ip}} </th>
									     <th scope="row"> {{$listad->usuario_creador}} </th>
									     @if( auth()->user()->tipo_rol =="COORDINADOR" || in_array( auth()->user()->id, $allowedIds) )
									     <th colspan=2 > 
									      <a href="{{ route('tecnico.soporte.editar.registro.ip', $listad->id) }}" class="btn btn-primary btn-sm fa fa-pencil" title="Editar Registro"></a>
									      <a id="eliminarRegistro" class="btn btn-danger bnt-xs fa fa-trash fa-xs eliminarRegistro"></a>
									      </th>
									     
									      
									      
									    @endif
									 </tr>
								@endforeach	   	                
							 </tbody>
						@else
						<p>NO HAY REGISTRO DE IP´s HASTA EL MOMENTO</p>	 
						@endif
							            
				     </table>
				  </div>
				</div>
			 </div>
			 

 <form id="form-eliminar-Ip" action="{{ route('tecnico.soporte.eliminar.ip',':IP_ID') }}" method="POST">
    @csrf
    @method('DELETE')
    </form>

<!-- Select2 -->
<script src="/bower_components/select2/dist/js/select2.full.min.js"></script>
  


<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/registroIp.js"></script> 

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
               var form = $('#form-eliminar-Ip');
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
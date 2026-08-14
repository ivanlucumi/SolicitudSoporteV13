@extends('layouts.admin')
@section('title', 'Solicitudes Despacho')
@section('cabecera', 'LISTADO SOLICITUDES DESPACHO')

@section('content')
<div class="container-fluid">
      <div class="row" style="border-style: ;">
        <div class="col-xs-12 col-sm-8" >
            <center>
                <h2>
                  <strong>{{strtoupper($despacho->nombreDespacho)}}</strong>  
                </h2>
            </center>
        </div>
        
        <div class="col-xs-12 col-sm-4" >
            <center>
                <h2>
                  <strong> {{strtoupper($despacho->ciudad->nombreCiudad)}}</strong>
                </h2>
            </center>
        </div>
        <!--div class="col-xs-12 col-sm-5" >
            <center>
                <h1>
                   {{$despacho->correoD}}  
                </h1>
            </center>
        </div-->
        
    </div>
    <div class="row">
        <p>
            <h4>
                <center>
                    <strong>
                        <font color="#C0392B"> 
                        Antes de realizar cualquier acción relacionada con el inventario, es importante que verifiques detenidamente las cantidades disponibles en tu inventario actual. Esto garantiza que no se superen los límites de los elementos activos y en uso. 
                        </font>
                    </strong>
                </center>
            </h4>
        </p>
        <p>
            <h4>
                <center>
                    <strong>
                        <font color="#C0392B"> 
                        Es relevante destacar que las cantidades registradas están sujetas a validación por parte del Grupo de Almacén e Inventarios de la Seccional.
                        </font>
                    </strong>
                </center>
            </h4>
        </p>
    </div>
     <hr >
     <hr >
     @if( auth()->user()->requerimiento=="REQUERIMIENTO") 
    <div class="row">
        <div class="col-xs-12 col-sm-2"></div>
                <div class="col-xs-12 col-sm-8">
                <form action="{{ route('requerimientodespachos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
                <input class="form-control " placeholder="Especifique detalladamente todas las novedades presentadas" autocomplete="off" type="hidden" name="despacho_id" id="despacho_id" value="{{ $despacho->codigoDespacho }}"> 
                
                <div class="col-xs-12 col-sm-12">
                        <label for="especialidad">TIPO SOLICITUD:</label>
        	        	<select class="form-control select 2   @error('tipo_solicitud') is-invalid @enderror" id="tipo_seleccionado" autocomplete="off" name="tipo_solicitud">
    <option value="">Seleccione Tipo Solicitud</option>
    @foreach($Solicitudes as $key => $value)
        <option value="{{ $key }}" @selected(old('tipo_solicitud') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('tipo_solicitud')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
                 </div>
                 <div class="col-xs-12 col-sm-12" id="tipos" style="display:none">
                        <label for="especialidad">ESCRIBA TIPO SOLICITUD:</label>
        	        	<input class="form-control  @error('tipo_otro') is-invalid @enderror" id="otros_tipos" placeholder="Tipo Solicitud" autocomplete="off" minlength="3" maxlength="20" type="text" name="tipo_otro" value="{{ old('tipo_otro') }}">
@error('tipo_otro')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
                 </div>
                 <div class="col-xs-12 col-sm-12">
                        <label for="especialidad">CANTIDAD:</label>
        	        	<input class="form-control  @error('cantidad_elementos') is-invalid @enderror" id="otros_tipos" placeholder="Especifique la Cantidad de Elementos" autocomplete="off" min="1" type="number" name="cantidad_elementos" value="{{ old('cantidad_elementos') }}">
@error('cantidad_elementos')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
                 </div>
                 
                 <div class="col-xs-12 col-sm-12">
                        <label for="especialidad">OBSERVACIONES:</label>
        	        	<textarea class="form-control  @error('observaciones') is-invalid @enderror" placeholder="Especifique detalladamente todas las novedades presentadas" autocomplete="off" name="observaciones" id="observaciones">{{ old('observaciones') }}</textarea>
@error('observaciones')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
                 </div>
                 
                 <div class="col-xs-12 col-sm-5">
                     <img id="uploadPreview1" width="180" height="130" src="/img/nodisponible.jpg" />
                 </div>
                 <div class="col-xs-12 col-sm-7">
                        <label for="especialidad">FOTOGRAFIA EVIDENCIA: (jpeg,png,jpg)</label>
					    <input id="uploadImage1" class="form-control @error('images') is-invalid @enderror" accept=".jpeg,.png,.jpg" placeholder="Fecha que estara pública informativa" onchange="previewImage(1);" type="file" name="images">
@error('images')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        
                 </div>
                 
                </div>
        <div class="col-xs-12 col-sm-2"></div>
        
    </div>
    
    <br>
    <div class="row" style="Background-color:">
         <div class="col-xs-12 col-sm-3"></div>
          <div class="col-xs-12 col-sm-6">
               <button class="btn btn-success btn-sm btn-block mt-3 mb-3 my-3" type="submit">REGISTRAR SOLICITUD</button>
        	   </form>
          </div>
           <div class="col-xs-12 col-sm-3"></div>
                     
                 </div>
    
</div>
@endif
<hr>

	
<div class="col-xs-12 col-md-12  form-group table-responsive">
	<table id="table9" class="table table-bordered table-striped">
		<thead class="shadow" style="background-color: #004182; color: #fff;">
			<tr>
				<th>DESPACHO</th>
				<th>EMAIL</th>
				<th>TIPO SOLICITUD</th>
				<th>CANTIDAD</th>
				<th>OBSERVACIONES</th>
				<th>FECHA REGISTRO</th>
				<th>FOTO</th>

				<th>EKIMINAR</th>
			</tr>
		</thead>
		<tbody>
			@foreach($requerimientodespachos as $requerimientodespacho)

				<tr>
					<td>{{ $requerimientodespacho->nombre_despacho }}</td>
					<td>{{ $requerimientodespacho->email_despacho }}</td>
					<td>{{ $requerimientodespacho->tipo_solicitud }}</td>
					<td>{{ $requerimientodespacho->cantidad_elementos }}</td>
					<td>{{ $requerimientodespacho->observaciones }}</td>
					<td>{{ $requerimientodespacho->fecha_solicitud }}</td>
					<td><img src="/Solicitudes/{{ $requerimientodespacho->despacho_id }}/{{ $requerimientodespacho->evidencia_fotografica }}" alt="{{ $requerimientodespacho->evidencia_fotografica }}" style="width:100px;heigth:auto" ></td>

					<td  scope="row" style="background-color: ;">
					    <div class="row">
					       <div class="col-xs-12">
                             <form action="{{ route('requerimientodespachos.destroy', $requerimientodespacho->id) }}" method="POST">
    @csrf
    @method('DELETE')
                                <button class="btn btn-danger btn-xs fa fa-close" style="display: inline-block;" type="submit">X</button>
                            </form>
                            </div> 
					    </div>
						
                        
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>
</div>

<script>

    
 document.getElementById('tipo_seleccionado').addEventListener('change', function() {
     
     document.getElementById("tipos").style.display = "none";
     var x = document.getElementById("tipos");
     
     
     console.log(this.value);
        
            if(this.value === 'OTRO' ) //si la opcion seleccionada es activoCREACION USUARIO DOMINIO
            {
                document.getElementById("tipos").style.display = "block";
                if (x.style.display === "none") {
                   x.style.display = "block";
                   $("#otros_tipos").attr("required", true);
                } else {
                    x.style.display = "block";
                   $("#otros_tipos").attr("required", true);
                }
            }else{
                x.style.display = "none";
                xx.style.display = "none";
                info.style.display = "none";
                document.getElementById("tipos").style.display = "none";
                $('#otros_tipos').removeAttr('required', false);
                $('#otros_tipos').removeAttr('required', false);
            }
            
            
            
            
        });

</script>

<script>
  function previewImage(nb) {        
    var reader = new FileReader();         
    reader.readAsDataURL(document.getElementById('uploadImage'+nb).files[0]);         
    reader.onload = function (e) {             
        document.getElementById('uploadPreview'+nb).src = e.target.result;         
    };     
}
</script>

@endsection
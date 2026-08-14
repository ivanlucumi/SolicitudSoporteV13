@extends('layouts.usuarios')
@section('title', 'Solicitudes Despacho')
@section('cabecera', 'LISTADO SOLICITUDES DESPACHO')

@section('content')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">

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
     
    <div class="row">
        <div class="col-xs-12 col-sm-2"></div>
                <div class="col-xs-12 col-sm-8">
                <form action="{{ route('requerimientodespachos.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
                <input class="form-control " placeholder="Especifique detalladamente todas las novedades presentadas" autocomplete="off" type="hidden" name="despacho_id" id="despacho_id" value="{{ $despacho->codigoDespacho }}"> 
                 <div class="col-xs-12 col-sm-12 form-group ">
                  <label for="nRadicacion">Identificaci&oacute;n:</label>    
                  <input id="identificacion" class="form-control @error('identificacion') is-invalid @enderror" min="1" placeholder="Ingrese número de cédula" autocomplete="off" type="number" name="identificacion" value="{{ old('identificacion') }}">
@error('identificacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                  </div>
                  <div class="col-xs-12 col-sm-12">
                  <label for="hora">Ingrese Nomgre(s) y apellido(s):</label><br>
                      <input id="nombre-funcionario" class="form-control @error('nombre_funcionario') is-invalid @enderror" placeholder="Nombre Completo" autocomplete="off" type="text" name="nombre_funcionario" value="{{ old('nombre_funcionario') }}">
@error('nombre_funcionario')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>	
                  </div>
                 <div class="col-xs-12 col-sm-12">
                 <label for="category">Categoría:</label>
                    <select id="category" class="form-control" name="tipo_solicitud">
                        <option value="">Seleccione una categoría</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xs-12 col-sm-12">
                    <label for="elements">Elementos:</label>
                    <select id="elements" class="form-control" name="elemento">
                        <option value="">Seleccione un elemento</option>
                    </select>
                </div>
                 <div class="col-xs-12 col-sm-12">
                        <label for="especialidad">No. Elementos:</label>
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

<hr>

	
<div class="col-xs-12 col-md-12  form-group table-responsive">
	<table id="table9" class="table table-bordered table-striped">
		<thead class="shadow" style="background-color: #004182; color: #fff;">
			<tr>
				<th>TIPO SOLICITUD</th>
				<th>ELEMENTO</th>
				<th>CANTIDAD</th>
				<th>OBSERVACIONES</th>
				<th>FECHA REGISTRO</th>
				<th>ESTADO</th>
				<th>FOTO</th>

				<th>ELIMINAR</th>
			</tr>
		</thead>
		<tbody>
			@foreach($requerimientodespachos as $requerimientodespacho)

				<tr style="@if($requerimientodespacho->estado == 'PENDIENTE') background:#faac9a; 
                    @elseif($requerimientodespacho->estado == 'ARREGLO PARCIAL') background:#fbde4c; 
                    @elseif($requerimientodespacho->estado == 'REALIZADO') background:#a8f6a7; 
                    @endif">
					<td>{{ $requerimientodespacho->categoria }}</td>
					<td>{{ $requerimientodespacho->tipo_solicitud }}</td>
					<td>{{ $requerimientodespacho->cantidad_elementos }}</td>
					<td>* {{ $requerimientodespacho->observaciones }}
					    <br>* {{ $requerimientodespacho->segunda_visita }}
					</td>
					<td>{{ $requerimientodespacho->fecha_solicitud }}</td>
					
					<td>{{ $requerimientodespacho->estado }}</td>
					<td><img src="/Solicitudes/{{ $requerimientodespacho->evidencia_fotografica }}" alt="{{ $requerimientodespacho->evidencia_fotografica }}" style="width:100px;heigth:auto" ></td>

					<td  scope="row" style="background-color: ;">
					    <div class="row">
					        @if($requerimientodespacho->estado == "PENDIENTE")
    					       <div class="col-xs-12">
                                 <form action="{{ route('requerimientodespachos.destroy', $requerimientodespacho->id) }}" method="POST">
    @csrf
    @method('DELETE')
                                    <button class="btn btn-danger btn-sm fa fa-close" style="display: inline-block;" type="submit">X</button>
                                </form>
                                </div> 
                            @else
                            <div class="col-xs-12">
                             <button class="btn btn-danger btn-sm fa fa-close " style="display: inline-block;" disabled></button>
                             </div> 
                            @endif
					    </div>
						
                        
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>
</div>

    

<script>
        $(document).ready(function() {
            // Incluir automáticamente el token CSRF en las solicitudes AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')  // Tomar el token CSRF de la metaetiqueta
                }
            });

            // Controlador del cambio de categoría
            $('#category').on('change', function() {
                var categoryId = $(this).val();
                if (categoryId) {
                    $.ajax({
                        url: '/usuarios/requerimiento/categories/elements',
                        type: 'POST',  // Cambiado a POST
                        data: {
                            category_id: categoryId  // Enviar el ID de la categoría como datos
                        },
                        success: function(data) {
                            $('#elements').empty();
                            $('#elements').append('<option value="">Seleccione un elemento</option>');
                            $.each(data, function(key, value) {
                                $('#elements').append('<option value="+ value.id +">'+ value.elemento +'</option>');
                            });
                        },
                        error: function(xhr) {
                            console.log(xhr.responseText);  // Mostrar el error en la consola para depuración
                        }
                    });
                } else {
                    $('#elements').empty();
                    $('#elements').append('<option value="">Seleccione un elemento</option>');
                }
            });
        });
    </script>


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
<script>
       //EMPLEADO
     
    var verifCedula = document.getElementById('identificacion');
    verifCedula.addEventListener('input', function() 
    {

        console.log(this.value.nombre);

        $.get("/tecnico/soporte/consulta/cedula/corte/" + this.value + "", function(response, juzgado) {

            console.log(response[0].nameE)
            if (Object.keys(response).length > 0) {
                document.getElementById('nombre-funcionario').value = response[0].nameE+" "+response[0].lastnameE;
               
                
            } else {
                document.getElementById('nombre-funcionari').value = "";
            }
            
            
        });
    });
</script>

@endsection
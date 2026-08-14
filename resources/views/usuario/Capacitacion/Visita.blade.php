@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Registro Jornada Visita a Despacho Siugj')
@section('cabecera', 'Registro Jornada Visita a Despacho Siugj')

@section('content') 
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">

  

	<div class="row justify-content-md-center">
	    
        <div class="row">
            
            <div class="col-xs-12 col-sm-8">
              <div class="card mb-3" >
                  <div class="row no-gutters">
                    <div class="col-md-12">
                     <center> <img src="/img/siugj2.jpeg" class="card-img" width="380em" height="160em"></center>
                    </div>
                    <div class="col-md-12">
                      <div class="card-body">
                         <p class="card-text"><h3><strong><center>FORMULARIO PARA REGISTRO DE VISITA DE LOS FUNCIONARIOS DEL SIUGJ <br>REGISTRO ESPECIALIDAD LABORAL CIUDAD DE CALI</center></strong></h3> </p>
                        <br>
                        
                       </div>
                    </div>
                  </div>
                </div>
            </div> 
            <div class="col-xs-12 col-sm-4">
                <div class="card-body">
                    <center><p>
                        <strong>REGISTRADOS</strong>
                    </p></center>
                        <div class="table-responsive">
                              <table  class="table table-hover table-condensed table-bordered ">
                                  <thead style="background-color: #AFAFAF; color: #fff;">
                                      <tr>
                                          <th>#</th>
                                          <th>Fecha</th>
                                          <th>Jornada</th>
                                          <th>Cantidad</th>				     				
                                      </tr>
                                  </thead>                  
                                      
                                      <tbody class="buscar">
                                          @foreach($TotalRegistro as $key => $Regsitros)
                                          
                                          <tr class="table-light">                                
                                            <th scope="row">{{ $key+1 }}</th>
                                              <th scope="row">{{ $Regsitros->fecha_visita }}</th>
                                              <th scope="row">{{ $Regsitros->jornada }}</th>
                                              <th scope="row">{{ $Regsitros->cantidad }}</th> 
                                          </tr>
                                          @endforeach	 
                                         
                                      </tbody>
                              </table>
                          </div>
                        
                       </div>
            </div>     
        </div>
      </div>
      <hr>
<hr>
<center>
    <h2>
        CUPO POR JORNADA DE VISITAS 3 DESPACHOS
    </h2>
</center>
    
  @if( auth()->user()->rol == 3)
  <form action="{{ route('usuario.store.visita.siugj') }}" method="POST">
    @csrf  
  <input class="form-control" type="hidden" name="codigo_despacho" id="codigo_despacho" value="{{  auth()->user()->cedula }}">
  <input class="form-control" type="hidden" name="despacho" id="despacho" value="{{  auth()->user()->name.' '.  auth()->user()->lastname }}">
  <div class="row ">
      <div class="col-xs-12 col-sm-4 form-group ">
      <label for="nRadicacion">Direccion:</label>    
      <input id="identificacion" class="form-control @error('direccion') is-invalid @enderror" min="1" placeholder="Direccion" autocomplete="off" type="text" name="direccion" value="{{ old('direccion') }}">
@error('direccion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
      </div>
      <div class="col-xs-12 col-sm-4">
      <label for="hora">Tel&eacute;fono:</label><br>
          <input id="nombre-funcionario" class="form-control @error('telefono') is-invalid @enderror" placeholder="Tel&eacute;fono" autocomplete="off" type="text" name="telefono" value="{{ old('telefono') }}">
@error('telefono')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>	
      </div>
      <div class="col-xs-12 col-sm-4">
          <label for="hora">N&uacute;mero Colaboradores:</label><br>
          <input class="form-control @error('numero_colaboradores') is-invalid @enderror" placeholder="N&uacute;mero Colaboradores" autocomplete="off" type="number" name="numero_colaboradores" id="numero_colaboradores" value="{{ old('numero_colaboradores') }}">
@error('numero_colaboradores')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>	
      </div>
  </div>
  
  <div class="col-xs-12 col-md-12 form-group ">
  
      <label for="empleado">FECHA VISITA:</label>
  
      <div class="row">
          
             
              @for($i=0;$i<count($fecha);$i++)
                    @if($fecha[$i] >  \Carbon\Carbon::now()->toDateString())
                      <div class="col-xs-6 col-sm-2 mb-3 mt-3">
      
                          <label><input type="radio" required id="cbox3" value="{{ $fecha[$i] }}" name="fecha_visita"  > <font size=3 > {{ $fecha[$i] }}</font></label>
              
                          </div> 
                  @else
                  
                  @endif
              
              @endfor
  
      </div>
  
  </div>
  <hr>
  <div class="col-xs-12 col-md-6 form-group">
    <label for="empleado">JORNADA:</label>

    <div class="row">
        @for($i = 0; $i < count($jornada); $i++)
            <div class="col-xs-6 col-sm-6">
                
                    <label>
                        <input type="radio" required id="cbox3" value="{{ $jornada[$i] }}" name="jornada">
                        <font size=3>{{ $jornada[$i] }}</font>
                    </label>
            </div>
        @endfor
    </div>

    <!-- Span para mostrar el mensaje si no hay jornada disponible -->
    <span id="no-jornada-msg" style="display: none; color: red;">No hay jornada disponible para esta fecha.</span>
</div>


  </div>
  
   
  
   <br> 
   </div>
 
  
  
  <div class="row">
      <div class="col-xs-12 col-sm-4"></div>
      
      <div class="col-xs-12 col-sm-4" style="display:block" id="sinDetenido">
          <button class="btn btn-success btn-block" style="background-color: #004182; color: #fff;" type="submit">REGISTRAR</button>
          
      </div>
      
      <div class="col-xs-12 col-sm-4"></div>                
  </div>   
  </form> 
  
      <br>
      <hr>
  @else
        <div class="row">
            <div class="col-xs-12 col-sm-3">
                <br>
                <form action="{{ route('administrador.descarga.programacion.capacitacion') }}" method="POST">
    @csrf
                
                <div class="row">
                    <div class="col-xs-12 col-sm-12">
                        <label for="Descarga">Descarga</label>
                    </div>
                    <div class="col-xs-12 col-sm-12">
                        <button class="btn btn-warning btn-md" type="submit">Descargar Excel </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>     
  @endif   
  <hr>
  
  <div class="table-responsive">
      <table id="example" class="table  table-hover table-condensed table-bordered ">
          <thead style="background-color: #AFAFAF; color: #fff;">
              <tr>
                  <th>#</th>
                  <th>DESPACHO</th>
                  <th>FECHA</th>
                  <th>JORNADA</th>					     				
              </tr>
          </thead>
          @if($users != null)
              @foreach($users as $key => $user)
              <tbody class="buscar">
                  <tr class="table-light">
                      <th scope="row">{{$key+1}}</th>
                      <th scope="row">{{$user->despacho}}</th>
                      <th scope="row">{{$user->fecha_visita}}</th>
                      <th scope="row">{{$user->jornada}} </th>					     
                  </tr>	                
              </tbody>
              @endforeach
          @endif
      </table>
  </div>   
 <script>
    document.addEventListener('DOMContentLoaded', function() {
        const fechaRadios = document.querySelectorAll('input[name="fecha_visita"]');
        const jornadaRadios = document.querySelectorAll('input[name="jornada"]');
        const noJornadaMsg = document.getElementById('no-jornada-msg'); // El span del mensaje

        // Escuchar cambios en la selección de la fecha
        fechaRadios.forEach(radio => {
            radio.addEventListener('click', function() {
                const selectedFecha = this.value;

                // Limpiar selección de jornadas cuando se cambia de fecha
                jornadaRadios.forEach(jornadaRadio => {
                    jornadaRadio.checked = false; // Desmarcar cualquier jornada seleccionada
                    const jornadaLabel = jornadaRadio.closest('label'); // Encontrar el label correspondiente

                    jornadaRadio.disabled = false; // Activar las jornadas
                    jornadaLabel.style.display = 'block'; // Asegurarse de que el label esté visible
                    noJornadaMsg.style.display = 'none'; // Ocultar el mensaje al cambiar de fecha
                    
                    jornadaRadio.addEventListener('click', function() {
                        const selectedJornada = this.value;

                        // Enviar la petición AJAX a Laravel para validar cupo
                        fetch('/usuarios/verificar-cupo-visita-siugj', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify({
                                fecha: selectedFecha,
                                jornada: selectedJornada
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.disponible) {
                                jornadaRadio.disabled = false; // Jornada disponible
                                jornadaLabel.style.display = 'block'; // Mostrar el label y el radio si está oculto
                                noJornadaMsg.style.display = 'none'; // Ocultar el mensaje si hay cupo
                            } else {
                                // Ocultar el radio button y el label si no hay cupo
                                jornadaRadio.disabled = true;
                                jornadaLabel.style.display = 'none';
                                jornadaRadio.checked = false; // Limpiar la selección si no hay cupo
                                noJornadaMsg.style.display = 'block';
                                // Mostrar el mensaje si el cupo es igual a 30
                                if (data.cupo === 2) {
                                    noJornadaMsg.style.display = 'block';
                                }
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                    });
                });
            });
        });
    });
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
  





   
  
  
  
  
  @push('scripts')

    
 <!-- Llamar a los complementos javascript>

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
   fileName: "Solicitud De capacitacion",    //Nombre del archivo 
});

</script-->
  
 
  @endpush


@endsection
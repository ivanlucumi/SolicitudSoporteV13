@extends('layouts.tanqueo')
<!--ponerle titulo a la paginga-->
@section('title', 'Registro Tanqueos')
@section('cabecera', 'HISTORIAL VEHICULOS')
@section('content') 
<script>
 window.onload = function() {
     var campoArchivo = document.getElementById('archivoInput');
     campoArchivo.value = '';
        // Detectar si la página se está cargando en un dispositivo móvil
        var esDispositivoMovil = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

        // Mostrar u ocultar elementos según el tipo de dispositivo
        if (esDispositivoMovil) {
            document.getElementById('opcionesMovil').style.display = 'block';
            
        }else{
            document.getElementById('opcionesComputadora').style.display = 'block';
            document.getElementById('opcionesComputadora2').style.display = 'block';
            document.getElementById("placa_soporte").setAttribute("required",'True');
            document.getElementById("placa_soporte").removeAttribute("required");
        }
        if(esDispositivoMovil=== false){
            
            document.getElementById('opcionesComputadora').style.display = 'block';
            document.getElementById('opcionesComputadora2').style.display = 'block';
            document.getElementById("placa_soporte").setAttribute("required",'True');
            document.getElementById("placa_soporte").removeAttribute("required");
        }
 };
    </script>
<style>
		@media only screen and (max-width: 700px) {
			video {
				max-width: 100%;
			}
		}
</style>

    <div class="container-fluid">
        <div class="row ">
            <div class="col-xs-12 col-sm-3"></div>
            <div class="col-xs-12 col-sm-6" id="info-vehiculo" style="display: none;">
               <div class="col-xs-12 col-sm-3 form-group ">
                <label for="semana_regsitro">PLACA:</label>
                 <input id="PLACA" class="form-control @error('PLACA') is-invalid @enderror" type="text" name="PLACA" value="{{ old('PLACA') }}">
@error('PLACA')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div> 
                <div class="col-xs-12 col-sm-3 form-group ">
                <label for="semana_regsitro">VEHICULO:</label>
                 <input id="VEHICULO" class="form-control @error('VEHICULO') is-invalid @enderror" type="text" name="VEHICULO" value="{{ old('VEHICULO') }}">
@error('VEHICULO')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div> 
                <div class="col-xs-12 col-sm-3 form-group ">
                <label for="semana_regsitro">SOAT:</label>
                 <input id="SOAT" class="form-control @error('SOAT') is-invalid @enderror" type="text" name="SOAT" value="{{ old('SOAT') }}">
@error('SOAT')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div> 
                <div class="col-xs-12 col-sm-3 form-group ">
                <label for="TECNO">TECNOMECANICA:</label>
                 <input id="TECNO" class="form-control @error('TECNO') is-invalid @enderror" type="text" name="TECNO" value="{{ old('TECNO') }}">
@error('TECNO')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div> 
            </div>
            <div class="col-xs-12 col-sm-3"></div>
        </div>
         <div class="row ">
             <div class="col-xs-12 col-sm-3"></div>
             <div class="col-xs-12 col-sm-6">
            <form enctype="multipart/form-data" id="save.registro.tanqueo" action="{{ route('save.registro.tanqueo') }}" method="POST">
    @csrf
			<div class="col-xs-12 col-sm-4 form-group ">
            <label for="semana_regsitro">VEHICULO:</label>
             <select id="id_vehiculo" class="form-control @error('id_vehiculo') is-invalid @enderror" autocomplete="off" name="id_vehiculo">
    <option value="">Seleccione Veh&iacute;culo</option>
    @foreach($vehiculos as $key => $value)
        <option value="{{ $key }}" @selected(old('id_vehiculo') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('id_vehiculo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
            <!--div class="col-xs-12 col-sm-4 form-group ">
            <label for="semana_regsitro">SEMANA REGITSRO:</label>
            <input class="form-control  @error('semana_regsitro') is-invalid @enderror" autocomplete="off" type="week" name="semana_regsitro" id="semana_regsitro" value="{{ old('semana_regsitro') }}">
@error('semana_regsitro')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
            <div class="col-xs-12 col-sm-2 form-group ">
                <label for="semana_regsitro">DEL:</label>
            <input class="form-control  @error('semana_dia_i') is-invalid @enderror" autocomplete="off" type="number" name="semana_dia_i" id="semana_dia_i" value="{{ old('semana_dia_i') }}">
@error('semana_dia_i')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div><div class="col-xs-12 col-sm-2 form-group ">
                <label for="semana_regsitro">HASTA:</label>
            <input class="form-control  @error('semana_dia_fin') is-invalid @enderror" autocomplete="off" type="number" name="semana_dia_fin" id="semana_dia_fin" value="{{ old('semana_dia_fin') }}">
@error('semana_dia_fin')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div-->
            <div class="col-xs-12 col-sm-4 form-group ">
                <label for="kilometraje">KILOMETRAJE:</label>
                <input class="form-control  @error('kilometraje') is-invalid @enderror" autocomplete="off" placeholder="Ingrese Kilometraje" type="number" name="kilometraje" id="kilometraje" value="{{ old('kilometraje') }}">
@error('kilometraje')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                
            </div>
            <div class="col-xs-12 col-sm-4 form-group ">
                <label for="nivel_tanque">NIVEL TANQUE:</label>
                <select class="form-control  @error('nivel_tanque') is-invalid @enderror" autocomplete="off" name="nivel_tanque" id="nivel_tanque">
    <option value="">Seleccione Nivel Tanque</option>
    @foreach($niveles as $key => $value)
        <option value="{{ $key }}" @selected(old('nivel_tanque') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('nivel_tanque')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                
            </div>
            <div class="col-xs-12 col-sm-5 form-group ">
                <label for="conductor">CONDUCTOR:</label>
                <input id="conductor" class="form-control  @error('conductor') is-invalid @enderror" autocomplete="off" placeholder="Ingrese Cedula Conductor" type="number" name="conductor" value="{{ old('conductor') }}">
@error('conductor')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                
            </div>
            <div class="col-xs-12 col-sm-7 form-group ">
                <label for="nombre_conductor">NOMBRE CONDUCTOR:</label>
                <input id="nombre_conductor" class="form-control  @error('nombre_conductor') is-invalid @enderror" autocomplete="off" placeholder="Nombre Conductor" type="text" name="nombre_conductor" value="{{ old('nombre_conductor') }}">
@error('nombre_conductor')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                
            </div>
            <div class="col-xs-12 col-sm-12 form-group ">
                <label for="observaciones">OBSERVACIONES:</label>
                <input class="form-control  @error('observaciones') is-invalid @enderror" autocomplete="off" placeholder="Observaciones" type="text" name="observaciones" id="observaciones" value="{{ old('observaciones') }}">
@error('observaciones')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
            <div class="col-xs-12 col-sm-12" id="opcionesComputadora2" style="display:none;">
                   <img id="capturedImage" style="display: none;" alt="Captured Image" name="foto" width="100%" height="100%" value="">
                   <!-- Campo oculto para la imagen Base64 -->
                    <input type="hidden" id="imageInput" name="imagen_base64" value="">
               </div>
                <div class="col-xs-12 col-sm-12" id="opcionesMovil" style="display:none;" >
                 <input type="file" accept="image/*" capture="camera" name="imagen_base64">
                 
                 </div> 
             </div>
             <div class="col-xs-12 col-sm-3"></div>
            
            
        </div> 
        <hr>
        <div class="row" id="opcionesComputadora" style="display:none;">
            <div class="col-xs-12 col-sm-4"></div>
               <div class="col-xs-12 col-sm-4">
                  <video muted="muted" id="video" width="100%" height="100%"></video>
        	      <canvas id="canvas" style="display: none;" width="100%" height="100%"></canvas> 
        	      <hr>
        	      <select class='form-control' name="listaDeDispositivos" id="listaDeDispositivos"></select>
        	      <br>
            		<button class="btn btn-danger btn-block shadow" id="boton">Tomar foto</button>
            		<p id="estado"></p>
               </div> 
              <div class="col-xs-12 col-sm-4"></div>
               
            </div>
           
            
         
        
        <div class="row ">
            <div class="col-xs-12 col-sm-3 form-group ">
            </div>
            <div class="col-xs-12 col-sm-3  form-group ">
                <button class="btn btn-primary btn-block" type="submit">Guardar</button>
                
                </form>
            </div>
            <div class="col-xs-12 col-sm-3 form-group ">
                 <a href="{!! url('/usuarios')!!}" class="btn btn-warning btn-block shadow">Cancelar</a>
            </div>
            <div class="col-xs-12 col-sm-3  form-group ">
            </div>
        </div>
       
    </div>
    
    <hr>
    @if($registros != null)
    

    <div class="col-xs-12 col-md-12  form-group table-responsive">
      <table  id="table9" class="table table-bordered table-striped">
        <thead class="shadow" style="background-color: #004182; color: #fff;">
        	<tr>    
                <td>FECHA REGISTRO</td>
                <td>VEH&Iacute;CULO</td>
                <td>CONDUCTOR</td>
                <td>KILOMETRAJE</td>
                <td>NIVEL TANQUE</td>
                <td>FOTO</td>
                <td>OBSERVACIONES</td>
                <td>ACCI&Oacute;N</td>
                </tr>
            </thead>  
             @foreach($registros as $registro)
                <tbody data-id="{!!$registro->id!!}">
                <tr >
                 <td>{{$registro->fecha_registro}}</td>
                 <td>{{$registro->vehiculo->marca}}-{{$registro->vehiculo->placa}}</td>
                 <td>{{$registro->nombre_conductor}}</td>
                 <td>{{$registro->kilometraje}}</td>
                 <td>{{$registro->nivel_tanque}}</td>
                 <td>
                     <img src="/Tanqueo/{{$registro->foto}}" alt="" width="100%" height="130" >
                 </td>
                 <td>{{$registro->observaciones}}</td>
                 <td>
                    <a id="eliminarRegistro" class="btn btn-danger bnt-xs fa fa-trash fa-lg eliminarRegistro" disabled></a>
                 </td>
                </tr>
                </tbody>
            @endforeach
             
           
        </table>
     </div>
     @endif
     
  </div>   
 <form id="form-registro-vehiculo" action="{{ route('regsitro.vehiculo.show',':VEHICULO_ID') }}" method="POST">
    @csrf
</form>

  @push('scripts')
  <script src="/js/jquery.js"></script>
  <script src="/tablefilter/tablefilter.js"></script> 
 
  
<script>
    /*
    Tomar una fotografía y guardarla en un archivo v3
    @date 2018-10-22
    @author parzibyte
    @web parzibyte.me/blog
*/
const tieneSoporteUserMedia = () =>
    !!(navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia)
const _getUserMedia = (...arguments) =>
    (navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia).apply(navigator, arguments);

// Declaramos elementos del DOM
const $video = document.querySelector("#video"),
    $canvas = document.querySelector("#canvas"),
    $estado = document.querySelector("#estado"),
    $boton = document.querySelector("#boton"),
    $listaDeDispositivos = document.querySelector("#listaDeDispositivos");
let capturedImage = document.getElementById('capturedImage');

const limpiarSelect = () => {
    for (let x = $listaDeDispositivos.options.length - 1; x >= 0; x--)
        $listaDeDispositivos.remove(x);
};
const obtenerDispositivos = () => navigator
    .mediaDevices
    .enumerateDevices();

// La función que es llamada después de que ya se dieron los permisos
// Lo que hace es llenar el select con los dispositivos obtenidos
const llenarSelectConDispositivosDisponibles = () => {

    limpiarSelect();
    obtenerDispositivos()
        .then(dispositivos => {
            const dispositivosDeVideo = [];
            dispositivos.forEach(dispositivo => {
                const tipo = dispositivo.kind;
                if (tipo === "videoinput") {
                    dispositivosDeVideo.push(dispositivo);
                }
            });

            // Vemos si encontramos algún dispositivo, y en caso de que si, entonces llamamos a la función
            if (dispositivosDeVideo.length > 0) {
                // Llenar el select
                dispositivosDeVideo.forEach(dispositivo => {
                    const option = document.createElement('option');
                    option.value = dispositivo.deviceId;
                    option.text = dispositivo.label;
                    $listaDeDispositivos.appendChild(option);
                });
            }
        });
}

(function() {
    // Comenzamos viendo si tiene soporte, si no, nos detenemos
    if (!tieneSoporteUserMedia()) {
        alert("Lo siento. Tu navegador no soporta esta característica");
        $estado.innerHTML = "Parece que tu navegador no soporta esta característica. Intenta actualizarlo.";
        return;
    }
    //Aquí guardaremos el stream globalmente
    let stream;


    // Comenzamos pidiendo los dispositivos
    obtenerDispositivos()
        .then(dispositivos => {
            // Vamos a filtrarlos y guardar aquí los de vídeo
            const dispositivosDeVideo = [];

            // Recorrer y filtrar
            dispositivos.forEach(function(dispositivo) {
                const tipo = dispositivo.kind;
                if (tipo === "videoinput") {
                    dispositivosDeVideo.push(dispositivo);
                }
            });

            // Vemos si encontramos algún dispositivo, y en caso de que si, entonces llamamos a la función
            // y le pasamos el id de dispositivo
            if (dispositivosDeVideo.length > 0) {
                // Mostrar stream con el ID del primer dispositivo, luego el usuario puede cambiar
                mostrarStream(dispositivosDeVideo[0].deviceId);
            }
        });



    const mostrarStream = idDeDispositivo => {
        _getUserMedia({
                video: {
                    // Justo aquí indicamos cuál dispositivo usar
                    deviceId: idDeDispositivo,
                }
            },
            (streamObtenido) => {
                // Aquí ya tenemos permisos, ahora sí llenamos el select,
                // pues si no, no nos daría el nombre de los dispositivos
                llenarSelectConDispositivosDisponibles();

                // Escuchar cuando seleccionen otra opción y entonces llamar a esta función
                $listaDeDispositivos.onchange = () => {
                    // Detener el stream
                    if (stream) {
                        stream.getTracks().forEach(function(track) {
                            track.stop();
                        });
                    }
                    // Mostrar el nuevo stream con el dispositivo seleccionado
                    mostrarStream($listaDeDispositivos.value);
                }

                // Simple asignación
                stream = streamObtenido;

                // Mandamos el stream de la cámara al elemento de vídeo
                $video.srcObject = stream;
                $video.play();

                //Escuchar el click del botón para tomar la foto
                //Escuchar el click del botón para tomar la foto
                $boton.addEventListener("click", function() {
                    event.preventDefault();
                    //Pausar reproducción
                    $video.pause();

                    //Obtener contexto del canvas y dibujar sobre él
                    let contexto = $canvas.getContext("2d");
                    $canvas.width = $video.videoWidth;
                    $canvas.height = $video.videoHeight;
                    contexto.drawImage($video, 0, 0, $canvas.width, $canvas.height);

                    let foto = $canvas.toDataURL(); //Esta es la foto, en base 64
                    $estado.innerHTML = "Enviando foto. Por favor, espera...";
                    var dataUrl = canvas.toDataURL();
                    console.log(dataUrl);
                    //alert(dataUrl);
                    // Mostrar la imagen capturada en la etiqueta <img>
                    capturedImage.src = canvas.toDataURL('image/png');
                    capturedImage.style.display = 'block';
                    // Establecer el valor Base64 en el campo oculto
                    imageInput.value = capturedImage.src;
                    //Reanudar reproducción
                    $video.play();
                });
            }, (error) => {
                console.log("Permiso denegado o error: ", error);
                $estado.innerHTML = "No se puede acceder a la cámara, o no diste permiso.";
            });
    }
})();
</script> 
  <script>
    // Obtener el elemento select
    var selectElement = document.getElementById("id_vehiculo");
    var resultadoDiv = document.getElementById("info-vehiculo");

    // Agregar un evento change al select
    selectElement.addEventListener("change", function() {
      // Obtener el valor seleccionado
      var valorSeleccionado = selectElement.value;
    //alert(valorSeleccionado)
     var form = $('#form-registro-vehiculo');
          
          var url = form.attr('action').replace(':VEHICULO_ID', valorSeleccionado);
          var data = form.serialize();
          //alert(url)
          $.get(url, data, function(result) {
            console.log(result);
                
            
                var PLACA = document.getElementById("PLACA").value = result.placa;
                var VEHICULO   = document.getElementById("VEHICULO").value = result.marca;
                var SOAT = document.getElementById("SOAT").value = result.fecha_soat;
                var TECNO = document.getElementById("TECNO").value = result.fecha_tecnomecanica;
                resultadoDiv.style.display = "block";
                
                var soat = result.fecha_soat;
                var tecno = result.fecha_tecnomecanica;
                Hoy = new Date();//Fecha actual del sistema
                F_hoy =Hoy.toISOString().substring(0, 10)
                //alert(Hoy.toISOString().substring(0, 10))
                console.log(F_hoy)
                console.log(soat)
                console.log(tecno)
                
                if (soat < F_hoy){
                    alert ("SOAT VENCIDO");
                    document.getElementById("SOAT").style.backgroundColor = "red";
                }
                 if (tecno < F_hoy){
                    alert ("TECNOMECANICA VENCIDA");
                    document.getElementById("TECNO").style.backgroundColor = "red";
                }
                
                if (soat === F_hoy){
                    alert ("SOAT CON VIGENCIA HASTA HOY");
                    document.getElementById("SOAT").style.backgroundColor = "orange";
                }
                 if (tecno === F_hoy){
                    alert ("TECNOMECANICA CON VIGENCIA HASTA HOY");
                    document.getElementById("TECNO").style.backgroundColor = "orange";
                }
                
             // resultadoDiv.innerHTML = "PLACA:" + result.placa+"<br> VEHICULO"+result.marca+"<br> SOAT: "+result.fecha_soat+"<br> TECNOMECANICA"+result.fecha_tecnomecanica;
                   
                    });
    });
  </script>
<script>
       //EMPLEADO
     
    var verifCedula = document.getElementById('conductor');
    verifCedula.addEventListener('input', function() 
    {

        console.log(this.value.nombre);

        $.get("parqueadero/consulta/conductor/" + this.value + "", function(response, juzgado) {

            console.log(response[0].nameE)
            if (Object.keys(response).length > 0) {
                document.getElementById('nombre_conductor').value = response[0].nameE + response[0].lastnameE;
                
                
            } else {
                document.getElementById('nombre_conductor').value = "";
            }
            
            
            
        });
    });
    </script>

  
   @endpush
   

@endsection
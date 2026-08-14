@extends('layouts.monitoreo.parqueadero')
<!--ponerle titulo a la paginga-->
@section('title', 'Registro Ingreso')
@section('cabecera')
   REGISTRO {{ auth()->user()->name}} {{ auth()->user()->lastname}}
@endsection
@section('content') 

<script>
 window.onload = function() {
     //var campoArchivo = document.getElementById('archivoInput');
     //campoArchivo.value = '';
        // Detectar si la página se está cargando en un dispositivo móvil
        var esDispositivoMovil = /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

        // Mostrar u ocultar elementos según el tipo de dispositivo
        if (esDispositivoMovil) {
            document.getElementById('opcionesMovil').style.display = 'block';
            
        }else{
            document.getElementById('opcionesComputadora').style.display = 'block';
            document.getElementById('opcionesComputadora2').style.display = 'block';
            
        }
        if(esDispositivoMovil=== false){
            
            document.getElementById('opcionesComputadora').style.display = 'block';
            document.getElementById('opcionesComputadora2').style.display = 'block';
            
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

<style>
        #loadingMessage {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 15px;
            border-radius: 5px;
            font-size: 18px;
            z-index: 1000;
        }
        .sending {
            background-color: #f39c12; /* Cambia el color del botón a un naranja */
            color: white;
        }
        
    </style>

    <div class="container-fluid">
        
        <div class="row">
            <div class="col-xs-12 col-lg-6">
                
             <div class="col-xs-12 col-lg-12" style="background-color:">
                    <form enctype="multipart/form-data" id="biometria.registro.save" action="{{ route('biometria.parqueadero.registro.cargar.foto') }}" method="POST">
    @csrf
        			<div class="col-xs-12 col-lg-6 form-group ">
                    <label for="semana_regsitro">IDENTIFICACION:</label>
                    <input id="conductor" class="form-control  @error('identificacion') is-invalid @enderror" autocomplete="off" placeholder="Ingrese Cedula Del Visitante" type="number" name="identificacion" value="{{ old('identificacion', $verificacion->identificacion) }}">
@error('identificacion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                     </div>
                    <div class="col-xs-12 col-lg-6 form-group ">
                        <label for="p_apellido">PRIMER APELLIDO:</label>
                        <input class="form-control  @error('p_apellido') is-invalid @enderror" autocomplete="off" placeholder="Primer Apellido" type="text" name="p_apellido" id="p_apellido" value="{{ old('p_apellido', $verificacion->p_apellido) }}">
@error('p_apellido')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        
                    </div>
                    <div class="col-xs-12 col-lg-6 form-group ">
                        <label for="s_apellido">SEGUNDO APELLIDO:</label>
                        <input class="form-control  @error('s_apellido') is-invalid @enderror" autocomplete="off" placeholder="Segundo Apellido" type="text" name="s_apellido" id="s_apellido" value="{{ old('s_apellido', $verificacion->s_apellido) }}">
@error('s_apellido')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        
                    </div>
                    <div class="col-xs-12 col-lg-6 form-group ">
                        <label for="p_nombre">PRIMER NOMBRE:</label>
                        <input id="p_nombre" class="form-control  @error('p_nombre') is-invalid @enderror" autocomplete="off" placeholder="Primer Nombre" type="text" name="p_nombre" value="{{ old('p_nombre', $verificacion->p_nombre) }}">
@error('p_nombre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        
                    </div>
                    <div class="col-xs-12 col-lg-6 form-group ">
                        <label for="s_nombre">SEGUNDO NOMBRE:</label>
                        <input id="s_nombre" class="form-control  @error('s_nombre') is-invalid @enderror" autocomplete="off" placeholder="Segundo Nombre" type="text" name="s_nombre" value="{{ old('s_nombre', $verificacion->s_nombre) }}">
@error('s_nombre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                        
                    </div>
                    <div class="col-xs-12 col-lg-6 form-group ">
                                <label for="tipo">TIPO INGRESO:</label>
                                <input id="s_nombre" class="form-control  @error('tipo') is-invalid @enderror" autocomplete="off" placeholder="Visitante o Funcionario" type="text" name="tipo" value="{{ old('tipo', $verificacion->tipo) }}">
@error('tipo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                                
                    </div>
                    <div class="col-xs-12 col-lg-12 form-group ">
                        <label for="observaciones">OBSERVACIONES:</label>
                        <input class="form-control  @error('observaciones') is-invalid @enderror" autocomplete="off" placeholder="Observaciones" style=" heigth : 150px" type="text" name="observaciones" id="observaciones" value="{{ old('observaciones') }}">
@error('observaciones')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                    </div>
                    <div class="col-xs-12 col-lg-12" id="opcionesComputadora2" style="display:;">
                           <img id="capturedImage" style="display: none;" alt="Captured Image" name="foto" width="100%" height="100%" value="" required>
                           <!-- Campo oculto para la imagen Base64 -->
                            <input type="hidden" id="imageInput" name="imagen_base64" value=""required>
                       </div>
                        <div class="col-xs-12 col-lg-12" id="opcionesMovil" style="display:none;" >
                         <input type="file" accept="image/*" capture="camera" name="camera_imagen_base64">1
                         
                         </div> 
             </div>

              
            </div>
            <div class="col-xs-12 col-lg-6 " style="background-color:">
             <div class="row" id="opcionesComputadora" style="display:none;">
               <div class="col-xs-12 col-lg-8">
                  <video muted="muted" id="video" width="100%" height="100%"></video>
        	      <canvas id="canvas" style="display: none;" width="100%" height="100%"></canvas> 
        	      <hr>
        	      <select class='form-control' name="listaDeDispositivos" id="listaDeDispositivos"></select>
        	      <br>
            		<button class="btn btn-danger btn-block shadow" id="boton">Tomar foto</button>
            		<p id="estado"></p>
               </div> 
               
            </div>  
            </div>
        </div>
       
            
        <hr>
        <br>
        
        <div class="row ">
            <div class="col-xs-12 col-sm-3 form-group ">
            </div>
            <div class="col-xs-12 col-sm-3  form-group ">
                <button class="btn btn-primary btn-block" type="submit">REGISTRAR INGRESO</button>
                
                </form>
            </div>
            <div class="col-xs-12 col-sm-3 form-group ">
                 <a href="{!! url('/usuarios')!!}" class="btn btn-warning btn-block shadow">Cancelar</a>
            </div>
            <div class="col-xs-12 col-sm-3  form-group ">
            </div>
        </div>
       
    </div>
    
    
    <div id="loadingMessage">ALMACENANDO RESGISTRO ESPERA UN MOMENTO...</div>
    <hr>
    
     
  </div>   
 <form id="form-registro-vehiculo" action="{{ route('regsitro.vehiculo.show',':VEHICULO_ID') }}" method="POST">
    @csrf
</form>

  @push('scripts')
 <script>
const tieneSoporteUserMedia = () =>
    !!(navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia);

const _getUserMedia = (...arguments) =>
    (navigator.getUserMedia || (navigator.mozGetUserMedia || navigator.mediaDevices.getUserMedia) || navigator.webkitGetUserMedia || navigator.msGetUserMedia).apply(navigator, arguments);

const $video = document.querySelector("#video"),
    $canvas = document.querySelector("#canvas"),
    $estado = document.querySelector("#estado"),
    $boton = document.querySelector("#boton"),
    $listaDeDispositivos = document.querySelector("#listaDeDispositivos"),
    capturedImage = document.getElementById('capturedImage'),
    imageInput = document.getElementById('imageInput');

const limpiarSelect = () => {
    for (let x = $listaDeDispositivos.options.length - 1; x >= 0; x--)
        $listaDeDispositivos.remove(x);
};

const obtenerDispositivos = () => navigator.mediaDevices.enumerateDevices();

const llenarSelectConDispositivosDisponibles = () => {
    limpiarSelect();
    obtenerDispositivos()
        .then(dispositivos => {
            const dispositivosDeVideo = dispositivos.filter(dispositivo => dispositivo.kind === "videoinput");
            if (dispositivosDeVideo.length > 0) {
                dispositivosDeVideo.forEach(dispositivo => {
                    const option = document.createElement('option');
                    option.value = dispositivo.deviceId;
                    option.text = dispositivo.label || `Cámara ${$listaDeDispositivos.length + 1}`;
                    $listaDeDispositivos.appendChild(option);
                });
            }
        });
};

(function() {
    if (!tieneSoporteUserMedia()) {
        alert("Lo siento. Tu navegador no soporta esta característica");
        $estado.innerHTML = "Parece que tu navegador no soporta esta característica. Intenta actualizarlo.";
        return;
    }

    let stream;

    const mostrarStream = (idDeDispositivo, esMovil = false) => {
        _getUserMedia({
                video: {
                    deviceId: idDeDispositivo ? { exact: idDeDispositivo } : undefined,
                    facingMode: esMovil ? { exact: "environment" } : "user",
                }
            },
            (streamObtenido) => {
                llenarSelectConDispositivosDisponibles();
                $listaDeDispositivos.onchange = () => {
                    if (stream) {
                        stream.getTracks().forEach(track => track.stop());
                    }
                    mostrarStream($listaDeDispositivos.value, /Android|webOS|iPhone|iPad|iPod/i.test(navigator.userAgent));
                };

                stream = streamObtenido;
                $video.srcObject = stream;
                $video.play();

                $boton.addEventListener("click", function(event) {
                    event.preventDefault();
                    $video.pause();
                    let contexto = $canvas.getContext("2d");
                    $canvas.width = $video.videoWidth;
                    $canvas.height = $video.videoHeight;
                    contexto.drawImage($video, 0, 0, $canvas.width, $canvas.height);
                    capturedImage.src = $canvas.toDataURL('image/png');
                    capturedImage.style.display = 'block';
                    imageInput.value = capturedImage.src;
                    $video.play();
                });
            }, (error) => {
                console.log("Permiso denegado o error: ", error);
                $estado.innerHTML = "No se puede acceder a la cámara, o no diste permiso.";
            });
    };

    obtenerDispositivos().then(dispositivos => {
        const dispositivosDeVideo = dispositivos.filter(dispositivo => dispositivo.kind === "videoinput");
        if (dispositivosDeVideo.length > 0) {
            const esMovil = /Android|webOS|iPhone|iPad|iPod/i.test(navigator.userAgent);
            mostrarStream(dispositivosDeVideo[0].deviceId, esMovil);
        }
    });
})();

</script>

 <script>
        const form = document.getElementById('myForm');
        const loadingMessage = document.getElementById('loadingMessage');
        const submitButton = form.querySelector('button[type="submit"]');

        form.addEventListener('submit', function() {
            // Mostrar el mensaje de carga
            loadingMessage.style.display = 'block';
            
            // Cambiar el color del botón y el texto a "Enviando..."
            submitButton.classList.add('sending');
            submitButton.textContent = "Enviando...";

            // Ocultar el mensaje automáticamente después de 5 segundos
            setTimeout(() => {
                loadingMessage.style.display = 'none';

                // Restaurar el estado original del botón
                submitButton.classList.remove('sending');
                submitButton.textContent = "Enviar";
            }, 5000);
        });
    </script>
 


  
   @endpush
   

@endsection
@extends('layouts.monitoreo.ingreso')
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
                    {!!Form::open(['route'=>'biometria.registro.cargar.foto', 'method'=>'POST','enctype'=>"multipart/form-data",'id'=>'biometria.registro.save'])!!}
        			{{csrf_field()}}
        			
        			@if(!empty($verificacion->observaciones))
                        <div id="alertaNovedadDiscreta" style="background-color: #fff1f2; border-left: 5px solid #e11d48; color: #881337; padding: 15px; border-radius: 4px; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(225, 29, 72, 0.1);">
                            <div style="font-weight: 600; margin-bottom: 5px; display: flex; align-items: center; gap: 6px;">
                                <i class="fa fa-exclamation-circle" style="font-size: 22px; color: #e11d48;"></i> 
                                NOVEDAD REGISTRADA POR COORDINACIÓN:
                            </div>
                            <div id="textoNovedadDiscreta" style="font-size: 15px; margin-left: 28px; line-height: 1.4;">{{ $verificacion->observaciones }}</div>
                        </div>
                    @endif
                    
        			<div class="col-xs-12 col-lg-4 form-group ">
                    {!!Form::label('semana_regsitro',"IDENTIFICACION:")!!}
                    {!!Form::number('identificacion',$verificacion->identificacion,['id'=>'conductor','class'=>'form-control ',old('conductor'),'shadow','required','autocomplete'=>"off",'placeholder'=>'Ingrese Cedula Del Visitante','readonly'])!!}
                     </div>
                    <div class="col-xs-12 col-lg-6 form-group ">
                        {!!Form::label('p_apellido',"PRIMER APELLIDO:")!!}
                        {!!Form::text('p_apellido',$verificacion->p_apellido,['class'=>'form-control ',old('p_apellido'),'shadow','required','autocomplete'=>"off",'placeholder'=>'Primer Apellido','readonly'])!!}
                        
                    </div>
                    <div class="col-xs-12 col-lg-6 form-group ">
                        {!!Form::label('s_apellido',"SEGUNDO APELLIDO:")!!}
                        {!!Form::text('s_apellido',$verificacion->s_apellido,['class'=>'form-control ',old('s_apellido'),'shadow','autocomplete'=>"off",'placeholder'=>'Segundo Apellido','readonly'])!!}
                        
                    </div>
                    <div class="col-xs-12 col-lg-6 form-group ">
                        {!!Form::label('p_nombre',"PRIMER NOMBRE:")!!}
                        {!!Form::text('p_nombre',$verificacion->p_nombre,['id'=>'p_nombre','class'=>'form-control ',old('p_nombre'),'shadow','required','autocomplete'=>"off",'placeholder'=>'Primer Nombre','readonly'])!!}
                        
                    </div>
                    <div class="col-xs-12 col-lg-6 form-group ">
                        {!!Form::label('s_nombre',"SEGUNDO NOMBRE:")!!}
                        {!!Form::text('s_nombre',$verificacion->s_nombre,['id'=>'s_nombre','class'=>'form-control ',old('s_nombre'),'shadow','autocomplete'=>"off",'placeholder'=>'Segundo Nombre','readonly'])!!}
                        
                    </div>
                    <div class="col-xs-12 col-lg-6 form-group ">
                                {!!Form::label('tipo',"TIPO INGRESO:")!!}
                                {!!Form::text('tipo',$verificacion->tipo,['id'=>'s_nombre','class'=>'form-control ',old('s_nombre'),'shadow','autocomplete'=>"off",'placeholder'=>'Visitante o Funcionario','readonly'])!!}
                                
                    </div>
                    <div class="col-xs-12 col-lg-12 form-group ">
                        {!!Form::label('observaciones',"OBSERVACIONES:")!!}
                        {!!Form::text('observaciones',null,['class'=>'form-control ',old('observaciones'),'shadow','autocomplete'=>"off",'placeholder'=>'Observaciones','style'=>" heigth : 150px"])!!}
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
                {!!Form::submit('REGISTRAR INGRESO',['class'=>'btn btn-primary btn-block'])!!}
                
                {!!Form::close()!!}
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
 {!!Form::open(['id'=>'form-registro-vehiculo','route'=>['regsitro.vehiculo.show',':VEHICULO_ID'], 'method'=>'GET'])!!}
{!!Form::close()!!}

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
 
  
<!--script>
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
                    //$estado.innerHTML = "Enviando foto. Por favor, espera...";
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
</script--> 
 


  
   @endpush
   

@endsection
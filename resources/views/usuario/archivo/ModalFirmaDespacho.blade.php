<!-- Modal -->
<div class="modal fade" id="FirmaDespacho" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #004182;color:white">
        <h3 class="modal-title" id="exampleModalLongTitle"><center>AUTORIZACION INGRESO ARCHIVO</center></h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
       <form action="{{ route('usuario.firma.despacho') }}" method="POST">
    @csrf
      <div class="modal-body">
          <div class="container-fluid">
              <input class="form-control @error('id') is-invalid @enderror" placeholder="Ingresa email" required="required" id="id" type="text" name="id" value="{{ old('id') }}">
@error('id')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
              <div class="row">
                  <div class="col-xs-12 col-sm-6">
                    <p>FIRMA DE AUTORIZACION INGRESO ARCHIVO<span id="expediente">.</strong> </span> <span id="nombre">.</strong> </span> </p> 
                  </div>
                  <div class="col-xs-12 col-sm-12">
                      <div class="form-group col-xs-12  col-sm-6 " >
                                <label for="firma">Firma Aceptacion Ingreso:</label>
                                <div id="div" autofocus placeholder="Firmar Documento y Luedo dar en Enviar">
                                <canvas id="draw-canvas" width="359" height="359" style='border: 1px solid #CCC;' >Su navegador no soporta canvas :( </canvas>
                                </div>
                                <div class="row">
                                    <div class="form-group col-xs-12  col-sm-6 " id="oculto-guardar" style="display: block;" >
                                        <button class="btn btn-danger btn-guardar btn-sm pull-left " type='button' id="draw-submitBtn" style="display: block;" title="Guarde la firma para poder almacenar el comprobante">Guardar Firma</button>
                                    </div>
                                    <div class="form-group col-xs-12  col-sm-6 " id="muestro-guardar" style="display: block;">
                                        <button class="btn btn-dark  btn-sm " id="draw-clearBtn" type='button' >Volver a Firmar</button>
                                    </div>
                                </div>
                                <input type='hidden' name='firma_titular_despacho' id='imagen' value="" required />
                            </div> 
                  </div>
                  
              </div>
              
          </div>
       
        <div class="row">
          <div class=" col-xs-12 col-md-12">
        </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal" id="draw-clearBtn">CERRAR</button>
        <button type="submit" class="btn btn-lg btn-success" >AUTORIZAR</button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
     /*
          El siguiente codigo en JS Contiene mucho codigo
          de las siguietes 3 fuentes:
          https://stipaltamar.github.io/dibujoCanvas/
          https://developer.mozilla.org/samples/domref/touchevents.html - https://developer.mozilla.org/es/docs/DOM/Touch_events
          http://bencentra.com/canvas/signature/signature.html - https://bencentra.com/code/2014/12/05/html5-canvas-touch-events.html
  */
  
  (function() { // Comenzamos una funcion auto-ejecutable
  
  // Obtenenemos un intervalo regular(Tiempo) en la pamtalla
  window.requestAnimFrame = (function (callback) {
    return window.requestAnimationFrame ||
          window.webkitRequestAnimationFrame ||
          window.mozRequestAnimationFrame ||
          window.oRequestAnimationFrame ||
          window.msRequestAnimaitonFrame ||
          function (callback) {
             window.setTimeout(callback, 1000/60);
            // Retrasa la ejecucion de la funcion para mejorar la experiencia
          };
  })();
  
  // Traemos el canvas mediante el id del elemento html
  var canvas = document.getElementById("draw-canvas");
  var ctx = canvas.getContext("2d");
  
  
  // Mandamos llamar a los Elemetos interactivos de la Interfaz HTML
  var drawText = document.getElementById("draw-dataUrl");
  var drawImage = document.getElementById("draw-image");
  var clearBtn = document.getElementById("draw-clearBtn");
  var submitBtn = document.getElementById("draw-submitBtn");
  clearBtn.addEventListener("click", function (e) {
    // Definimos que pasa cuando el boton draw-clearBtn es pulsado
    clearCanvas();
    //drawImage.setAttribute("src", "");
    imagen.value = '';
    document.getElementById('imagen').value = '';
    document.getElementById('oculto-guardar').style.display = '';
    //alert(document.getElementById('oculto-guardar').style.display = 'none' );

  }, false);
    // Definimos que pasa cuando el boton draw-submitBtn es pulsado
  submitBtn.addEventListener("click", function (e) {
    var canvas = document.getElementById('draw-canvas');    
    var dataUrl = canvas.toDataURL();
    console.log(dataUrl);
    //alert(dataUrl);
    
    //drawImage.setAttribute("src", dataUrl);
    imagen.value = dataUrl;
    document.getElementById('oculto-guardar').style.display = 'none'; 
   // alert(document.getElementById('oculto-guardar').style.display = 'block' );
   }, false);
  
  // Activamos MouseEvent para nuestra pagina
  var drawing = false;
  var mousePos = { x:0, y:0 };
  var lastPos = mousePos;
  canvas.addEventListener("mousedown", function (e)
  {
    /*
      Mas alla de solo llamar a una funcion, usamos function (e){...}
      para mas versatilidad cuando ocurre un evento
    */
    var tint = "#000000";
    var punta = 3;
    //console.log(e);
    drawing = true;
    lastPos = getMousePos(canvas, e);
  }, false);
  canvas.addEventListener("mouseup", function (e)
  {
    drawing = false;
  }, false);
  canvas.addEventListener("mousemove", function (e)
  {
    mousePos = getMousePos(canvas, e);
  }, false);
  
  // Activamos touchEvent para nuestra pagina
  canvas.addEventListener("touchstart", function (e) {
    mousePos = getTouchPos(canvas, e);
    //console.log(mousePos);
    e.preventDefault(); // Prevent scrolling when touching the canvas
    var touch = e.touches[0];
    var mouseEvent = new MouseEvent("mousedown", {
      clientX: touch.clientX,
      clientY: touch.clientY
    });
    canvas.dispatchEvent(mouseEvent);
  }, false);

  canvas.addEventListener("touchend", function (e) {
    e.preventDefault(); // Prevent scrolling when touching the canvas
    var mouseEvent = new MouseEvent("mouseup", {});
    canvas.dispatchEvent(mouseEvent);
  }, false);

  canvas.addEventListener("touchleave", function (e) {
    // Realiza el mismo proceso que touchend en caso de que el dedo se deslice fuera del canvas
    e.preventDefault(); // Prevent scrolling when touching the canvas
    var mouseEvent = new MouseEvent("mouseup", {});
    canvas.dispatchEvent(mouseEvent);
  }, false);

  canvas.addEventListener("touchmove", function (e) {
    e.preventDefault(); // Prevent scrolling when touching the canvas
    var touch = e.touches[0];
    var mouseEvent = new MouseEvent("mousemove", {
      clientX: touch.clientX,
      clientY: touch.clientY
    });

    canvas.dispatchEvent(mouseEvent);
  }, false);
  
  // Get the position of the mouse relative to the canvas
  function getMousePos(canvasDom, mouseEvent) {
    var rect = canvasDom.getBoundingClientRect();
    /*
      Devuelve el tamaño de un elemento y su posición relativa respecto
      a la ventana de visualización (viewport).
    */
    return {
      x: mouseEvent.clientX - rect.left,
      y: mouseEvent.clientY - rect.top
    };
  }
  
  // Get the position of a touch relative to the canvas
  function getTouchPos(canvasDom, touchEvent) {
    var rect = canvasDom.getBoundingClientRect();
    //console.log(touchEvent);
    /*
      Devuelve el tamaño de un elemento y su posición relativa respecto
      a la ventana de visualización (viewport).
    */
    return {
      x: touchEvent.touches[0].clientX - rect.left, // Popiedad de todo evento Touch
      y: touchEvent.touches[0].clientY - rect.top
    };
  }
  
  // Draw to the canvas
  function renderCanvas() {
    if (drawing) {
      var tint = "#000000";
      var punta = 3;
      ctx.strokeStyle = tint.value;
      ctx.beginPath();
      ctx.moveTo(lastPos.x, lastPos.y);
      ctx.lineTo(mousePos.x, mousePos.y);
      //console.log(punta.value);
      ctx.lineWidth = punta.value;
      ctx.stroke();
      ctx.closePath();
      lastPos = mousePos;
    }
  }
  
  function clearCanvas() {
    canvas.width = canvas.width;
  }
  
  // Allow for animation
  (function drawLoop () {
    requestAnimFrame(drawLoop);
    renderCanvas();
  })();

  
})(); 



</script>
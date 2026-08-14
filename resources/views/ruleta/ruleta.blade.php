<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="keywords" content="Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design, SIRIS CALI, DISAJCALI, siriscali, disajcali, mision, vision, consejo superior de la judicatura, directorio teléfonico disajcali"/>
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
  <script src="https://cdn.jsdelivr.net/npm/vue"></script>
  <title>@yield('title')</title>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
<link rel="shortcut icon" href="{{asset('img/icono.png')}}">

<script async src="https://www.googletagmanager.com/gtag/js?id=G-GQV5YWSC6Y"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());
  gtag('config', 'G-GQV5YWSC6Y');
</script>

<style type="text/css">
html {
  position: relative;
  min-height: 100%;
}
body {
  margin-bottom: 60px;
}
.footer {
  position: absolute;
  bottom: -60px;
  width: 100%;
  height: 60px;
  line-height: 30px;
  background-color: #004182;
  color: #ffffff;
}

ul li:hover {background: #ffffff52;}

.cBlanco{
  color: #ffffff;
}

.navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:focus, .navbar-default .navbar-nav>.open>a:hover{
  background-color: #a2a2a2b3;
}

.dropdown-menu > li > a:hover{
  background-color: #a2a2a2b3;
}

/* Estilos para la ruleta mejorada */
.ruleta-container {
  position: relative;
  display: inline-block;
  margin: 50px 0;
}

/* NÚMERO GANADOR GIGANTE QUE SOBRESALE */
.numero-ganador {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  font-size: 350px; /* ¡SUPER GRANDE! */
  font-weight: 900;
  color: #FFD700; /* Dorado brillante */
  text-shadow: 
    0 0 30px rgba(255, 215, 0, 1),
    0 0 60px rgba(255, 215, 0, 0.8),
    0 0 90px rgba(255, 215, 0, 0.6),
    8px 8px 20px rgba(0, 0, 0, 0.9),
    -4px -4px 10px rgba(255, 255, 255, 0.8);
  z-index: 10000;
  animation: explotar 0.8s ease-out;
  pointer-events: none;
  font-family: 'Impact', 'Arial Black', sans-serif;
  -webkit-text-stroke: 4px #ff0000;
  letter-spacing: 10px;
}

@keyframes explotar {
  0% { 
    transform: translate(-50%, -50%) scale(0) rotate(-180deg); 
    opacity: 0; 
  }
  60% { 
    transform: translate(-50%, -50%) scale(1.3) rotate(10deg); 
  }
  80% { 
    transform: translate(-50%, -50%) scale(0.9) rotate(-5deg); 
  }
  100% { 
    transform: translate(-50%, -50%) scale(1) rotate(0deg); 
    opacity: 1; 
  }
}

/* Efecto de resplandor pulsante continuo */
@keyframes brillar {
  0%, 100% { 
    text-shadow: 
      0 0 30px rgba(255, 215, 0, 1),
      0 0 60px rgba(255, 215, 0, 0.8),
      0 0 90px rgba(255, 215, 0, 0.6),
      8px 8px 20px rgba(0, 0, 0, 0.9),
      -4px -4px 10px rgba(255, 255, 255, 0.8);
  }
  50% { 
    text-shadow: 
      0 0 50px rgba(255, 215, 0, 1),
      0 0 100px rgba(255, 215, 0, 1),
      0 0 150px rgba(255, 215, 0, 0.8),
      8px 8px 20px rgba(0, 0, 0, 0.9),
      -4px -4px 10px rgba(255, 255, 255, 1);
  }
}

.numero-ganador.activo {
  animation: explotar 0.8s ease-out, brillar 2s ease-in-out infinite 0.8s;
}

/* Fondo oscuro detrás del número */
.numero-ganador::before {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 500px;
  height: 500px;
  background: radial-gradient(circle, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0) 70%);
  z-index: -1;
  border-radius: 50%;
}

.numeros-salidos {
  margin-top: 20px;
  padding: 15px;
  background-color: #f0f0f0;
  border-radius: 10px;
  box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.numeros-salidos h3 {
  color: #004182;
  margin-bottom: 10px;
}

.numero-item {
  display: inline-block;
  margin: 5px;
  padding: 8px 12px;
  background-color: #004182;
  color: white;
  border-radius: 5px;
  font-weight: bold;
}

.controles {
  margin: 20px 0;
  padding: 15px;
  background-color: #f9f9f9;
  border-radius: 10px;
}

.control-group {
  margin: 10px 0;
}

.control-group label {
  display: inline-block;
  width: 200px;
  font-weight: bold;
}

.control-group input[type="range"] {
  width: 300px;
}

.control-group span {
  margin-left: 10px;
  font-weight: bold;
  color: #004182;
}
</style>

<link rel="stylesheet" href="/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="/adminlte/bower_components/Ionicons/css/ionicons.min.css">
<link rel="stylesheet" href="/adminlte/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="/adminlte/dist/css/AdminLTE.css">
<link rel="stylesheet" href="/adminlte/dist/css/skins/skin-black.css">
<link rel="stylesheet" href="/css/sticky-footer.css">
<link href="/gallery/galeria/animate.css" rel="stylesheet" />
<link href="/gallery/galeria/light-gallery/css/lightgallery.css" rel="stylesheet">

@stack('style')

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

<div style="text-align: center;"><a style= "@media screen and (max-width: 980px) display: none; left: 0px; height: 200px; width: 70px; position: fixed; top: 0px;"><img src="img/navidad/adornos.gif" _fcksavedurl="" alt="" /></a></div>
<script src="navidad/efectoNieve.js"></script>
</head>

<body style="background: #fff;">
  <main role="main" class="container-fluid" style="width: 80%">
    <div class="row">
      <div class="col-xs-12  col-md-4">
        <img src="/img/logoLargo.png" class="img-responsive">
      </div>
      <div class="col-xs-12  col-md-5">
        <p style="text-align: center; font-size: 17px; font-weight: bold;">
          <br>Consejo Superior de la Judicatura<br>
          Direcci&oacute;n Ejecutiva Seccional de Administraci&oacute;n Judicial<br>
          Cali - Valle del Cauca
        </p>
      </div>
      <div class="col-xs-12  col-md-3" >
          <div style="text-align: center; position: absolute; bottom: -80px;">
            <div id="google_translate_element" ></div>    
          </div>
      </div>
    </div>

   
      
      @include('alerts.flash-message')
      @yield('content')
      
      <div class="container-fluid">
          <div class="row">
              <div class="col-xs-12 col-sm-12">
                  
                  <!-- CONTROLES DE CONFIGURACIÓN -->
                  <div class="controles">
                      
                  
                  <!-- RULETA -->
                  <div style="text-align: center;">
                      <input class="btn btn-danger btn-lg" type="button" value="🎰 ¡GIRAR RULETA!" id='spin' />
                      <div class="ruleta-container">
                          <canvas id="canvas" width="1024" height="1024"></canvas>
                          <div id="numeroGanador" class="numero-ganador" style="display: none;"></div>
                      </div>
                  </div>
                  
                  <!-- NÚMEROS QUE HAN SALIDO -->
                  <div class="numeros-salidos">
                      <h3>📊 Números que han salido (<span id="contadorSalidos">0</span>):</h3>
                      <div id="listaNumerosSalidos"></div>
                  </div>
                  
                  <h3 style="color: #004182; text-align: center;">⚙️ CONTROLES DE LA RULETA</h3>
                      
                      <div class="control-group">
                          <label>🎯 Cantidad de Números (1-200):</label>
                          <input type="range" id="cantidadNumeros" min="1" max="200" value="100" oninput="actualizarCantidad(this.value)">
                          <span id="valorCantidad">100</span>
                      </div>
                      
                      <div class="control-group">
                          <label>⚡ Velocidad de Giro (1-10):</label>
                          <input type="range" id="velocidadGiro" min="1" max="10" value="5" oninput="actualizarVelocidad(this.value)">
                          <span id="valorVelocidad">5</span>
                      </div>
                      
                      <div class="control-group">
                          <button class="btn btn-warning btn-lg" onclick="reiniciarRuleta()">🔄 Reiniciar Ruleta</button>
                          <button class="btn btn-info btn-lg" onclick="limpiarHistorial()">🗑️ Limpiar Historial</button>
                      </div>
                  </div>
                  
              </div>
          </div>
      </div>

<script>
// ============================================
// 🎯 VARIABLES DE CONFIGURACIÓN PRINCIPALES
// ============================================

// 📊 CANTIDAD DE NÚMEROS: Cambia este valor para aumentar o disminuir los números de la ruleta (1-200)
var CANTIDAD_NUMEROS = 100;

// ⚡ VELOCIDAD DE GIRO: Cambia este valor para controlar la velocidad (1=muy lento, 10=muy rápido)
var VELOCIDAD_GIRO = 5;

// ============================================

var options = [];
var numerosSalidos = []; // Array para almacenar números que ya salieron
var startAngle = 0;
var arc = Math.PI / (options.length / 2);
var spinTimeout = null;
var spinAngleStart = 5;
var spinTime = 0;
var spinTimeTotal = 0;
var ctx;
var girando = false;

// Inicializar opciones
function inicializarOpciones() {
    options = [];
    for(var i = 1; i <= CANTIDAD_NUMEROS; i++) {
        options.push(i.toString());
    }
    arc = Math.PI / (options.length / 2);
}

// Actualizar cantidad de números
function actualizarCantidad(valor) {
    document.getElementById('valorCantidad').textContent = valor;
    CANTIDAD_NUMEROS = parseInt(valor);
    reiniciarRuleta();
}

// Actualizar velocidad
function actualizarVelocidad(valor) {
    document.getElementById('valorVelocidad').textContent = valor;
    VELOCIDAD_GIRO = parseInt(valor);
}

// Reiniciar ruleta
function reiniciarRuleta() {
    numerosSalidos = [];
    inicializarOpciones();
    drawRouletteWheel();
    actualizarListaNumerosSalidos();
    document.getElementById('numeroGanador').style.display = 'none';
}

// Limpiar historial
function limpiarHistorial() {
    numerosSalidos = [];
    actualizarListaNumerosSalidos();
}

// Actualizar lista de números salidos
function actualizarListaNumerosSalidos() {
    var lista = document.getElementById('listaNumerosSalidos');
    var contador = document.getElementById('contadorSalidos');
    
    if(numerosSalidos.length === 0) {
        lista.innerHTML = '<p style="color: #999;">Aún no han salido números...</p>';
        contador.textContent = '0';
    } else {
        lista.innerHTML = numerosSalidos.map(function(num) {
            return '<span class="numero-item">' + num + '</span>';
        }).join('');
        contador.textContent = numerosSalidos.length;
    }
}

document.getElementById("spin").addEventListener("click", spin);

function byte2Hex(n) {
  var nybHexString = "0123456789ABCDEF";
  return String(nybHexString.substr((n >> 4) & 0x0F,1)) + nybHexString.substr(n & 0x0F,1);
}

function RGB2Color(r,g,b) {
  return '#' + byte2Hex(r) + byte2Hex(g) + byte2Hex(b);
}

function getColor(item, maxitem) {
  var phase = 0;
  var center = 128;
  var width = 127;
  var frequency = Math.PI*2/maxitem;
  
  red   = Math.sin(frequency*item+2+phase) * width + center;
  green = Math.sin(frequency*item+0+phase) * width + center;
  blue  = Math.sin(frequency*item+4+phase) * width + center;
  
  return RGB2Color(red,green,blue);
}

function drawRouletteWheel() {
  var canvas = document.getElementById("canvas");
  if (canvas.getContext) {
    var outsideRadius = 400;
    var textRadius = 370;
    var insideRadius = 275;

    ctx = canvas.getContext("2d");
    ctx.clearRect(0,0,1024,1024);

    ctx.strokeStyle = "white";
    ctx.lineWidth = 8;

    ctx.font = 'bold 14px Helvetica, Arial';

    for(var i = 0; i < options.length; i++) {
      var angle = startAngle + i * arc;
      ctx.fillStyle = getColor(i, options.length);

      ctx.beginPath();
      ctx.arc(512, 512, outsideRadius, angle, angle + arc, false);
      ctx.arc(512, 512, insideRadius, angle + arc, angle, true);
      ctx.stroke();
      ctx.fill();

      ctx.save();
      ctx.shadowOffsetX = -1;
      ctx.shadowOffsetY = -1;
      ctx.shadowBlur    = 0;
      ctx.shadowColor   = "rgb(220,220,220)";
      ctx.fillStyle = "black";
      ctx.translate(512 + Math.cos(angle + arc / 2) * textRadius, 
                    512 + Math.sin(angle + arc / 2) * textRadius);
      ctx.rotate(angle + arc / 2 + Math.PI / 2);
      var text = options[i];
      ctx.fillText(text, -ctx.measureText(text).width / 2, 0);
      ctx.restore();
    } 

    // Flecha
    ctx.fillStyle = "black";
    ctx.beginPath();
    ctx.moveTo(512 - 4, 512 - (outsideRadius + 8));
    ctx.lineTo(512 + 4, 512 - (outsideRadius + 8));
    ctx.lineTo(512 + 4, 512 - (outsideRadius - 8));
    ctx.lineTo(512 + 9, 512 - (outsideRadius - 8));
    ctx.lineTo(512 + 0, 512 - (outsideRadius - 13));
    ctx.lineTo(512 - 9, 512 - (outsideRadius - 8));
    ctx.lineTo(512 - 4, 512 - (outsideRadius - 8));
    ctx.lineTo(512 - 4, 512 - (outsideRadius + 5));
    ctx.fill();
  }
}

function spin() {
  if(girando) return;
  
  if(numerosSalidos.length >= options.length) {
    alert('¡Todos los números ya han salido! Reinicia la ruleta para continuar.');
    return;
  }
  
  girando = true;
  document.getElementById('numeroGanador').style.display = 'none';
  document.getElementById('numeroGanador').classList.remove('activo');
  
  spinAngleStart = Math.random() * 180 + 140;
  spinTime = 0;
  
  // Calcular spinTimeTotal basado en VELOCIDAD_GIRO
  var velocidadBase = 4500; // Tiempo base
  var factorVelocidad = (11 - VELOCIDAD_GIRO) / 10; // Invertir: velocidad 10 = más rápido
  spinTimeTotal = velocidadBase * factorVelocidad;
  
  rotateWheel();
}

function rotateWheel() {
  spinTime += 25;
  if(spinTime >= spinTimeTotal) {
    stopRotateWheel();
    return;
  }
  var spinAngle = spinAngleStart - easeOut(spinTime, 0, spinAngleStart, spinTimeTotal);
  startAngle += (spinAngle * Math.PI / 180);
  drawRouletteWheel();
  spinTimeout = setTimeout(rotateWheel, 30);
}

function stopRotateWheel() {
  clearTimeout(spinTimeout);
  var degrees = startAngle * 180 / Math.PI + 90;
  var arcd = arc * 180 / Math.PI;
  var index = Math.floor((360 - degrees % 360) / arcd);
  
  var numeroGanador = options[index];
  
  // Verificar si el número ya salió
  if(numerosSalidos.indexOf(numeroGanador) !== -1) {
    // Si ya salió, girar de nuevo automáticamente
    girando = false;
    spin();
    return;
  }
  
  // Agregar a números salidos
  numerosSalidos.push(numeroGanador);
  actualizarListaNumerosSalidos();
  
  // Mostrar número ganador GIGANTE en el centro
  var divGanador = document.getElementById('numeroGanador');
  divGanador.textContent = numeroGanador;
  divGanador.style.display = 'block';
  divGanador.classList.add('activo');
  
  girando = false;
}

function easeOut(t, b, c, d) {
  var ts = (t/=d)*t;
  var tc = ts*t;
  return b+c*(tc + -3*ts + 3*t);
}

// Inicializar al cargar
inicializarOpciones();
drawRouletteWheel();
actualizarListaNumerosSalidos();
</script>

<script src="js/jquery-3.2.1.min.js"></script> 
<script src="adminlte/bower_components/jquery/dist/jquery.min.js"></script> 
<script src="adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="adminlte/bower_components/datatables.net/js/jquery.dataTables.min.js"></script> 
<script src="adminlte/dist/js/adminlte.min.js"></script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<script>
$(document).ready( function(){
    $.fn.snow({ minSize: 7, maxSize: 14, newOn: 100, flakeColor: '#45F9F1' });
});
</script>

</body>
</html>
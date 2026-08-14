@extends('layouts.ReservasPublico')
<!--ponerle titulo a la paginga-->
@section('title', 'Audiencias en Sala Palacio de Justicia')
<style>
    /* Estilos CSS para la tabla */
    table {
      width: 100%;
      border-collapse: collapse;
    }
    
    thead {
        background-color: red;
    }
    
    th, td {
      border: 1px solid black;
      padding: 8px;
    }
    
    th {
      background-color: #f2f2f2;
    }
    
    /* Estilos CSS para la animación */
    .blink {
      animation: blink-animation 1s steps(5, start) infinite;
      -webkit-animation: blink-animation 1s steps(5, start) infinite;
    }
    
    @keyframes blink-animation {
      to {
        visibility: hidden;
      }
    }
    
    @-webkit-keyframes blink-animation {
      to {
        visibility: hidden;
      }
    }
    /* Estilo CSS para resaltar la fila actual */
    .current-row {
      background-color: yellow;
    }
  </style>



@section('content')

<?php 
$val =\Carbon\Carbon::parse(\Carbon\Carbon::Now(), 'America/Bogota')->timezone->getName();
 \Carbon\Carbon::setLocale('es');
 
//echo $car =\Carbon\Carbon::Now()->toDateTimeString()->subMinutes(15);
 $car =\Carbon\Carbon::Now()->subMinutes(15)->toDateTimeString();
?>

  <h1>PROGRAMACI&Oacute;N DE AUDIENCIAS {{$edificio->nombre_edificio}} de {{$ciudad->nombreCiudad}}   <strong> {{ \Carbon\Carbon::parse(\Carbon\Carbon::Now())->translatedFormat('d-M-Y') }}</strong></h1>
  <div class="table-responsive">
  <table id="waiting-table" class="bordered">
    <thead>
      <tr>
        <th style="font-size:30px;"><center> RADICACI&Oacute;N</center></th>
		<th style="font-size:30px"><center>DESPACHO</center></th>
		<th style="font-size:30px"><center>SALA</center></th>
		<th style="font-size:30px"><center>TORRE PISO</center></th>
		<th style="font-size:30px"><center>DEMANDANTE O FISCAL&Iacute;A</center></th>
		<th style="font-size:30px"><center>DEMANDADO O INDICIADO</center></th>	
		<th style="font-size:30px"><center>HORA DE INICIO</center></th>	
		<th style="font-size:30px"><center>HORA FIN</center></th>
      </tr>
    </thead>
    <tbody>
      <!-- Aquí se generarán las filas dinámicamente -->
    </tbody>
  </table>
  </div>
<style>
    /* Estilos CSS para la tabla */
    table {
      width: 100%;
      border-collapse: collapse;
    }
    
    th, td {
      border: 3px solid black;
      padding: 8px;
    }
    
    th {
      background-color: #68996F;
    }
    
    /* Estilo CSS para resaltar la fila actual */
    .current-row {
      background-color: #C7CA98!;
    }
    
     /* Estilo CSS para las filas impares 
    tr:nth-child(odd) {
      background-color: #e9e9e9;
    }*/
  </style>
  
  


  <script>
    // Obtén la tabla y sus filas
    var table = document.getElementById('waiting-table');
    var rows = table.getElementsByTagName('tr');

    // Variable para almacenar el índice de la fila actual
    var currentRowIndex = 0;

    // Función para resaltar la fila actual
    function resaltarFilaActual() {
      // Remueve la clase "current-row" de todas las filas
      for (var i = 0; i < rows.length; i++) {
        rows[i].classList.remove('current-row');
      }

      // Agrega la clase "current-row" a la fila actual
      rows[currentRowIndex].classList.add('current-row');

      // Incrementa el índice de la fila actual
      currentRowIndex++;

      // Si se alcanza el final de las filas, vuelve al principio
      if (currentRowIndex >= rows.length) {
        currentRowIndex = 0;
      }
      // Hace scroll hacia la fila actual
      rows[currentRowIndex].scrollIntoView({ behavior: 'smooth' });
    }

    // Establece el intervalo para recorrer las filas automáticamente
    var interval = setInterval(resaltarFilaActual, 2000); // Cambia el valor 2000 por el tiempo deseado en milisegundos

    // Detener el recorrido automático después de un número de vueltas determinado
    var vueltas = 100000; // Cambia el valor 3 por el número de vueltas deseado
    var contadorVueltas = 0;

    function detenerRecorrido() {
      contadorVueltas++;
      if (contadorVueltas >= vueltas) {
        clearInterval(interval);
      }
    }
  </script>



@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
  // Función para cargar los datos en la tabla
  function cargarDatos() {
     ///reservas/salas/{edificio}/{ciudad} 
    // Realiza una llamada a tu script PHP que obtenga los datos de la sala de espera 
    var edificio = '<?php echo $edificio->id;?>'
    var ciudad = '<?php echo $ciudad->codigoCiudad;?>';
    var url ='/ajax/consulta/reservas/salas/<?php echo $edificio->id ?>/<?php echo $ciudad->codigoCiudad; ?>'
    
    $.ajax({
      url: url,
      type: 'GET',
      dataType: 'json',
      success: function(data) {
        // Limpia la tabla antes de agregar los nuevos datos
        $('#waiting-table tbody').empty();
        
        // Recorre los datos y agrega filas a la tabla
        for (var i = 0; i < data.length; i++) {
        //sacar nombre de sala
        var sala = data[i].sala_nombre;
        var cantidad = sala.length;
         sala.slice(4, cantidad);
         //console.log(sala)
         
         //separa 
         var nombre_f = data[i].nombre_fiscal
         let arr = nombre_f.split(' ');
         //console.log(arr[0])
         
         var nombre_d = data[i].nombre_indiciado
         let arrIn = nombre_d.split(' ');
         //console.log(arrIn[0])

        
          var row = $('<tr style="font-weight:bold;">');
          row.append($('<td style="font-size:20px;">').text(data[i].radicacion));
          row.append($('<td>').text(data[i].despacho));
          row.append($('<td style="font-size:30px;">').text(sala.slice(4, cantidad)));
          row.append($('<td>').text(data[i].ubicacion_nombre));
          row.append($('<td>').text(arr[0]+' @@@'));
          row.append($('<td>').text(arrIn[0]+' @@@'));
          row.append($('<td style="font-size:30px;">').text(data[i].hora_inicio));
          row.append($('<td style="font-size:30px;">').text(data[i].hora_fin));
          $('#waiting-table tbody').append(row);
        }
        
        // Agrega la clase "blink" a la primera celda de la tabla para animarla
        //$('#waiting-table tbody tr:first-child td:first-child').addClass('blink');
      },
      error: function() {
        console.log('Error al cargar los datos');
      }
    });
  }
  
  // Carga los datos inicialmente
  cargarDatos();
  
  // Actualiza los datos cada 5 segundos
  setInterval(cargarDatos, 90000);
});

function refreshAt(hours, minutes, seconds) {
    var now = new Date();
    var then = new Date();

    if(now.getHours() > hours ||
       (now.getHours() == hours && now.getMinutes() > minutes) ||
        now.getHours() == hours && now.getMinutes() == minutes && now.getSeconds() >= seconds) {
        then.setDate(now.getDate() + 1);
    }
    then.setHours(hours);
    then.setMinutes(minutes);
    then.setSeconds(seconds);

    var timeout = (then.getTime() - now.getTime());
    setTimeout(function() {
       window.location.reload(true);
    }, timeout);
}
</script>

<script>
  
      refreshAt(06,00,0); //Recargara la pagina a las 06:30AM
      refreshAt(18,00,0); //Recargara la pagina a las 06:30PM
      refreshAt(12,00,0); //Recargara la pagina a las 12:00PM
      
  </script>

@endpush


@endsection




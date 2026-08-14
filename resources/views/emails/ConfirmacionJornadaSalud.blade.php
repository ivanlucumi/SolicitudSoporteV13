@extends('layouts.correo')
@section('title', 'Reserva Vacunaci&oacute;n')

@section('content')
@section('cabecera', 'Solicitud de Vacunaci&oacute;n')
  <!-- Main content -->
  <p><span class="derecha">Fecha: <?php $time = time(); echo date("d-m-Y", $time);?></span></p>
  <p ><span class="izquierda"><h2>El Se&ntilde;or @</h2></span></p>
  <p class="izquierda"><strong > <h3>{{$nombre}}</h3></strong></p>
  <p class="izquierda"><strong ><h4>{{$apellido}}</h4></strong></p><br>
  
  
  
  
  <p>
      <h3>La Reserva ha Sido Asignada.</h3><br>
      <h2>Confirmaci&oacute;n De Registro de  Jornada De Salud</h2> <br>
  </p>
    
<hr>
  <div style="color: black; font-size: 18px; text-transform: uppercase;"><b>Jornada de Salud</b></div><br>
                   
  <table>
    <tr>
      <th><b>Cedula</b></th>
      <th>{{$cedula}}</th>
    </tr>
    <tr>
      <th><b>Nombre</b></th>
      <th>{{$nombre}}</th>
    </tr>
    <tr>
      <td><b>Apellidos</b></td>
      <td>{{$apellido}}</td>
    </tr>
    <tr>
      <td><b>Sexo:</b></td>
      <td>{{$sexo}}</td>
    </tr>
    <tr>
        <td><b>Citologia:</b></td>
        <td>{{$hora_citologia}}</td>
      </tr>  
    <tr>
        <td><b>Odontologia:</b></td>
        <td>{{$hora_odntologia}} </td>
      </tr> 
      <tr>
        <td><b>Correo:</b></td>
        <td>{{$correo}} </td>
      </tr>
     <tr>
        <td><b>Celular:</b></td>
        <td>{{$celular}} </td>
      </tr> 
       
  </table>
  <br>  

  <p>
      
    <h2>
        Inicias Sesi&oacute;n: <a href="https://disajcali.gov.co/login" target="_blank" style="display: block;
        width: 115px;height: 30px;background: rgb(0, 125, 110);padding: 5px;text-align: center;border-radius: 3px;
        color: white; font-weight: bold;">Login</a>
    </h2>
  </p><br>    
        
@endsection
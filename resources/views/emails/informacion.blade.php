@extends('layouts.correo')
@section('title', 'Nueva Solicitud')

@section('content')
@section('cabecera', 'Nueva Solicitud ')
  <!-- Main content -->
  <p><span class="izquierda">Se&ntilde;or(@) administrador</span>
  <span class="derecha">Fecha: <?php $time = time(); echo date("d-m-Y", $time);?></span></p> 
  <br>
  <p>
    <h2>
      Inicias Sesi&oacute;n: <a href="https://disajcali.gov.co/login" target="_blank" style="display: block;
    width: 115px;height: 25px;background: rgb(0, 125, 110);padding: 10px;text-align: center;border-radius: 5px;
    color: white; font-weight: bold;">Login</a>
    </h2>
  </p>
    

  <div style="color: black; font-size: 18px; text-transform: uppercase;"><b>Detalles de la solicitud</b></div>
                   
  <table>
    <tr>
      <th style="width: 35%;">Nombre</th>
      <th>Descripción</th>
    </tr>
    <tr>
      <td><b>Solicitante</b></td>
      <td>{{$name}} {{$lastname}}</td>
    </tr>
    <tr>
      <td><b>Informacion:</b></td>
      <td>{{$nombreRequerimiento}}</td>
    </tr>
    <tr>
      <td><b>Descripción</b></td>
      <td>{{$descripcion}}</td>
    </tr>
    
    
  </table>
  <br>      
      
        
@endsection

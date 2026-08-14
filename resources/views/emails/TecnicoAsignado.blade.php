@extends('layouts.correo')
@section('title', 'Tecnico Asignado')

@section('content')
@section('cabecera', 'Tecnico Asignado Satisfactoriamente')
  <!-- Main content -->
  <p><span class="izquierda">Señor(@) usuario: {{$name}} {{$lastname}}</span><span class="derecha">Fecha: {{$created_at}}</span></p> 
  <br>
  <p>
    <h2>
      Radicado: {{$radicado}}
    </h2>
  </p>
  
  <p>Se le ha asignado la siguiente solicitud de usuario para brindar apoyo tecnico, por parte de usted.</p>  

  <div style="color: black; font-size: 18px; text-transform: uppercase;"><b>Detalles de la solicitud</b></div>
                   
  <table>
    <tr>
      <th style="width: 35%;">Nombre</th>
      <th>Descripci贸n</th>
    </tr>
    <tr>
      <td><b>Despacho</b></td>
      <td>{{$nameD}}</td>
    </tr>
    <tr>
      <td><b>Dsitricto</b></td>
      <td>{{$distD}}</td>
    </tr>
    <tr>
      <td><b>Fecha Visita:</b></td>
      <td>{{$fecha_visita}}</td>
    </tr>
    <tr>
      <td><b>Tipo Requerimiento:</b></td>
      <td>{{$requerim}}</td>
    </tr>
    <tr>
      <td><b>Descripcipon:</b></td>
      <td>{{$descripcion}}</td>
    </tr>
  </table>
  <br>      
      
        
@endsection

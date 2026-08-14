@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Historico Solicitudes')
@section('cabecera', 'HISTORICO SOLICITUD ALMACEN')

@section('content') 

<style>
    .sombra {
  /* Add a relief effect */
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
  /* Add a shadow effect */
  filter: drop-shadow(0px 0px 10px rgba(0, 0, 0, 0.5));
  /* Add some depth with a pseudo-element */
  position: relative;
}

.sombra::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: #fff;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
  transform: translateY(-5px);
  z-index: -1;
}

table {
  /* Add a border to the table */
  border-collapse: collapse;
  border: 1px solid #ccc;
}

th, td {
  /* Add a border to each cell */
  border: 1px solid #ccc;
  padding: 10px;
  text-align: left;
  /* Add rounded borders to each cell */
  border-radius: 10px;
}

/* Add stripes to the table */
tbody tr:nth-child(even) {
  background-color: #D5F5E3;
}

tbody tr:nth-child(odd) {
  background-color: #fff;
}
</style>

<hr>
<div class="table-responsive sombra">
    <table id="table9" class="table  table-hover table-condensed table-bordered">
        <thead style="background-color: #AFAFAF; color: #fff;">
            <tr>
                <th>ELEMENTO</th>
                <th>CANTIDAD SOLICITADA</th>
                <th>FECHA SOLICITUD</th>
                <th>OBSERVACIONES</th>
                <th>CANTIDAD ENTREGADA</th> <!-- Nueva columna -->
                <th>FECHA RESPUESTA</th> <!-- Nueva columna -->
            </tr>
        </thead>
        @if($Solicitudes != null)
            @foreach($Solicitudes as $solicitud)
            <tbody class="buscar">
                <tr class="table-light">
                    <th scope="row">{{$solicitud->elemento}}</th>
                    <th scope="row">{{$solicitud->cantidad}}</th>
                    <th scope="row">{{$solicitud->fecha_solicitud}}</th>
                    <th scope="row">{{$solicitud->observaciones}}</th>
                    <th scope="row">{{$solicitud->cantidad_entregada}}</th>
                    <th scope="row">{{$solicitud->fecha_respuesta}}</th>
                    
                </tr>
            </tbody>
            @endforeach
        @endif
    </table>
</div>


@endsection


@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Solicitudes de notificaciones')
@section('cabecera', 'NOTIFICACIONES REALIZADAS')


@section('content')
 <div class="panel-group">
    <div class="panel panel-warning">
      <div class="panel-body">
        <center>
          <h3>
            <strong> NOTIFICACIONES </strong>
          </h3>
        </center>
      </div>
      <div class="panel-footer">
         <div class="col-xs-12 col-md-12  form-group table-responsive">
      <table  id="table9" class="table table-bordered table-striped">
        <thead class="shadow" style="background-color: #004182; color: #fff;">
        	<tr> 
        	    <td>DESPACHO</td>
                <td>RADICACION</td>
                <td>DELITO</td>
                <td>CLASE AUDIENCIA</td>
                <td>FECHA</td>
                <td>HORA</td>
                <td>LUGAR</td>
                <td>ACCION</td>
                </tr>
            </thead>  
             @foreach($notificaciones as $notificacion)
                <tbody data-id="{!!$notificacion->id_seguimiento!!}">
                <tr >
                 <td>{{$notificacion->despacho}}</td>
                 <td>{{$notificacion->numero_radicado_proceso}}</td>
                 <td>{{$notificacion->delito}}</td>
                 <td>{{$notificacion->clase_audiencia}}</td>
                 <td>{{$notificacion->fecha_audiencia}}</td>
                 <td>{{$notificacion->hora_inicio}}</td>
                 <td>{{$notificacion->lugar}}</td>
                 <td>
                     <a href="{{ route('usuario.historico.solicitud', $notificacion->id_seguimiento) }}" class="btn btn-warning btn-xs btn-block fa fa-eye fa-2x" title="editar usuario"> </a>
                 </td>
                </tr>
                </tbody>
            @endforeach
             
           
        </table>
     </div>

      </div>
    </div>
<hr>


<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterNotificacion.js"></script> 



@push('scripts')

@endpush


@endsection








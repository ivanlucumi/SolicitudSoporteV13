@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Agendamiento de Ingresos')
@section('cabecera', 'Agenda la cita para permitir ingreso')

@section('content') 
<div class="card-body">
      <div class="container-fluid">
        <P><center><h2>SELECCIONA EL TIPO DE USUARIO QUE INGRESA PARA DILIGENCIAR SOLICITUD</h2> </center></P><hr>
       </div>  
</div>

@include('reg_ingreso.includeRegIngreso.includeAgendamiento')
              


@push('scripts')
<script src="/js/1configuracion.js"></script>  
<script src="/js/ingreso/ingreso.js"></script>  
  
    
@endpush
       

@endsection
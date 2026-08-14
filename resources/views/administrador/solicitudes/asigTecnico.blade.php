

@extends('layouts.tecnicos')
 
<!--ponerle titulo a la paginga-->
@section('title', 'Solicitudes')
@section('cabecera', ' Solicitudes de Usuarios Asignadas')

@section('content') 

@if($solicitudes != null && $solitcont > 0)

@foreach($solicitudes as $solicitud)
  @if($solicitud->estado_solicitud == null)
         @include('administrador.solicitudes.asignadas')

         <div class="row">
          <div class="col-xs-4">
             
          </div>
           <div class="col-xs-4">
            <a href="{{ route('respuesta', $solicitud->id) }}" class="btn btn-warning btn-block">Atender Solicitud</a>   
               
          </div>
           <div class="col-xs-4">
               
          </div>
        </div>


         </div>
    </div>
  @endif
 @endforeach 

 @else
 <div class="row">
         <div class="col-xs-12 col-md-2">
           
         </div>
         <div class="col-xs-12 col-md-8">
           <strong><h3> Por el momento no tiene solicitudes asignadas </h3></strong>
          
         </div>
         <div class="col-xs-12 col-md-2">
          
         </div>
       </div>

@endif

@endsection

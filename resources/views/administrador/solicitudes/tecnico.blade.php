@extends('layouts.tecnicos') 
<!--ponerle titulo a la paginga-->
@section('title', 'Solicitudes')
@section('cabecera', ' Solicitudes de Usuarios')

@section('content') 

  @include('../alerts.request')
  @include('../alerts.success')

@if($solicitudes != null && $solitcont > 0)

    @foreach($solicitudes as $solicitud)

    @if($solicitud->tecnico == null )    
      <form action="{{ route('tecnico..update',$solicitud->id) }}" method="POST">
    @csrf
    @method('PUT')
     <div class="row">
       <div class="form-group" style="display:none;">
                  <input class="form-control @error('tecnico') is-invalid @enderror" display="true" type="text" name="tecnico" id="tecnico" value="{{ old('tecnico', $solicitud->tecnico ??  auth()->user()->id) }}">
@error('tecnico')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        </div>
    </div>

         @include('administrador.solicitudes.show')
        <div class="row">
          <div class="col-xs-12 col-md-6">
            <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
              @php
                $dato  = \Carbon\Carbon::now()->format('Y-m-d'); 
              @endphp
              <input min="$dato" class="form-control @error('fechavisita') is-invalid @enderror" placeholder="Fecha que estara pública la imagen en el banner" type="date" name="fechavisita" id="fechavisita" value="{{ old('fechavisita', $solicitud->fechavisita ?? '') }}">
@error('fechavisita')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
          </div>
          <div class="col-xs-12 col-md-6">
            <button class="btn btn-warning btn-block" type="submit">Tomar Caso</button>
            </form>
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
           <strong><h3> Por el momento no se han generado solicitudes </h3></strong>
           <br>
           <strong><h3> Revisa las solicitudes que tienes asignadas  </h3></strong>
         </div>
         <div class="col-xs-12 col-md-2">
          
         </div>
       </div>

    @endif
    


@endsection


 @extends('layouts.admin') 
<!--ponerle titulo a la paginga-->
@section('title', 'Solicitudes')
@section('cabecera', ' Solicitudes de Usuarios')

@section('content')

  @include('../alerts.request')
  @include('../alerts.success')


@if($solicitudes != null && $solitcont > 0)

    @foreach($solicitudes as $solicitud)
 @if($solicitud->tecnico == null )
 <form action="{{ route('administrador.update',$solicitud->id) }}" method="POST">
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
          
            @if($solicitud->tecnico == null)          
            <div class ="form-group col-xs-12">
              <div class="col-xs-12 col-md-6">
                <div class="form-group">
                <label>Fecha visita:</label>

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
                <!-- /.input group -->
              </div>
              </div>
              <div class="col-xs-12 col-md-6">
                <label for="tecnico"> T&eacute;cnico:</label>
                 <select class="form-control @error('tecnico') is-invalid @enderror" name="tecnico" id="tecnico">
    <option value="">Selecione Técnico</option>
    @foreach($select as $key => $value)
        <option value="{{ $key }}" @selected(old('tecnico') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('tecnico')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
              </div>
               
            </div ><br>
            <div class=" col-xs-12" >
              <button class="btn btn-warning btn-block" type="submit">Asignar T&eacute;cnico</button>
              </form>
            </div>
            @else
            <div class="col-xs-12 col-md-12">
               <a href="#" class="btn btn-success btn-block">Tecnico Asignado</a>
            </div>
            @endif
        </div>
      </div>
    </div>
  @endif
 @endforeach 

    @else
        <div class="row">
         <div class="col-xs-12 col-md-2">
           
         </div>
         <div class="col-xs-12 col-md-8" style="text-align: center;">
           <strong><h3> Por el momento no se han generado solicitudes </h3></strong>
           <br>
           <strong><h3> Revisa las solicitudes que tienes asignadas  </h3></strong>
         </div>
         <div class="col-xs-12 col-md-2">
          
         </div>
       </div>

    @endif
@endsection




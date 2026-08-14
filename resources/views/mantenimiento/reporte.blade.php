@extends('layouts.mantenimiento')
<!--ponerle titulo a la paginga-->
@section('title', 'Control Registro De ingreso')
@section('cabecera', 'Control Registro De ingreso Desde Porter&iacute;a')

@section('content') 

<div class="container-fluid">
    <!-- Date dd/mm/yyyy -->
    <div class="form-group">
    <form action="{{ route('reporte.incidente.save',$solicitud->id) }}" method="POST">
    @csrf
    @method('PUT')
        <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-6 ">
                  <label>CATEGOR&Iacute;A:</label>
                  <div class="form-group">                              
                      <input type="text" value="{{$solicitud->categoria}}" name="categoria" class="form-control" id="idCategoria" readonly>
                    </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-6 ">
                  <label>REPORTE:</label>
                  <div class="form-group">                              
                      <input type="text" name="reporte" value="{{$solicitud->item}}" class="form-control" id="idIReporte" readonly>
                    </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 ">
                  <label>DESCRIPCI&Oacute;N:</label>
                  <div class="form-group">
                    <textarea name="textarea" value="{{$solicitud->descripcion}}" style="height: 10em;width: 100%" id="idDescripcion"readonly></textarea>
                  </div>
              </div>
              
      
          
            <div class="col-xs-12 col-sm-12 col-md-6">
                  <!-- Date -->
               <div class="form-group">
                    <label>FECHA REPORTE:</label>
                    <input type="text" name="fecha_ingreso" value="{{$solicitud->created_at}}" placeholder="Ingresa Fecha de visita" class="form-control" readonly required/>
               </div>                        
            </div>
            <div class="col-xs-12 col-sm-12 col-md-6 ">
                  <!-- Date -->
               <div class="form-group">
                    <label>ESTADO:</label>
                    <input type="text" class="form-control" value="{{$solicitud->estado}}" name="radicado" id='nProceso' readonly required/>
               </div>                        
            </div>
        
        
        <div class="col-xs-12 col-sm-12 col-md-6">
          <div class="form-group">
            <label for="trasladado">TRASLADAR A:</label><br>
            <select class="form-control @error('trasladado_a') is-invalid @enderror" name="trasladado_a" id="trasladado_a">
    <option value="">Seleccione Jefe mantenimiento</option>
    @foreach($mantenimiento as $key => $value)
        <option value="{{ $key }}" @selected(old('trasladado_a') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('trasladado_a')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>
            
          </div>
          
      </div>
      <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
          
            <label for="asignado">ASIGNAR A:</label><br>
            <select class="form-control @error('asignado_a') is-invalid @enderror" name="asignado_a" id="asignado_a">
    <option value="">Seleccione Operario Mantenimiento</option>
    @foreach($operario as $key => $value)
        <option value="{{ $key }}" @selected(old('asignado_a') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('asignado_a')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            
        </div>
        
    </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
            <label>OBSERVACIONES:</label>
                <textarea placeholder="Descripcion de la solución" class="form-control @error('observaciones') is-invalid @enderror" style="height: 10em;width: 100%" name="observaciones" id="observaciones">{{ old('observaciones', $solicitud->observaciones ?? '') }}</textarea>
@error('observaciones')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
            
        </div>

    </div>
    
  </div>
  </div>
  <div class="row">
    <div class="col-xs-3 form-group">
        <button onClick={() => this.handleRowClick(ticket)}></button>
    </div>
    <div class="col-xs-3 form-group">
        <button class="btn btn-primary btn-block" type="submit">Generar</button>
    </div>
    <div class="col-xs-3 form-group">
        <button class="btn btn-primary btn-block" type="submit">Generar</button>
    </div>
    <div class="col-xs-3 form-group">
        <a href="{{ url()->previous() }}" class="btn btn-danger btn-block">Cancelar</a>
        </form>
    </div>
    
</div>
  
  @push('scripts')
  <script>
   
  </script>
@endpush
    

 
 
@endsection



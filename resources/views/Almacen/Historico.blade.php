@extends('layouts.Almacen.Almacen')
<!--ponerle titulo a la paginga-->
@section('title', 'Almacen Noticias')
@section('cabecera', 'Historico de Solicitudes')



@section('content') 

<link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">
<div class="row justify-content-between">
    <div class="col-xs-12 col-sm-4">
        <div class="" style="text-align: ">
	      
            <nav class="navbar navbar-light bg-light">
              <form action="{{ route('almacen.Historial') }}" method="POST">
    @csrf
               <div class="col-xs-12 col-md-12 ">
                        <label for="despacho">Seleccione Despacho:</label>
                        <select class="form-control select2 @error('despacho') is-invalid @enderror" autocomplete="off" name="despacho" id="despacho">
    <option value="">Seleccione Despacho</option>
    @foreach($despachos as $key => $value)
        <option value="{{ $key }}" @selected(old('despacho', $despacho) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('despacho')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
                </div>
                <div class="col-xs-12 col-md-12 ">
                        <label for="meses">Seleccione Mes:</label>
                        <select class="form-control select2 @error('mes') is-invalid @enderror" autocomplete="off" name="mes" id="mes">
    <option value="">Seleccione Mes</option>
    @foreach($meses as $key => $value)
        <option value="{{ $key }}" @selected(old('mes', $mes) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('mes')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
                </div>
                
                <div class="col-xs-12 col-md-6 mt-3 mb-3">
                    <br>
                    <button class="form-group btn btn-success btn-block my-2 my-sm-0 shadow" type="submit">BUSCAR DESPACHO</button>
                </div>
                <div class="col-xs-12 col-md-6 ">
                    <br>
                    <a href="{!! route('almacen.Historial')!!}" class="btn btn-warning btn-block">VER TODOS</a> 
                </div>
                
              </form>
            </nav>
          </div>

    </div>
    
    <div class="col-xs-12 col-sm-6">
        <div class="" style="text-align: ">
	      
            <nav class="navbar navbar-light bg-light">
              <form action="{{ route('almacen.solicitud.Historial.excel') }}" method="POST">
    @csrf
                <div class="col-xs-12 col-md-6 ">
                        <label for="meses">Seleccione Mes:</label>
                        <select class="form-control select2 @error('mes') is-invalid @enderror" autocomplete="off" name="mes" id="mes">
    <option value="">Seleccione Mes</option>
    @foreach($meses as $key => $value)
        <option value="{{ $key }}" @selected(old('mes', $mes) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('mes')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
                </div>
                <br>
                <button class="form-group btn btn-success btn-md my-2 my-sm-0 shadow" type="submit">DESCARGAR EXCEL POR MES</button>
              </form>
            </nav>
          </div>

    </div>
    
</div>

<div id="response-message" class="alert alert-info" style="display: none;"></div>

    <hr>
<div class="table-responsive">    
<table id="table9" class="table  table-hover table-condensed table-bordered">
    <thead style="background-color: #AFAFAF; color: #fff;">
        <tr>
            <th>CODIGO DESPACHO</th>
            <th>DESPACHO</th>
            <th>NUMERO SEGUIMIENTO</th>
            <th>ELEMENTOS SOLICITADOS</th>
            <th>OBSERVACIONES</th>
            <th>GENERAR CSV</th>
        </tr>
    </thead>
    <tbody>
        @foreach($Solicitudes as $id_despacho => $despachoGroup)
            @foreach($despachoGroup as $num_seguimiento => $solicitudes)
                <tr>
                    <td>{{ $id_despacho }}</td>
                    <td>
                        {{ $solicitudes->first()->NomDespacho->nombreDespacho }} <!-- Acceder al nombre del despacho -->
                    </td>
                    <td>{{ $num_seguimiento }}</td>
                    <td>
                        <ul>
                            @foreach($solicitudes as $solicitud)
                                <li>
                                    {{ $solicitud->elemento }} - Cantidad Solicitada: {{ $solicitud->cantidad }} - Entregado: {{ $solicitud->cantidad_entregada }}
                                </li>
                            @endforeach
                        </ul>
                    </td>
                    <td >{{$solicitud->observacion_cierre}}</td>
                    <td>
                            <!-- Botón para generar CSV -->
                      <a href="{{ route('generate.csv', ['num_seguimiento' => $num_seguimiento]) }}" class="btn btn-primary btn-sm">Generar CSV</a>
                    </td>
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>
</div>
<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/Almacen4.js"></script> 


<script src="adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    
 });
</script>
 
  @push('scripts')
 
   

   @endpush
   

@endsection
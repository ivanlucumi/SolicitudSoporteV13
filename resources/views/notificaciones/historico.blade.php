@extends('layouts.notificaciones')
<!--ponerle titulo a la paginga-->
@section('title', 'Solicitud de Notificaciones')
@section('cabecera', 'NOTIFICACIONES CON OFICIO')

@section('content')


<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">

<label><input type="checkbox" onClick="toggle(this)" /> Seleccionar/Deseleccionar todos</label><br><br>

<form action="{{ route('notificaciones.excel') }}" method="POST">
    @csrf
<button class="btn btn-danger" style=" color: #fff;" type="submit">DESCARGAR EXCEL</button>

<!--<form action="{{ route('notificaciones.excel') }}" method="POST">
    @csrf
<div class="container-fluid">
    <div class="row">
        <div class="col-sx-4 col-offset-4">
            <br>

            <div class="col-xs-12 col-sm-5">
                <label for="ESTADO">ESTADO:</label>
                <select class="form-control select2 @error('estado') is-invalid @enderror" autocomplete="off" id="clase_audiencia" name="estado">
    <option value="">Seleccione Estado Notificacion</option>
    @foreach($estado as $key => $value)
        <option value="{{ $key }}" @selected(old('estado') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('estado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

            </div>
            <div class="col-xs-12 col-sm-5">
                <label for=""></label><br>
                <button class="btn btn-warning btn-lg" style=" color: #fff;" type="submit">REGISTRAR</button>
            </div>
        </div>
    </div>
</div>-->
<hr>
@if(!empty($notificaciones))
<div class="box-body">
           	<div class="row">
				 <div class="table-responsive">
					 <table id="table9" class="table table-bordered table-striped" >
                        <thead class="shadow" style="background-color: #004182; color: #fff;">
						  <tr>
						    <th></th>
						  	<th>RADICACION</th>
						    <th>OFICIO</th>
						  	<th>DELITO</th>
						    <th>AUDIENCIA</th>
						    <th>IDENTIFICACION</th>
                            <th>NOMBRES</th>
                            <th>TIPO PARTE</th>
                            <th>NOTIFICACION</th>
                            <th>DIRECCION</th>
                            <th>CIUDAD</th>
                            <th>TELEFONO</th>
                            <th>CORREO</th>
                            <th>OBSERVACIONES</th>

					      </tr>
						</thead>
						@foreach($notificaciones as $listad)
							 <tbody class="buscar">
									 <tr class="table-light">
									     <th scope="row"><input type="checkbox" class="dinamico" name="dinamico[]" value="{{$listad->id}}" ></th>
									     <th scope="row"> {{$listad->numero_radicado_proceso}} </th>
									     <th scope="row"> {{$listad->oficio}} </th>
										 <th scope="row"> {{$listad->delito}} </th>
									     <th scope="row"> {{$listad->clase_audiencia}} <br>Fecha:{{$listad->fecha_audiencia}} <br>Hora: {{$listad->hora_inicio}} <br>Lugar:{{$listad->lugar}} </th>

									     <th scope="row"> {{$listad->tipo_identificacion }}: {{$listad->identificacion}} </th>
									     <th scope="row"> {{$listad->nombre_apellido}} </th>
									     <th scope="row"> {{$listad->tipo_parte}} </th>
									     <th scope="row"> {{$listad->tipo_notificacion}} </th>
									     <th scope="row"> {{$listad->direccion}} </th>
									     <th scope="row"> {{$listad->ciudad}} </th>
									     <th scope="row"> {{$listad->telefono_citado}} </th>
									     <th scope="row"> {{$listad->correo_citado}} </th>
									     <th scope="row"> {{$listad->observaciones}} </th>


									 </tr>
								@endforeach
							 </tbody>
                             </form>

				     </table>
				  </div>
				</div>
			 </div>
@endif

<script>
    function toggle(source) {
  checkboxes = document.getElementsByClassName('dinamico');

  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }

}
</script>

<script src="/bower_components/select2/dist/js/select2.full.min.js"></script>



<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/notificacion.js"></script>


@push('scripts')



@endpush


@endsection




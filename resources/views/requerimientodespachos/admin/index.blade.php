@extends('layouts.admin')
@section('title', 'Solicitudes Despacho')
@section('cabecera', 'LISTADO SOLICITUDES')


@section('content')

<link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">



@if( auth()->user()->requerimiento=="REQUERIMIENTO" ||  auth()->user()->rol == 1)
 @if( auth()->user()->requerimiento=="REQUERIMIENTO")
<div class="container-fluid">
    <div class="row">
        <form enctype="multipart/form-data" action="{{ route('requerimientodespachos.create') }}" method="POST">
    @csrf 
        <div class="col-xs-12 col-sm-4">
                        <label for="especialidad">DESPACHO PARA REPARTO:</label>
        	        	<select class="form-control select2  @error('despacho_id') is-invalid @enderror" autocomplete="off" name="despacho_id" id="despacho_id">
    <option value="">Seleccione Despacho para Reparto</option>
    @foreach($despachos as $key => $value)
        <option value="{{ $key }}" @selected(old('despacho_id') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('despacho_id')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
        </div>
        <div class="col-xs-12 col-sm-4">
            <br>
            <button class="btn btn-success btn-block" type="submit">CREAR SOLICITUD DE DESPACHO</button>
            </form>
        </div>
    </div>
</div>
@endif
<br>
<hr>

<p>
    <center>
        <h1>
            LISTADO DE REQUERIMIENTOS
        </h1>
    </center>
</p>



	
<div class="col-xs-12 col-md-12  form-group table-responsive">
	<table id="table9" class="table table-bordered table-striped">
		<thead class="shadow" style="background-color: #004182; color: #fff;">
			<tr>
				<th>DESPACHO</th>
				<th>EMAIL</th>
				<th>ACCION</th>
			</tr>
		</thead>
		<tbody>
			@foreach($requerimientodespachos as $requerimientodespacho)

				<tr>
					<td>{{ $requerimientodespacho->nombre_despacho }}</td>
					<td>{{ $requerimientodespacho->email_despacho }}</td>

					<td>
						<div class="d-flex gap-3">
                            <form action="{{ route('requerimientodespachos.create') }}" method="POST">
    @csrf 
                            	        	<input class="form-control " autocomplete="off" type="hidden" name="despacho_id" id="despacho_id" value="{{ $requerimientodespacho->despacho_id }}"> 
                                <button class="btn btn-success btn-block" type="submit">VER</button>
                                </form>
                        </div>
					</td>
				</tr>

			@endforeach
		</tbody>
	</table>
</div>
@else

<P>
    <center>
        <strong>
            <h1>
                NO TIENE LOS PERMISOS PARA REALIZAR EL REQUERIMIENTO
            </h1>
        </strong>
    </center>
</P>



@endif
@stop

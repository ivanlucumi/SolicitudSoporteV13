@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Vista de Empleados')
@section('cabecera', 'Empleados de los juzgados Inscritos ')

@section('content') 
@include('../alerts.success')
@include('../alerts.request')

		<div class="row" style="margin-bottom: 20px;">
			<div class="col-xs-12 col-md-2" style="margin-bottom: 10px;">
				<a href="{{ url('/administrador/empleados/create') }}" class="btn btn-warning btn-block">Crear Empleado</a>     	    
			</div>
            <div class="col-xs-12 col-md-5" style="margin-bottom: 10px;">
                <div style="display: flex; gap: 10px;">
                    <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; padding: 6px 10px; font-size: 13px; color: #334155; flex: 1; text-align: center;">
                        <strong>Total:</strong> {{ number_format($empleados->total()) }}
                    </div>
                    <div style="background-color: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 6px; padding: 6px 10px; font-size: 13px; color: #004182; flex: 1; text-align: center;" title="Carnets con fotografía cargada">
                        <strong><i class="fa fa-camera"></i> Fotos:</strong> {{ number_format($totalConFoto ?? 0) }}
                    </div>
                    <div style="background-color: #eff6ff; border: 1px solid #bfdbfe; border-radius: 6px; padding: 6px 10px; font-size: 13px; color: #1e40af; flex: 1; text-align: center;" title="Dispositivos PWA enlazados exitosamente">
                        <strong><i class="fa fa-mobile"></i> Instalados:</strong> {{ number_format($totalInstalados ?? 0) }}
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-5">
                <form action="{{ route('empleados.index') }}" method="GET" class="form-inline pull-right" style="width: 100%;">
                    <div class="input-group" style="width: 100%;">
                        <input type="text" name="search" class="form-control" placeholder="Buscar por cédula, nombre, cargo o sede..." value="{{ $search ?? '' }}">
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            @if(!empty($search))
                                <a href="{{ route('empleados.index') }}" class="btn btn-default" title="Limpiar"><i class="fa fa-eraser"></i></a>
                            @endif
                        </span>
                    </div>
                </form>
            </div>
		</div>

<div class="table-responsive">
	<table class="table table-hover table-condensed table-bordered table-striped">
	    <thead style="background-color: #274a8a; color: #fff;">
		    <tr>
                <th style="width: 50px; text-align: center;"><i class="fa fa-image" title="Foto"></i></th>
		        <th>CÉDULA</th>
				<th>NOMBRE Y APELLIDO</th>
				<th>CARGO / ROL</th>
                <th>JUZGADO / DEPENDENCIA</th>
				<th>SEDE</th>
				<th style="width: 100px;">ESTADO</th>
				<th style="width: 120px;">ACCIONES</th>					     				
		    </tr>
	    </thead>
	    <tbody>
	    @if($empleados->count() > 0)
		    @foreach($empleados as $empleado)
				<tr>
                    <td class="text-center">
                        <img src="/img/carnet/{{ $empleado->foto ?: asset('img/carnet/default.png') }}" 
                             alt="Foto" 
                             style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%; border: 2px solid #e2e8f0;">
                    </td>
					<td>{{$empleado->cedulaE}}</td>
					<td>{{$empleado->nameE}} {{$empleado->lastnameE}}</td>
					<td>{{$empleado->cargo_titular}}</td>
                    <td>{{$empleado->dependencia_titular ?? $empleado->cod_despacho ?? 'N/A'}}</td>
					<td>{{$empleado->ciudad_ubicacion_laboral}}</td>
					<td class="text-center">
                        @if($empleado->estaActivo())
                            <span class="label label-success">ACTIVO</span>
                        @else
                            <span class="label label-danger">INACTIVO</span>
                        @endif
                    </td>
					<td>
						<div style="display: flex; gap: 5px; justify-content: center;">
							<a href="{{ route('empleados.edit', $empleado->id) }}" class="btn btn-primary btn-sm" title="Editar"><i class="fa fa-pencil"></i></a>
							<form action="{{ route('empleados.reset_device', $empleado->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('¿Desenlazar este carnet del dispositivo actual para permitir su instalación PWA en uno nuevo?');">
								@csrf
								<button type="submit" class="btn btn-warning btn-sm" title="Desenlazar Dispositivo PWA">
									<i class="fa fa-mobile-phone"></i>
								</button>
							</form>
							<a href="#" data-target="#modal-delete-{{$empleado->id}}" data-toggle="modal" class="btn btn-danger btn-sm" title="Eliminar"><i class="fa fa-trash"></i></a>
						</div>
					</td>					     
				</tr>	                
                @include('administrador.empleados.modaleliminar')
			@endforeach
		@else
            <tr>
                <td colspan="8" class="text-center" style="padding: 20px;">No se encontraron empleados.</td>
            </tr>
        @endif
	    </tbody>
	</table>
</div>

<div class="text-center">
    {{ $empleados->appends(request()->query())->links() }}
</div>


@endsection
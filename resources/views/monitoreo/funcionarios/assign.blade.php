@extends('layouts.monitoreo.coordinador')

@section('title', 'Asignar Puesto')
@section('cabecera', 'Asignar Puesto de Parqueo')

@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2">

    {{-- Tarjeta del Funcionario --}}
    <div class="box box-info" style="border-radius:12px; margin-bottom:20px;">
      <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-user"></i> Funcionario</h3>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-sm-6">
            <strong>Nombre:</strong> {{ $funcionario->nombre }}<br>
            <strong>Cédula:</strong> {{ $funcionario->cedula }}<br>
            <strong>Cargo:</strong> {{ $funcionario->cargo ?? '—' }}
          </div>
          <div class="col-sm-6">
            <strong>Placa:</strong> <span class="label label-info">{{ $funcionario->placa }}</span><br>
            <strong>Vehículo:</strong> {{ $funcionario->tipo_vehiculo }}<br>
            <strong>Permiso:</strong>
            @if($funcionario->tipo_ingreso == 'GLOBAL')
              <span class="label label-warning">GLOBAL</span>
            @else
              <span class="label label-default">LOCAL</span>
            @endif
          </div>
        </div>
        @if($funcionario->puesto)
        <div class="alert alert-warning" style="margin-top:10px; margin-bottom:0;">
          <i class="fa fa-exclamation-triangle"></i>
          Actualmente tiene asignado el puesto: <strong>{{ $funcionario->puesto->parqueadero }}</strong>
          ({{ $funcionario->puesto->edificio }} — {{ $funcionario->puesto->ubicacion }}).
          Al asignar otro puesto, se reemplazará.
        </div>
        @endif
      </div>
    </div>

    {{-- Formulario de asignación --}}
    <div class="box box-success" style="border-radius:12px;">
      <div class="box-header with-border">
        <h3 class="box-title"><i class="fa fa-building-o"></i> Seleccionar Puesto</h3>
      </div>

      <form action="{{ route('cooringreso.funcionarios.assign.store') }}" method="POST">
    @csrf
      <input type="hidden" name="funcionario_id" id="funcionario_id" value="{{ $funcionario->id }}">
      <div class="box-body" style="padding:25px;">

        <div class="form-group">
          <label>Puesto de Parqueo Disponible: <span class="text-danger">*</span></label>
          <select name="puesto_id" class="form-control" required>
            <option value="">— Seleccione un puesto —</option>
            @foreach($puestos as $p)
              <option value="{{ $p->id }}"
                {{ $funcionario->puesto && $funcionario->puesto->id == $p->id ? 'selected' : '' }}>
                {{ $p->parqueadero }} — {{ $p->edificio }} / {{ $p->ubicacion }}
                ({{ $p->estado }})
                @if($p->asignaciones->count() > 0)
                  · {{ $p->asignaciones->count() }} asignado(s)
                @endif
              </option>
            @endforeach
          </select>
          <span class="help-block">Un puesto puede tener varios funcionarios asignados.</span>
        </div>

      </div>
      <div class="box-footer">
        <button type="submit" class="btn btn-success btn-lg">
          <i class="fa fa-check"></i> Confirmar Asignación
        </button>
        <a href="{{ route('cooringreso.funcionarios.index') }}" class="btn btn-default btn-lg pull-right">
          Cancelar
        </a>
      </div>
      </form>
    </div>

  </div>
</div>
@endsection

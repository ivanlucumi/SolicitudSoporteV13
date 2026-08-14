@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Nuevo Registro de Ingreso</h2>
        <form method="POST" action="{{ route('police-entries.store') }}">
            @csrf
            <div class="form-group">
                <label for="fecha_ingreso">Fecha de Ingreso</label>
                <input type="date" name="fecha_ingreso" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="cedula">Cédula</label>
                <input type="text" name="cedula" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="hora_ingreso">Hora de Ingreso</label>
                <input type="time" name="hora_ingreso" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="hora_salida">Hora de Salida (opcional)</label>
                <input type="time" name="hora_salida" class="form-control">
            </div>
            <div class="form-group">
                <label for="observaciones">Observaciones</label>
                <textarea name="observaciones" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>
@endsection
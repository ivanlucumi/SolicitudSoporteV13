@extends('layouts.monitoreo.monitoreo')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="glyphicon glyphicon-plus"></i> Registrar Nueva Novedad
                    </h3>
                </div>
                <div class="panel-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <strong>¡Error!</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('notificaciones.store') }}" method="POST">
                        @csrf
                        
                        <div class="form-group">
                            <label for="usuario">
                                <i class="glyphicon glyphicon-user"></i> Usuario *
                            </label>
                            <input type="text" 
                                   class="form-control" 
                                   id="usuario" 
                                   name="usuario" 
                                   value="{{ old('usuario') }}" 
                                   placeholder="Nombre del usuario"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="ciudad">
                                <i class="glyphicon glyphicon-map-marker"></i> Ciudad *
                            </label>
                            <input type="text" 
                                   class="form-control" 
                                   id="ciudad" 
                                   name="ciudad" 
                                   value="{{ old('ciudad') }}" 
                                   placeholder="Ciudad"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="edificio">
                                <i class="glyphicon glyphicon-home"></i> Edificio *
                            </label>
                            <input type="text" 
                                   class="form-control" 
                                   id="edificio" 
                                   name="edificio" 
                                   value="{{ old('edificio') }}" 
                                   placeholder="Nombre del edificio"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="direccion">
                                <i class="glyphicon glyphicon-road"></i> Dirección *
                            </label>
                            <input type="text" 
                                   class="form-control" 
                                   id="direccion" 
                                   name="direccion" 
                                   value="{{ old('direccion') }}" 
                                   placeholder="Dirección completa"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="descripcion">
                                <i class="glyphicon glyphicon-pencil"></i> Descripción *
                            </label>
                            <textarea class="form-control" 
                                      id="descripcion" 
                                      name="descripcion" 
                                      rows="5" 
                                      placeholder="Describe la novedad..."
                                      required>{{ old('descripcion') }}</textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                <i class="glyphicon glyphicon-send"></i> Registrar Novedad
                            </button>
                            <a href="{{ route('notificaciones.index') }}" class="btn btn-default btn-lg btn-block">
                                <i class="glyphicon glyphicon-arrow-left"></i> Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
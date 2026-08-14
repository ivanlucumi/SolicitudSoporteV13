@extends('layouts.admin')

@section('title', 'Banner')
@section('cabecera', 'Crear Imagen Banner')

@section('content') 
    @include('../alerts.request')

    <form action="{{ route('banner.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-xs-6">
                <div class="form-group">
                    <label for="bNombre" class="fa fa-asterisk"> Descripción Noticia:</label>
                    <input type="text" name="bNombre" id="bNombre" class="form-control" placeholder="Ingrese la descripción de la noticia" required>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label for="bFoto" class="fa fa-asterisk"> Imagen Banner 1140x421:</label>
                    <input type="file" name="bFoto" id="bFoto" class="form-control" accept=".jpeg,.png,.jpg" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6">
                <div class="form-group">
                    <label for="bLink">URL página:</label>
                    <input type="text" name="bLink" id="bLink" class="form-control" placeholder="url página a redireccionar ej: www.google.com">
                </div>
            </div>
           <div class="col-xs-6">
                <div class="form-group">
                    <label for="bTiempo">Seleccione días para la publicación:</label>
            
                    @if( auth()->check() &&  auth()->user()->email == 'gmstdesajvalle3@cendoj.ramajudicial.gov.co' ||  auth()->user()->email == 'gmstdesajvalle@cendoj.ramajudicial.gov.co')
                        <input type="number"
                               name="bTiempo"
                               id="bTiempo"
                               class="form-control"
                               min="1"
                               max="365"
                               placeholder="Ingrese cantidad de días"
                               required>
                    @else
                        <select name="bTiempo" id="bTiempo" class="form-control" required>
                            <option value="">Seleccione Cantidad de Días</option>
                            <option value="2">2 Días</option>
                            <option value="3">3 Días</option>
                            <option value="5">5 Días</option>
                        </select>
                    @endif
            
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6">
                <div class="form-group">
                    <label for="bEstado" class="fa fa-asterisk"> Estado Publicación:</label>
                    <select name="bEstado" id="bEstado" class="form-control">
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label for="bCreador">Persona que Crea el Recurso:</label>
                    <input type="text" name="bCreador" id="bCreador" class="form-control" value="{{  auth()->user()->name }}" readonly>
                </div>
            </div>
            <div class="col-xs-6">
                <div class="form-group">
                    <label for="documento">Generar Link Documento:</label>
                    <input type="file" name="documento" id="documento" class="form-control-file">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6">
                <button type="submit" class="btn btn-primary btn-block">Guardar Imagen Banner</button>
            </div>
            <div class="col-xs-6">
                <a href="{{ url()->previous() }}" class="btn btn-danger btn-block">Cancelar</a>
            </div>
        </div>
    </form>
@endsection

@extends('layouts.admin')

@section('title', 'Banner')
@section('cabecera', 'Editar Información de Imagen del Banner')

@section('content') 
@include('../alerts.request')

<form action="{{ route('banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
<div class="container">
    <div class="row">
        <div class="col-xs-12 text-center">
            <h4><strong>CREADO EL {{ $banner->created_at->format('d/m/Y H:i') }}</strong></h4>
        </div>
        <div class="col-xs-12 text-center">
            <div class="thumbnail" style="max-width: 100%; padding: 10px;">
                <img src="/img/{{ $banner->bFoto }}" alt="Imagen del Banner" class="img-responsive center-block" style="max-height: 400px; object-fit: contain;">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6">
            <div class="form-group">
                <label for="bNombre">Descripción Noticia:</label>
                <input class="form-control @error('bNombre') is-invalid @enderror" placeholder="Ingrese la descripción de la noticia" type="text" name="bNombre" id="bNombre" value="{{ old('bNombre', $banner->bNombre ?? '') }}">
@error('bNombre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
        </div>
        <div class="col-xs-6">
            <div class="form-group">
                <label for="bFoto">Imagen del Banner (1140x421):</label>
                <input class="form-control @error('bFoto') is-invalid @enderror" accept=".jpeg,.png,.jpg" type="file" name="bFoto" id="bFoto">
@error('bFoto')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6">
            <div class="form-group">
                <label for="bLink">URL de Redirección:</label>
                <input class="form-control @error('bLink') is-invalid @enderror" placeholder="Ej: www.google.com" type="text" name="bLink" id="bLink" value="{{ old('bLink', $banner->bLink ?? '') }}">
@error('bLink')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
        </div>
        {{-- Puedes habilitar esta parte si deseas manejar tiempo de publicación --}}
        {{--
        <div class="col-xs-6">
            <div class="form-group">
                <label for="bTiempo">Tiempo de Publicación:</label>
                <input class="form-control @error('bTiempo') is-invalid @enderror" type="date" name="bTiempo" id="bTiempo" value="{{ old('bTiempo', $banner->bTiempo ?? $fechademas) }}">
@error('bTiempo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
        </div>
        --}}
    </div>

    <div class="row">
        <div class="col-xs-6">
            <div class="form-group">
                <label for="bEstado">Estado de Publicación:</label>
                <select class="form-control @error('bEstado') is-invalid @enderror" name="bEstado" id="bEstado">
    @foreach(['1' => 'Activo', '0' => 'Inactivo'] as $key => $value)
        <option value="{{ $key }}" @selected(old('bEstado') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('bEstado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
        </div>
        <div class="col-xs-6">
            <div class="form-group">
                <label for="bModificador">Persona que Modifica:</label>
                <input class="form-control @error('bModificador') is-invalid @enderror" type="text" name="bModificador" id="bModificador" value="{{ old('bModificador', $banner->bModificador ??  auth()->user()->name) }}">
@error('bModificador')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-6">
            <button class="btn btn-primary btn-block" type="submit">Actualizar Información</button>
        </div>
        <div class="col-xs-6">
            <a href="{!! url()->previous() !!}" class="btn btn-danger btn-block">Cancelar</a>
        </div>
    </div>
</div>

</form>
@endsection

@extends('layouts.Almacen.Almacen')
<!--ponerle titulo a la paginga-->
@section('title', 'Carga Elementos')
@section('cabecera', 'Carga Elementos')



@section('content') 

@section('content')
<div class="container">
    <h3>Cargar Inventario desde Excel</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('inventario.importar') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="archivo">Seleccione archivo Excel:</label>
            <input type="file" name="archivo" class="form-control" required>
        </div>
        <button class="btn btn-primary">Importar Inventario</button>
    </form>
</div>
@endsection

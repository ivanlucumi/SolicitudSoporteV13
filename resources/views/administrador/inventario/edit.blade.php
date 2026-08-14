@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Inventario')
@section('cabecera', 'Editar Inventario')

@section('content') 
@include('alerts.request')
<form action="{{ route('inventarios.update',$inventario->id) }}" method="POST">
    @csrf
    @method('PUT')
     @include('administrador.inventario.form.form')                                                                       
                       

 <button class="btn btn-danger" type="submit">Registrar Inventario</button>
</form>



@endsection
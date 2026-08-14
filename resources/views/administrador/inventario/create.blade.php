@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Inventario')
@section('cabecera', 'Registrar Inventario')

@section('content') 

<form action="{{ route('inventarios.store') }}" method="POST">
    @csrf
     @include('administrador.inventario.form.form')                                                                       
                       

 <button class="btn btn-danger" type="submit">Registrar Inventario</button>
</form>



@endsection
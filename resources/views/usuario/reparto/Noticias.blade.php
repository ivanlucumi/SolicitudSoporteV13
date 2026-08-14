@extends('layouts.reparto')
<!--ponerle titulo a la paginga-->
@section('title', 'Noticias Siriscali')
@section('cabecera', 'Sección de Noticias')

@section('content') 

@include('usuario.datosNoticias')

@endsection
@extends('layouts.admin')

@section('title', 'Crear contrato')
@section('cabecera', 'Crear Contrato / Orden de Compra')

@section('content')
@include('../alerts.success')
@include('../alerts.request')

@include('administrador.Contratos._form')


@endsection
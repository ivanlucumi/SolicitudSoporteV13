@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Siniestro')
@section('cabecera', 'Siniestro Reportado')

@section('content') 

@include('../alerts.success')
@include('../alerts.request')


@include('administrador.siniestros.formEdit')


<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>


@endsection


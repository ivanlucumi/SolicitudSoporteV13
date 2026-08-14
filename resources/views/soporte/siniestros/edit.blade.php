@extends('layouts.soporte')
<!--ponerle titulo a la paginga-->
@section('title', 'Siniestros')
@section('cabecera', 'Siniestros Reportados')

@section('content') 

@include('../alerts.success')
@include('../alerts.request')

@include('administrador.siniestros.formEdit')

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/FilterOnceSiniestro.js"></script> 


@endsection
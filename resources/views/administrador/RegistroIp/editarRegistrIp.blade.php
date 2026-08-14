@extends('layouts.admin')
<!--ponerle titulo a la paginga-->
@section('title', 'Tecnicos de Soporte')
@section('cabecera', 'Editar Registro IP')

@section('content') 

@include('soporte.cuerpos.editarRegistrIp')

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/registroIp.js"></script> 


@endsection
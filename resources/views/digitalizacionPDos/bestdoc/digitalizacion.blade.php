@extends('layouts.digitalizacion.digitalizacion')
<!--ponerle titulo a la paginga-->
@section('title', 'Registro de Carga a Bestdoc')
@section('cabecera', 'Listado de Expedientes para Migrar')



@section('content') 

@include('digitalizacionPDos.bestdoc.index')


<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>  
<script src="/js/filterCincoBestdoc.js"></script> 


@endsection
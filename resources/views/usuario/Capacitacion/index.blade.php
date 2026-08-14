@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Capacitacion Gestor Documental')
@section('cabecera', 'Registro Jornada Capacitacion SGDE')

@section('content') 
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">

  @include('usuario.Capacitacion.form')
   
  
  
  
  
  @push('scripts')

    
 <!-- Llamar a los complementos javascript>

<script src="/js/exportTabla/jquery-1.12.4.min.j"></script>
<script src="/js/exportTabla/FileSaver.min.js"></script>
<script src="/js/exportTabla/Blob.min.js"></script>
<script src="/js/exportTabla/xls.core.min.js"></script>
<script src="/js/exportTabla/js/tableexport.js"></script>

<script>
$("table").tableExport({
   formats: ["xlsx"], //Tipo de archivos a exportar ("xlsx","txt", "csv", "xls")
   position: 'top',  // Posicion que se muestran los botones puedes ser: (top, bottom)
   bootstrap: true,//Usar lo estilos de css de bootstrap para los botones (true, false)
   fileName: "Solicitud De capacitacion",    //Nombre del archivo 
});

</script-->
  
 
  @endpush


@endsection
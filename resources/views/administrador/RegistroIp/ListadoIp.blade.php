@extends('layouts.admin')

<!--ponerle titulo a la paginga-->
@section('title', 'Listado de IP admin')
@section('cabecera', 'IP Usadas')

@section('content') 
<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">

@include('soporte.cuerpos.ListadoIp')


<script src="/bower_components/select2/dist/js/select2.full.min.js"></script>
  


<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/registroIp.js"></script> 

<script>
 $(function () {            
        
                
                /* setting time */
                $("#timepicker").datetimepicker({
                    format : "HH:mm"
                });
                /* setting time */
                $("#timepicker2").datetimepicker({
                    format : "HH:mm"
                });
                
                 //Initialize Select2 Elements
                $('.select2').select2()
            
                //Initialize Select2 Elements
                $('.select2bs4').select2({
                  theme: 'bootstrap4'
                })
                
              
                
            }); 
</script>

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
	fileName: "Registro Ip",    //Nombre del archivo 
});

</script>

@endsection
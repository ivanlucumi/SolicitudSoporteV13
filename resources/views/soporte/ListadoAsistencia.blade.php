@extends('layouts.soporte')	
 @section('title', 'Listado Regsitro de Asistencia')

<!--ponerle titulo a la paginga-->

@section('cabecera', 'Listado Asistencia')

@section('content') 
<style>
    
#lista{
    font-size: 18;
}

/* #box{
   
    width: 180px;
} */

#imagen{
    display: flex;
    justify-content: center;
    height: 150px;
   
}


</style>
 <div class="container-fluid">

 <h1>Registro de Asistencia</h1>
   

 <div id="imagen">
            <img src="/img/logoAsistencia.png" id = imagen>
 </div>
 
 <center><h2 class="mt-4">Historial de Asistencia</h2></center>
 <hr>
   <div class="col-xs-12 col-md-12  form-group table-responsive">
      <table  id="table9" class="table table-bordered table-striped">
        <thead class="shadow" style="background-color: #004182; color: #fff;">
        	<tr> 
        	    <td>USUARIO</td>
        	    <td>SEDE</td>
                <td>FECHA</td>
                <td>HORA INGRESO</td>
                <td>HORA SALIDA</td>
                <td>OBSERVACIONES</td>
                </tr>
            </thead> 
            @if($listado != null)
             @foreach($listado as $asistencia)
                <tbody data-id="{!!$asistencia->id!!}">
                <tr >
                 <td>{{$asistencia->usuario->cedula}} {{$asistencia->usuario->name}} {{$asistencia->usuario->lastname}} </td>
                 <td>{{$asistencia->sede}} </td>
                 <td>{{$asistencia->fecha_registro}} </td>
                 <td>{{$asistencia->hora_ingreso}}</td>
                 <td>{{$asistencia->hora_salida}} </td>
                 <td>{{$asistencia->observaciones}}</td>
                </tr>
                </tbody>
            @endforeach
          @endif 
           
        </table>
     </div>
   
   
    
    
</div>


<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/registroIp.js"></script> 


<script src="/js/exportTabla/jquery-1.12.4.min.j"></script>
<script src="/js/exportTabla/FileSaver.min.js"></script>
<script src="/js/exportTabla/Blob.min.js"></script>
<script src="/js/exportTabla/xls.core.min.js"></script>
<script src="/js/exportTabla/js/tableexport.js"></script>


  
@endsection
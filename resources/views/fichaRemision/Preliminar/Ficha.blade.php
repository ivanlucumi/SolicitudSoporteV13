@extends('layouts.Ficha.Ficha')
<!--ponerle titulo a la paginga-->
@section('title', 'Ficha Preliminar')
@section('cabecera', 'Ficha Preliminar')
@section('content') 
<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">

 
    <hr>
        
    <input type="button" align="right" value="Clic para Actualizar si no borra" onclick="location.reload()" 
        style="font-family:Arial;font-size:10pt;width:200px;height:30px;
        background:#777777;color:#fff444;cursor:pointer; float: right;"/>

    <div class="col-xs-12 col-md-12  form-group table-responsive">
      <table  id="table9" class="table table-bordered table-striped">
        <thead class="shadow" style="background-color: #004182; color: #fff;">
        	<tr>    
                <td>RADICACION</td>
                <td>PROCESADO</td>
                <td>TIPO SOLICITUD</td>
                <td>ANEXOS</td>
                <td>REMITE</td>
                <td>REMITENTE</td>
                <td>FECHA SOLICITUD</td>
                <td>ACCI&Oacute;N</td>
                </tr>
            </thead> 
            @if($fichas != null)
             @foreach($fichas as $ficha)
                <tbody data-id="{!!$ficha->id!!}">
                <tr @if($ficha->id_usuario_atiende ==  auth()->user()->id)
                <?php echo 'style="background-color: #BCFFC5"'; ?>
                @endif
                @if(empty($ficha->id_usuario_atiende))
                <?php echo 'style="background-color: #"'; ?>
                @endif
                @if($ficha->id_usuario_atiende !=  auth()->user()->id)
                <?php echo 'style="background-color: #FDCED3"'; ?>
                @endif>
                 <td>{{$ficha->numero_radicado_proceso}}</td>
                 <td>{{$ficha->procesado}} </td>
                 <td>{{$ficha->tipo_solicitud}}</td>
                 <td><a onClick="window.open('/fichaPreliminar/{{$ficha->anexos}}','popup', 'width=800px,height=600px')">ANEXO</a><br>
                     </td>
                 <td>{{$ficha->despacho_remite}}</td>
                 <td>{{$ficha->cedula_quien_solicita}}<br> {{$ficha->quien_solicita}} <br> {{$ficha->email_notificacion}}</td>
                 <td>{{$ficha->fecha_solicitud}}</td>
                 <td>
                      @if($ficha->user_id ==  auth()->user()->id || empty($ficha->user_id))
                     <div class="row">
                         <div class="col-xs-12 col-sm-6">
                             
                              <a href="{{ route('adminfichas.reporte.solicitud', $ficha->id) }}" class="btn btn-warning btn-md btn-block active fa fa-eye" title="VER SOLICITUD"></a>
                         </div>
                         <div class="col-xs-12 col-sm-6">
                              <a  class="btn btn-success  active cambiar-tipo btn-sm " id="{{ $ficha->id }}"
                                    data-toggle="modal" href="#modal-entregar" data-id="{{$ficha->id}}"
                                    data-expediente="{{$ficha->numero_radicado_proceso}}" data-target="#myModal" title="TRASLADAR TIPO SOLICITUD" > <i class="fa fa-exchange  trasladar"></i>
                                </a>
                         </div>
                     </div>
                    @else
                    <a href="#" class="btn btn-danger ">EN PROCESO</a>
                    @endif
                 </td>
                </tr>
                </tbody>
            @endforeach
          @endif 
           
        </table>
     </div>
    
     
    @include('fichaRemision.Preliminar.ModalCambiarTipo') 

    
    
    <form id="form-revocar-Registro" action="{{ route('usuario.revocar.trabajo.remoto',':REGISTRO_ID') }}" method="POST">
    @csrf
    @method('PUT')
    </form>
    
    
  
   <script src="/js/jquery.js"></script>
  <script src="/tablefilter/tablefilter.js"></script>
  <script src="/js/filterFichaPre.js"></script>

<script>
$(document).ready(function () {
    $('.cambiar-tipo').click(function () {
        // Obtener los valores de los atributos data del botón
        var id = $(this).data('id');
        var expediente = $(this).data('expediente');

        // Asignar los valores a los elementos del modal innerHTML = name
      
        
        document.getElementById("expediente").innerHTML=expediente;
        $('#id').val(id);
        // Abrir el modal
        $('#modal-cambiar-tipo').modal('show');
    });
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
	fileName: "Solicitudes",    //Nombre del archivo 
});

</script> 
  @push('scripts')
  @endpush
   

@endsection
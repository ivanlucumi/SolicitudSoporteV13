@extends('layouts.Ficha.Ficha')
<!--ponerle titulo a la paginga-->
@section('title', 'HISTORICO')
@section('cabecera', 'HISTORICO')
@section('content') 

<link rel="stylesheet" href="/js/exportTabla/css/tableexport.css">
@if( auth()->user()->email == "avargasmo@cendoj.ramajudicial.gov.co")
    <div class="col-xs-12 col-sm-2">
         <div class="" style="text-align: left">	
        	<a href="{!! route('adminfichas.historico.cerrado')!!}" class="btn btn-danger " >VER TODO 0</a>
        </div>
    </div>
 @endif   
    
    <hr>
    
     <div class="col-xs-12 col-sm-10">
        <div class="" style="text-align: left">

            <nav class="navbar navbar-light bg-light">
              <form action="{{ route('adminfichas.historico.cerrado') }}" method="POST">
    @csrf
                <input class="form-group mr-sm-2 shadow @error('radicado') is-invalid @enderror" placeholder="Buscar Por Radicado" autocomplete="off" aria-label="Search" type="number" name="radicado" id="radicado" value="{{ old('radicado') }}">
@error('radicado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                <input class="form-group mr-sm-2 shadow @error('procesado') is-invalid @enderror" placeholder="Buscar Por Nombre Procesado" autocomplete="off" aria-label="Search" type="text" name="procesado" id="procesado" value="{{ old('procesado') }}">
@error('procesado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                <input class="form-group mr-sm-2 shadow @error('fecha_reparto') is-invalid @enderror" placeholder="Buscar Por Fecha Reparto" autocomplete="off" aria-label="Search" type="date" name="fecha_reparto" id="fecha_reparto" value="{{ old('fecha_reparto') }}">
@error('fecha_reparto')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                <button class="form-group btn btn-warning my-2 my-sm-0 shadow" type="submit">BUSCAR EXPEDIENTE</button>
              </form>
            </nav>
          </div>
    </div>   

    <div class="col-xs-12 col-md-12  form-group table-responsive">
      <table  id="table9" class="table table-bordered table-striped">
        <thead class="shadow" style="background-color: #004182; color: #fff;">
        	<tr> 
        	
                <td>FECHA REMISION</td>
                <td>RADICACION</td>
                <td>PROCESADO</td>
                <td>TIPO SOLICITUD</td>
                <td>DOCUMENTOS</td>
                <td>REMITE</td>
                <td>REMITENTE</td>
                <td>FECHA SOLICITUD</td>
                <td>REPARTO</td>
                <td>OBSERVACIONES</td>
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
                
                 <td>{{$ficha->fecha_reparto}} </td>
                 <td>{{$ficha->numero_radicado_proceso}}</td>
                 <td>{{$ficha->procesado}} </td>
                 <td>{{$ficha->tipo_solicitud}}</td>
                 <td>
                    
                     <a onClick="window.open('/fichaPreliminar/{{$ficha->anexos}}','popup', 'width=800px,height=600px')">ANEXO</a><br>
                      @if(!empty($ficha->acta_reparto))
                     <a onClick="window.open('/fichaPreliminar/{{$ficha->acta_reparto}}','popup', 'width=800px,height=600px')">ACTA DE REPARTO</a>
                     @endif
                 </td>
                 <td>{{$ficha->despacho_remite}}</td>
                 <td>{{$ficha->cedula_quien_solicita}}<br> {{$ficha->quien_solicita}}<br> {{$ficha->email_notificacion}}<br> {{$ficha->telefono}} </td>
                 <td>{{$ficha->fecha_solicitud}} </td>
                 <td>{{$ficha->despacho_reparto}} </td>
                 <td>{{$ficha->observaciones_reparto}} </td>
                
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
  <script src="/js/filterFichaH.js"></script>

<script>
$(document).ready(function () {
    $('.cambiar-tipo').click(function () {
        // Obtener los valores de los atributos data del bot贸n
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
	fileName: "Historico Registros",    //Nombre del archivo 
});

</script>   
  @push('scripts')
  @endpush
   

@endsection
@extends('layouts.reparto')
<!--ponerle titulo a la paginga-->
@section('title', 'Ficha Remision')
@section('cabecera', 'Ficha Remision')
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
                <td>DESPACHO</td>
                <td>MOTIVO REMISION</td>
                <td>RADICADO</td>
                <td>GR REAPRTO</td>
                <td>DEMANDANTE</td>
                <td>DEMANDADO</td>
                <td>CONOCIMINETO PREVIO</td>
                <td>FICHA REMISION</td>
                <td>URL</td>
                <td>FECHA</td>
                <td>ACCI&Oacute;N</td>
                </tr>
            </thead> 
            @if($fichas != null)
             @foreach($fichas as $ficha)
                <tbody data-id="{!!$ficha->id!!}">
                <tr @if($ficha->user_id ==  auth()->user()->id)
                <?php echo 'style="background-color: #BCFFC5"'; ?>
                @endif
                @if(empty($ficha->user_id))
                <?php echo 'style="background-color: #"'; ?>
                @endif
                @if($ficha->user_id !=  auth()->user()->id)
                <?php echo 'style="background-color: #FDCED3"'; ?>
                @endif>
                 <td>{{$ficha->despacho_remite}}</td>
                 <td>{{$ficha->m_remision}} <br>{{$ficha->especialidad}} </td>
                 <td>{{$ficha->numero_radicado_proceso}}</td>
                 
                 <td>{{$ficha->gr_reparto}}</td>
                 <td>{{$ficha->demandante}}</td>
                 <td>{{$ficha->demandado}}</td>
                 <td>{{$ficha->concocimiento_pre}}</td>
                 <td><a href="{{ route('reparto.ficha.remision.descarga', $ficha->id) }}" class="btn btn-success btn-xs btn-block" title="VER FICHA REMISION">VER DOCUMENTO</a></td>
                 <td><a href="{{$ficha->url_expediente}}" target="_blank">Url Expediente</a> </td>
                 <td>{{$ficha->hora_remision}}</td>
                 <td COLSPAN="3">
                    @if($ficha->user_id ==  auth()->user()->id || empty($ficha->user_id))
                    <a href="{{ route('reparto.responder.remision', $ficha->id) }}" class="btn btn-primary btn-xs btn-block" title="FICHA">VER FICHA REMISION</a>
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
    
     
     

    
    
    <form id="form-revocar-Registro" action="{{ route('usuario.revocar.trabajo.remoto',':REGISTRO_ID') }}" method="POST">
    @csrf
    @method('PUT')
    </form>
    
    
  
   <script src="/js/jquery.js"></script>
  <script src="/tablefilter/tablefilter.js"></script>
  <script src="/js/filterDiezFicha.js"></script>

   
  @push('scripts')
  @endpush
   

@endsection
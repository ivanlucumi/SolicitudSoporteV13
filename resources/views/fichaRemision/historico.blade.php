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
                <td>ASIGNADO A</td>
                <td>DOCUMENTOS</td>
                <td>FECHA</td>
                </tr>
            </thead> 
            @if($fichas != null)
             @foreach($fichas as $ficha)
                <tbody data-id="{!!$ficha->id!!}">
                <tr>
                 <td>{{$ficha->despacho_remite}}</td>
                 <td>{{$ficha->m_remision}} <br>{{$ficha->especialidad}} </td>
                 <td>{{$ficha->numero_radicado_proceso}}</td>
                 
                 <td>{{$ficha->gr_reparto}}</td>
                 <td>{{$ficha->demandante}}</td>
                 <td>{{$ficha->demandado}}</td>
                 <td>{{$ficha->concocimiento_pre}}</td>
                 <td><a href="{{ route('reparto.ficha.remision.descarga', $ficha->id) }}" class="btn btn-success btn-xs btn-block" title="VER FICHA REMISION">VER DOCUMENTO</a></td>
                 <td>{{$ficha->despacho_corresponde}}</td>
                 <td>
                    <a onClick="window.open('/fichaRemision/{{$ficha->acta_reparto}}','popup', 'width=800px,height=600px')">ACTA REPARTO</a> <br>
                    @if(!empty($ficha->consulta))
                    <a onClick="window.open('/fichaRemision/{{$ficha->consulta}}','popup', 'width=800px,height=600px')">ACTA REPARTO</a> 
                    @endif
                 </td>
                 <td>{{$ficha->updated_at}}</td>
                 
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
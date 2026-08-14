
 
<div class="panel panel-warning">
  <div class="panel-heading">
    <h3 class="panel-title"><strong style="font-size:30px">DESPACHO:  {{strtoupper($solicitud->despachoSoli->nombreDespacho)}}</strong></h3>
    <h3 style="color: red; text-align: left;">Prioridad: <strong>{{$solicitud->AtSoli->prioridad}}</strong>
      <br>Tiempo atenci&oacute;n {{$solicitud->AtSoli->maximoD}} dias</h3>
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-xs-4">
        <div class="col-xs-6 col-md-6">
          SOLICIT&Oacute;:
        </div>
        <div class="col-xs-12 col-md-6 estiloShow">
          <!-- se llama el metodo categoriaSoli que esta en el modelo de SolicitudUsuario para que me traiga el dato de la el usuario. -->
          {{$solicitud->usuarioSoli->name}} 
          {{$solicitud->usuarioSoli->lastname}}  
        </div>
      </div>
      <div class="col-xs-4 ">
        <div class="col-xs-12 col-md-6">
          EDIFICIO:
        </div>
        <div class="col-xs-12 col-md-6 estiloShow">
          {{strtoupper($solicitud->edificio)}}
        </div>
      </div>
      <div class="col-xs-4">
        <div class="col-xs-12 col-md-6">
          REQUERIMIENTO:
        </div>
        <div class="col-xs-12 col-md-6 estiloShow">
          <!-- se llama el metodo categoriaSoli que esta en el modelo de SolicitudUsuario para que me traiga el dato de la requerimiento. -->
          {{strtoupper($solicitud->requerimientoSoli->nombreRequerimiento)}}
        </div>
      </div>
      
    </div>
<hr>
    <div class="row">
      <div class="col-xs-12 col-md-6">
        <div class="col-xs-12 col-md-4">
          CATEGORIA:
        </div>
        <div class="col-xs-12 col-md-8 estiloShow">
          <!-- se llama el metodo categoriaSoli que esta en el modelo de SolicitudUsuario para que me traiga el dato de la categoria. -->
          {{strtoupper($solicitud->categoriaSoli->descripcioncategoria)}}
        </div>
      </div>
       <div class="col-xs-12 col-md-6">
        <div class="col-xs-12 col-md-6">
          ELEMENTO:
        </div>
        <div class="col-xs-12 col-md-6 estiloShow">
          {!! $solicitud->elementosSoli->pluck('nombreElemento')->implode(', <br>  ')!!}
        </div>
      </div>
           
    </div>

<hr>
    <div class="row">
      <div class="col-xs-12">
         <div class="col-xs-12 col-md-3">
        DESCRIPCION:
        
      </div>
      <div class="col-xs-12 col-md-3 estiloShow">
        {{strtoupper($solicitud->descripcion)}}
        
      </div>
      </div>
           
    </div>
    
    <hr>
    
    
    



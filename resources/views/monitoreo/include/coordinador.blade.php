<div class="row">
    <div id="content" class="col-lg-12" style="text-align: right; border:radius">
        <span>Personas En el edificio: </span><br>
        
        <span><strong><h3>{{Carbon\carbon::now()->todateString()}}</h3></strong> </span>
        <h1><span id="value">0</span></h1> 
    </div>
</div>

<div class="row">
    <div class="col-xs-12 col-sm-3">
        <div class="container">
        <div class="" style="text-align: left">
            <nav class="navbar navbar-light bg-light">
              
               <input class="form-group mr-sm-2 shadow" alt="Ingresa Cedula para consultar" name="cedula" type="number"  placeholder="Buscar por Cedula" aria-label="Search" id="cedulaIngreso" required autofocus autocomplete="off">
                
                <a href="#" class="btn btn-success btn-sm 
                                    fa fa-plus-square" id="Bcedula" title="Confirmar Temperatura 1"> Buscar</a>
              
            </nav>
          </div>
            
        </div>
    </div>
</div>
<hr>


<div class="table-responsive">
    <table id="table9" class="table  table-hover table-condensed table-bordered ">
    
    </div>	
        <thead style="background-color: #004182; color: #fff;">
            <tr>
                <th>IDENTIFICACI&Oacute;N</th>
                <th>NOMBRE</th>
                <th>PARQUEADERO</th>
                <th>PLACA</th>
                <th>T. VEHICULO</th>
                <th>FECHA DE INGRESO</th>
                <th>HORA INGRESO</th>
                <th>DESPACHO</th>
                <th>RADICADO</th>
                <th>PORTER&Iacute;A / CIUDAD</th>
                <th>SOLICITUD</th>            
                <th>ESTADO</th>           
                <th>ACCION</th>
            </tr>
        </thead>
    @if($ingresos != null)
            @foreach($ingresos as $ingreso)
            <tbody class="buscar" data-id="{!!$ingreso->id!!}" >
                <tr class="table-light" style = "@if($ingreso->ingreso != null)
                background-color: #F5A9A9;@endif">
                    <th scope="row">{{$ingreso->identificacion}}</th>									
                    <th scope="row">{{$ingreso->fullname}}</th>									
                    <th scope="row">{{isset($ingreso->parqueado->no_parqueadero)? $ingreso->parqueado->no_parqueadero : "SIN PERMISO"}}</th>	
                    <th scope="row">{{isset($ingreso->parqueado->placa)? $ingreso->parqueado->placa : "N/A" }}</th>
                    <th scope="row">{{isset($ingreso->parqueado->tipo_vehiculo) ? $ingreso->parqueado->tipo_vehiculo : "N/A" }}</th>
                    <th scope="row">{{$ingreso->fecha_ingreso}}</th>
                    <th scope="row">{{$ingreso->hora_ingreso}}</th>									
                    <th scope="row">{{$ingreso->despacho}}</th>
                    <th scope="row">{{$ingreso->radicado}}</th>
                    <th scope="row">
                        <small>{{$ingreso->porteria}}</small>
                        @if($ingreso->ciudad)
                            <br><span class="label label-default">{{$ingreso->ciudad}}</span>
                        @endif
                    </th>
                    <th>{{$ingreso->tipo_solicitud}}</th>
                    <th scope="row">@if($ingreso->ingreso != null)INGRESÓ @endif</th>
                    
                    <th scope="row">
                    @if($ingreso->vehiculo != null) 
                        
                     <center><button class="btn btn-warning AutorizacionVehiculo" id="AutorizacionVehiculo">
                        @if($ingreso->vehiculo_autorizado === "AUTORIZADO")
                            Autorizado
                        @endif
                        @if($ingreso->vehiculo_autorizado === "NEGADO")
                            Negado
                        @endif
                        @if($ingreso->vehiculo_autorizado != "NEGADO" && $ingreso->vehiculo_autorizado != "AUTORIZADO")
                            Verificar
                         @endif
                     </button></center>
                   
                    @endif   
                    </th>
                </tr>	                
            </tbody>
            
            @endforeach
        @else
        <tr class="table-light">
            <p class="lead">Actualmente esta sección no cuenta con información disponible, lo invitamos a seguir navegando en las demás pestañas.</p3>
        </tr>
       @endif
    </table>
</div>

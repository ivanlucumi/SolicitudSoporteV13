@extends('layouts.monitoreo.coordinador')
<!--ponerle titulo a la paginga-->
@section('title', 'Control Registro De ingreso')
@section('cabecera', 'Control Registro De ingreso')

@section('content') 
    <!--CONTAR USUARIOS -->
    <style> 
        #value {
    width:150px;
    float:right;
    text-align:right;
    padding:10px;
    background-color:#dadada;
    font-size:36px;
}
    </style>
    
    <div>
        <center>
            <p>
                <h1>
                    <strong>
                        {!! auth()->user()->name!!}
                    </strong>
                </h1>
            </p>
        </center>
    </div>
    
<div class="row">
    <div id="content" class="col-lg-12" style="text-align: right; border:radius">
        <span>Personas En el edificio: </span><br>
        
        <span><strong><h3>{{Carbon\carbon::now()->todateString()}}</h3></strong> </span>
        <h1><span id="value">{{$contarUsuario}}</span></h1> 
    </div>
</div>

	<div class="row">
			<div class="col-xs-12 col-sm-2">
				<div class="container">
            		<a href="{!!route('coordinador.parqueadero.form')!!}" class="btn btn-warning">Crear Zona Parqueadero</a>      
            	</div>
			</div>
		</div>
        <hr>

<div class="row">
    <div class="col-xs-12 col-sm-3">
        <div class="container">
        <div class="" style="text-align: left">
            <nav class="navbar navbar-light bg-light">
              
               <input class="form-group mr-sm-2 shadow" alt="Ingresa Cedula para consultar" name="cedula" type="number"  placeholder="Buscar por Cedula" aria-label="Search" id="cedulaIngreso" required autofocus autocomplete="off">
                
                <a href="#" class="btn btn-success btn-sm 
                                    fa fa-plus-square" id="Bcedula" title="Buscar por cedula"> Buscar</a>
              
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
                <th>No. PARQUEADERO</th>
                <th>CALIDA</th>
                <th>T. VEH&Iacute;CULO</th>
                <th>PLACA</th>
                <th>DESC. VEH&Iacute;CULO</th>
                <th>CEDULA</th>
                <th>NOMBRE</th>
                <th>CARGO</th>            
                <th>JUZGADO</th>            
                <th>ESPECIALIDAD</th>
                <th>ESTADO</th>
                <th>TIPO INGRESO</th>
                <th>ACCIONES</th>
                
            </tr>
        </thead>
    @if($parqueadero != null)
            @foreach($parqueadero as $parqueader)
            <tbody class="buscar" data-id="{!!$parqueader->id!!}" >
                <tr class="table-light" >
                    <th scope="row">{{$parqueader->no_parqueadero}}</th>									
                    <th scope="row">{{$parqueader->calidad}}</th>									
                    <th scope="row">{{$parqueader->tipo_vehiculo}}</th>									
                    <th scope="row">{{$parqueader->placa}}</th>
                    <th scope="row">{{$parqueader->descripcion_vehiculo}}</th>									
                    <th scope="row">{{$parqueader->cedula}}</th>
                    <th scope="row">{{$parqueader->nombre}}</th>
                    <th scope="row">{{$parqueader->cargo}}</th>
                    <th scope="row">{{$parqueader->juzgado}}</th>
                    <th scope="row">{{$parqueader->especialidad}}</th>
                    <th scope="row">
                        @if($parqueader->puesto && $parqueader->puesto->estado === 'INACTIVO')
                            <span class="label label-danger">INACTIVO</span>
                        @else
                            {{$parqueader->ocupado}}
                        @endif
                    </th>
                    <th scope="row">{{$parqueader->tipo_ingreso}}</th>
                    <th scope="row"><a href="{{ route('coordinador.parqueadero.editForm', $parqueader->id) }}" class="btn btn-primary btn-xs fa fa-pencil" title="editar usuario"></a>
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



<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>


@push('scripts')
<script src="/js/ingreso/coordinadorIndex.js"></script>  
@endpush
    

 
 
@endsection


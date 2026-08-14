
<div class="row">
    <div id="content" class="col-lg-12" style="text-align: right; border:radius">
        <span>Personas En el edificio cambiando: </span><br>
        
        <span><strong><h3>{{Carbon\carbon::now()->todateString()}}</h3></strong> </span>
        <h1><span id="value">{{$contarUsuario}}1</span></h1> 
    </div>
</div>


<!--div class="row">
    <div class="col-xs-12 col-sm-3">
        <div class="container">
        <div class="" style="text-align: left">
            <nav class="navbar navbar-light bg-light">
              
               <input class="form-group mr-sm-2 shadow" name="cedula" type="number"  placeholder="Buscar por Cedula" aria-label="Search" id="cedulaIngreso" required autofocus>
               <input class="form-group mr-sm-2 shadow" style="width : 0px; heigth : 1px">
               <input class="form-group mr-sm-2 shadow" style="width : 0px; heigth : 1px">
               <input class="form-group mr-sm-2 shadow" style="width : 0px; heigth : 1px">
               <input class="form-group mr-sm-2 shadow" style="width : 0px; heigth : 1px">
               <input class="form-group mr-sm-2 shadow" style="width : 0px; heigth : 1px">
               <input class="form-group mr-sm-2 shadow" style="width : 0px; heigth : 1px">
                
                <a href="#" class="btn btn-success btn-sm 
                                    fa fa-plus-square" id="BcedulaIngreso" title="Buscar por c&eacute;dula"> Buscar</a>
              
            </nav>
          </div>
            
        </div>
    </div>
   
              
               
</div-->
<div class="container-fluid">
   <div class="row">
    <div class="col-xs-12">
        <div class="" style="text-align: left">
              
            <input class="form-group mr-sm-2 shadow" name="cedula" type="number"  placeholder="Buscar por Cedula" aria-label="Search" id="cedulaIngreso" required autofocus>
               <input class="form-group mr-sm-2 shadow" name="primer_ap" type="text" placeholder="Primer Apellido" style="width : 80px; heigth : 10px"  aria-label="Search" id="primer_ap" >
               <input class="form-group mr-sm-2 shadow" name="segundo_ap" type="text" placeholder="Segundo Apellido" style="width : 80px; heigth : 10px"  aria-label="Search" id="segundo_ap" >
               <input class="form-group mr-sm-2 shadow" name="primer_nomb" type="text" placeholder="Primer Nombre" style="width : 80px; heigth : 10px" aria-label="Search" id="primer_nomb" >
               <input class="form-group mr-sm-2 shadow" name="segundo_nomb" type="text" placeholder="Segundo Nombre" style="width : 80px; heigth : 10px"  aria-label="Search" id="segundo_nomb" >
               <input class="form-group mr-sm-2 shadow" name="sexo" type="text" placeholder="Sexo (M | F)" style="width : 80px; heigth : 10px"  aria-label="Search" id="sexo" >
               <input class="form-group mr-sm-2 shadow" name="fecha_nacimiento" placeholder="Fecha Nacimiento" style="width : 80px; heigth : 10px" type="text"   aria-label="Search" id="fecha_nacimiento" >               
               <input class="form-group mr-sm-2 shadow" name="tipo_sangre" type="text" placeholder="Tipo Sangre" style="width : 80px; heigth : 10px"  aria-label="Search" id="tipo_sangre" >
               
               <div class="mt-3 mb-3">
                  <a href="#" class="btn btn-success btn-lg 
                                    fa fa-plus-square mt-3 mb-3" id="BRegisVist" onClic="registrarVisita()"> Registrar </a> 
               </div>
               <br>
               <div class="mt-3 mb-3">
                 <a href="#" class="btn btn-danger btn-lg 
                                    fa fa-eraser  mt-3 mb-3" id="BorrarVista" onClic="BCancelarIngreso"> Limpiar</a>  
               </div>
                
              
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
            <th>NOMBRE COMPLETO</th>
            <th>FECHA DE INGRESO</th>
            <th>HORA DE INGRESO</th>
            <th>TORRE</th>
            <th>PISO</th>
            <th>SALIDA</th>

            <!--th>H. SOLICITUD INGRESO</th-->
            <!--th>H. QUE INGRESA</th>
            <th>SALIDA</th>
            <th>DESPACHO QUE SOLICIT&Oacute;</th>
            <th>ROL</th>
            <th>ESTADO INGRESO</th-->
            
        </tr>
    </thead>
@if($ingresos != null)
        @foreach($ingresos as $ingreso)
        
        <tbody class="buscar" data-id="{!!$ingreso->id!!}" >
            <tr class="table-light" style = "@if($ingreso->ingreso != null && $ingreso->salida != null )
            background-color: #F5A9A9;@endif
            @if($ingreso->ingreso != null && $ingreso->salida == null )
            background-color:#BFFCC0 ;@endif">
                <th scope="row">{{$ingreso->identificacion}}</th>									
                <th scope="row">{{strtoupper($ingreso->fullname)}}</th>										
                <th scope="row">{{$ingreso->fecha_ingreso}}</th>
                <th scope="row">{{$ingreso->ingreso}}</th>	
                <th scope="row">{{$ingreso->torre}}</th>	
                <th scope="row">{{$ingreso->piso}}</th>	
                <th scope="row">{{$ingreso->salida}}</th>	
                <!--th scope="row">{{$ingreso->despacho}}</th>								
                <th scope="row">{{$ingreso->tipo_solicitud}}</th>
                <th scope="row">{{$ingreso->vehiculo_autorizado}}</th-->
                
                
            </tr>	                
        </tbody>
        
        @endforeach
    @else
    <tr class="table-light">
        <p class="lead">Actualmente esta secci贸n no cuenta con informaci贸n disponible, lo invitamos a seguir navegando en las dem谩s pesta帽as.</p3>
    </tr>
@endif
</table>
</div>


<script>
    function FocusAutomatico() {
       
    //focus
    document.getElementById("cedulaIngreso").focus();
    
    }
    setInterval(FocusAutomatico, 20000); 
</script>



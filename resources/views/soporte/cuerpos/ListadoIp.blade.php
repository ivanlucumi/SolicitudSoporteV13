    <div class="container-fluid">
        
         <div class="row">
         
         
         @if( auth()->user()->rol == "1") 
            <form action="{{ route('administrador.soporte.registro_ip.save') }}" method="POST">
    @csrf
            @else
             <form action="{{ route('tecnico.soporte.registro_ip.save') }}" method="POST">
    @csrf
            @endif
            <select class="form-group select2 mr-sm-2 shadow  @error('municipio') is-invalid @enderror" aria-label="Search" name="municipio" id="municipio">
    <option value="">Seleccione Sede</option>
    @foreach($municipios as $key => $value)
        <option value="{{ $key }}" @selected(old('municipio') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('municipio')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror  
        
            
            <select class="form-group select2 mr-sm-2 shadow  @error('sede') is-invalid @enderror" aria-label="Search" name="sede" id="sede">
    <option value="">Seleccione Sede</option>
    @foreach($sedes as $key => $value)
        <option value="{{ $key }}" @selected(old('sede') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('sede')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror  
         
             <select class="form-group select2 " aria-label="Search" name="despacho" required>
                 <option value="">Seleccione Despacho</option>
                 <option  value="OTRO">OTRO</option>
                 @foreach($despachos as $despacho)
                  <option value="{{$despacho->nombreDespacho}}">{{$despacho->nombreDespacho}}</option>
                 @endforeach
            </select>
        
             <input class="form-group @error('oficina') is-invalid @enderror" placeholder="Registrar oficina" autocomplete="off" type="text" name="oficina" id="oficina" value="{{ old('oficina') }}">
@error('oficina')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
        
             <select class="form-group select2 mr-sm-2 shadow  @error('tipo_equipo') is-invalid @enderror" aria-label="Search" name="tipo_equipo" id="tipo_equipo">
    <option value="">Seleccione Tipo Equipo</option>
    @foreach($equipos as $key => $value)
        <option value="{{ $key }}" @selected(old('tipo_equipo') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('tipo_equipo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
         
              <input class="form-group @error('ip') is-invalid @enderror" placeholder="Registrar Ip Equipo" autocomplete="off" id="ip" type="text" name="ip" value="{{ old('ip') }}">
@error('ip')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
         
               <input class="form-group @error('nombre_equipo') is-invalid @enderror" placeholder="Registrar Nombre Equipo" autocomplete="off" type="text" name="nombre_equipo" id="nombre_equipo" value="{{ old('nombre_equipo') }}">
@error('nombre_equipo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
         </div>
         
       
     
      <div class="row">
          <div class="col xs-12 col-sm-4">
              <button class="form-group btn btn-success my-2 my-sm-0 shadow" type="submit">Registrar</button>
                </form>
          </div>
      </div>
    </div>
    
 


           <div class="box-body">
           	<div class="row">
				 <div class="table-responsive">
					 <table id="table9" class="table table-bordered table-striped" >
                        <thead class="shadow" style="background-color: #004182; color: #fff;">
						  <tr>
						  	   <th>MUNICIPIO</th>
						      <th>SEDE</th>
						  	  <th>DESPACHO</th>
						      <th>OFICINA</th>
						      <th>TIPO EQUIPO</th>
						      <th>NOMBRE EQUIPO</th>	
						      <th>IP</th>
						      <th>ACCIONES</th>
					      </tr>
						</thead>

						@if(!empty($listado))
						@foreach($listado as $listad)
							 <tbody class="buscar">
									 <tr class="table-light">
									     <th scope="row"> {{$listad->municipio}} </th>
									     <th scope="row"> {{$listad->sede}} </th>
										 <th scope="row"> {{$listad->despacho}} </th>
									     <th scope="row"> {{$listad->oficina}} </th>
									     <th scope="row"> {{$listad->tipo_equipo}} </th>
									     <th scope="row"> {{$listad->nombre_equipo}} </th>
									     <th scope="row"> {{$listad->ip}} </th>
									     <th scope="row"> {{$listad->usuario_creador}} </th>
									     @if( auth()->user()->email =="jbolivarr@disajcali.gov.co" ||  auth()->user()->email =="pbonillal@disajcali.gov.co") 
									      <th scope="row"> <a href="{{ route('tecnico.soporte.editar.registro.ip', $listad->id) }}" class="btn btn-primary btn-xs fa fa-pencil" title="Editar Registro"></a> </th>
									      
									     @endif 
									     @if( auth()->user()->rol == "1") 
									      <th scope="row"> <a href="{{ route('administrador.soporte.editar.registro.ip', $listad->id) }}" class="btn btn-primary btn-xs fa fa-pencil" title="Editar Registro"></a> </th>
									      
									     @endif 
									 </tr>
								@endforeach	   	                
							 </tbody>
						@else
						<p>NO HAY REGISTRO DE IP´s HASTA EL MOMENTO</p>	 
						@endif
							            
				     </table>
				  </div>
				</div>
			 </div>


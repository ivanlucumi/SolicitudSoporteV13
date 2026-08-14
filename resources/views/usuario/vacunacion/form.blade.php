<form action="{{ route('$url') }}" method="POST">
    @csrf   

<div class="row">
    <div class="card-body">
    <p class="card-text"><h2 style="color:red"><strong><center>SE INFORMA QUE HAY DISPONIBLE SOLO EL BIOL&Oacute;GICO PFIZER, SINOVAC, JANSSEN.</center></strong></h2> </p>
     </div>
</div>

<div class="row ">
    <div class="col-xs-12 col-sm-4 form-group ">
    <label for="nRadicacion">Número de cedula:</label>
    
    <input class="form-control @error('cedula') is-invalid @enderror" min="1" placeholder="Ingrese número de cédula" type="number" name="cedula" id="cedula" value="{{ old('cedula') }}">
@error('cedula')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
    </div>
    <div class="col-xs-12 col-sm-3">
		<label for="hora">Seleccione Hora Asistencia:</label><br>
		<select class="form-control @error('hora') is-invalid @enderror" name="hora" id="hora">
    <option value="">Seleccione Hora</option>
    @foreach($hora as $key => $value)
        <option value="{{ $key }}" @selected(old('hora') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('hora')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>	
	</div>
	<div class="col-xs-12 col-md-5 form-group ">

       <label for="vacuna"> Tipo de Vacuna Disponible:</label><br>
		<select class="form-control @error('vacuna') is-invalid @enderror" name="vacuna" id="vacuna">
    <option value="">Seleccione Vacuna</option>
    @foreach($vacunas as $key => $value)
        <option value="{{ $key }}" @selected(old('vacuna') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('vacuna')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>

        
    </div>
    					
    </div>
    
    <div class="row">
    <div class="col-xs-12 col-sm-4"></div>
    
    @if($hora->isEmpty())
     <button class="btn btn-danger btn-block">Ya No hay Disponible Cupo Por Horario</button>
    
    @else
    
    <div class="col-xs-12 col-sm-4" style="display:block" id="sinDetenido">
        <button class="btn btn-success btn-block" style="background-color: #004182; color: #fff;" type="submit">Consultar</button>
        
    </div>
    
    @endif
    
    <div class="col-xs-12 col-sm-4"></div>                
</div>



 
</form> 
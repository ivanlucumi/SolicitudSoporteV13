<form action="{{ route('$url') }}" method="POST">
    @csrf   

<div class="row">
    <div class="card-body">
    <p class="card-text"><h2 style="color:red"><strong><center>CARRO MOVIL PALACIO DE JUSTICIA  "PEDRO EL&Iacute;AS SERRANO ABAD&Iacute;A"</center></strong></h2> </p>
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
      <div class="col-xs-12 col-md-8 form-group ">

        <label for="sexo">Seleccione Sexo:</label>

        <div class="row">

            <div class="col-xs-6 col-sm-4">

                <label><input type="radio" id="cbox2" value="HOMBRE" name="sexo" onclick="HOMBRE()" > HOMBRE</label>

                </div>

                <div class="col-xs-6 col-sm-4">

                    <label><input type="radio" id="cbox2" value="MUJER" name="sexo" onclick="MUJER()"> MUJER</label>

                </div>
               
        </div>

</div>


    <div class="col-xs-12 col-sm-3" id="muj" style="display:none">
		<label for="hora">Seleccione Asistencia Citolog&iacute;a:</label><br>
		<select class="form-control @error('horaCitologia') is-invalid @enderror" name="horaCitologia" id="horaCitologia">
    <option value="">Seleccione Hora Citologia</option>
    @foreach($horaCitologia as $key => $value)
        <option value="{{ $key }}" @selected(old('horaCitologia') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('horaCitologia')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>	
	</div>
	<div class="col-xs-12 col-sm-3" id="todo" style="display:none">
		<label for="hora">Seleccione Asistencia Higiene Oral:</label><br>
		<select class="form-control @error('horaOdontologia') is-invalid @enderror" name="horaOdontologia" id="horaOdontologia">
    <option value="">Seleccione Hora Odontologia</option>
    @foreach($horaOdontologia as $key => $value)
        <option value="{{ $key }}" @selected(old('horaOdontologia') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('horaOdontologia')
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



 <script>
    

//mostrar nombre  vacuna
function MUJER() {
    var x = document.getElementById("muj");
    var xx = document.getElementById("todo");
    if (x.style.display === "none") {
        x.style.display = "block";
        xx.style.display = "block"
    } else {
        x.style.display = "block";
        xx.style.display = "block"
    }
    
}
function HOMBRE() {
    var x = document.getElementById("todo");
    var mujr = document.getElementById("muj");
    if (x.style.display === "none") {
        x.style.display = "block";
        mujr.style.display = "none"
    } else {
        x.style.display = "block";
        mujr.style.display = "none"
    }
    
    
}
        
</script>
<form action="{{ route('$url') }}" method="POST">
    @csrf   

<div class="row">
    <div class="card-body">
    <p class="card-text"><h2 style="color:red"><strong><center></center></strong></h2> </p>
     </div>
</div>

        <div class="row ">
                <div class="col-xs-12 col-sm-3 form-group ">
                <label for="cedula">Número de cedula:</label>    
                <input class="form-control @error('cedula') is-invalid @enderror" min="1" placeholder="Ingrese número de cédula" type="number" name="cedula" id="cedula" value="{{ old('cedula') }}">
@error('cedula')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                </div>
                <div class="col-xs-12 col-md-6 form-group ">

                        <label for="fecha">Seleccione Fecha:</label>  <br>      

                            <div class="col-xs-6 col-sm-4">

                            <label><input type="radio" id="cbox2" value="{{ $fecha_1 }}" name="fecha" onclick="fecha_1()" > {{ $fecha_1 }}</label>

                            </div>

                            <div class="col-xs-6 col-sm-4">

                                <label><input type="radio" id="cbox2" value="{{ $fecha_2 }}" name="fecha" onclick="fecha_2()"> {{ $fecha_2 }}</label>

                            </div>

                            <div class="col-xs-6 col-sm-4">

                                <label><input type="radio" id="cbox2" value="{{ $fecha_3 }}" name="fecha" onclick="fecha_3()"> {{ $fecha_3 }}</label>

                            </div>
                        
                    </div>

                <div class="col-xs-12 col-sm-3 form-group">            
                        <div class="col-xs-12 " id="fecha_1" style="display:none">
                            <label for="hora">Seleccione Hora Asistencia 1:</label><br>
                            <select class="form-control @error('hora_1') is-invalid @enderror" name="hora_1" id="hora_1">
    <option value="">Seleccione Hora</option>
    @foreach($jornada_1 as $key => $value)
        <option value="{{ $key }}" @selected(old('hora_1') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('hora_1')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>	
                        </div>
                        <div class="col-xs-12 " id="fecha_2" style="display:none">
                            <label for="hora">Seleccione Hora Asistencia 2:</label><br>
                            <select class="form-control @error('hora_2') is-invalid @enderror" name="hora_2" id="hora_2">
    <option value="">Seleccione Hora</option>
    @foreach($jornada_2 as $key => $value)
        <option value="{{ $key }}" @selected(old('hora_2') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('hora_2')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>	
                        </div>
                        <div class="col-xs-12 " id="fecha_3" style="display:none">
                            <label for="hora">Seleccione Hora Asistencia 3:</label><br>
                            <select class="form-control @error('hora_3') is-invalid @enderror" name="hora_3" id="hora_3">
    <option value="">Seleccione Hora</option>
    @foreach($jornada_3 as $key => $value)
        <option value="{{ $key }}" @selected(old('hora_3') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('hora_3')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>	
                        </div>
                    
                </div>

        </div>

<hr>
   
    
    <div class="col-xs-12 col-sm-12" style="display:block" id="sinDetenido">
        <button class="btn btn-success btn-block" style="background-color: #004182; color: #fff;" type="submit">Consultar</button>
        
    </div>
    

</form> 



 <script>
    

//mostrar nombre  vacuna
function fecha_1() {
    var x = document.getElementById("fecha_1");
    var xx = document.getElementById("fecha_2");    
    var xxx = document.getElementById("fecha_3");

    if (x.style.display === "none") {
        x.style.display = "block";
        xx.style.display = "none"
        xxx.style.display = "none"
    } else {
        x.style.display = "block";
        xx.style.display = "none"
        xxx.style.display = "none"
    }
    
}
function fecha_2() {
    var x = document.getElementById("fecha_1");
    var xx = document.getElementById("fecha_2");    
    var xxx = document.getElementById("fecha_3");

    if (xx.style.display === "none") {
        xx.style.display = "block";
        x.style.display = "none"
        xxx.style.display = "none"
    } else {
        x.style.display = "none";
        xx.style.display = "block"
        xxx.style.display = "none"
    }
}

function fecha_3() {
    var x = document.getElementById("fecha_1");
    var xx = document.getElementById("fecha_2");    
    var xxx = document.getElementById("fecha_3");

    if (xxx.style.display === "none") {
        xx.style.display = "none";
        x.style.display = "none"
        xxx.style.display = "block"
    } else {
        x.style.display = "none";
        xx.style.display = "none"
        xxx.style.display = "block"
    }
}
        
</script>
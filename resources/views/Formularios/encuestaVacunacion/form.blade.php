<div>

    <input class="form-control" autocomplete="off" type="hidden" name="edita" id="edita" value="{{ $edita }}">

</div>



<!-- Fin de los inputs ocultos   -->

<div class="row ">

    <div class="col-xs-6 col-sm-4 form-group ">

        <label for="fechaA">C&eacute;dula Funcionario:</label>

        <input class="form-control @error('cedula') is-invalid @enderror" autocomplete="off" placeholder="Ingrese No C&eacute;dula" type="number" name="cedula" id="cedula" value="{{ old('cedula', $encuesta->cedula) }}">
@error('cedula')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>

    <div class="col-xs-6 col-sm-4 form-group ">

        <label for="nombre">Nombre:</label>

        <input class="form-control @error('nombre') is-invalid @enderror" autocomplete="off" placeholder="Ingrese Nombre" type="text" name="nombre" id="nombre" value="{{ old('nombre', $encuesta->nombre) }}">
@error('nombre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>

    <div class="col-xs-6 col-sm-4  form-group ">

        <label for="apellido">Apellido:</label>

        <input class="form-control @error('apellido') is-invalid @enderror" placeholder="Ingrese Apellido" autocomplete="off" type="text" name="apellido" id="apellido" value="{{ old('apellido', $encuesta->apellido) }}">
@error('apellido')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>

    

</div>




<div class="row ">

    

    <div class="col-xs-12 col-sm-6  form-group ">

        <label for="esquema">Esquema de Vacunacion</label>

        <div class="row">
            <div class="col-xs-12 col-lg-3">

                <label><input type="radio" id="cbox2" value="NINGUNA" onClick="oculto()" name="esquema" @if($encuesta->esquema == 'NINGUNA')

                    <?php echo 'checked'; ?>

                @endif > NINGUNA</label>

                </div>

            <div class="col-xs-12 col-lg-3">

                <label><input type="radio" id="cbox2" value="1_DOSIS" onClick="visible()" name="esquema" @if($encuesta->esquema == '1_DOSIS')

                    <?php echo 'checked'; ?>

                @endif > 1 DOSIS</label>

                </div>
            <div class="col-xs-12 col-lg-3">

                <label><input type="radio" id="cbox2" value="2_DOSIS" onClick="visible()" name="esquema" @if($encuesta->esquema == '2_DOSIS')

                    <?php echo 'checked'; ?>

                @endif > 2 DOSIS</label>

                </div>
            <div class="col-xs-12 col-lg-3">

                <label><input type="radio" id="cbox2" value="3_DOSIS" onClick="visible()" name="esquema" @if($encuesta->esquema == '3_DOSIS')

                    <?php echo 'checked'; ?>

                @endif > 3 DOSIS</label>

                </div>

        </div>

        

    </div>
    <div class="col-xs-6" style= "display:none" id="vacuna">
		<label for="hora">Seleccione Vacuna Aplicada:</label><br>
		<select class="form-control @error('vacuna') is-invalid @enderror" name="vacuna" id="vacuna">
    <option value="">Seleccione Vacuna</option>
    @foreach($VACUNAS as $key => $value)
        <option value="{{ $key }}" @selected(old('vacuna') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('vacuna')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>	
	</div>

   <div class="col-xs-12  form-group " id="estado_vac" style= "display:block">

        <label for="estado">Estado Vacunaci&oacute;n</label>

        <div class="row">

            <div class="col-xs-12 col-lg-6">

                <label><input type="radio" id="cboxvac"  value="SIN_VACUNA" name="estado" onClick="oculto()" @if($encuesta->estado == 'SIN_VACUNA')

                    <?php echo 'checked'; ?>

                @endif >SIN_VACUNA</label>

                </div>
            <div class="col-xs-12 col-lg-6">

                <label><input type="radio" id="cboxvac" value="NO_DESEO_SER_VACUNADO" onClick="oculto()" name="estado" @if($encuesta->estado == 'NO_DESEO_SER_VACUNADO')

                    <?php echo 'checked'; ?>

                @endif >NO_DESEO_SER_VACUNADO</label>

                </div>
            

        </div>


</div>
</div>


 <script>
     
function oculto(){
          //console.log(id)
        //div = document.getElementById(id);
            
       var det = document.getElementById('vacuna'); 
        det.style.display = 'none';
        
        var sindet = document.getElementById('estado_vac'); 
        sindet.style.display = 'block';
        
        } 
function visible(){
         var det = document.getElementById('vacuna'); 
        det.style.display = 'block';
        
        // Uncheck
document.getElementById("cboxvac").checked = false;
        
        var sindet = document.getElementById('estado_vac'); 
        sindet.style.display = 'none';
        } 
        
</script>

    
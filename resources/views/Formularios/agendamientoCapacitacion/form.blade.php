
<div class="row ">

    <div class="col-xs-6 col-sm-4 form-group ">

        <label for="fechaA">C&eacute;dula Funcionario:</label>

        <input class="form-control @error('cedula') is-invalid @enderror" autocomplete="off" placeholder="Ingrese No C&eacute;dula" type="number" name="cedula" id="cedula" value="{{ old('cedula', $agendamiento->cedula) }}">
@error('cedula')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>

    <div class="col-xs-6 col-sm-4 form-group ">

        <label for="nombre">Nombre:</label>

        <input class="form-control @error('nombre') is-invalid @enderror" autocomplete="off" placeholder="Ingrese Nombre" type="text" name="nombre" id="nombre" value="{{ old('nombre', $agendamiento->nombre) }}">
@error('nombre')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>

    <div class="col-xs-6 col-sm-4  form-group ">

        <label for="apellido">Apellido:</label>

        <input class="form-control @error('apellido') is-invalid @enderror" placeholder="Ingrese Apellido" autocomplete="off" type="text" name="apellido" id="apellido" value="{{ old('apellido', $agendamiento->apellido) }}">
@error('apellido')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>
    
    <div class="col-xs-6 col-sm-4  form-group ">

        <label for="cargo">Cargo:</label>

        <input class="form-control @error('cargo') is-invalid @enderror" placeholder="Ingrese Apellido" autocomplete="off" type="text" name="cargo" id="cargo" value="{{ old('cargo', $agendamiento->cargo) }}">
@error('cargo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>
    
     <div class="col-xs-6 col-sm-4  form-group ">

        <label for="asistencia">Tipo Asistencia:</label>

        <select class="form-control @error('tipo_asitencia') is-invalid @enderror" autocomplete="off" name="tipo_asitencia" id="tipo_asitencia">
    <option value="">Seleccione Asistencia</option>
    @foreach($tipoAsistencias as $key => $value)
        <option value="{{ $key }}" @selected(old('tipo_asitencia') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('tipo_asitencia')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

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

    
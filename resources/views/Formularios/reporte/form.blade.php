<form action="{{ route('$url') }}" method="POST">
    @csrf 
    <div class="row ">
    
        <div class="col-xs-12 col-sm-6 form-group ">
            <label for="radicado">Numero Radicado de Proceso:</label>
            <input class="form-control  @error('procesos_activos') is-invalid @enderror" autocomplete="off" placeholder="Radicado con 23 d&iacute;gitos" type="number" name="procesos_activos" id="procesos_activos" value="{{ old('procesos_activos') }}">
@error('procesos_activos')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        </div>
        
        <div class="col-xs-12 col-sm-6 form-group ">
            <label for="demandate">Nombre Demandante : </label>
            <input class="form-control  @error('demandante') is-invalid @enderror" autocomplete="off" placeholder="Nombre Demandante" type="text" name="demandante" id="demandante" value="{{ old('demandante') }}">
@error('demandante')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        </div>
        
        <div class="col-xs-12 col-sm-6 form-group ">
            <label for="demandate">Nombre Demandado : </label>
            <input class="form-control  @error('demandado') is-invalid @enderror" autocomplete="off" placeholder="Nombre Demandado" type="text" name="demandado" id="demandado" value="{{ old('demandado') }}">
@error('demandado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        </div>
        <div class="col-xs-12 col-sm-3 form-group ">
            <label for="folios">N&uacute;mero Folios:</label>
            <input class="form-control  @error('procesos_activos') is-invalid @enderror" min="0" autocomplete="off" placeholder="N&uacute;mero de Folios" type="number" name="procesos_activos" id="procesos_activos" value="{{ old('procesos_activos') }}">
@error('procesos_activos')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        </div>
        <div class="col-xs-12 col-sm-3 form-group ">
            <label for="cuadernos">N&uacute;mero Cuadernos:</label>
            <input class="form-control  @error('procesos_activos') is-invalid @enderror" min="0" autocomplete="off" placeholder="Cantidad de cuadernos" type="number" name="procesos_activos" id="procesos_activos" value="{{ old('procesos_activos') }}">
@error('procesos_activos')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        </div>
    
    
    </div>

<div class="row ">
    <div class="col-xs-12 col-sm-3  form-group ">
    </div>
   
    <div class="col-xs-12 col-sm-3 form-group ">
    </div>  
    </div>
    
    <div class="row ">
        <div class="col-xs-12 col-sm-3 form-group ">
        </div>
        <div class="col-xs-12 col-sm-3  form-group ">
             <button class="btn btn-success btn-block shadow" style="background-color: #004182; color: #fff;" type="submit">GUARDAR</button>
             
        </div>
        <div class="col-xs-12 col-sm-3 form-group ">
             <a href="{!! url('/usuarios')!!}" class="btn btn-warning btn-block shadow">Cancelar</a>
        </div>
        <div class="col-xs-12 col-sm-3  form-group ">
        </div>
    </div>
    
     
 
</form> 
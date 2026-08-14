<form action="{{ route('$url') }}" method="POST">
    @csrf 
<div class="row ">

    <div class="col-xs-12 col-sm-6 form-group ">
        

        <label for="sinsentencia">N&uacute;mero de procesos Activos (CON TRAMITE SIN SENTENCIA Y CON SENTENCIA)  al 30 de junio de 2020:</label>

        <input class="form-control  @error('procesos_activos') is-invalid @enderror" min="0" autocomplete="off" placeholder="Cantidad de procesos en gesti&oacute;n" type="number" name="procesos_activos" id="procesos_activos" value="{{ old('procesos_activos') }}">
@error('procesos_activos')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>
    
    <div class="col-xs-12 col-sm-6 form-group ">

        <label for="autorizadigitalizacion">¿En caso de salir a vacaciones en el mes de diciembre, autoriza la entrega de expedientes para realizar la digitalizaci&oacute;n fuera del despacho ? </label>

        <div class="row">

            <div class="col-xs-12 col-lg-6">

            <label><input type="radio" id="cbox1" value="SI" name="autorizadigitalizacion" required > SI</label>

            </div>

            <div class="col-xs-12 col-lg-4">

                <label><input type="radio" id="cbox2" value="NO" name="autorizadigitalizacion" required "> NO</label>

            </div>
            
           

        </div>

        

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
<form action="{{ route('$url') }}" method="POST">
    @csrf 
<div class="row ">

    <div class="col-xs-6 col-sm-4 form-group ">

        <label for="sinsentencia">Inventario de procesos sin sentencia o decisión que ponga fin a la instancia con corte al 30 de junio de 2020:</label>

        <input class="form-control monto1 @error('sinsentencia') is-invalid @enderror" min="1" id="sinsen" autocomplete="off" placeholder="Procesos sin sentencia" onchange="sumar(this.value);" type="number" name="sinsentencia" value="{{ old('sinsentencia') }}">
@error('sinsentencia')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>

    <div class="col-xs-6 col-sm-4 form-group ">

        <label for="consentencia">Inventario de procesos con sentencia o decisión que ponga fin a la instancia con corte al 30 de junio de 2020:</label>

        <input class="form-control monto1 @error('consentencia') is-invalid @enderror" min="1" id="consen" autocomplete="off" placeholder="Procesos con sentencia" onchange="sumar(this.value);" type="number" name="consentencia" value="{{ old('consentencia') }}">
@error('consentencia')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>

    <div class="col-xs-6 col-sm-4  form-group ">

        <label for="total_procesos">Total Procesos:</label><br>
        <label>Este es el número total de procesos en el despacho:  <h2><strong> <span style="color: green" id="spTotal1"></span></strong></h2> </label>
        
        

    </div>

    

</div>

<div class="row ">

    <div class="col-xs-6 col-sm-4 form-group ">

        <label for="porcesosdespacho">¿Cantidad de procesos a despacho para fallo? :</label>

        <input class="form-control monto2 @error('porcesosdespacho') is-invalid @enderror" min="1" id="porcesosdespacho" autocomplete="off" placeholder="Procesos en Despacho" onchange="sumar2(this.value);" type="number" name="porcesosdespacho" value="{{ old('porcesosdespacho') }}">
@error('porcesosdespacho')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>

    <div class="col-xs-6 col-sm-4 form-group ">

        <label for="procesossecretaria">¿Cantidad de procesos en secretaría? :</label>

        <input class="form-control monto2 @error('procesossecretaria') is-invalid @enderror" min="1" id="procesossecretaria" autocomplete="off" placeholder="Procesos en secretaria" onchange="sumar2(this.value);" type="number" name="procesossecretaria" value="{{ old('procesossecretaria') }}">
@error('procesossecretaria')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>

    <div class="col-xs-6 col-sm-4  form-group ">

        <label for="total_procesos2">Total Procesos:</label><br>
        <label>Debe concordar con el total de procesos: <br> <h2><span style="color: red" id="spTotal2"></h2> </label>
        <label id="compa10">  </label>
        

    </div>

    

</div>
<div class="row ">

    <div class="col-xs-6 col-sm-4 form-group ">

        <label for="procesosactivos">Cantidad de procesos Activos:</label>

        <input class="form-control monto3 @error('procesosactivos') is-invalid @enderror" min="1" id="procesosactivos" autocomplete="off" placeholder="Procesos activos" onchange="sumar3(this.value);" type="number" name="procesosactivos" value="{{ old('procesosactivos') }}">
@error('procesosactivos')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>

    <div class="col-xs-6 col-sm-4 form-group ">

        <label for="procesosinactivos">Cantidad de procesos Inactivos:</label>

        <input class="form-control monto3 @error('procesosinactivos') is-invalid @enderror" min="1" id="procesosinactivos" autocomplete="off" placeholder="Procesos inactivos" onchange="sumar3(this.value);" type="number" name="procesosinactivos" value="{{ old('procesosinactivos') }}">
@error('procesosinactivos')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>

    <div class="col-xs-6 col-sm-4  form-group ">

        <label for="total_procesos3">Total Procesos:</label><br>

        <label>Debe concordar con el total de procesos: <br> <h2><span style="color: red" id="spTotal3"></span></h2> </label>
        <label> <br> </span><span style="color: red" id="compa11"></span></label>

    </div>

    

</div>


<div class="row ">
    <div class="col-xs-12 col-sm-3  form-group ">
    </div>
   <div class="col-xs-12 col-sm-6 form-group ">

        <label for="autorizadigitalizacion">¿Autorizaría la entrega de expedientes para realizar la digitalización en la vacancia judicial? </label>

        <div class="row">

            <div class="col-xs-12 col-lg-6">

            <label><input type="radio" id="cbox1" value="SI" name="autorizadigitalizacion" required onclick="comprobartotal()"> SI</label>

            </div>

            <div class="col-xs-12 col-lg-6">

                <label><input type="radio" id="cbox2" value="NO" name="autorizadigitalizacion" required onclick="comprobartotal()"> NO</label>

            </div>

        </div>

        

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
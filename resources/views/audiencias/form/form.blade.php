<div>

    <input class="form-control" autocomplete="off" type="hidden" name="codigoDespacho" id="codigoDespacho" value="{{ $solicitudAudiencia->codigoDespacho }}">

</div>




<!-- inputs ocultos para el formulario   -->
<div >


        <input class="form-control" placeholder="Correo del despacho que solicita" autocomplete="nope" type="hidden" name="email" id="email" value="{{ $solicitudAudiencia->email }}">

    </div>

    <div >


        <input class="form-control" placeholder="Nombre" autocomplete="off" type="hidden" name="nombre_entidad" id="nombre_entidad" value="{{ $solicitudAudiencia->nombre_entidad }}">

    </div>

<!-- Fin de los inputs ocultos   -->

<div class="row ">

    <div class="col-xs-6 col-sm-4 form-group ">

        <label for="fechaA">Programar Fecha:</label>

        <input class="form-control @error('fecha_prgramada') is-invalid @enderror" autocomplete="off" type="date" name="fecha_prgramada" id="fecha_prgramada" value="{{ old('fecha_prgramada', $solicitudAudiencia->fecha_prgramada) }}">
@error('fecha_prgramada')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>

    <div class="col-xs-6 col-sm-4 form-group ">

        <label for="horaI">Hora inicio:</label>

        <input class="form-control @error('hora_inicio') is-invalid @enderror" id="timepicker" autocomplete="off" placeholder="Ingrese formato militar (24 horas)" type="text" name="hora_inicio" value="{{ old('hora_inicio', $solicitudAudiencia->hora_inicio) }}">
@error('hora_inicio')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>

    <div class="col-xs-6 col-sm-4  form-group ">

        <label for="horaF">Hora finalización:</label>

        <input class="form-control @error('hora_fin') is-invalid @enderror" id="timepicker2" placeholder="Ingrese formato militar (24 horas)" autocomplete="off" type="text" name="hora_fin" value="{{ old('hora_fin', $solicitudAudiencia->hora_fin) }}">
@error('hora_fin')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>

    

</div>

<div class="row ">

    <div class="col-xs-12 col-sm-6 col-md-4 form-group ">

        <label for="ciudad">Ciudad origen de la audiencia:</label>

        <input class="form-control @error('ciudad_destino') is-invalid @enderror" placeholder="Ingrese Ciudad de la Audiencia" autocomplete="off" type="text" name="ciudad_destino" id="ciudad_destino" value="{{ old('ciudad_destino', $solicitudAudiencia->ciudad_destino) }}">
@error('ciudad_destino')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>

    <div class="col-xs-12 col-sm-6 col-md-4 form-group ">

        <label for="entidadDest">Demandante:</label>

        <input class="form-control @error('entidad_destino') is-invalid @enderror" placeholder="Ingrese Demandante" autocomplete="off" type="text" name="entidad_destino" id="entidad_destino" value="{{ old('entidad_destino', $solicitudAudiencia->entidad_destino) }}">
@error('entidad_destino')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>

    <div class="col-xs-12 col-sm-6 col-md-4 form-group ">

        <label for="nRadicacion">Número de radicaci&oacute;n del proceso:</label>

        <input class="form-control @error('numero_radicado_proceso') is-invalid @enderror" id="nProceso" /*'onkeyup'="&quot;validarcantidad(this)&quot;" */'min'="'1" placeholder="Ingrese número de radicado" type="number" name="numero_radicado_proceso" value="{{ old('numero_radicado_proceso', $solicitudAudiencia->numero_radicado_proceso) }}">
@error('numero_radicado_proceso')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

        <div id="cantidad"></div>

    </div>

</div>

<div class="row ">

    <div class="col-xs-12 col-sm-6 col-md-4 form-group ">

        <label for="decoindi">Declarante, Demandado o Indiciado?:</label>

        <input class="form-control @error('declarante_indiciado') is-invalid @enderror" placeholder="Ingrese nombre" autocomplete="off" type="text" name="declarante_indiciado" id="declarante_indiciado" value="{{ old('declarante_indiciado', $solicitudAudiencia->declarante_indiciado) }}">
@error('declarante_indiciado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>

    <div class="col-xs-12 col-sm-6 col-md-4 form-group " style="display:none">

        <label for="direccion">Dirección:</label>

        <input class="form-control @error('direccion') is-invalid @enderror" placeholder="Ingrese la dirección" autocomplete="off" type="text" name="direccion" id="direccion" value="{{ old('direccion', $solicitudAudiencia->direccion) }}">
@error('direccion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>

    <div class="col-xs-12 col-sm-6 col-md-4 form-group ">

        <label for="telefono">Teléfono del solicitante:</label>

        <input class="form-control @error('telefono') is-invalid @enderror" min="1" placeholder="Ingrese número de tel&eacute;fono" autocomplete="off" type="number" name="telefono" id="telefono" value="{{ old('telefono', $solicitudAudiencia->telefono) }}">
@error('telefono')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>

</div>

<div class="row ">

    

    <div class="col-xs-12 col-sm-6 col-md-4 form-group ">

        <label for="auprivada">La audiencia es reservada ?</label>

        <div class="row">

            <div class="col-xs-12 col-lg-6">

                <label><input type="radio" id="cbox2" value="1" name="audiencia_privada" @if($solicitudAudiencia->audiencia_privada == '1')

                    <?php echo 'checked'; ?>

                @endif > SI</label>

                </div>

                <div class="col-xs-12 col-lg-6">

                    <label><input type="radio" id="cbox2" value="0" name="audiencia_privada" @if($solicitudAudiencia->audiencia_privada == '0')

                      <?php echo 'checked'; ?>

                    @endif > NO</label>

                </div>

        </div>

        

    </div>

    <div class="col-xs-12 col-sm-6 col-md-4 form-group ">

        <label for="detenido">Audiencia con detenidos(s) a cargo del inpec?</label>

        <div class="row">

            <div class="col-xs-12 col-lg-6">

            <label><input type="radio" id="cbox1" value="1" name="detenido" onClick="condetenido()" @if($solicitudAudiencia->detenido == '1')

                <?php echo 'checked'; ?>

            @endif   > SI</label>

            </div>

            <div class="col-xs-12 col-lg-6">

                <label><input type="radio" id="cbox2" value="0" name="detenido" onClick="sindetenido()" @if($solicitudAudiencia->detenido == '0')

                  <?php echo 'checked'; ?>

                @endif > NO</label>

            </div>

        </div>

        

    </div>

</div>
<script>
     /*LIMITAR A SOLO 23 DIGITOS EL NUMERO DEL RADICADO DEL PROCESO*/
    var input = document.getElementById('nProceso');
    input.addEventListener('input', function() {
        if (this.value.length > 23)
            this.value = this.value.slice(0, 23);
    })


    //verificar los 23 digitos
    var input = document.getElementById('nProceso');
    input.addEventListener('input', function() {
        var maxLength = 23;
        if (this.value.length > 23) {
            document.getElementById("cantidad").innerHTML = '<strong> <span style="color: red;">' + this.value.length + ' de ' + maxLength + ' dígitos</span></strong>';
        }
        if (this.value.length === 23) {
            document.getElementById("cantidad").innerHTML = '<strong> <span style="color: green;">' + ' Ya esta completo los ' + maxLength + ' dígitos</span></strong>';
        } else {
            document.getElementById("cantidad").innerHTML = '<strong> <span style="color: red;">' + this.value.length + ' de ' + maxLength + ' dígitos</span></strong>';
        }
    })
 
function nombre(id){
        //console.log(id)
        div = document.getElementById(id);
            
        console.log('hola')

        } 
    
</script>
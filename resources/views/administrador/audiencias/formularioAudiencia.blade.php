
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

    <div class="col-xs-12 col-sm-6 col-md-3 form-group " style="display:none">

        <label for="direccion">Dirección:</label>

        <input class="form-control @error('direccion') is-invalid @enderror" placeholder="Ingrese la dirección" autocomplete="off" type="text" name="direccion" id="direccion" value="{{ old('direccion', $solicitudAudiencia->direccion) }}">
@error('direccion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>

    <div class="col-xs-12 col-sm-6 col-md-2 form-group ">

        <label for="telefono">Teléfono del solicitante:</label>

        <input class="form-control @error('telefono') is-invalid @enderror" min="1" placeholder="Ingrese número de tel&eacute;fono" autocomplete="off" type="number" name="telefono" id="telefono" value="{{ old('telefono', $solicitudAudiencia->telefono) }}">
@error('telefono')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>
    
     <div class="col-xs-12 col-sm-3 col-md-2 form-group ">

        <label for="fecha_solicitud">Fecha solicitud:</label>

        <input class="form-control @error('fecha_solicitud') is-invalid @enderror" placeholder="Fecha solicitud" autocomplete="off" type="datetime" name="fecha_solicitud" id="fecha_solicitud" value="{{ old('fecha_solicitud', $solicitudAudiencia->fecha_solicitud) }}">
@error('fecha_solicitud')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>
    <div class="form-group col-xs-6 col-sm-4">
					<label for="Tecnico ">Seleccione Técnico:</label><br>
					<select id="estado" class="form-control @error('quien_asigno') is-invalid @enderror" name="quien_asigno">
    <option value="">Seleccione técnico</option>
    @foreach($tecnicos as $key => $value)
        <option value="{{ $key }}" @selected(old('quien_asigno') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('quien_asigno')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror 
	</div>

</div>

<div class="row ">

    <div class="col-xs-12 col-sm-6 col-md-3 form-group ">

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
     <div class="col-xs-12 col-sm-5 col-md-3 form-group ">

        <label for="enlace">Url Conexión:</label>

        <input class="form-control @error('enlace') is-invalid @enderror" min="1" placeholder="Url conexión lifesize" autocomplete="off" type="text" name="enlace" id="enlace" value="{{ old('enlace', $solicitudAudiencia->enlace) }}">
@error('enlace')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>
    <div class="col-xs-12 col-sm-3 col-md-2 form-group ">

        <label for="id_conexion">Id Conexión:</label>

        <input class="form-control @error('id_conexion') is-invalid @enderror" min="1" placeholder="id lifesize" autocomplete="off" type="text" name="id_conexion" id="id_conexion" value="{{ old('id_conexion', $solicitudAudiencia->id_conexion) }}">
@error('id_conexion')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror

    </div>
   
   

</div>


@if($solicitudAudiencia->detenido == 1)

     <div class="row">

            
            <div class="col-md-12">

                <center><h2><strong> LISTA DE DETENIDOS QUE ASISTIRÁN</strong></h2></center>

                <table class="table text-center table-bordered" ><!--Creamos una tabla que mostrará todas las tareas-->

                        <thead style="background-color: #004182;">

                            <tr>

                                <th scope="col">NOMBRE</th>

                                <th scope="col">CIUDAD</th>

                                <th scope="col">NOMBRE ESTABLECIIENTO</th>

                                <th scope="col">Acciones</th>

                            </tr>

                        </thead>

                        @foreach($solicitudAudiencia->Detenidos as $detenido)

                            <tbody data-id="{!!$detenido->id!!}">

                            <tr>

                                <td>{{$detenido->nombre_interno}}</td>

                                <td>{{$detenido->ciudad}}</td>

                                <td>{{$detenido->nombre_estalecimiento}}</td> 

                                <td><button class="fa fa-trash btn-danger boton_delete_detenido" type="button"></button></td>

                            </tr>

                            </tbody>

                        @endforeach

                    </table>

            </div>

        </div>

 @endif

 <script>
  
            

    //solo numeros
     let numerico = document.querySelector('#nProceso').addEventListener('keypress', validaNumericos);
    
        function validaNumericos(e) {
            var key = window.event ? e.which : e.keyCode;
            if (key < 48 || key > 57) {
                e.preventDefault();
            }
        }
    
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
 

    
</script>
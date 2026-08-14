@extends('layouts.expedientes')
<!--ponerle titulo a la paginga-->
@section('title', 'Reportes de Expedientes En Prestamo')
@section('cabecera', 'Expedientes en Prestamo')



@section('content')

<form action="{{ route('expediente.actualizar.expediente',$expediente->id) }}" method="POST">
    @csrf
    @method('PUT')
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 col-xs-6">
        <label for="fechaA">RADICACI&Oacute;N : </label> <label id="cantidad"></label> <br>
        <input class="form-control form-group  shadow @error('radicado') is-invalid @enderror" placeholder="Registrar Radicacion" autocomplete="off" id="nProceso" type="number" name="radicado" value="{{ old('radicado', $expediente->radicado ?? '') }}">
@error('radicado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        <div id="cantidad"></div>
</div>
<div class="col-xs-12 col-xs-6">
    <label for="fechaA">NI:</label><br>
    <input class="form-control form-group  shadow @error('ni') is-invalid @enderror" placeholder="Registrar Radicacion" autocomplete="off" type="number" name="ni" id="ni" value="{{ old('ni', $expediente->ni ?? '') }}">
@error('ni')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
 </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-xs-6">
     <label for="fechaA">CEDULA PROCESADO:</label><br>
     <input class="form-control form-group  shadow @error('cedula_procesado') is-invalid @enderror" placeholder="Registrar Radicacion" autocomplete="off" type="text" name="cedula_procesado" id="cedula_procesado" value="{{ old('cedula_procesado', $expediente->cedula_procesado ?? '') }}">
@error('cedula_procesado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
  </div>
 <div class="col-xs-12 col-sm-6">
    <label for="quienSolicita">NOMBRE PROCESADO:</label><br>
    <input placeholder="Seleccione Despacho" class="form-control form-group  shadow  @error('nombre_procesado') is-invalid @enderror" aria-required="true" type="text" name="nombre_procesado" id="nombre_procesado" value="{{ old('nombre_procesado', $expediente->nombre_procesado ?? '') }}">
@error('nombre_procesado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
 </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-xs-6">
    <label for="fechaA">DELITO:</label><br>
    <input class="form-control form-group  shadow @error('delito') is-invalid @enderror" placeholder="Registrar Radicacion" autocomplete="off" type="text" name="delito" id="delito" value="{{ old('delito', $expediente->delito ?? '') }}">
@error('delito')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
    </div>
    <div class="col-xs-12 col-xs-6">
        <label for="fechaA">SEDE:</label><br>
        <select class="form-control select2 @error('sede') is-invalid @enderror" aria-required="true" style="width:100%" name="sede" id="sede">
    <option value="">Seleccione Sede</option>
    @foreach($sedes as $key => $value)
        <option value="{{ $key }}" @selected(old('sede', $expediente->sede) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('sede')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
    </div>
    </div>
    <div class="row">
         <div class="col-xs-12 col-xs-6">
        <label for="fechaA">TIPO EMPAQUE:</label><br>
        <select class="form-control select2 @error('almacenado_en') is-invalid @enderror" aria-required="true" style="width:100%" name="almacenado_en" id="almacenado_en">
    <option value="">Seleccione Tipo Empaque</option>
    @foreach($empaque as $key => $value)
        <option value="{{ $key }}" @selected(old('almacenado_en', $expediente->almacenado_en) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('almacenado_en')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
    </div>
    <div class="col-xs-12 col-xs-6">
        <label for="fechaA">No. CAJA:</label><br>
        <input placeholder="Registre No. Caja" class="form-control  @error('no_caja') is-invalid @enderror" aria-required="true" type="text" name="no_caja" id="no_caja" value="{{ old('no_caja', $expediente->no_caja ?? $expediente->no_caja) }}">
@error('no_caja')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
    </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-xs-6">
        <label for="fechaA">N. CUADERNO:</label><br>
        <input class="form-control form-group  shadow @error('cuadernos') is-invalid @enderror" placeholder="Registrar Radicacion" autocomplete="off" type="number" name="cuadernos" id="cuadernos" value="{{ old('cuadernos', $expediente->cuadernos ?? '') }}">
@error('cuadernos')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        </div>
        <div class="col-xs-12 col-xs-6">
            <label for="fechaA">NUMERO DE FOLIOS:</label><br>
            <input class="form-control form-group  shadow @error('folios') is-invalid @enderror" placeholder="Registrar Radicacion" autocomplete="off" type="text" name="folios" id="folios" value="{{ old('folios', $expediente->folios ?? '') }}">
@error('folios')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-xs-4">
            <label for="fechaA">TIPO EXPEDIENTE:</label><br>
            <select class="form-control select2 @error('tipo_expediente') is-invalid @enderror" aria-required="true" style="width:100%" name="tipo_expediente" id="tipo_expediente">
    <option value="">Seleccione Tipo Proceso</option>
    @foreach($tproceso as $key => $value)
        <option value="{{ $key }}" @selected(old('tipo_expediente', $expediente->tipo_expediente) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('tipo_expediente')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
        </div>
        <div class="col-xs-12 col-xs-4">
            <label for="fechaA">FECHA DIGITALIZACION:</label><br>
            <input class="form-control form-group  shadow @error('fecha_digitalizado') is-invalid @enderror" placeholder="Registrar Radicacion" autocomplete="off" type="date" name="fecha_digitalizado" id="fecha_digitalizado" value="{{ old('fecha_digitalizado', $expediente->fecha_digitalizado ?? '') }}">
@error('fecha_digitalizado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
        <div class="row"><div class="col-xs-12 col-xs-4">
                <label for="fechaA">ASUNTO ARCHIVO:</label><br>
                <select class="form-control select2 @error('asunto_archivo') is-invalid @enderror" aria-required="true" style="width:100%" name="asunto_archivo" id="asunto_archivo">
    <option value="">Seleccione Asunto Archivo</option>
    @foreach($asuntarchivo as $key => $value)
        <option value="{{ $key }}" @selected(old('asunto_archivo', $expediente->asunto_archivo) == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('asunto_archivo')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div>
    </div>
    
            <div class="col-xs-12 col-xs-12">
                <label for="fechaA">OBSERVACIONES:</label><br>
                <textarea class="form-control form-group  shadow @error('observaciones') is-invalid @enderror" placeholder="Registrar Radicacion" autocomplete="off" name="observaciones" id="observaciones">{{ old('observaciones', $expediente->observaciones ?? '') }}</textarea>
@error('observaciones')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
            </div></div>
</div>
</div>
<div class="modal-footer">
<div class="row">
<div class="col-xs-6">
    <a href="{{ url()->previous() }}" class="btn btn-danger  btn-block">CERRAR</a>
</div>
<div class="col-xs-6">
    <button class="btn btn-warning  btn-block" style="background-color: #004182; color: #fff;" type="submit">ACTUALIZAR DATOS EXPEDIENTE</button>
    </div>
</div>
</form>


<script>

        //ACEPTAR SOLO NUMERO EN INPUTS
        //funcion para solo permitir ingreso de valores numericos
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
                document.getElementById("cantidad").innerHTML = '<strong> <span style="color: green;">' + ' ' + maxLength + ' dígitos</span></strong>';
            } else {
                document.getElementById("cantidad").innerHTML = '<strong> <span style="color: red;">' + this.value.length + ' de ' + maxLength + ' dígitos</span></strong>';
            }
        })



    </script>



@endsection

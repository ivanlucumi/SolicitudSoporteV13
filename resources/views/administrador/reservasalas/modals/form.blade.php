    <div class="row">
      <div class="col-xs-12 col-md-12 form-group">
        <label for="rs_numero_radicado">#Número Radicado:</label>
        <input class="form-control @error('rs_numero_radicado') is-invalid @enderror" placeholder="Ingrese el nombre de la sala del juzgado ej: 76001..." style="text-transform:uppercase;" type="number" name="rs_numero_radicado" id="rs_numero_radicado" value="{{ old('rs_numero_radicado') }}">
@error('rs_numero_radicado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-md-6 form-group {{$errors->has('body') ? 'has-errors' : ''}}">
        <label for="rs_sala">Seleccionar Piso:</label>
        <select ['id'="'responsables','class' => 'form-control ','style'=>'width: 100%;','placeholder'=>'Seleccione sala reserva','required']" name="rs_sala" id="rs_sala" class="@error('rs_sala') is-invalid @enderror">
    @foreach($salas as $key => $value)
        <option value="{{ $key }}" @selected(old('rs_sala') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('rs_sala')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
      </div>
      <div class="col-xs-12 col-md-6 form-group {{$errors->has('body') ? 'has-errors' : ''}}">
        <label for="rs_codigo_juzgado">Seleccionar Juzgado:</label>
        <select ['id'="'responsables','class' => 'form-control ','style'=>'width: 100%;','placeholder'=>'Seleccione Juzgado reserva']" name="rs_codigo_juzgado" id="rs_codigo_juzgado" class="@error('rs_codigo_juzgado') is-invalid @enderror">
    @foreach($despacho as $key => $value)
        <option value="{{ $key }}" @selected(old('rs_codigo_juzgado') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('rs_codigo_juzgado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-sm-6 form-group">
        <label for="rs_nombre_fiscal">Nombre Fiscal:</label>
        <input class="form-control @error('rs_nombre_fiscal') is-invalid @enderror" placeholder="Ingrese el nombre del fiscal ej: Mario" style="text-transform:uppercase;" type="text" name="rs_nombre_fiscal" id="rs_nombre_fiscal" value="{{ old('rs_nombre_fiscal') }}">
@error('rs_nombre_fiscal')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
      </div>
      <div class="col-xs-12 col-sm-6 form-group">
        <label for="rs_nombre_indiciado">Nombre indiciado:</label>
        <input class="form-control @error('rs_nombre_indiciado') is-invalid @enderror" placeholder="Ingrese el nombre de la persona indiciada ej: Mario" style="text-transform:uppercase;" type="text" name="rs_nombre_indiciado" id="rs_nombre_indiciado" value="{{ old('rs_nombre_indiciado') }}">
@error('rs_nombre_indiciado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
      </div>
    </div>


    <div class="row">
      <div class="col-xs-12 col-md-6 form-group">
        <label for="rs_fecha">Fecha Reserva:</label>
        <input min="$fechaA" class="form-control @error('rs_fecha') is-invalid @enderror" placeholder="Ingrese el nombre de la persona indiciada ej: Mario" style="text-transform:uppercase;" type="date" name="rs_fecha" id="rs_fecha" value="{{ old('rs_fecha') }}">
@error('rs_fecha')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
      </div>
      <div class="col-xs-12 col-md-6 form-group">
        <label for="rs_estado">Estadp Reserva:</label>
        <input class="form-control @error('rs_estado') is-invalid @enderror" placeholder="Ingrese el estado de la reserva" style="text-transform:uppercase;" type="text" name="rs_estado" id="rs_estado" value="{{ old('rs_estado', 'ACTIVO') }}">
@error('rs_estado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
      </div>
    </div>

    <div class="row">
      <div class="col-xs-12 col-md-6 form-group">
        <label for="rs_hora_inicio">Hora Inicio Reserva:</label>
        <input class="form-control @error('rs_hora_inicio') is-invalid @enderror" placeholder="Ingrese la hora inicio de la reserva" style="text-transform:uppercase;" type="time" name="rs_hora_inicio" id="rs_hora_inicio" value="{{ old('rs_hora_inicio') }}">
@error('rs_hora_inicio')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror  
      </div>
      <div class="col-xs-12 col-md-6 form-group">
        <label for="rs_hora_fin">Hora Fin Reserva:</label>
        <input class="form-control @error('rs_hora_fin') is-invalid @enderror" placeholder="Ingrese la hora inicio de la reserva" style="text-transform:uppercase;" type="time" name="rs_hora_fin" id="rs_hora_fin" value="{{ old('rs_hora_fin') }}">
@error('rs_hora_fin')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror  
      </div>
    </div> 
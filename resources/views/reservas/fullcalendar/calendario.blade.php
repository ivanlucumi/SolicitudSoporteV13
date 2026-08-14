 @extends('reservas.fullcalendar.horario')
<!--ponerle titulo a la paginga-->
@section('title', 'Calendario de horarios')

@section('encabezado')
CALENDARIO DE LA SALA  <strong>{{$salaN}}</strong>
@endsection


@section('content') 


@endsection

@section('salas') 
    <form action="{{ route('reservas.calendario') }}" method="POST">
    @csrf
        <label for="rs_sala">Seleccionar Piso:</label>
        <select ['id'="'responsables','class' => 'form-control select2 ','type'=>'search', 'tabindex'=>&quot;0&quot;, 'autocomplete'=>&quot;off&quot;, 'autocorrect'=>&quot;off&quot;, 'autocapitalize'=>&quot;none&quot;, 'spellcheck'=>&quot;false&quot;, 'role'=>&quot;textbox&quot;, 'aria-autocomplete'=>&quot;list&quot;,'style'=>'width: 100%;','placeholder'=>'Seleccione sala reserva','required']" name="rs_sala" id="rs_sala" class="@error('rs_sala') is-invalid @enderror">
    @foreach($salas as $key => $value)
        <option value="{{ $key }}" @selected(old('rs_sala') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('rs_sala')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
    <button class="form-group btn bg-olive elevation-5  my-2 my-sm-0 shadow" type="submit">Buscar Sala</button>
      </form>
@endsection


@section('calendar') 


@include('reservas.fullcalendar.contenidoCalendario')

@endsection
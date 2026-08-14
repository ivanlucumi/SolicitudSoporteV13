@php
    $esEdicion = isset($contrato);
@endphp

<form method="POST"
      action="{{ $esEdicion ? route('contratos.novedades.update', $contrato->id) : route('contratos.novedades.store') }}"
      enctype="multipart/form-data">

    @csrf
    @if($esEdicion)
        @method('PUT')
    @endif

    <div class="panel panel-default">

        <div class="panel-heading">
            <strong>{{ $esEdicion ? 'Editar contrato/ Orden de Compra' : 'Crear contrato / Orden de Compra' }}</strong>
        </div>

        <div class="panel-body">

            {{-- TIPO --}}
            <div class="row">
                {{-- NUMERO --}}
                <div class="col-md-2">
                    <div class="form-group">
                        <label>N&uacute;mero</label>
                        <input type="text"
                               name="numero"
                               id="numero"
                               class="form-control"
                               value="{{ old('valor', isset($contrato) ? $contrato->numero : '') }}"
                               placeholder="Numero"
                               required>
                    </div>
                </div>
                {{-- TIPO --}}
                <div class="col-md-3">
                    <label>Tipo</label>
                    <select name="tipo" class="form-control" required>
                        <option value="">Seleccione</option>
                        <option value="CONTRATO" {{ old('tipo', $contrato->tipo ?? '')=='CONTRATO'?'selected':'' }}>CONTRATO</option>
                        <option value="ORDEN_COMPRA" {{ old('tipo', $contrato->tipo ?? '')=='ORDEN_COMPRA'?'selected':'' }}>ORDEN DE COMPRA</option>
                    </select>
                </div>
                
                {{-- CONTRATISTA --}}
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Contratista</label>
                        <input type="text"
                               name="contratista"
                               id="contratista"
                               class="form-control"
                               value="{{ old('valor', isset($contratista) ? $contrato->contratista : '') }}"
                               placeholder="Contratista"
                               required>
                    </div>
                </div>

                {{-- ESTADO --}}
                <div class="col-md-3">
                    <label>Estado</label>
                    <select name="estado" class="form-control" required>
                        @foreach(['ACTIVO','FINALIZADO','CERRADO'] as $estado)
                            <option value="{{ $estado }}"
                                {{ old('estado', $contrato->estado ?? 'ACTIVO')==$estado?'selected':'' }}>
                                {{ $estado }}
                            </option>
                        @endforeach
                    </select>
                </div>

               
            </div>
            
            <div class="row">
                
                 {{-- VALOR --}}
                <div class="col-md-4">
                    <label>Valor del contrato</label>
                    <input type="text"
                           name="valor"
                           id="valor"
                           min="1"
                           class="form-control"
                           value="{{ old('valor', isset($contrato) ? $contrato->valor : '') }}"
                           placeholder="costo en pesos (10.000.000,00)"
                           required>
                </div>

                {{-- OBJETO --}}
                <div class="col-md-8">
                    <div class="form-group">
                        <label>Objeto</label>
                        <textarea name="objeto"
                                  class="form-control"
                                  rows="3"
                                  required>{{ old('objeto', $contrato->objeto ?? '') }}</textarea>
                    </div>
                </div>
                
                 {{-- OBJETO --}}
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Forma de Pago</label>
                        <textarea name="forma_pago"
                                  class="form-control"
                                  rows="3"
                                  required>{{ old('objeto', $contrato->forma_pago ?? '') }}</textarea>
                    </div>
                </div>
            
            </div>
            
            {{-- FECHAS --}}
            <div class="row">
                <div class="col-md-3">
                    <label>Fecha inicio</label>
                    <input type="date" name="fecha_inicio" class="form-control"
                           value="{{ old('fecha_inicio', isset($contrato)?$contrato->fecha_inicio->format('Y-m-d'):'') }}" required>
                </div>

                <div class="col-md-3">
                    <label>Fecha pólizas</label>
                    <input type="date" name="fecha_polizas" class="form-control"
                           value="{{ old('fecha_polizas', optional($contrato->fecha_polizas ?? null)->format('Y-m-d')) }}">
                </div>

                <div class="col-md-3">
                    <label>Fecha terminación</label>
                    <input type="date" name="fecha_terminacion" class="form-control"
                           value="{{ old('fecha_terminacion', isset($contrato)?$contrato->fecha_terminacion->format('Y-m-d'):'') }}" required>
                </div>

                <div class="col-md-3">
                    <label>Fecha cierre</label>
                    <input type="date" name="fecha_cierre" class="form-control"
                           value="{{ old('fecha_cierre', optional($contrato->fecha_cierre ?? null)->format('Y-m-d')) }}">
                </div>
            </div>

            {{-- DOCUMENTO --}}
            <hr>
            <label>Documento inicial</label>

            @if($esEdicion && $contrato->documento_inicial)
                <p>
                    <a href="{{ asset('storage/'.$contrato->documento_inicial) }}" target="_blank">
                        Ver documento actual
                    </a>
                </p>
            @endif

            <input type="file" name="documento_inicial" class="form-control">

        </div>

        <div class="panel-footer text-right">
            <button class="btn btn-success">
                {{ $esEdicion ? 'Guardar cambios' : 'Crear contrato' }}
            </button>

            <a href="{{ route('contratos.novedades.index') }}" class="btn btn-default">
                Cancelar
            </a>
        </div>
    </div>
</form>


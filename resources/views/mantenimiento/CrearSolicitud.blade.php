@extends('layouts.mantenimiento')

@section('title', 'Reporte de Incidentes')
@section('cabecera', 'Registrar Incidentes a Mantenimiento')

@section('content')

<style>
    .minimal-wrapper {
        max-width: 850px;
        margin: auto;
    }

    .minimal-card {
        background: #ffffff;
        border-radius: 14px;
        padding: 35px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        margin-bottom: 30px;
    }

    .minimal-title {
        text-align: center;
        font-weight: 600;
        margin-bottom: 25px;
        letter-spacing: 0.5px;
    }

    .minimal-form-group {
        margin-bottom: 18px;
    }

    .minimal-form-group label {
        font-size: 13px;
        font-weight: 500;
        margin-bottom: 6px;
        display: block;
        color: #444;
    }

    .minimal-input {
        width: 100%;
        padding: 10px 12px;
        border-radius: 8px;
        border: 1px solid #e5e5e5;
        font-size: 14px;
        transition: all 0.2s ease;
        outline: none;
    }

    .minimal-input:focus {
        border-color: #004182;
        box-shadow: 0 0 0 3px rgba(0,125,110,0.08);
    }

    .minimal-btn {
        background: #004182;
        color: white;
        border: none;
        padding: 12px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        letter-spacing: 0.5px;
        width: 100%;
        transition: 0.2s ease;
    }

    .minimal-btn:hover {
        background: #005f54;
    }
</style>

<style>
.select2-container--default .select2-selection--single {
    height: 40px;
    border-radius: 8px;
    border: 1px solid #e5e5e5;
    padding: 6px 8px;
}

.select2-container--default .select2-selection--single:focus {
    border-color: #004182;
}

.select2-container--default .select2-selection__rendered {
    line-height: 26px;
    font-size: 14px;
}

.select2-container--default .select2-selection__arrow {
    height: 38px;
}
</style>


<div class="container-fluid">
    <div class="row">
        <div class="col-xs-1"></div>
        <div class="col-xs-10">
            <div class="card mb-3">
                <div class="card-body text-center">
                    <h2><strong>FORMULARIO PARA REGISTRO DE INCIDENTES A MANTENIMIENTO</strong></h2>
                    <h4></h4>
                    <h3>{{ strtoupper( auth()->user()->name) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-xs-1"></div>
    </div>

    <div class="row">
        <form action="{{ route('reporte.incidente.save') }}" method="POST">
    @csrf
        <div class="col-xs-12 col-sm-4">
            <div class="minimal-form-group">
            <label for="despacho_id">Despacho</label>
            <select name="despacho_id" id="despacho_id" class="minimal-input select2" required>
                <option value="">Seleccione un despacho</option>

                <!-- Opción fija primero -->
                <option value="7600100000">ZONA COMÚN</option>

                @foreach($despachos as $despacho)
                    <option value="{{ $despacho->codigoDespacho }}">
                        {{ $despacho->nombreDespacho }}
                    </option>
                @endforeach
            </select>
        </div>
        </div>
        
       <div class="col-xs-12 col-sm-4">
            <div class="minimal-form-group">
            <label for="ubicacion">Ubicación</label>
            <input 
                type="text" 
                name="ubicacion" 
                id="ubicacion"
                class="minimal-input"
                placeholder="Ej: Oficina 204, Sala de juntas..."
                required
            >
        </div>
       </div>
       
       <div class="col-xs-12 col-sm-4">
            <div class="minimal-form-group">
            <label for="piso">Piso</label>
            <input 
                type="text" 
                name="piso" 
                id="piso"
                class="minimal-input"
                placeholder="Ej: 2"
                min="0"
                required
            >
        </div>
       </div>

        @include('usuario.Mantenimiento.form')

        <div class="col-xs-12 text-center my-3">
            <button class="btn btn-primary" type="submit">REGISTRAR SOLICITUD</button>
        </div>

        </form>
    </div>

    <hr>

    <div class="row">
        <div class="col-xs-1"></div>
        <div class="col-xs-10">
            <div class="card mb-3">
                <div class="card-body text-center">
                    <h2><strong>LISTADO DE INCIDENTES SIN SOLUCI&Oacute;N</strong></h2>
                </div>
            </div>
        </div>
        <div class="col-xs-1"></div>
    </div>

    <div class="row">
        <div class="table-responsive col-xs-12">
            <table id="table9" class="table table-bordered table-striped">
                <thead style="background-color: #004182; color: #fff;">
                    <tr>
                        <th>Consecutivo</th>
                        <th>Categor&iacute;a</th>
                        <th>Requerimiento</th>
                        <th>Descripci&oacute;n</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Observaciones</th>
                        <th>Acci&oacute;n</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($incidentes as $solicitud)
                        <tr class="buscar" data-id="{{ $solicitud->id }}">
                            <td>{{ $solicitud->consecutivo }}</td>
                            <td>{{ $solicitud->categoria }}</td>
                            <td>{{ $solicitud->item }}</td>
                            <td>{{ $solicitud->descripcion }}</td>
                            <td>{{ $solicitud->created_at }}</td>
                            <td>{{ $solicitud->estado }}</td>
                            <td>{{ $solicitud->observaciones }}</td>
                            <td>
                                <button class="btn btn-success btn-block fa fa-eye ver" title="Ver"></button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center">No hay incidentes reportados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @include('usuario.formIncidente')
</div>

<form id="form-reporte-incidente-consulta" action="{{ route('mantenimiento.consulta.reporte.incidente',':ID_ID') }}" method="POST">
    @csrf
</form>
<!-- jQuery 3 -->

<script src="adminlte/bower_components/jquery/dist/jquery-3.2.1.min.js"></script>

<script>
    $(document).on('click', '.ver', function (e) {
        e.preventDefault();
        const id = $(this).closest('tr').data('id');
        const url = $('#form-reporte-incidente-consulta').attr('action').replace(':ID_ID', id);

        $.get(url, function (result) {
            $('#id').val(result.id);
            $('#idCategoria').val(result.categoria);
            $('#IdItem').val(result.item);
            $('#idDescripcion').val(result.descripcion);
            $('#IdFecha').val(result.created_at);
            $('#idIReporte').val(result.marca);
            $('#IdEstado').val(result.estado);
            $('#Idobservaciones').val(result.observaciones);
            $('#IdRespTecnico').val(result.respuesta_tecnico);
            $('#modal_Revisar_reporte').modal('show');
        });
    });

    $('#identificacion').on('input', function () {
        $.get("/usuarios/consulta/cedula/" + this.value, function (response) {
            if (Object.keys(response).length > 0) {
                $('#nombre-funcionario').val(response.nombre + " " + response.apellidos);
            } else {
                $('#nombre-funcionario').val('');
            }
        });
    });

    $(document).on('change', '.categoria-select', function () {
        const categoria = $(this).val();
        const itemSelect = $(this).closest('.categoria-item').find('.item-select');
        itemSelect.empty().append('<option selected disabled>Cargando...</option>');

        $.get("/mantenimiento/reporte/incidentes/reporte/categories/elements/" + categoria, function (data) {
            itemSelect.empty();
            if (data.length > 0) {
                
                itemSelect.append('<option value="" disabled selected>Seleccione Requerimiento</option>');
                $.each(data, function (i, v) {
                    
                    itemSelect.append('<option value=" + v.id + ">' + v.elemento + '</option>');
                });
                itemSelect.append('<option value="otro">OTRO</option>');

            } else {
                itemSelect.append('<option disabled>No hay elementos disponibles</option>');
            }
        }).fail(function () {
            itemSelect.empty().append('<option disabled>Error al cargar los elementos</option>');
        });
    });

    // Agregar línea adicional de categoría-requerimiento
    $(document).on('click', '.add-line', function () {
        const container = $('#categorias-container');
        const index = container.find('.categoria-item').length;
        const template = `
        <div class="row categoria-item mt-2" data-index="${index}">
            <div class="col-xs-12 col-sm-5">
                <label>Categor&iacute;a:</label>
                <select name="categoria[]" class="form-control categoria-select" required>
                    <option value="">Seleccione Categor&iacute;a</option>
                    @foreach($categorias as $a)
                        <option value="{{ $a->id }}">{{ $a->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-xs-12 col-sm-5">
                <label>Requerimiento:</label>
                <select name="item[]" class="form-control item-select" required>
                    <option value="">Seleccione una categor&iacute;a primero</option>
                </select>
            </div>
            <div class="col-xs-12 col-sm-2">
                <label>&nbsp;</label>
                <button type="button" class="btn btn-danger btn-deleter btn-block remove-line"><i class="fa fa-trash" aria-hidden="true"></i></button>
            </div>
        </div>`;
        container.append(template);
    });

    $(document).on('click', '.remove-line', function () {
        $(this).closest('.categoria-item').remove();
    });
</script>

<script>
    // Mostrar campo input si se selecciona "Otro"
$(document).on('change', '.item-select', function () {
    const selected = $(this).val();
    const container = $(this).closest('.categoria-item');

    if (selected === 'otro') {
        if (container.find('.otro-input').length === 0) {
            container.find('.item-select').after(`<br><label>Registre Requerimiento:</label>
                <input type="text" name="otro_item[]" class="form-control otro-input mt-1" maxlength="30" placeholder="Especifique el requerimiento Max 30 Caracteres" required>
            `);
        }
    } else {
        container.find('.otro-input').remove();
    }
});

</script>
@push('scripts')
<script>
$(function () {

    $('#despacho_id').select2({
        placeholder: "Buscar despacho...",
        allowClear: true,
        width: '100%'
    });

});
</script>
@endpush



@endsection

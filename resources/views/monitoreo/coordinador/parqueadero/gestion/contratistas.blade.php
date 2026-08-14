@extends('layouts.monitoreo.coordinador')

@section('cabecera')
    Gestión de Contratistas
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Listado de Contratistas</h3>
                <div class="box-tools">
                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalContratista">
                        <i class="fa fa-plus"></i> Nuevo Contratista
                    </button>
                </div>
            </div>
            <div class="box-body">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <i class="fa fa-check-circle"></i> {{ session('success') }}
                </div>
                @endif

                <form action="{{ route('coordinador.ingresos') }}" method="GET" class="form-inline" style="margin-bottom: 20px;">
                    <input type="text" name="cedula" class="form-control" placeholder="Buscar por cédula..." value="{{ request('cedula') }}">
                    <button type="submit" class="btn btn-default">Buscar</button>
                </form>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width:70px;">Foto</th>
                                <th>Cédula</th>
                                <th>Nombre</th>
                                <th>Empresa/Dependencia</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contratistas as $c)
                            <tr>
                                <td style="text-align:center;">
                                    @if($c->foto && file_exists(public_path('contratistas/' . $c->foto)))
                                        <img src="{{ asset('contratistas/' . $c->foto) }}" alt="Foto"
                                             style="width:45px;height:45px;object-fit:cover;border-radius:50%;border:2px solid #0f3460;">
                                    @else
                                        <div style="width:45px;height:45px;border-radius:50%;background:linear-gradient(135deg,#1a1a2e,#0f3460);display:flex;align-items:center;justify-content:center;margin:0 auto;">
                                            <i class="fa fa-user" style="color:#fff;font-size:20px;"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $c->cedula }}</td>
                                <td>{{ $c->nombre }}</td>
                                <td>{{ $c->empresa }}</td>
                                <td>
                                    @if($c->activo)
                                    <span class="label label-success">Activo</span>
                                    @else
                                    <span class="label label-danger">Inactivo</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-xs btn-warning" onclick='editContratista(@json($c))'>
                                        <i class="fa fa-edit"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $contratistas->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalContratista" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('coordinador.ingresos.store') }}" method="POST" enctype="multipart/form-data" id="formContratista">
                <input type="hidden" name="id" id="input_id">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title" id="modalTitle">Nuevo Contratista</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Cédula</label>
                        <input type="text" name="cedula" id="input_cedula" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Nombre Completo</label>
                        <input type="text" name="nombre" id="input_nombre" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Empresa / Proyecto</label>
                        <input type="text" name="empresa" id="input_empresa" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Foto del Contratista <small class="text-muted">(JPG, PNG — máx. 2MB)</small></label>
                        <div style="display:flex;align-items:center;gap:15px;">
                            <div id="preview_foto_container" style="width:70px;height:70px;border-radius:50%;overflow:hidden;background:linear-gradient(135deg,#1a1a2e,#0f3460);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                <img id="preview_foto" src="" alt="" style="width:100%;height:100%;object-fit:cover;display:none;">
                                <i id="preview_icon" class="fa fa-user" style="color:#fff;font-size:28px;"></i>
                            </div>
                            <div style="flex:1;">
                                <input type="file" name="foto" id="input_foto" class="form-control" accept="image/*">
                            </div>
                        </div>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="activo" id="input_activo" checked> Activo
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
function editContratista(c) {
    $('#modalTitle').text('Editar Contratista');
    $('#input_id').val(c.id);
    $('#input_cedula').val(c.cedula);
    $('#input_nombre').val(c.nombre);
    $('#input_empresa').val(c.empresa);
    $('#input_activo').prop('checked', c.activo == 1);

    // Mostrar foto actual si existe
    if (c.foto) {
        // La foto se guarda como nombre de archivo. La URL pública es /contratistas/{nombre}
        const fotoUrl = '/contratistas/' + c.foto;
        $('#preview_foto').attr('src', fotoUrl).show();
        $('#preview_icon').hide();
    } else {
        $('#preview_foto').hide();
        $('#preview_icon').show();
    }

    $('#modalContratista').modal('show');
}

$('#modalContratista').on('hidden.bs.modal', function () {
    $('#modalTitle').text('Nuevo Contratista');
    $('#input_id').val('');
    $('#input_cedula').val('');
    $('#input_nombre').val('');
    $('#input_empresa').val('');
    $('#input_activo').prop('checked', true);
    $('#input_foto').val('');
    $('#preview_foto').attr('src', '').hide();
    $('#preview_icon').show();
});

// Preview de foto al seleccionar archivo
$('#input_foto').on('change', function () {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            $('#preview_foto').attr('src', e.target.result).show();
            $('#preview_icon').hide();
        };
        reader.readAsDataURL(file);
    }
});
</script>
@endpush
@endsection

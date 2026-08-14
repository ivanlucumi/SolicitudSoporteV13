@extends('layouts.SinSidebar')

@section('title', 'Administración de Publicaciones')
@section('cabecera', 'Gestión de Acuerdos y Circulares')

@push('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap4.min.css">
<style>
    .admin-card { background: #fff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); padding: 20px; margin-bottom: 25px; }
    .card-title { color: #0a2a4a; font-weight: 700; font-size: 1.2rem; border-bottom: 2px solid #FDC500; padding-bottom: 10px; margin-bottom: 20px; }
    .form-group label { font-weight: 600; color: #333; }
    .btn-submit { background-color: #0a2a4a; color: white; border: none; border-radius: 4px; padding: 10px 20px; font-weight: 600; transition: background 0.3s; }
    .btn-submit:hover { background-color: #0d3b66; color: white; }
    .table-responsive { overflow-x: auto; }
    .btn-delete { background-color: #dc3545; color: white; border: none; padding: 5px 10px; border-radius: 3px; }
    .btn-delete:hover { background-color: #c82333; }
    .badge-tipo { background-color: #e3f2fd; color: #1565c0; padding: 5px 10px; border-radius: 20px; font-size: 0.8rem; font-weight: bold; }
</style>
@endpush

@section('content')
<div class="container-fluid" style="padding: 20px 30px;">
    
    @if(Session::has('message'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Éxito!</strong> {{ Session::get('message') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>Error!</strong> Por favor revise los campos del formulario.
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">
        <!-- Formulario de Registro -->
        <div class="col-md-4">
            <div class="admin-card">
                <h3 class="card-title">Registrar Nueva Publicación</h3>
                <form action="{{ route('admin.publicaciones.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-group">
                        <label for="tipo_publicacion">Tipo de Publicación *</label>
                        <select name="tipo_publicacion" id="tipo_publicacion" class="form-control" required>
                            <option value="">Seleccione una opción...</option>
                            <option value="ACUERDO CONSEJO SUPERIOR DE LA JUDICATURA BOGOTA">ACUERDO CONSEJO SUPERIOR DE LA JUDICATURA BOGOTA</option>
                            <option value="ACUERDO CONSEJO SECCIONAL CALI">ACUERDO CONSEJO SECCIONAL CALI</option>
                            <option value="CIRCULARES DIRECCION EJECUTIVA ADMINISTRACION JUDICIAL BOGOTA">CIRCULARES DIRECCION EJECUTIVA ADMINISTRACION JUDICIAL BOGOTA</option>
                            <option value="CIRCULARES DIRECCION SECCIONAL CALI">CIRCULARES DIRECCION SECCIONAL CALI</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="numero_acta"># Acta (Opcional)</label>
                        <input type="text" name="numero_acta" id="numero_acta" class="form-control" placeholder="Ej: 001-2023">
                    </div>

                    <div class="form-group">
                        <label for="fecha">Fecha *</label>
                        <input type="date" name="fecha" id="fecha" class="form-control" required value="{{ date('Y-m-d') }}">
                    </div>

                    <div class="form-group">
                        <label for="asunto">Asunto / Descripción *</label>
                        <textarea name="asunto" id="asunto" class="form-control" rows="4" required placeholder="Ingrese el asunto de la publicación..."></textarea>
                    </div>

                    <div class="form-group">
                        <label for="documento">Archivo PDF *</label>
                        <input type="file" name="documento" id="documento" class="form-control" accept=".pdf" required>
                        <small class="text-muted">Solo archivos PDF (Max: 10MB).</small>
                    </div>

                    <button type="submit" class="btn-submit btn-block">
                        <i class="fa fa-save"></i> Guardar Publicación
                    </button>
                </form>
            </div>
        </div>

        <!-- Tabla de Registros -->
        <div class="col-md-8">
            <div class="admin-card">
                <h3 class="card-title">Publicaciones Registradas</h3>
                
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover" id="tabla-publicaciones">
                        <thead style="background-color: #0a2a4a; color: white;">
                            <tr>
                                <th>Fecha</th>
                                <th>Tipo</th>
                                <th># Acta</th>
                                <th>Asunto</th>
                                <th>Archivo</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($publicaciones as $pub)
                            <tr>
                                <td style="white-space: nowrap;">{{ $pub->fecha ? \Carbon\Carbon::parse($pub->fecha)->format('d/m/Y') : 'N/A' }}</td>
                                <td>
                                    <span class="badge-tipo" title="{{ $pub->tipo_publicacion }}">
                                        {{ \Illuminate\Support\Str::limit($pub->tipo_publicacion, 30) }}
                                    </span>
                                </td>
                                <td>{{ $pub->numero_acta ?? 'N/A' }}</td>
                                <td style="max-width: 250px;" title="{{ $pub->asunto }}">{{ \Illuminate\Support\Str::limit($pub->asunto, 50) }}</td>
                                <td class="text-center">
                                    <a href="{{ $pub->archivo_pdf }}" target="_blank" class="btn btn-sm btn-info" title="Ver PDF">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                </td>
                                <td class="text-center">
                                    <form action="{{ route('admin.publicaciones.destroy', $pub->id) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar esta publicación?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete" title="Eliminar">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted">No hay publicaciones registradas aún.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tabla-publicaciones').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
            },
            order: [[0, 'desc']]
        });
    });
</script>
@endpush

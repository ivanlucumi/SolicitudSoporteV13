@extends('layouts.admin')

@section('title', 'Sincronización de Carpetas Azure')
@section('cabecera', 'Sincronización a Azure')

@section('content')
@include('../alerts.success')
@include('../alerts.request')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <h3 class="panel-title" style="line-height: 34px;"><i class="fa fa-folder-open"></i> Carpetas Registradas</h3>
                    </div>
                    <div class="col-xs-12 col-sm-6 text-right">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddFolder">
                            <i class="fa fa-plus"></i> Registrar Carpeta
                        </button>
                        <form action="{{ route('admin.azure_folders.sync') }}" method="POST" style="display:inline;" onsubmit="return confirm('Esta operación puede tardar varios minutos dependiendo del volumen de archivos. ¿Continuar?');">
                            @csrf
                            <button type="submit" class="btn btn-success">
                                <i class="fa fa-cloud-upload"></i> Sincronizar a Azure
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="panel-body">
                <p>Las carpetas registradas aquí serán escaneadas al hacer clic en <strong>Sincronizar a Azure</strong>. El sistema buscará todos los archivos en estas carpetas y los subirá a Azure Blob Storage. Los archivos que ya han sido subidos se omitirán para evitar duplicados.</p>

                <div class="table-responsive" style="margin-top: 20px;">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ruta Local</th>
                                <th>Archivos Sincronizados</th>
                                <th>Estado</th>
                                <th>Fecha de Registro</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($folders as $folder)
                                <tr>
                                    <td>{{ $folder->id }}</td>
                                    <td><code>{{ $folder->path }}</code></td>
                                    <td><span class="badge bg-blue">{{ $folder->uploaded_files_count }}</span></td>
                                    <td>
                                        @if($folder->is_active)
                                            <span class="label label-success">Activa</span>
                                        @else
                                            <span class="label label-danger">Inactiva</span>
                                        @endif
                                    </td>
                                    <td>{{ $folder->created_at->format('d/m/Y H:i') }}</td>
                                    <td>
                                        <form action="{{ route('admin.azure_folders.destroy', $folder->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar el registro de esta carpeta? Los archivos en Azure y el historial no se borrarán, pero dejará de sincronizarse.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar Carpeta">
                                                <i class="fa fa-trash"></i> Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No hay carpetas registradas para sincronización.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para agregar carpeta -->
<div class="modal fade" id="modalAddFolder" tabindex="-1" role="dialog" aria-labelledby="modalAddFolderLabel">
  <div class="modal-dialog" role="document">
    <form action="{{ route('admin.azure_folders.store') }}" method="POST">
        @csrf
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="modalAddFolderLabel">Registrar Nueva Carpeta</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="path">Ruta Absoluta de la Carpeta Local</label>
                    <input type="text" name="path" id="path" class="form-control" placeholder="Ej: C:\laragon\www\archivos_pdf" required>
                    <small class="help-block">La ruta debe existir en el servidor local. Todos los archivos contenidos se sincronizarán.</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Registrar</button>
            </div>
        </div>
    </form>
  </div>
</div>
@endsection

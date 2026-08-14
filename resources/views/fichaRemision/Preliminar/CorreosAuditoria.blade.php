@extends('adminlte::page')

@section('title', 'Auditoría de Correos')

@section('content_header')
    <h1>Auditoría de Bandeja de Salida - Fichas Preliminares</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Registro de Envíos de Correo</h3>
    </div>
    <div class="card-body">
        
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Fecha Intento</th>
                        <th>Estado</th>
                        <th>Destinatarios</th>
                        <th>Asunto</th>
                        <th>Intentos</th>
                        <th>Mensaje de Error</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($correos as $correo)
                    <tr>
                        <td>{{ $correo->created_at->format('d/m/Y H:i:s') }}</td>
                        <td>
                            @if($correo->estado == 'ENVIADO')
                                <span class="badge badge-success">Enviado</span>
                            @elseif($correo->estado == 'FALLIDO')
                                <span class="badge badge-danger">Fallido</span>
                            @else
                                <span class="badge badge-warning">Pendiente</span>
                            @endif
                        </td>
                        <td>
                            <strong>To:</strong> {{ Str::limit($correo->destinatario, 50) }}<br>
                            @if($correo->con_copia)
                                <strong>Cc:</strong> {{ Str::limit($correo->con_copia, 50) }}
                            @endif
                        </td>
                        <td>{{ Str::limit($correo->asunto, 50) }}</td>
                        <td>{{ $correo->intentos }}</td>
                        <td>
                            @if($correo->mensaje_error)
                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#errorModal{{ $correo->id }}">
                                    Ver Error
                                </button>
                                
                                <!-- Modal -->
                                <div class="modal fade" id="errorModal{{ $correo->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                  <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title">Detalle del Error</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <pre style="white-space: pre-wrap; font-size: 12px;">{{ $correo->mensaje_error }}</pre>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td>
                            @if($correo->estado == 'FALLIDO')
                                <form action="{{ route('fichas.correos.reenviar', $correo->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('¿Está seguro de forzar el reenvío de este correo?')">
                                        <i class="fas fa-paper-plane"></i> Reenviar
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No hay registros de correos.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <div class="mt-3">
            {{ $correos->links() }}
        </div>
        
    </div>
</div>
@stop

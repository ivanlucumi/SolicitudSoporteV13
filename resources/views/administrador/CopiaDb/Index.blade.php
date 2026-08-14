@extends('layouts.admin') 
@section('title', 'Registro de Backups Db')
@section('cabecera', 'Registro de Backups Db')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold text-primary">📀 Bit&aacute;cora de Copias de Seguridad</h2>
        <span class="badge bg-light text-dark shadow-sm px-3 py-2">Ultimos Registros: {{ $registros->count() }}</span>
    </div>
    
    
    <div class="mb-3 d-flex">
        @php
            $meses = [
                1 => 'Enero',
                2 => 'Febrero',
                3 => 'Marzo',
                4 => 'Abril',
                5 => 'Mayo',
                6 => 'Junio',
                7 => 'Julio',
                8 => 'Agosto',
                9 => 'Septiembre',
                10 => 'Octubre',
                11 => 'Noviembre',
                12 => 'Diciembre',
            ];
        @endphp
        
        <form action="{{ route('copia.exportarExcel') }}" method="GET" class="d-flex gap-2">
            <select name="mes" class="form-select">
                <option value="">-- Mes --</option>
                @foreach ($meses as $num => $nombre)
                    <option value="{{ $num }}">{{ $nombre }}</option>
                @endforeach
            </select>
    
            <select name="anio" class="form-select">
                <option value="">-- Año --</option>
                @for ($y = now()->year; $y >= 2020; $y--)
                    <option value="{{ $y }}">{{ $y }}</option>
                @endfor
            </select>
    
            <button class="btn btn-success">⬇ Exportar Excel</button>
        </form>
    </div>

    

    <!-- Formulario para crear nuevo -->
    <div class="card shadow-sm border-0 rounded-4 mb-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h5 class="mb-0">➕ Nuevo Registro</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('copia.store') }}" method="POST" class="row g-3">
                @csrf
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Fecha</label>
                    <input type="date" name="fecha_copia" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Servidor</label>
                    <input list="servidores" name="nombre_servidor" class="form-control" placeholder="Seleccione o escriba" required>
                    <datalist id="servidores">
                        @foreach($servidores as $s)
                            <option value="{{ $s }}">
                        @endforeach
                    </datalist>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Base de Datos</label>
                    <input list="basesDatos" name="base_datos" class="form-control" placeholder="Seleccione o escriba" required>
                    <datalist id="basesDatos">
                        @foreach($basesDatos as $b)
                            <option value="{{ $b }}">
                        @endforeach
                    </datalist>
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Carpeta</label>
                    <input type="text" name="carpeta" placeholder="Carpeta destino" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Estado</label>
                    <input type="text" name="estado" placeholder="OK" class="form-control">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-semibold">Azure</label>
                    <input type="text" name="copia_azure" placeholder="SI/NO" class="form-control">
                </div>
                <div class="col-md-12">
                    <label class="form-label fw-semibold">Observaciones</label>
                    <textarea name="observaciones" rows="2" class="form-control" placeholder="Escribe una observación"></textarea>
                </div>
                <br>
                <div class="col-md-12 mt-3 mb-3">
                    <button class="btn btn-lg btn-warning rounded-3 shadow-sm">
                        Guardar Registro 🚀
                    </button>
                </div>
            </form>
        </div>
    </div>
<hr>
    <!-- Tabla de registros -->
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-0">
            <table id="table9" class="table align-middle table-hover mb-0">
                <thead class="table-primary">
                    <tr>
                        <th>📅 Fecha</th>
                        <th>🖥 Servidor</th>
                        <th>🗄 Base Datos</th>
                        <th>📂 Carpeta</th>
                        <th>⚡ Estado</th>
                        <th>☁ Azure</th>
                        <th>📝 Observaciones</th>
                        <th>📅 Fecha Carga</th>
                        <th>✍️ Firma</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($registros as $r)
                    <tr>
                        <td>{{ \Carbon\Carbon::parse($r->fecha_copia)->format('Y-m-d') }}</td>
                        <td class="fw-semibold">{{ $r->nombre_servidor }}</td>
                        <td>{{ $r->base_datos }}</td>
                        <td><span class="badge bg-light text-dark">{{ $r->carpeta }}</span></td>
                        <td>
                            <span class="badge {{ $r->estado == 'OK' ? 'bg-success' : 'bg-danger' }}">
                                {{ $r->estado ?? 'Pendiente' }}
                            </span>
                        </td>
                        <td>{{ $r->copia_azure ?? '❌' }}</td>
                        <td>{{ $r->observaciones }}</td>
                        <td>{{ $r->created_at }}</td>
                        <td>
                            @if($r->firma_quien_verifica)
                                <strong>{{$r->nombre_usuario }}</strong>
                            @else
                                ❌ No firmado
                            @endif
                        </td>
                        <td class="text-center">
                            @if(!$r->firma_quien_verifica)
                                <form action="{{ route('copia.firmar', $r->id) }}" method="POST" class="d-flex flex-column">
                                    @csrf
                                    <input type="text" name="observaciones" placeholder="Observaciones" class="form-control form-control-sm mb-2" required>
                                    <button class="btn btn-success btn-sm rounded-pill">✍️ Firmar</button>
                                </form>
                            @else
                                <span class="badge bg-secondary">Firmado</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-4">⚠️ No hay registros aún</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterNueveCopias.js"></script> 
<!-- Script para mostrar input de nuevo servidor / BD -->
<script>
document.getElementById('selectServidor').addEventListener('change', function() {
    document.getElementById('nuevoServidor').classList.toggle('d-none', this.value !== 'nuevo');
});
document.getElementById('selectBD').addEventListener('change', function() {
    document.getElementById('nuevaBD').classList.toggle('d-none', this.value !== 'nuevo');
});
</script>
@endsection

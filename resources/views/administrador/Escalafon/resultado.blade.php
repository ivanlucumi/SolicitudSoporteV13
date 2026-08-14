@extends(auth()->user()->rol === 1 ? 'layouts.admin' : 'layouts.usuario')

@section('content')
<div class="container-fluid py-4">
    <!-- Tarjeta principal con animación de entrada -->
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden animate__animated animate__fadeInUp">
        <div class="card-header bg-gradient-primary text-white py-3 d-flex align-items-center">
            <i class="bi bi-bar-chart-steps fs-3 me-3"></i>
            <div>
                <h4 class="mb-0 fw-bold">Administración Escalafón</h4>
                <small class="opacity-75">Gestión y visualización de registros</small>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th scope="col" class="ps-4">#</th>
                            <th scope="col"><i class="bi bi-person-badge me-1"></i>Cédula</th>
                            <th scope="col">Apellidos</th>
                            <th scope="col">Nombres</th>
                            <th scope="col">Cargo</th>
                            <th scope="col">Grado</th>
                            <th scope="col">Despacho</th>
                            <th scope="col" class="text-center">Orden</th>
                            <th scope="col">Novedad</th>
                            <th scope="col">Tipo Acto</th>
                            <th scope="col">Circuito</th>
                            <th scope="col">No. Acto</th>
                            <th scope="col">Fecha</th>
                            <th scope="col" class="text-center">Vinculación</th>
                            <th scope="col" class="text-center">Certificado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($registros as $index => $r)
                        @php
                            if ($r->persona_propietario_id == $empleado->id) {
                                $persona = $r->propietario;
                                $tipoVinculacion = 'PROPIETARIO';
                                $badgeClass = 'bg-success';
                            } elseif ($r->persona_provisional_id == $empleado->id) {
                                $persona = $r->provisional;
                                $tipoVinculacion = 'PROVISIONAL';
                                $badgeClass = 'bg-warning text-dark';
                            } else {
                                $persona = null;
                                $tipoVinculacion = '';
                                $badgeClass = 'bg-secondary';
                            }
                        @endphp
                        <tr class="table-row-hover">
                            <td class="ps-4 fw-medium text-secondary">{{ $r->id }}</td>
                            <td><span class="fw-semibold">{{ $persona->cedulaE ?? '' }}</span></td>
                            <td>{{ $persona->lastnameE ?? '' }}</td>
                            <td>{{ $persona->nameE ?? '' }}</td>
                            <td>{{ $r->cargo->nombre_cargo ?? '' }}</td>
                            <td>{{ $r->cargo->grado ?? '' }}</td>
                            <td>
                                <span class="text-primary">
                                    {{ $r->cargo->despachoJudicial->nombreDespacho ?? '' }}
                                </span>
                            </td>
                            <td class="text-center fw-medium">
                                {{ substr(trim((string) ($r->cargo->despachoJudicial->codigoDespacho ?? '')), -1) }}
                            </td>
                            <td><span class="text-secondary">{{ $r->escalafon->novedad ?? '' }}</span></td>
                            <td>
                                <span class="badge bg-info-subtle text-info-emphasis rounded-pill px-3 py-2">
                                    {{ $r->escalafon->tipo_acto ?? '' }}
                                </span>
                            </td>
                            <td>{{ $r->cargo->despachoJudicial->circuito ?? '' }}</td>
                            <td>{{ $r->escalafon->numero_acto ?? '' }}</td>
                            <td>{{ optional($r->escalafon->fecha_acto)->format('d/m/Y') }}</td>
                            <td class="text-center">
                                <span class="badge {{ $badgeClass }} rounded-pill px-3 py-2 badge-animate">
                                    {{ $tipoVinculacion }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('certificacion.escalafon.descargar', $persona->cedulaE) }}"
                                   class="btn btn-sm btn-primary">
                                    Descargar Certificado
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Estilos personalizados y animaciones -->
<style>
    /* Animación de entrada para la tarjeta */
    .animate__animated {
        animation-duration: 0.6s;
        animation-fill-mode: both;
    }
    .animate__fadeInUp {
        animation-name: fadeInUp;
    }
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translate3d(0, 30px, 0);
        }
        to {
            opacity: 1;
            transform: translate3d(0, 0, 0);
        }
    }

    /* Efecto hover en filas */
    .table-row-hover {
        transition: background-color 0.2s ease, transform 0.1s ease;
    }
    .table-row-hover:hover {
        background-color: rgba(0, 123, 255, 0.03) !important;
        transform: scale(1.001);
    }

    /* Animación de aparición secuencial de filas */
    tbody tr {
        opacity: 0;
        animation: fadeInRow 0.4s ease forwards;
    }
    tbody tr:nth-child(1) { animation-delay: 0.1s; }
    tbody tr:nth-child(2) { animation-delay: 0.15s; }
    tbody tr:nth-child(3) { animation-delay: 0.2s; }
    tbody tr:nth-child(4) { animation-delay: 0.25s; }
    tbody tr:nth-child(5) { animation-delay: 0.3s; }
    tbody tr:nth-child(6) { animation-delay: 0.35s; }
    tbody tr:nth-child(7) { animation-delay: 0.4s; }
    tbody tr:nth-child(8) { animation-delay: 0.45s; }
    tbody tr:nth-child(9) { animation-delay: 0.5s; }
    tbody tr:nth-child(10) { animation-delay: 0.55s; }
    /* Añade más si hay muchas filas */

    @keyframes fadeInRow {
        to {
            opacity: 1;
        }
    }

    /* Animación para los badges */
    .badge-animate {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .badge-animate:hover {
        transform: scale(1.08);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    /* Degradado para el encabezado */
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    /* Mejora de tipografía en badges */
    .badge {
        font-weight: 500;
        letter-spacing: 0.3px;
        font-size: 0.75rem;
    }

    /* Ajustes para la tabla en móviles */
    .table-responsive {
        border-radius: 0.5rem;
    }

    /* Sombra suave en el hover de la tarjeta */
    .card {
        transition: box-shadow 0.3s ease;
    }
    .card:hover {
        box-shadow: 0 20px 40px rgba(0,0,0,0.15) !important;
    }

    /* Iconos en cabeceras */
    th i {
        margin-right: 6px;
        color: #6c757d;
    }
</style>

<!-- Incluir Bootstrap Icons si no están ya en el layout -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@endsection
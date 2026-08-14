@extends('layouts.admin')

@section('title', 'Inventario de Salas de Audiencia')


@section('cabecera')
Inventario de Salas de Audiencia
@endsection

@section('content')
<style>
/* Animaciones y efectos */
@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

@keyframes slideInLeft {
    from { opacity: 0; transform: translateX(-20px); }
    to { opacity: 1; transform: translateX(0); }
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

@keyframes bounce {
    0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
    40% { transform: translateY(-8px); }
    60% { transform: translateY(-4px); }
}

@keyframes gradientShift {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

/* Contenedor adaptado al layout existente */
.content-wrapper {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    padding: 1.5rem;
    margin-bottom: 1rem;
    animation: fadeInUp 0.6s ease;
    position: relative;
    overflow: hidden;
}

.content-wrapper::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, #667eea, #764ba2, #4facfe, #00f2fe);
    background-size: 300% 100%;
    animation: gradientShift 3s ease infinite;
}

/* Header compacto */
.page-header {
    text-align: center;
    margin-bottom: 2rem;
    position: relative;
    z-index: 2;
}

.page-title {
    color: #2d3748;
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
}

.page-title i {
    color: #667eea;
    animation: pulse 2s infinite;
}

.page-subtitle {
    color: #718096;
    font-size: 1rem;
    font-weight: 400;
}

/* Debug info */
.debug-info {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    padding: 1rem;
    margin-bottom: 1rem;
    font-family: monospace;
    font-size: 0.85rem;
}

/* Cards adaptadas */
.sala-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    margin-bottom: 1.5rem;
    overflow: hidden;
    transition: all 0.3s ease;
    animation: slideInLeft 0.5s ease;
}

.sala-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    border-color: #667eea;
}

/* Header de la card compacto */
.card-header-custom {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 1rem 1.5rem;
    border: none;
    position: relative;
}

.card-header-custom::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0.3));
}

.sala-title {
    font-size: 1.2rem;
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.sala-icon {
    width: 35px;
    height: 35px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1rem;
}

.sala-location {
    font-size: 0.85rem;
    opacity: 0.9;
    margin-top: 0.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

/* Body de la card */
.card-body-custom {
    padding: 1.5rem;
    background: #fff;
}

/* Estado sin elementos compacto */
.no-elements {
    text-align: center;
    padding: 2rem 1rem;
    color: #a0aec0;
    background: #f8fafc;
    border-radius: 6px;
    border: 2px dashed #e2e8f0;
}

.no-elements-icon {
    font-size: 2.5rem;
    margin-bottom: 1rem;
    animation: bounce 2s infinite;
}

.no-elements-text {
    font-size: 1rem;
    font-weight: 500;
}

/* Tabla compacta */
.table-modern {
    background: #fff;
    border-radius: 6px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
    margin: 0;
    font-size: 0.9rem;
}

.table-modern thead th {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    font-weight: 600;
    text-transform: uppercase;
    font-size: 0.75rem;
    letter-spacing: 0.5px;
    padding: 0.75rem;
    border: none;
}

.table-modern tbody td {
    padding: 0.75rem;
    border: none;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: middle;
    transition: all 0.2s ease;
}

.table-modern tbody tr:hover {
    background: #f8fafc;
    transform: scale(1.005);
}

.table-modern tbody tr:last-child td {
    border-bottom: none;
}

/* Elementos de la tabla compactos */
.elemento-name {
    font-weight: 600;
    color: #2d3748;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.elemento-icon {
    width: 25px;
    height: 25px;
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.8rem;
}

.elemento-id {
    background: #e2e8f0;
    color: #64748b;
    padding: 0.2rem 0.4rem;
    border-radius: 10px;
    font-size: 0.65rem;
    font-weight: 500;
    margin-left: 0.5rem;
}

.cantidad-badge {
    background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    color: white;
    padding: 0.4rem 0.8rem;
    border-radius: 15px;
    font-weight: 600;
    font-size: 0.85rem;
    display: inline-block;
    min-width: 40px;
    text-align: center;
    box-shadow: 0 2px 4px rgba(16, 185, 129, 0.2);
}

.estados-list {
    display: flex;
    flex-wrap: wrap;
    gap: 0.4rem;
}

.estado-badge {
    padding: 0.2rem 0.6rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.3px;
}

.estado-bueno { background: #d1fae5; color: #065f46; }
.estado-regular { background: #fef3c7; color: #92400e; }
.estado-malo { background: #fee2e2; color: #991b1b; }
.estado-no-tiene { background: #e2e8f0; color: #64748b; }

.observaciones-text {
    color: #64748b;
    font-style: italic;
    max-width: 180px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* Estadísticas compactas */
.stats-container {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 8px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    color: white;
    text-align: center;
    animation: fadeInUp 0.6s ease 0.2s both;
}

.stats-grid {
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
    gap: 1rem;
}

.stat-item {
    text-align: center;
    padding: 0.75rem;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 8px;
    backdrop-filter: blur(10px);
    transition: all 0.3s ease;
    min-width: 100px;
    flex: 1;
}

.stat-item:hover {
    transform: translateY(-3px);
    background: rgba(255, 255, 255, 0.2);
}

.stat-number {
    font-size: 1.8rem;
    font-weight: 700;
    display: block;
    margin-bottom: 0.25rem;
}

.stat-label {
    font-size: 0.8rem;
    opacity: 0.9;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Filtros */
.filter-controls {
    display: flex;
    flex-wrap: wrap;
    gap: 1rem;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    padding: 1.5rem;
    border-radius: 8px;
    margin-bottom: 2rem;
}
.filter-controls .form-group {
    flex: 1;
    min-width: 200px;
}
.filter-controls label {
    font-weight: 600;
    color: #4a5568;
    margin-bottom: 0.5rem;
    display: block;
}
.filter-controls .form-control {
    width: 100%;
    padding: 0.5rem 1rem;
    border: 1px solid #cbd5e0;
    border-radius: 6px;
    transition: all 0.2s ease;
}
.filter-controls .form-control:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
}

/* Mensaje de no resultados */
.no-results {
    text-align: center;
    padding: 3rem;
    color: #a0aec0;
    font-size: 1.2rem;
    display: none; /* Se muestra con JS */
}

/* Responsive mejorado */
@media (max-width: 768px) {
    .content-wrapper { 
        padding: 1rem; 
        margin: 0.5rem 0;
        border-radius: 6px;
    }
    .page-title { 
        font-size: 1.6rem; 
        flex-direction: column;
        gap: 0.5rem;
    }
    .sala-card { margin-bottom: 1rem; }
    .card-header-custom, .card-body-custom { padding: 1rem; }
    .table-modern { font-size: 0.8rem; }
    .table-modern thead th,
    .table-modern tbody td { padding: 0.5rem; }
    .stats-grid { 
        flex-direction: column; 
        gap: 0.75rem;
    }
    .stat-item {
        min-width: auto;
        padding: 1rem;
    }
    .elemento-name { 
        flex-direction: column; 
        align-items: flex-start; 
        gap: 0.25rem;
    }
    .observaciones-text { max-width: 120px; }
    .estados-list { gap: 0.25rem; }
    .estado-badge { font-size: 0.7rem; padding: 0.15rem 0.5rem; }
    .filter-controls { flex-direction: column; }
}

@media (max-width: 480px) {
    .content-wrapper { padding: 0.75rem; }
    .page-title { font-size: 1.4rem; }
    .sala-title { font-size: 1rem; }
    .table-modern { font-size: 0.75rem; }
    .no-elements { padding: 1.5rem 0.75rem; }
    .no-elements-icon { font-size: 2rem; }
}

/* Loading animation optimizada */
.loading {
    opacity: 0;
    animation: fadeInUp 0.5s ease forwards;
}

</style>

<div class="container-fluid">
    <!-- Header -->
    <div class="page-header">
        <p class="page-subtitle">Gestión y control de elementos por sala</p>
        <br>
        <div class="text-center mb-3">
            <a href="{{ route('inventario.sala.audiencia.export') }}" class="btn btn-success">
                <i class="fa fa-file-excel-o"></i> Descargar Inventario en Excel
            </a>
        </div>
    </div>

    <!-- Controles de filtrado mejorados -->
    <div class="filter-controls">
        <div class="form-group">
            <label for="filtro-sala">Filtrar por Sala</label>
            <select id="filtro-sala" class="form-control">
                <option value="todos">Todas las Salas</option>
                @if(isset($salas) && is_countable($salas))
                    @php
                        $nombresUnicos = array_unique($salas->pluck('nombre')->toArray());
                        sort($nombresUnicos);
                    @endphp
                    @foreach($nombresUnicos as $nombreSala)
                        <option value="{{ strtolower($nombreSala) }}">{{ $nombreSala }}</option>
                    @endforeach
                @endif
            </select>
        </div>
        
         <!-- 🔹 Nuevo filtro por municipio -->
            <div class="form-group">
                <label for="filtro-municipio">Filtrar por Municipio</label>
                <select id="filtro-municipio" class="form-control">
                    <option value="todos">Todos los Municipios</option>
                    @if(isset($salas) && is_countable($salas))
                        @php
                            $municipiosUnicos = array_unique($salas->pluck('municipio')->toArray());
                            sort($municipiosUnicos);
                        @endphp
                        @foreach($municipiosUnicos as $municipio)
                            @if($municipio)
                                <option value="{{ strtolower($municipio) }}">{{ $municipio }}</option>
                            @endif
                        @endforeach
                    @endif
                </select>
            </div>
        
        <!-- 🔹 Nuevo filtro por sede -->
            <div class="form-group">
                <label for="filtro-sede">Filtrar por Sede</label>
                <select id="filtro-sede" class="form-control">
                    <option value="todas">Todas las Sedes</option>
                    @if(isset($salas) && is_countable($salas))
                        @php
                            $sedesUnicas = array_unique($salas->pluck('sede')->toArray());
                            sort($sedesUnicas);
                        @endphp
                        @foreach($sedesUnicas as $sede)
                            @if($sede)
                                <option value="{{ strtolower($sede) }}">{{ $sede }}</option>
                            @endif
                        @endforeach
                    @endif
                </select>
            </div>
        
        <div class="form-group">
            <label for="filtro-elemento">Filtrar por Elemento</label>
            <input type="text" id="filtro-elemento" class="form-control" placeholder="Ej: Computadora, Silla...">
        </div>
        <div class="form-group" style="visibility: hidden;">
            <label for="filtro-estado">Filtrar por Estado</label>
            <select id="filtro-estado" class="form-control">
                <option value="todos">Todos los Estados</option>
                <option value="bueno">Bueno</option>
                <option value="malo">Malo</option>
                <option value="no-tiene">No Tiene</option>
            </select>
        </div>
    </div>
    
    <!-- Estadísticas -->
    <div id="stats-container" class="stats-container">
        <div class="stats-grid">
            <div class="stat-item">
                <span id="total-salas-stat" class="stat-number">0</span>
                <span class="stat-label">Salas Totales</span>
            </div>
            <div class="stat-item">
                <span id="total-elementos-stat" class="stat-number">0</span>
                <span class="stat-label">Elementos</span>
            </div>
            <div class="stat-item">
                <span id="salas-con-inventario-stat" class="stat-number">0</span>
                <span class="stat-label">Con Inventario</span>
            </div>
            <div class="stat-item">
                <span id="salas-sin-inventario-stat" class="stat-number">0</span>
                <span class="stat-label">Sin Inventario</span>
            </div>
        </div>
    </div>

    <!-- Salas (sección principal) -->
    <div id="salas-container" class="row">
        @if(isset($salas) && is_countable($salas))
            @forelse($salas as $index => $sala)
                <div class="col-12 mb-4 sala-card loading" data-sala-nombre="{{ strtolower($sala->nombre ?? '') }}"
                    data-sala-municipio="{{ strtolower($sala->municipio ?? '') }}"
                    data-sala-sede="{{ strtolower($sala->sede ?? '') }}">
                    <div class="card-header-custom">
                        <h3 class="sala-title">
                            <div class="sala-icon">
                                <i class="fa fa-university"></i>
                            </div>
                            {{ $sala->nombre ?? 'Nombre no disponible' }}
                        </h3>
                        <div class="sala-location">
                            <i class="fa fa-map-marker"></i>
                            {{ $sala->municipio }} • {{ $sala->sede ?? 'Sede no disponible' }}
                            @if(isset($sala->piso) && $sala->piso)
                                • Piso {{ $sala->piso }}
                            @endif
                        </div>
                    </div>
                    
                    <div class="card-body-custom">
                        @if(!isset($sala->elementosAgrupados) || !is_countable($sala->elementosAgrupados) || count($sala->elementosAgrupados) == 0)
                            <div class="no-elements">
                                <div class="no-elements-icon">
                                    <i class="fa fa-inbox"></i>
                                </div>
                                <div class="no-elements-text">
                                    Sin elementos registrados en el inventario
                                </div>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table class="table table-modern" data-elementos-data="{{ json_encode($sala->elementosAgrupados) }}">
                                    <thead>
                                        <tr>
                                            <th><i class="fa fa-cube"></i> Elemento</th>
                                            <th><i class="fa fa-calculator"></i> Cantidad</th>
                                            <th><i class="fa fa-check-circle"></i> Estados</th>
                                            <th><i class="fa fa-comment"></i> Observaciones</th>
                                            <th><i class="fa fa-comment"></i> Observaciones Sala</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sala->elementosAgrupados as $elemento)
                                        
                                        
                                            <tr>
                                                <td>
                                                    <div class="elemento-name">
                                                        <div class="elemento-icon">
                                                            <i class="fa fa-cube"></i>
                                                        </div>
                                                        <div>
                                                            {{ $elemento['nombre'] ?? 'Nombre no disponible' }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="cantidad-badge">{{ $elemento['cantidad_total'] ?? 0 }}</span>
                                                </td>
                                                <td>
                                                    @if(isset($elemento['estados']) && is_array($elemento['estados']) && count($elemento['estados']) > 0)
                                                        <div class="estados-list">
                                                            @foreach($elemento['estados'] as $estado => $cantidad)
                                                                @if($cantidad > 0)
                                                                    <span class="estado-badge estado-{{ strtolower($estado) }}">
                                                                         {{ $cantidad }}
                                                                    </span>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if(isset($elemento['observaciones']) && $elemento['observaciones'])
                                                        <span class="observaciones-text" title="{{ $elemento['observaciones'] }}">
                                                            {{ $elemento['observaciones'] }}
                                                        </span>
                                                    @else
                                                        <span class="text-muted">-</span>
                                                    @endif
                                                </td>
                                                
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                    
                    <div class="card-body-custom">
                        @if(isset($sala->observaciones_generales) && $sala->observaciones_generales)
                             {{ $sala->observaciones_generales }}
                        @endif
                    </div>
                </div>
            @empty
                <div class="no-elements">
                    <div class="no-elements-icon">
                        <i class="fa fa-building-o"></i>
                    </div>
                    <div class="no-elements-text">
                        No hay salas de audiencia registradas
                    </div>
                </div>
            @endforelse
        @endif
        
        <div id="no-results" class="no-results">
            <i class="fa fa-exclamation-circle fa-2x"></i>
            <p class="mt-2">No se encontraron resultados para los filtros aplicados.</p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const salaSelect = document.getElementById('filtro-sala');
    const sedeSelect = document.getElementById('filtro-sede'); // sede
    const municipioSelect = document.getElementById('filtro-municipio'); // 🔹 nuevo
    const elementoInput = document.getElementById('filtro-elemento');
    const estadoSelect = document.getElementById('filtro-estado');
    const salaCards = document.querySelectorAll('.sala-card');
    const noResultsMessage = document.getElementById('no-results');
    const stats = {
        totalSalas: document.getElementById('total-salas-stat'),
        totalElementos: document.getElementById('total-elementos-stat'),
        salasConInventario: document.getElementById('salas-con-inventario-stat'),
        salasSinInventario: document.getElementById('salas-sin-inventario-stat')
    };

    // Animación de entrada
    salaCards.forEach((card, index) => {
        setTimeout(() => {
            card.style.opacity = '1';
        }, (index * 50) + 200);
    });

    // Función principal de filtrado
    function filterCards() {
        const salaSelected = salaSelect.value;
        const sedeSelected = sedeSelect.value; // 🔹 nuevo
        const municipioSelected = municipioSelect.value; // 🔹 nuevo
        const elementoTerm = elementoInput.value.toLowerCase().trim();
        const estadoSelected = estadoSelect.value;
        let visibleCount = 0;
        let totalElementosVisible = 0;
        let salasConInventarioVisible = 0;

        salaCards.forEach(card => {
            let isVisible = true;
            const salaNombre = card.dataset.salaNombre;
            const salaSede = card.dataset.salaSede; // 🔹 nuevo
            const salaMunicipio = card.dataset.salaMunicipio; // 🔹 nuevo
            const hasInventory = card.querySelector('.table-modern') !== null;
            
            // 1. Filtro por sala (nombre exacto)
            if (salaSelected !== 'todos' && salaNombre !== salaSelected) {
                isVisible = false;
            }
            // 2. Filtro por sede 🔹 nuevo
            if (isVisible && sedeSelected !== 'todas' && salaSede !== sedeSelected) {
                isVisible = false;
            }
            
            // 3. Filtro por municipio 🔹 nuevo
            if (isVisible && municipioSelected !== 'todos' && salaMunicipio !== municipioSelected) {
                isVisible = false;
            }

            // 2. Filtro por estado
            if (isVisible && estadoSelected !== 'todos') {
                if (estadoSelected === 'no-tiene') {
                    // Muestra solo las salas que no tienen inventario
                    isVisible = !hasInventory;
                } else {
                    // Muestra las salas que tienen al menos un elemento con el estado seleccionado
                    if (!hasInventory) {
                        isVisible = false;
                    } else {
                        const elementosData = JSON.parse(card.querySelector('.table-modern').dataset.elementosData);
                        const hasMatchingState = elementosData.some(elemento => {
                            const estadosElemento = elemento.estados ? Object.keys(elemento.estados).map(e => e.toLowerCase()) : [];
                            return estadosElemento.includes(estadoSelected);
                        });
                        isVisible = hasMatchingState;
                    }
                }
            }
            

            // 3. Filtro por elemento
            if (isVisible && elementoTerm) {
                if (!hasInventory) {
                    isVisible = false; // No puede tener un elemento si no tiene inventario
                } else {
                    const elementosData = JSON.parse(card.querySelector('.table-modern').dataset.elementosData);
                    const hasMatchingElement = elementosData.some(elemento => {
                        const nombreElemento = elemento.nombre.toLowerCase();
                        return nombreElemento.includes(elementoTerm);
                    });
                    isVisible = hasMatchingElement;
                }
            }
            
            // Actualizar el estado de visibilidad
            card.style.display = isVisible ? 'block' : 'none';
            if (isVisible) {
                visibleCount++;
                if (hasInventory) {
                    salasConInventarioVisible++;
                    const elementosData = JSON.parse(card.querySelector('.table-modern').dataset.elementosData);
                    elementosData.forEach(elemento => {
                        totalElementosVisible += elemento.cantidad_total;
                    });
                }
            }
        });

        // Actualizar estadísticas y mensaje de no resultados
        stats.totalSalas.textContent = visibleCount;
        stats.totalElementos.textContent = totalElementosVisible;
        stats.salasConInventario.textContent = salasConInventarioVisible;
        stats.salasSinInventario.textContent = visibleCount - salasConInventarioVisible;
        
        noResultsMessage.style.display = visibleCount === 0 ? 'block' : 'none';
    }

    // Eventos de escucha para los filtros
    salaSelect.addEventListener('change', filterCards);
    elementoInput.addEventListener('input', filterCards);
    sedeSelect.addEventListener('change', filterCards); // 🔹 nuevo
    municipioSelect.addEventListener('change', filterCards); // 🔹 nuevo
    estadoSelect.addEventListener('change', filterCards);

    // Ejecutar el filtro inicial para mostrar los datos correctos
    filterCards();
});
</script>
@endsection

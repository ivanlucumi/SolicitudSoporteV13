@extends('layouts.admin')
@section('title', 'Reportes de Actividades Por Despacho')
@section('cabecera', 'Reportes de Actividades Por Despacho')

@section('content')
<!-- Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary: #6366f1;
        --primary-dark: #4f46e5;
        --secondary: #8b5cf6;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --info: #06b6d4;
        --dark: #1f2937;
        --light: #f8fafc;
        --surface: #ffffff;
        --border: #e5e7eb;
        --text-primary: #111827;
        --text-secondary: #6b7280;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        --radius: 12px;
        --radius-lg: 16px;
    }

    body, html {
        margin: 0;
        padding: 0;
        height: 100%;
        width: 100%;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: var(--text-primary);
        line-height: 1.6;
        overflow-x: hidden;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .page-title {
        text-align: center;
        margin-bottom: 3rem;
    }

    .page-title h2 {
        font-size: 2.5rem;
        font-weight: 700;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 0.5rem;
    }

    .page-title .subtitle {
        color: var(--text-secondary);
        font-size: 1.1rem;
        font-weight: 400;
    }

    .stats-card {
        background: var(--surface);
        border-radius: var(--radius);
        padding: 2rem;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border);
        position: relative;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .stats-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-xl);
    }

    .stats-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--card-color), var(--card-color-light));
    }

    .stats-card.stats-success {
        --card-color: var(--success);
        --card-color-light: #34d399;
    }

    .stats-card.stats-info {
        --card-color: var(--info);
        --card-color-light: #22d3ee;
    }

    .stats-card.stats-warning {
        --card-color: var(--warning);
        --card-color-light: #fbbf24;
    }

    .stats-card.stats-primary {
        --card-color: var(--primary);
        --card-color-light: var(--secondary);
    }

    .stats-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
    }

    .stats-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .stats-icon {
        width: 3rem;
        height: 3rem;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, var(--card-color), var(--card-color-light));
        color: white;
        font-size: 1.25rem;
    }

    .stats-number {
        font-size: 3rem;
        font-weight: 800;
        color: var(--text-primary);
        line-height: 1;
    }

    /* Nuevos estilos para filtros de circuito */
    .circuit-filters {
        background: var(--surface);
        border-radius: var(--radius);
        padding: 2rem;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border);
        margin-bottom: 2rem;
    }

    .filter-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .filter-title {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-primary);
    }

    .filter-controls {
        display: flex;
        gap: 1rem;
        align-items: center;
        flex-wrap: wrap;
    }

    .circuit-select {
        padding: 0.75rem 1rem;
        border: 2px solid var(--border);
        border-radius: var(--radius);
        background: var(--surface);
        color: var(--text-primary);
        font-size: 0.875rem;
        font-weight: 500;
        min-width: 200px;
        transition: all 0.3s ease;
    }

    .circuit-select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
    }

    .filter-group {
        display: flex;
        gap: 0.75rem;
        align-items: center;
        flex-wrap: wrap;
    }

    .show-btn, .clear-btn {
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: var(--radius);
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        white-space: nowrap;
    }

    .show-btn {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        box-shadow: var(--shadow-sm);
    }

    .show-btn:hover:not(:disabled) {
        background: linear-gradient(135deg, var(--primary-dark), var(--primary));
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .show-btn:disabled {
        background: var(--border);
        color: var(--text-secondary);
        cursor: not-allowed;
        transform: none;
        box-shadow: none;
    }

    .clear-btn {
        background: linear-gradient(135deg, var(--danger), #dc2626);
        color: white;
        box-shadow: var(--shadow-sm);
    }

    .clear-btn:hover {
        background: linear-gradient(135deg, #dc2626, var(--danger));
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .filter-status {
        background: linear-gradient(135deg, var(--success), #34d399);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        animation: slideUp 0.3s ease;
    }

    .view-toggle {
        display: flex;
        background: var(--light);
        border-radius: var(--radius);
        padding: 0.25rem;
        border: 1px solid var(--border);
    }

    .toggle-btn {
        padding: 0.5rem 1rem;
        border: none;
        background: transparent;
        color: var(--text-secondary);
        font-size: 0.875rem;
        font-weight: 500;
        border-radius: calc(var(--radius) - 2px);
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .toggle-btn.active {
        background: var(--primary);
        color: white;
        box-shadow: var(--shadow-sm);
    }

    .circuit-section {
        margin-bottom: 3rem;
        animation: slideUp 0.6s ease-out;
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border);
    }

    .circuit-accordion-header {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        padding: 1.5rem 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        cursor: pointer;
        transition: all 0.3s ease;
        user-select: none;
    }

    .circuit-accordion-header:hover {
        background: linear-gradient(135deg, var(--primary-dark), var(--primary));
        transform: translateY(-1px);
    }

    .circuit-accordion-header.collapsed {
        border-radius: var(--radius);
    }

    .circuit-title {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 1.25rem;
        font-weight: 700;
        margin: 0;
    }

    .circuit-badge {
        background: rgba(255, 255, 255, 0.2);
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .accordion-toggle {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        font-weight: 500;
        opacity: 0.9;
        transition: all 0.3s ease;
    }

    .accordion-toggle i {
        font-size: 1rem;
        transition: transform 0.3s ease;
    }

    .circuit-accordion-header.collapsed .accordion-toggle i {
        transform: rotate(-90deg);
    }

    .circuit-content {
        max-height: 2000px;
        overflow: hidden;
        transition: max-height 0.4s ease-out, opacity 0.3s ease;
        opacity: 1;
    }

    .circuit-content.collapsed {
        max-height: 0;
        opacity: 0;
        transition: max-height 0.3s ease-in, opacity 0.2s ease;
    }

    .circuit-header {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        padding: 1.5rem 2rem;
        border-radius: var(--radius) var(--radius) 0 0;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .chart-container {
        background: var(--surface);
        border-radius: var(--radius);
        padding: 2rem;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border);
        margin-bottom: 3rem;
        transition: all 0.3s ease;
    }

    .chart-container:hover {
        box-shadow: var(--shadow-lg);
    }

    .chart-container h4 {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 2rem;
    }

    .chart-container h4 i {
        color: var(--primary);
        font-size: 1.25rem;
    }

    .table-container {
        background: var(--surface);
        border-radius: 0 0 var(--radius) var(--radius);
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border);
        border-top: none;
        overflow: hidden;
    }

    .table-header {
        background: linear-gradient(135deg, var(--dark), #374151);
        color: white;
        padding: 1.5rem 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .table-header h4 {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 1.125rem;
        font-weight: 600;
        margin: 0;
    }

    .search-container {
        position: relative;
        max-width: 300px;
    }

    .search-input {
        width: 100%;
        padding: 0.75rem 1rem 0.75rem 2.5rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: var(--radius);
        background: rgba(255, 255, 255, 0.1);
        color: white;
        font-size: 0.875rem;
        backdrop-filter: blur(10px);
    }

    .search-input::placeholder {
        color: rgba(255, 255, 255, 0.7);
    }

    .search-icon {
        position: absolute;
        left: 0.75rem;
        top: 50%;
        transform: translateY(-50%);
        color: rgba(255, 255, 255, 0.7);
    }

    /* Estilos para filtros en encabezados de tabla */
    .table > thead > tr > th {
        background: linear-gradient(135deg, var(--dark), #374151);
        color: white;
        padding: 1.25rem 1.5rem;
        text-align: center;
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border: none;
        position: relative;
    }

    .table-header-with-search {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        width: 100%;
    }

    .header-text {
        font-weight: 600;
        margin: 0;
        color: white;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .header-search-input {
        width: 100%;
        padding: 6px 10px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 6px;
        font-size: 0.8rem;
        background: rgba(255, 255, 255, 0.1);
        color: white;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .header-search-input::placeholder {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.75rem;
    }

    .header-search-input:focus {
        outline: none;
        border-color: var(--primary);
        background: rgba(255, 255, 255, 0.2);
        box-shadow: 0 0 8px rgba(99, 102, 241, 0.4);
    }

    .table tbody tr {
        border-bottom: 1px solid var(--border);
        transition: all 0.2s ease;
    }

    .table tbody tr:hover {
        background: #f8fafc;
    }

    .table tbody td {
        padding: 1.25rem 1.5rem;
        font-size: 0.875rem;
        text-align: center;
    }

    .table tbody td strong {
        font-weight: 600;
        color: var(--text-primary);
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 2.5rem;
        height: 2.5rem;
        border-radius: 50%;
        font-size: 0.875rem;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .status-success {
        background: linear-gradient(135deg, var(--success), #34d399);
        color: white;
    }

    .status-danger {
        background: linear-gradient(135deg, var(--danger), #f87171);
        color: white;
    }

    .status-badge:hover {
        transform: scale(1.1);
    }

    .no-results {
        text-align: center;
        padding: 3rem;
        color: var(--text-secondary);
        display: none;
    }

    .no-results i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .hidden {
        display: none !important;
    }

    /* Botón de limpieza rápida por tabla */
    .table-clear-btn {
        background: linear-gradient(135deg, var(--warning), #f59e0b);
        color: white;
        border: none;
        padding: 0.5rem 1rem;
        border-radius: var(--radius);
        font-size: 0.75rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .table-clear-btn:hover {
        background: linear-gradient(135deg, #f59e0b, #d97706);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .row-count-indicator {
        color: var(--text-secondary);
        font-size: 0.75rem;
        margin-top: 0.5rem;
        text-align: center;
        font-style: italic;
    }

    @media (max-width: 768px) {
        .main-container {
            padding: 1.5rem;
            margin: 1rem;
        }

        .page-title h2 {
            font-size: 2rem;
        }

        .row {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .filter-header {
            flex-direction: column;
            align-items: stretch;
        }

        .filter-controls {
            justify-content: center;
        }

        .circuit-select {
            min-width: auto;
            width: 100%;
        }

        .circuit-header {
            flex-direction: column;
            gap: 1rem;
            align-items: stretch;
        }

        .table-header {
            flex-direction: column;
            gap: 1rem;
            align-items: stretch;
        }

        .search-container {
            max-width: none;
        }

        .header-search-input {
            font-size: 0.7rem;
            padding: 4px 8px;
        }

        .table > thead > tr > th {
            padding: 1rem 0.5rem;
        }

        .table tbody td {
            padding: 1rem 0.5rem;
        }
    }
</style>

<div class="container-fluid">
    <div class="main-container">
        <div class="page-title">
            <h2><i class="fas fa-chart-line"></i> Dashboard de Actividades de Despachos</h2>
            <p class="subtitle">Gestión y seguimiento de despachos por circuito en tiempo real</p>
        </div>

        <!-- Filtros de Circuito -->
        <div class="circuit-filters">
            <div class="filter-header">
                <h3 class="filter-title">
                    <i class="fas fa-filter"></i>
                    Filtros de Visualización
                </h3>
                <div class="filter-controls">
                    <div class="filter-group">
                        <select id="circuitFilter" class="circuit-select">
                            <option value="">Seleccionar Circuito...</option>
                            <option value="all">Todos los Circuitos</option>
                            @foreach($circuitos as $circuito)
                                <option value="{{ $circuito }}">{{ $circuito }}</option>
                            @endforeach
                        </select>
                        <button id="showCircuitBtn" class="show-btn" disabled>
                            <i class="fas fa-eye"></i>
                            Mostrar
                        </button>
                        <button id="clearFilterBtn" class="clear-btn" style="display: none;">
                            <i class="fas fa-times"></i>
                            Limpiar
                        </button>
                    </div>
                    <div class="view-toggle">
                        <button class="toggle-btn" data-view="combined">Vista Combinada</button>
                        <button class="toggle-btn active" data-view="separated">Vista Separada</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Vista Combinada (Totales Generales) -->
        <div id="combinedView" class="hidden">
            <div class="row">
                <div class="col-md-3">
                    <div class="stats-card stats-success">
                        <div class="stats-header">
                            <div class="stats-label">
                                <i class="fas fa-check-circle"></i>
                                Visitados
                            </div>
                            <div class="stats-icon">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="stats-number" id="totalVisitados">{{ $totales['visitados'] }}</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card stats-info">
                        <div class="stats-header">
                            <div class="stats-label">
                                <i class="fas fa-graduation-cap"></i>
                                Capacitados
                            </div>
                            <div class="stats-icon">
                                <i class="fas fa-book"></i>
                            </div>
                        </div>
                        <div class="stats-number" id="totalCapacitados">{{ $totales['capacitaciones'] }}</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card stats-warning">
                        <div class="stats-header">
                            <div class="stats-label">
                                <i class="fas fa-user-plus"></i>
                                Con Usuarios
                            </div>
                            <div class="stats-icon">
                                <i class="fas fa-user-circle"></i>
                            </div>
                        </div>
                        <div class="stats-number" id="totalConUsuarios">{{ $totales['con_usuarios'] }}</div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stats-card stats-primary">
                        <div class="stats-header">
                            <div class="stats-label">
                                <i class="fas fa-cogs"></i>
                                Usando SGDE
                            </div>
                            <div class="stats-icon">
                                <i class="fas fa-desktop"></i>
                            </div>
                        </div>
                        <div class="stats-number" id="totalUsandoSgde">{{ $totales['usando_sgde'] }}</div>
                    </div>
                </div>
            </div>

            <div class="chart-container">
                <h4><i class="fas fa-chart-bar"></i> Resumen Gráfico General</h4>
                <canvas id="actividadesChart" height="100"></canvas>
            </div>
        </div>

        <!-- Vista Separada por Circuitos -->
        <div id="separatedView">
            @foreach($despachosPorCircuito as $circuito => $datosCircuito)
            <div class="circuit-section" data-circuit="{{ $circuito }}">
                <div class="circuit-accordion-header" onclick="toggleAccordion('{{ $circuito }}')">
                    <h3 class="circuit-title">
                        <i class="fas fa-map-marker-alt"></i>
                        {{ $circuito }}
                        <span class="circuit-badge">{{ count($datosCircuito['despachos']) }} despachos</span>
                    </h3>
                    <div class="accordion-toggle">
                        <span>Ocultar detalles</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                </div>
                
                <div class="circuit-content" id="content-{{ $circuito }}">
                    <div class="row" style="margin: 0; padding: 2rem; background: var(--surface); border-left: 1px solid var(--border); border-right: 1px solid var(--border);">
                        <div class="col-md-3">
                            <div class="stats-card stats-success">
                                <div class="stats-header">
                                    <div class="stats-label">
                                        <i class="fas fa-check-circle"></i>
                                        Visitados
                                    </div>
                                    <div class="stats-icon">
                                        <i class="fas fa-users"></i>
                                    </div>
                                </div>
                                <div class="stats-number">{{ $datosCircuito['totales']['visitados'] }}</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stats-card stats-info">
                                <div class="stats-header">
                                    <div class="stats-label">
                                        <i class="fas fa-graduation-cap"></i>
                                        Capacitados
                                    </div>
                                    <div class="stats-icon">
                                        <i class="fas fa-book"></i>
                                    </div>
                                </div>
                                <div class="stats-number">{{ $datosCircuito['totales']['capacitaciones'] }}</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stats-card stats-warning">
                                <div class="stats-header">
                                    <div class="stats-label">
                                        <i class="fas fa-user-plus"></i>
                                        Con Usuarios
                                    </div>
                                    <div class="stats-icon">
                                        <i class="fas fa-user-circle"></i>
                                    </div>
                                </div>
                                <div class="stats-number">{{ $datosCircuito['totales']['con_usuarios'] }}</div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="stats-card stats-primary">
                                <div class="stats-header">
                                    <div class="stats-label">
                                        <i class="fas fa-cogs"></i>
                                        Usando SGDE
                                    </div>
                                    <div class="stats-icon">
                                        <i class="fas fa-desktop"></i>
                                    </div>
                                </div>
                                <div class="stats-number">{{ $datosCircuito['totales']['usando_sgde'] }}</div>
                            </div>
                        </div>
                    </div>

                    <div class="table-container">
                        <div class="table-header">
                            <h4><i class="fas fa-table"></i> Despachos de {{ $circuito }}</h4>
                        </div>
                        
                        <!-- Botón de limpieza rápida -->
                        <div style="padding: 1rem 2rem 0;">
                            <button class="table-clear-btn" onclick="clearTableFilters('table-{{ $loop->index }}')">
                                <i class="fas fa-eraser"></i>
                                Limpiar filtros de esta tabla
                            </button>
                        </div>
                        
                        <div class="table-responsive">
                            <table class="table table-hover searchable-table" id="table-{{ $loop->index }}" data-circuit="{{ $circuito }}">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="table-header-with-search">
                                                <span class="header-text">ORDEN</span>
                                                <input type="text" class="header-search-input" placeholder="Buscar orden..." data-column="0">
                                            </div>
                                        </th>
                                        <th>
                                            <div class="table-header-with-search">
                                                <span class="header-text">DESPACHO</span>
                                                <input type="text" class="header-search-input" placeholder="Buscar despacho..." data-column="1">
                                            </div>
                                        </th>
                                        <th>
                                            <div class="table-header-with-search">
                                                <span class="header-text">VISITADO</span>
                                                <input type="text" class="header-search-input" placeholder="SI/NO..." data-column="2">
                                            </div>
                                        </th>
                                        <th>
                                            <div class="table-header-with-search">
                                                <span class="header-text">CAPACITADO</span>
                                                <input type="text" class="header-search-input" placeholder="SI/NO..." data-column="3">
                                            </div>
                                        </th>
                                        <th>
                                            <div class="table-header-with-search">
                                                <span class="header-text">CON USUARIO</span>
                                                <input type="text" class="header-search-input" placeholder="SI/NO..." data-column="4">
                                            </div>
                                        </th>
                                        <th>
                                            <div class="table-header-with-search">
                                                <span class="header-text">USANDO SGDE</span>
                                                <input type="text" class="header-search-input" placeholder="SI/NO..." data-column="5">
                                            </div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($datosCircuito['despachos'] as $index => $despacho)
                                        @php $actividad = $despacho->actividadesDespacho->last(); @endphp
                                        <tr>
                                            <td><strong>{{ $index + 1 }}</strong></td>
                                            <td><strong>{{ $despacho->nombreDespacho }}</strong></td>
                                            <td>
                                                @if ($actividad && $actividad->visitado)
                                                    <span class="status-badge status-success">SI</span>
                                                @else
                                                    <span class="status-badge status-danger">NO</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($actividad && $actividad->capacitado)
                                                    <span class="status-badge status-success">SI</span>
                                                @else
                                                    <span class="status-badge status-danger">NO</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($actividad && $actividad->con_usuarios)
                                                    <span class="status-badge status-success">SI</span>
                                                @else
                                                    <span class="status-badge status-danger">NO</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($actividad && $actividad->en_produccion)
                                                    <span class="status-badge status-success">SI</span>
                                                @else
                                                    <span class="status-badge status-danger">NO</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Tabla General (Vista Combinada) -->
        <div id="generalTable" class="hidden">
            <div class="table-container">
                <div class="table-header">
                    <h4><i class="fas fa-table"></i> Detalle por Despacho</h4>
                </div>
                
                <!-- Botón de limpieza rápida -->
                <div style="padding: 1rem 2rem 0;">
                    <button class="table-clear-btn" onclick="clearTableFilters('generalDespachosTable')">
                        <i class="fas fa-eraser"></i>
                        Limpiar filtros de esta tabla
                    </button>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover searchable-table" id="generalDespachosTable">
                        <thead>
                            <tr>
                                <th>
                                    <div class="table-header-with-search">
                                        <span class="header-text">ORDEN</span>
                                        <input type="text" class="header-search-input" placeholder="Buscar orden..." data-column="0">
                                    </div>
                                </th>
                                <th>
                                    <div class="table-header-with-search">
                                        <span class="header-text">CIRCUITO</span>
                                        <input type="text" class="header-search-input" placeholder="Buscar circuito..." data-column="1">
                                    </div>
                                </th>
                                <th>
                                    <div class="table-header-with-search">
                                        <span class="header-text">DESPACHO</span>
                                        <input type="text" class="header-search-input" placeholder="Buscar despacho..." data-column="2">
                                    </div>
                                </th>
                                <th>
                                    <div class="table-header-with-search">
                                        <span class="header-text">VISITADO</span>
                                        <input type="text" class="header-search-input" placeholder="SI/NO..." data-column="3">
                                    </div>
                                </th>
                                <th>
                                    <div class="table-header-with-search">
                                        <span class="header-text">CAPACITADO</span>
                                        <input type="text" class="header-search-input" placeholder="SI/NO..." data-column="4">
                                    </div>
                                </th>
                                <th>
                                    <div class="table-header-with-search">
                                        <span class="header-text">CON USUARIO</span>
                                        <input type="text" class="header-search-input" placeholder="SI/NO..." data-column="5">
                                    </div>
                                </th>
                                <th>
                                    <div class="table-header-with-search">
                                        <span class="header-text">USANDO SGDE</span>
                                        <input type="text" class="header-search-input" placeholder="SI/NO..." data-column="6">
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($despachos as $index => $despacho)
                                @php $actividad = $despacho->actividadesDespacho->last(); @endphp
                                <tr data-circuit="{{ $despacho->circuito ?? 'Sin Circuito' }}">
                                    <td><strong>{{ $index + 1 }}</strong></td>
                                    <td><span class="badge badge-primary">{{ $despacho->circuito ?? 'Sin Circuito' }}</span></td>
                                    <td><strong>{{ $despacho->nombreDespacho }}</strong></td>
                                    <td>
                                        @if ($actividad && $actividad->visitado)
                                            <span class="status-badge status-success">SI</span>
                                        @else
                                            <span class="status-badge status-danger">NO</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($actividad && $actividad->capacitado)
                                            <span class="status-badge status-success">SI</span>
                                        @else
                                            <span class="status-badge status-danger">NO</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($actividad && $actividad->con_usuarios)
                                            <span class="status-badge status-success">SI</span>
                                        @else
                                            <span class="status-badge status-danger">NO</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($actividad && $actividad->en_produccion)
                                            <span class="status-badge status-success">SI</span>
                                        @else
                                            <span class="status-badge status-danger">NO</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div id="noResults" class="no-results">
                        <i class="fas fa-search"></i>
                        <p>No se encontraron resultados para tu búsqueda</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterSesis2025.js"></script> 

<script>
document.addEventListener('DOMContentLoaded', function() {
    let mainChart;
    
    // Datos originales para el gráfico
    const originalData = {
        visitados: {{ $totales['visitados'] }},
        capacitaciones: {{ $totales['capacitaciones'] }},
        con_usuarios: {{ $totales['con_usuarios'] }},
        usando_sgde: {{ $totales['usando_sgde'] }}
    };

    // Datos por circuito para filtrado
    const circuitData = @json($despachosPorCircuito);

    // Inicializar gráfico
    function initChart(data) {
        const ctx = document.getElementById('actividadesChart');
        if (!ctx) return;
        
        if (mainChart) {
            mainChart.destroy();
        }
        
        mainChart = new Chart(ctx.getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['Visitados', 'Capacitados', 'Con Usuarios', 'Usando SGDE'],
                datasets: [{
                    data: [data.visitados, data.capacitaciones, data.con_usuarios, data.usando_sgde],
                    backgroundColor: [
                        '#10b981',
                        '#06b6d4', 
                        '#f59e0b',
                        '#6366f1'
                    ],
                    borderRadius: 8,
                    borderSkipped: false,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    title: {
                        display: true,
                        text: 'Resumen de Actividades por Categoría',
                        font: { size: 16, weight: 'bold' },
                        color: '#111827',
                        padding: 20
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#e5e7eb' },
                        ticks: { color: '#6b7280' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#6b7280' }
                    }
                },
                animation: {
                    duration: 2000,
                    easing: 'easeOutQuart'
                }
            }
        });
    }

    // Inicializar con datos originales
    initChart(originalData);

    // Variables de estado
    let currentFilter = '';
    let isFiltered = false;

    // Elementos del DOM
    const circuitSelect = document.getElementById('circuitFilter');
    const showBtn = document.getElementById('showCircuitBtn');
    const clearBtn = document.getElementById('clearFilterBtn');

    // Habilitar/deshabilitar botón mostrar
    circuitSelect.addEventListener('change', function() {
        const selectedValue = this.value;
        if (selectedValue && selectedValue !== '') {
            showBtn.disabled = false;
        } else {
            showBtn.disabled = true;
        }
    });

    // Función para aplicar filtro
    function applyCircuitFilter(selectedCircuit) {
        const table = document.getElementById('generalDespachosTable');
        if (!table) return;
        
        const tbody = table.getElementsByTagName('tbody')[0];
        const rows = tbody.getElementsByTagName('tr');
        
        let filteredData = { visitados: 0, capacitaciones: 0, con_usuarios: 0, usando_sgde: 0 };
        let visibleRows = 0;

        // Mostrar/ocultar filas según el circuito seleccionado
        for (let i = 0; i < rows.length; i++) {
            const row = rows[i];
            const circuitCell = row.getElementsByTagName('td')[1];
            const circuitText = circuitCell ? circuitCell.textContent.trim() : '';
            const rowCircuit = circuitText.replace(/\s+/g, ' ').trim();
            
            if (selectedCircuit === 'all' || rowCircuit === selectedCircuit) {
                row.style.display = '';
                visibleRows++;
                
                // Contar para estadísticas filtradas
                const visitadoCell = row.querySelector('td:nth-child(4) .status-success');
                const capacitadoCell = row.querySelector('td:nth-child(5) .status-success');
                const conUsuariosCell = row.querySelector('td:nth-child(6) .status-success');
                const usandoSgdeCell = row.querySelector('td:nth-child(7) .status-success');
                
                if (visitadoCell) filteredData.visitados++;
                if (capacitadoCell) filteredData.capacitaciones++;
                if (conUsuariosCell) filteredData.con_usuarios++;
                if (usandoSgdeCell) filteredData.usando_sgde++;
            } else {
                row.style.display = 'none';
            }
        }

        // Actualizar estadísticas
        if (selectedCircuit === 'all') {
            document.getElementById('totalVisitados').textContent = originalData.visitados;
            document.getElementById('totalCapacitados').textContent = originalData.capacitaciones;
            document.getElementById('totalConUsuarios').textContent = originalData.con_usuarios;
            document.getElementById('totalUsandoSgde').textContent = originalData.usando_sgde;
            initChart(originalData);
        } else {
            document.getElementById('totalVisitados').textContent = filteredData.visitados;
            document.getElementById('totalCapacitados').textContent = filteredData.capacitaciones;
            document.getElementById('totalConUsuarios').textContent = filteredData.con_usuarios;
            document.getElementById('totalUsandoSgde').textContent = filteredData.usando_sgde;
            initChart(filteredData);
        }

        // Mostrar mensaje si no hay resultados
        const noResults = document.getElementById('noResults');
        if (noResults) {
            if (visibleRows === 0 && selectedCircuit !== 'all') {
                noResults.style.display = 'block';
                noResults.innerHTML = `
                    <i class="fas fa-search"></i>
                    <p>No se encontraron despachos para el circuito: <strong>${selectedCircuit}</strong></p>
                `;
            } else {
                noResults.style.display = 'none';
            }
        }

        // Actualizar estado
        currentFilter = selectedCircuit;
        isFiltered = selectedCircuit !== '' && selectedCircuit !== 'all';
        
        // Mostrar/ocultar botones
        if (isFiltered) {
            clearBtn.style.display = 'flex';
            showBtn.style.display = 'none';
            
            // Agregar indicador de filtro activo
            addFilterStatus(selectedCircuit);
        } else {
            clearBtn.style.display = 'none';
            showBtn.style.display = 'flex';
            showBtn.disabled = true;
            removeFilterStatus();
        }
    }

    // Función para agregar indicador de filtro activo
    function addFilterStatus(circuitName) {
        removeFilterStatus(); // Remover cualquier indicador existente
        
        const filterGroup = document.querySelector('.filter-group');
        const statusIndicator = document.createElement('div');
        statusIndicator.className = 'filter-status';
        statusIndicator.id = 'filterStatus';
        statusIndicator.innerHTML = `
            <i class="fas fa-filter"></i>
            Filtrado: ${circuitName}
        `;
        filterGroup.appendChild(statusIndicator);
    }

    // Función para remover indicador de filtro
    function removeFilterStatus() {
        const existingStatus = document.getElementById('filterStatus');
        if (existingStatus) {
            existingStatus.remove();
        }
    }

    // Evento del botón mostrar
    showBtn.addEventListener('click', function() {
        const selectedCircuit = circuitSelect.value;
        if (selectedCircuit && selectedCircuit !== '') {
            applyCircuitFilter(selectedCircuit);
        }
    });

    // Evento del botón limpiar
    clearBtn.addEventListener('click', function() {
        // Resetear select
        circuitSelect.value = '';
        
        // Aplicar filtro "todos"
        applyCircuitFilter('all');
        
        // Limpiar todos los filtros de búsqueda en encabezados
        const allSearchInputs = document.querySelectorAll('.header-search-input');
        allSearchInputs.forEach(input => {
            input.value = '';
        });
        
        // Mostrar todas las filas en todas las tablas
        const allTables = document.querySelectorAll('.searchable-table');
        allTables.forEach(table => {
            const rows = table.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
            for (let i = 0; i < rows.length; i++) {
                rows[i].style.display = '';
            }
            updateRowCount(table);
        });
    });

    // Toggle entre vistas
    document.querySelectorAll('.toggle-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.toggle-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            const view = this.dataset.view;
            const combinedView = document.getElementById('combinedView');
            const separatedView = document.getElementById('separatedView');
            const generalTable = document.getElementById('generalTable');
            
            if (view === 'combined') {
                combinedView.classList.remove('hidden');
                separatedView.classList.add('hidden');
                generalTable.classList.remove('hidden');
            } else {
                combinedView.classList.add('hidden');
                separatedView.classList.remove('hidden');
                generalTable.classList.add('hidden');
            }
        });
    });

    // Función de búsqueda en encabezados de tabla
    function initializeTableSearch() {
        const searchInputs = document.querySelectorAll('.header-search-input');
        
        searchInputs.forEach(input => {
            input.addEventListener('input', function() {
                const table = this.closest('table');
                const columnIndex = parseInt(this.getAttribute('data-column'));
                const searchTerm = this.value.toLowerCase().trim();
                const rows = table.querySelectorAll('tbody tr');
                
                rows.forEach(row => {
                    const cell = row.cells[columnIndex];
                    if (cell) {
                        const cellText = cell.textContent.toLowerCase();
                        
                        // Si hay término de búsqueda, verificar si coincide
                        if (searchTerm === '' || cellText.includes(searchTerm)) {
                            // Verificar si otras columnas también coinciden con sus filtros
                            let showRow = true;
                            const tableInputs = table.querySelectorAll('.header-search-input');
                            
                            tableInputs.forEach(otherInput => {
                                const otherColumnIndex = parseInt(otherInput.getAttribute('data-column'));
                                const otherSearchTerm = otherInput.value.toLowerCase().trim();
                                
                                if (otherSearchTerm !== '') {
                                    const otherCell = row.cells[otherColumnIndex];
                                    if (otherCell && !otherCell.textContent.toLowerCase().includes(otherSearchTerm)) {
                                        showRow = false;
                                    }
                                }
                            });
                            
                            row.style.display = showRow ? '' : 'none';
                        } else {
                            row.style.display = 'none';
                        }
                    }
                });
                
                // Actualizar el contador de resultados visibles
                updateRowCount(table);
            });
        });
    }

    // Función para actualizar contador de filas visibles
    function updateRowCount(table) {
        const visibleRows = table.querySelectorAll('tbody tr:not([style*="display: none"])');
        const totalRows = table.querySelectorAll('tbody tr');
        
        // Crear o actualizar el indicador de resultados
        let countIndicator = table.parentElement.querySelector('.row-count-indicator');
        if (!countIndicator) {
            countIndicator = document.createElement('div');
            countIndicator.className = 'row-count-indicator';
            table.parentElement.appendChild(countIndicator);
        }
        
        countIndicator.textContent = `Mostrando ${visibleRows.length} de ${totalRows.length} registros`;
    }

    // Función para limpiar filtros de una tabla específica
    window.clearTableFilters = function(tableId) {
        const table = document.getElementById(tableId);
        if (!table) return;
        
        const inputs = table.querySelectorAll('.header-search-input');
        inputs.forEach(input => {
            input.value = '';
            input.dispatchEvent(new Event('input'));
        });
    };

    // Inicializar búsqueda en tablas cuando se carga la página
    initializeTableSearch();
    
    // Inicializar contadores
    const tables = document.querySelectorAll('.searchable-table');
    tables.forEach(table => {
        updateRowCount(table);
    });
});

// Función para manejar el acordeón de circuitos
function toggleAccordion(circuitName) {
    const header = document.querySelector(`[onclick="toggleAccordion('${circuitName}')"]`);
    const content = document.getElementById(`content-${circuitName}`);
    const toggleText = header.querySelector('.accordion-toggle span');
    
    if (content.classList.contains('collapsed')) {
        // Expandir
        content.classList.remove('collapsed');
        header.classList.remove('collapsed');
        toggleText.textContent = 'Ocultar detalles';
    } else {
        // Contraer
        content.classList.add('collapsed');
        header.classList.add('collapsed');
        toggleText.textContent = 'Ver detalles';
    }
}
</script>

@endsection
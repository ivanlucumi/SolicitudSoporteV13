@extends('layouts.ensayo')

@section('title', 'Acuerdos y Circulares')

@section('content')
<!-- Fuentes e Iconos -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<style>
    :root {
        --primary-color: #002147;
        --secondary-color: #FDC500;
        --accent-color: #004080;
        --bg-color: #f4f7f6;
        --card-bg: rgba(255, 255, 255, 0.95);
        --text-main: #2c3e50;
        --text-muted: #6c757d;
    }

    body {
        font-family: 'Outfit', sans-serif;
        background-color: var(--bg-color);
        background-image: radial-gradient(#e2e8f0 1px, transparent 1px);
        background-size: 20px 20px;
        color: var(--text-main);
    }

    .hero-header {
        background: #002147;
        color: white;
        padding: 10px 20px;
        border-radius: 16px;
        margin-bottom: 40px;
        position: relative;
        overflow: hidden;
    }

    .hero-header::after {
        content: '';
        position: absolute;
        top: -20%;
        right: -10%;
        width: 300px;
        height: 190px;
        background: #00214;
        border-radius: 50%;
    }

    .hero-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
        letter-spacing: -1px;
        text-align: center;
    }

    .hero-subtitle {
        font-size: 1.8rem;
        font-weight: 500;
        opacity: 0.9;
        max-width: 1100px;
        margin: 0 auto;
        text-align: justify;
    }

    /* Tabs Styling */
    .nav-pills > li {
        margin-bottom: 10px;
    }
    
    .nav-pills > li > a {
        border-radius: 30px;
        padding: 12px 25px;
        font-weight: 500;
        color: var(--primary-color);
        background-color: white;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }

    .nav-pills > li > a:hover {
        background-color: #f8f9fa;
        transform: translateY(-2px);
    }

    .nav-pills > li.active > a, 
    .nav-pills > li.active > a:focus, 
    .nav-pills > li.active > a:hover {
        background-color: var(--primary-color);
        color: white;
        box-shadow: 0 6px 12px rgba(0,33,71,0.3);
    }

    /* Cards */
    .doc-card {
        background: var(--card-bg);
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 25px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        border-left: 5px solid var(--secondary-color);
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }

    .doc-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 25px rgba(0,0,0,0.1);
        border-left-color: var(--primary-color);
    }

    .doc-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
        font-size: 0.9rem;
        color: var(--text-muted);
    }

    .doc-date {
        display: flex;
        align-items: center;
        gap: 5px;
        background: #e9ecef;
        padding: 4px 12px;
        border-radius: 20px;
        font-weight: 500;
        color: var(--primary-color);
    }

    .doc-date i {
        font-size: 16px;
    }

    .doc-acta {
        font-weight: 600;
        color: var(--accent-color);
        background: rgba(0,64,128,0.1);
        padding: 4px 10px;
        border-radius: 6px;
    }

    .doc-title {
        font-size: 1.25rem;
        font-weight: 600;
        line-height: 1.4;
        margin-bottom: 20px;
        color: var(--primary-color);
        flex-grow: 1;
    }

    .btn-download {
        background-color: #fff;
        color: var(--primary-color);
        border: 2px solid var(--primary-color);
        border-radius: 30px;
        padding: 8px 20px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s ease;
        width: 100%;
    }

    .btn-download:hover {
        background-color: var(--primary-color);
        color: #fff;
        text-decoration: none;
        box-shadow: 0 4px 10px rgba(0,33,71,0.2);
    }
    
    .btn-download i {
        font-size: 20px;
    }

    /* Table Styling */
    .public-table {
        width: 100%;
        background: var(--card-bg);
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0,0,0,0.04);
        border-collapse: collapse;
        margin-bottom: 25px;
    }
    .public-table th {
        background: var(--primary-color);
        color: white;
        padding: 15px;
        font-weight: 500;
        text-align: left;
    }
    .public-table td {
        padding: 15px;
        border-bottom: 1px solid #eef2f5;
        vertical-align: middle;
    }
    .public-table tr:last-child td {
        border-bottom: none;
    }
    .public-table tr:hover td {
        background: rgba(253, 197, 0, 0.05);
    }
    .pdf-icon-btn {
        transition: transform 0.2s ease;
        display: inline-block;
    }
    .pdf-icon-btn:hover {
        transform: scale(1.1);
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
    }

    .empty-state i {
        font-size: 60px;
        color: #ddd;
        margin-bottom: 20px;
    }

    .empty-state h3 {
        color: var(--text-muted);
        font-weight: 400;
    }

    /* Animaciones */
    .fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Correcciones Navbar/Footer heredadas */
    nav.navbar.cBlanco { background-color: #002147 !important; }
    .footer { background-color: #002147 !important; }
</style>

<div class="container-fluid" style="padding: 20px 40px; max-width: 1400px; margin: 0 auto;">
    
    <div class="hero-header fade-in">
        <h2 class="hero-title">MEDIDAS TRANSITORIAS Y EXCEPCIONALES ADOPTADAS CON OCASIÓN DE LAS AFECTACIONES OCASIONADAS POR EL SISMO OCURRIDO EL 10 DE AGOSTO DE 2026.<br></h2>
           <p class="hero-subtitle"> En este espacio se encuentran disponibles los acuerdos, circulares y demás documentos expedidos por las distintas corporaciones, con el propósito de informar sobre las transitorias y medidas excepcionales adoptadas para atender las afectaciones ocasionadas por el sismo ocurrido el 10 de agosto de 2026.</p>
    </div>

    <div class="row">
        <!-- Sidebar Navigation (Tabs) -->
        <div class="col-md-3 fade-in" style="animation-delay: 0.1s;">
            <ul class="nav nav-pills nav-stacked" id="docTabs" role="tablist">
                @php $first = true; @endphp
                @forelse($publicacionesPorTipo as $tipo => $publicaciones)
                    <li role="presentation" class="{{ $first ? 'active' : '' }}">
                        <a href="#tab_{{ md5($tipo) }}" aria-controls="tab_{{ md5($tipo) }}" role="tab" data-toggle="tab">
                            {{ $tipo }}
                            <span class="badge pull-right" style="background-color: var(--secondary-color); color: var(--primary-color);">{{ count($publicaciones) }}</span>
                        </a>
                    </li>
                    @php $first = false; @endphp
                @empty
                    <li role="presentation" class="active">
                        <a href="#empty" aria-controls="empty" role="tab" data-toggle="tab">Sin Documentos</a>
                    </li>
                @endforelse
            </ul>
        </div>

        <!-- Tab Content -->
        <div class="col-md-9 fade-in" style="animation-delay: 0.2s;">
            <div class="tab-content">
                @php $firstTab = true; @endphp
                @forelse($publicacionesPorTipo as $tipo => $publicaciones)
                    <div role="tabpanel" class="tab-pane fade {{ $firstTab ? 'in active' : '' }}" id="tab_{{ md5($tipo) }}">
                        <div class="table-responsive fade-in">
                            <table class="public-table">
                                <thead>
                                    <tr>
                                        <th style="width: 15%;"># Acta</th>
                                        <th style="width: 20%;">Fecha</th>
                                        <th style="width: 50%;">Asunto</th>
                                        <th style="width: 15%; text-align: center;">Archivo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($publicaciones as $pub)
                                        <tr>
                                            <td>
                                                @if($pub->numero_acta)
                                                    <span class="doc-acta" title="Número de Acta">
                                                       {{ $pub->numero_acta }}
                                                    </span>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>
                                                <span class="doc-date" style="background: transparent; padding: 0;">
                                                    <i class="material-icons-outlined" style="font-size: 18px; margin-right: 5px;">calendar_today</i>
                                                    {{ $pub->fecha ? \Carbon\Carbon::parse($pub->fecha)->format('d/m/Y') : 'Sin fecha' }}
                                                </span>
                                            </td>
                                            <td style="font-weight: 500; color: var(--primary-color);">
                                                {{ $pub->asunto }}
                                            </td>
                                            <td style="text-align: center;">
                                                <a href="#" onClick="window.open('{{ $pub->archivo_pdf }}','popup', 'width=800px,height=600px')" class="pdf-icon-btn" title="Ver Documento PDF">
                                                    <img src="{{ asset('img/pdf.svg') }}" alt="PDF" style="height: 35px;">
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @php $firstTab = false; @endphp
                @empty
                    <div role="tabpanel" class="tab-pane fade in active" id="empty">
                        <div class="empty-state">
                            <i class="material-icons-outlined">folder_open</i>
                            <h3>Aún no hay documentos oficiales publicados.</h3>
                            <p class="text-muted">La información estará disponible pronto.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
@endsection

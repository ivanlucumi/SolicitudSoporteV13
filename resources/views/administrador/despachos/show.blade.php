@extends('layouts.admin')

@section('title', 'Información Despacho')
@section('cabecera', 'Información Despacho Juzgado')

@section('content')

<style>
  .show-card {
    background: rgba(255, 255, 255, 0.92);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border: 1px solid rgba(0, 63, 117, 0.08);
    border-radius: 1rem;
    box-shadow: 0 10px 40px rgba(0, 63, 117, 0.10);
    padding: 2rem;
    margin-bottom: 2rem;
    animation: fadeInUp 0.6s ease-out both;
  }
  @keyframes fadeInUp {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
  }
  .show-header {
    text-align: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid rgba(0, 63, 117, 0.10);
  }
  .show-header h3 {
    margin: 0;
    color: #003f75;
    font-weight: 500;
    font-size: 1.5rem;
    text-transform: uppercase;
  }
  .show-header small {
    color: #6c757d;
    font-size: 0.9rem;
  }
  .field-group {
    margin-bottom: 1.5rem;
  }
  .field-label {
    font-size: 0.75rem;
    font-weight: 700;
    color: #003f75;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    margin-bottom: 0.3rem;
  }
  .field-value {
    font-size: 0.95rem;
    color: #212529;
    word-wrap: break-word;
    padding: 0.5rem 0.75rem;
    background: rgba(0, 63, 117, 0.03);
    border-radius: 0.4rem;
    border-left: 3px solid #003f75;
    min-height: 2.2rem;
    display: flex;
    align-items: center;
  }
  .field-value.empty {
    color: #adb5bd;
    font-style: italic;
    border-left-color: #adb5bd;
  }
  .status-badge {
    display: inline-block;
    padding: 0.25rem 0.6rem;
    border-radius: 0.4rem;
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
  }
  .status-activo { background: rgba(40, 167, 69, 0.12); color: #28a745; }
  .status-inactivo { background: rgba(220, 53, 69, 0.12); color: #dc3545; }

  .btn-modern {
    border: none;
    border-radius: 0.6rem;
    padding: 0.75rem 1.5rem;
    font-size: 0.95rem;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.25s ease;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 0.03em;
    text-decoration: none;
  }
  .btn-modern:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.12);
    text-decoration: none;
  }
  .btn-editar {
    background: linear-gradient(135deg, #003f75 0%, #0056a3 100%);
    color: #fff;
  }
  .btn-editar:hover {
    background: linear-gradient(135deg, #0056a3 0%, #0074d9 100%);
    color: #fff;
  }
  .btn-inactivar {
    background: #fff;
    color: #dc3545;
    border: 1px solid #dc3545;
  }
  .btn-inactivar:hover {
    background: #dc3545;
    color: #fff;
  }
  .divider-modern {
    border: none;
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(0,63,117,0.15), transparent);
    margin: 1.5rem 0;
  }
  .section-title {
    font-size: 0.75rem;
    font-weight: 700;
    color: #003f75;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }
  .section-title::after {
    content: '';
    flex: 1;
    height: 1px;
    background: linear-gradient(90deg, rgba(0,63,117,0.2), transparent);
  }
</style>

<div class="show-card">
  <div class="show-header">
    <h3>{{ $despachos->codigoDespacho }} - {{ $despachos->nombreDespacho }}</h3>
    <small>
      Estado:
      @if($despachos->estado == 'Activo' || empty($despachos->estado))
        <span class="status-badge status-activo">Activo</span>
      @else
        <span class="status-badge status-inactivo">{{ $despachos->estado }}</span>
      @endif
    </small>
  </div>

  {{-- Información Principal --}}
  <div class="section-title">Información Principal</div>
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-4">
      <div class="field-group">
        <div class="field-label">Código Despacho</div>
        <div class="field-value">{{ $despachos->codigoDespacho }}</div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-4">
      <div class="field-group">
        <div class="field-label">Nombre Despacho</div>
        <div class="field-value">{{ $despachos->nombreDespacho }}</div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-4">
      <div class="field-group">
        <div class="field-label">Sede</div>
        <div class="field-value {{ empty($despachos->sede) ? 'empty' : '' }}">
          {{ $despachos->sede ?: 'No registrado' }}
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-4">
      <div class="field-group">
        <div class="field-label">Ciudad</div>
        <div class="field-value">
          {{ $despachos->ciudad->nombreCiudad ?? strtoupper($despachos->codCiudad) }}
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-4">
      <div class="field-group">
        <div class="field-label">Dirección</div>
        <div class="field-value">{{ $despachos->direccion }}</div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-4">
      <div class="field-group">
        <div class="field-label">Teléfono</div>
        <div class="field-value">{{ $despachos->telefono }}</div>
      </div>
    </div>
  </div>

  <hr class="divider-modern">

  {{-- Correos --}}
  <div class="section-title">Correos Electrónicos</div>
  <div class="row">
    <div class="col-xs-12 col-sm-4">
      <div class="field-group">
        <div class="field-label">Correo Principal</div>
        <div class="field-value">{{ $despachos->correoD }}</div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-4">
      <div class="field-group">
        <div class="field-label">Correo Demanda</div>
        <div class="field-value {{ empty($despachos->correo_demanda) ? 'empty' : '' }}">
          {{ $despachos->correo_demanda ?: 'No registrado' }}
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-4">
      <div class="field-group">
        <div class="field-label">Correo Memoriales</div>
        <div class="field-value {{ empty($despachos->correo_memoriales) ? 'empty' : '' }}">
          {{ $despachos->correo_memoriales ?: 'No registrado' }}
        </div>
      </div>
    </div>
  </div>

  <hr class="divider-modern">

  {{-- Ubicación y Jerarquía --}}
  <div class="section-title">Ubicación y Jerarquía</div>
  <div class="row">
    <div class="col-xs-12 col-sm-6 col-md-3">
      <div class="field-group">
        <div class="field-label">Edificio</div>
        <div class="field-value {{ empty($despachos->edificio) ? 'empty' : '' }}">
          {{ $despachos->edificio ?: 'No registrado' }}
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-3">
      <div class="field-group">
        <div class="field-label">Piso</div>
        <div class="field-value {{ empty($despachos->piso) ? 'empty' : '' }}">
          {{ $despachos->piso ?: 'No registrado' }}
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-3">
      <div class="field-group">
        <div class="field-label">Extensión</div>
        <div class="field-value {{ empty($despachos->extension) ? 'empty' : '' }}">
          {{ $despachos->extension ?: 'No registrado' }}
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-3">
      <div class="field-group">
        <div class="field-label">Circuito</div>
        <div class="field-value {{ empty($despachos->circuito) ? 'empty' : '' }}">
          {{ $despachos->circuito ?: 'No registrado' }}
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-3">
      <div class="field-group">
        <div class="field-label">Distrito</div>
        <div class="field-value {{ empty($despachos->districto) ? 'empty' : '' }}">
          {{ $despachos->districto ?: 'No registrado' }}
        </div>
      </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-3">
      <div class="field-group">
        <div class="field-label">Modificado por</div>
        <div class="field-value {{ empty($despachos->modificador) ? 'empty' : '' }}">
          {{ $despachos->modificador ?: 'No registrado' }}
        </div>
      </div>
    </div>
  </div>

  <hr class="divider-modern">

  {{-- Acciones --}}
  <div class="row">
    <div class="col-xs-12 col-sm-6" style="margin-bottom: 0.8rem;">
      <a href="{{ route('despachos.edit', $despachos->codigoDespacho) }}" class="btn-modern btn-editar btn-block">
        <i class="fa fa-pencil"></i> Editar Despacho
      </a>
    </div>
    <div class="col-xs-12 col-sm-6">
      <form action="{{ route('despachos.destroy', $despachos->codigoDespacho) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-modern btn-inactivar btn-block" onclick="return confirm('¿Está seguro de inactivar este despacho? El despacho no se eliminará, solo cambiará su estado a Inactivo.')">
          <i class="fa fa-power-off"></i> Inactivar Despacho
        </button>
      </form>
    </div>
  </div>
</div>

@endsection

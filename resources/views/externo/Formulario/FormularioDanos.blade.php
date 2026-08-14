@extends('layouts.usuarios')

@section('title', 'Reporte de Daños y Fallas')
@section('cabecera', 'Soporte Técnico - Reporte de Daños')

@push('style')
  <!-- Font and Icons -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
  
  <!-- ESTILOS CORPORATIVOS MODERNOS -->
  <style>
    :root {
      --primary: #0a2a4a;
      --primary-light: #0d3b66;
      --accent: #0088cc;
      --surface: #ffffff;
      --surface-alt: #f8fafd;
      --border: #e2e8f0;
      --border-light: #edf2f7;
      --text: #1a202c;
      --text-soft: #4a5568;
      --danger: #e53e3e;
      --shadow-sm: 0 1px 2px rgba(0,0,0,0.04);
      --shadow: 0 4px 12px rgba(0,0,0,0.06), 0 1px 3px rgba(0,0,0,0.04);
      --radius-sm: 8px;
      --radius: 12px;
      --radius-lg: 16px;
      --transition: 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .corp-container { position: relative; z-index: 1; max-width: 1000px; margin: 0 auto; padding-bottom: 80px; }

    /* Header Glassmorphism */
    .corp-header {
      background: rgba(255,255,255,0.85);
      backdrop-filter: blur(20px);
      border-bottom: 1px solid rgba(255,255,255,0.6);
      box-shadow: var(--shadow-sm);
      padding: 20px 24px;
      display: flex; align-items: center; justify-content: space-between;
      border-radius: var(--radius-lg);
      margin-bottom: 28px; border: 1px solid var(--border-light);
    }

    .corp-header img { max-height: 60px; }
    .corp-header .header-text { text-align: right; }
    .corp-header .header-text p { margin: 0; font-weight: 600; color: var(--primary); }
    .corp-header .header-text small { font-size: 0.78rem; color: var(--text-soft); }

    .corp-card {
      background: var(--surface); border-radius: var(--radius-lg);
      box-shadow: var(--shadow); border: 1px solid var(--border-light);
      overflow: hidden;
    }

    .corp-card .card-header {
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-light) 100%);
      color: #fff; padding: 22px 28px; position: relative;
    }
    .corp-card .card-header h3 { margin: 0; font-size: 1.5rem; font-weight: 700; color: #fff; }
    .corp-card .card-body { padding: 28px; }

    .corp-fieldset {
      border: 1.5px solid var(--border); border-radius: var(--radius);
      padding: 24px 28px; margin-bottom: 32px; background: var(--surface-alt);
    }

    legend.corp-section-title {
      font-size: 1.15rem; font-weight: 700; color: var(--primary);
      margin: 0; padding: 6px 16px; border: 1.5px solid var(--border);
      background: var(--surface); border-radius: 20px;
      display: inline-flex; align-items: center; gap: 8px; box-shadow: var(--shadow-sm);
    }
    legend.corp-section-title::before { content: ''; width: 6px; height: 6px; background: var(--accent); border-radius: 50%; }

    .corp-container label { font-weight: 600; font-size: 1.05rem; color: var(--text-soft); margin-bottom: 6px; display: inline-block; }

    .corp-container .form-control {
      width: 100%; border: 1.5px solid var(--border); border-radius: var(--radius-sm);
      padding: 10px 14px; font-size: 1.05rem; background: var(--surface); height: auto;
      transition: all var(--transition);
    }
    .corp-container .form-control:focus { outline: none; border-color: var(--accent); box-shadow: 0 0 0 3px rgba(0,136,204,0.1); }
    .corp-container textarea.form-control { resize: vertical; min-height: 80px; }

    /* Custom Checkbox/Switch */
    .switch-group {
      display: flex; flex-wrap: wrap; gap: 15px; margin-bottom: 20px;
    }
    .switch-label {
      display: flex; align-items: center; gap: 10px;
      padding: 12px 18px; border: 1.5px solid var(--border); border-radius: var(--radius-lg);
      background: var(--surface); cursor: pointer; transition: all var(--transition);
      font-weight: 600; font-size: 1.1rem; color: var(--primary); flex: 1; min-width: 200px;
      user-select: none;
      margin: 0;
    }
    .switch-label:hover { border-color: var(--danger); background: #fef2f2; }
    .switch-label.active { border-color: var(--danger); background: #fef2f2; color: var(--danger); }
    .switch-label.active input[type="checkbox"] { accent-color: var(--danger); }
    
    .switch-label input[type="checkbox"] {
      width: 18px; height: 18px; accent-color: var(--accent); cursor: pointer; margin: 0;
    }

    /* Dynamic Sub-sections */
    .falla-details {
      display: none;
      background: var(--surface); border-radius: var(--radius-sm); border: 1px dashed var(--border);
      padding: 16px; margin-bottom: 20px; animation: fadeIn 0.3s ease;
    }
    .falla-details.visible { display: block; }
    .falla-details h4 { margin-top: 0; color: var(--danger); font-size: 1.25rem; margin-bottom: 15px; }

    @keyframes fadeIn { from { opacity: 0; transform: translateY(-5px); } to { opacity: 1; transform: translateY(0); } }

    /* File Input Styling */
    .file-input-wrapper {
      position: relative; overflow: hidden; display: inline-block; width: 100%;
    }
    .file-input-wrapper input[type=file] {
      position: absolute; left: 0; top: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
    }
    .btn-upload {
      border: 1.5px dashed var(--accent); color: var(--accent); background: #f8fafd;
      padding: 12px; border-radius: var(--radius-sm); text-align: center;
      font-weight: 600; display: block; transition: all var(--transition);
    }
    .btn-upload:hover { background: #e6f3ff; }

    .btn-primary.corp-btn {
      background: var(--primary); color: #fff; border: none; padding: 12px 28px;
      border-radius: 24px; font-weight: 600; font-size: 0.95rem; cursor: pointer;
      transition: all var(--transition); display: block; width: fit-content; margin: 30px auto 0;
    }
    .btn-primary.corp-btn:hover { background: var(--primary-light); transform: translateY(-1px); box-shadow: var(--shadow-sm); }
    
    .btn-add {
        background: #f8fafd; border: 1.5px dashed var(--accent); color: var(--accent);
        padding: 8px 16px; border-radius: 20px; font-size: 0.85rem; font-weight: 600;
        cursor: pointer; margin-top: 10px; display: inline-flex; align-items: center; gap: 6px;
        transition: all var(--transition);
    }
    .btn-add:hover { background: #e6f3ff; }
    
    .equipo-item {
        background: #fdfdfd; border: 1px solid #e2e8f0; padding: 16px; border-radius: 8px; margin-bottom: 16px; position: relative;
    }
    .btn-remove {
        position: absolute; top: 10px; right: 10px; background: #fee2e2; color: #ef4444; border: none;
        width: 24px; height: 24px; border-radius: 50%; font-weight: bold; cursor: pointer;
        display: flex; align-items: center; justify-content: center;
    }
    .btn-remove:hover { background: #fca5a5; }
  </style>
@endpush

@section('content')
<div class="corp-container">
  
  <div class="corp-card">   
    <div class="card-body">
      <form action="{{ url('guardar-fallas') }}" method="POST" enctype="multipart/form-data" id="form-reporte" onsubmit="mostrarCargando()">
        @csrf

        <!-- Datos del Usuario -->
        <fieldset class="corp-fieldset">
          <legend class="corp-section-title">Información Básica</legend>
          <div class="row">
            <div class="col">
              <label for="cedula_funcionario">Cédula del Funcionario (Solo números):</label>
              <input type="number" id="cedula_funcionario" name="cedula_funcionario" class="form-control" placeholder="Ej. 123456789" required>
            </div>
            <div class="col">
              <label for="nombre">Nombre Completo:</label>
              <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Se completará automáticamente..." required readonly style="background-color: #f1f5f9; cursor: not-allowed;">
            </div>
          </div>
          <div class="row" style="margin-top: 15px;">
            <div class="col-12">
              <label for="despacho">Despacho / Dependencia (Juzgado):</label>
              <input type="text" id="despacho" name="despacho" class="form-control" value="{{ auth()->user()->name ?? 'Despacho Desconocido' }}" readonly style="background-color: #f1f5f9; cursor: not-allowed; color: #4a5568;">
              <input type="hidden" id="codigo_juzgado" name="codigo_juzgado" value="">
              <small style="color: #718096;">* Asignado automáticamente al consultar su cédula (o sesión)</small>
            </div>
          </div>
        </fieldset>

        <!-- Selección de Fallas -->
        <fieldset class="corp-fieldset">
          <legend class="corp-section-title">¿Qué tipo de fallas o daños presenta?</legend>
          <p style="font-size: 1.05rem; color: var(--text-soft); margin-bottom: 16px;">Seleccione una o varias opciones para habilitar el espacio de observaciones y adjuntar evidencias.</p>
          
          <div class="switch-group">
            <label class="switch-label" id="lbl-conectividad">
              <input type="checkbox" id="chk-conectividad" name="tipos_falla[]" value="conectividad" onchange="toggleFalla('conectividad')">
              Conectividad (Red/Internet)
            </label>

            <label class="switch-label" id="lbl-computo">
              <input type="checkbox" id="chk-computo" name="tipos_falla[]" value="computo" onchange="toggleFalla('computo')">
              Equipos de Cómputo
            </label>

            <label class="switch-label" id="lbl-impresoras">
              <input type="checkbox" id="chk-impresoras" name="tipos_falla[]" value="impresoras" onchange="toggleFalla('impresoras')">
              Impresoras
            </label>

            <label class="switch-label" id="lbl-escaner">
              <input type="checkbox" id="chk-escaner" name="tipos_falla[]" value="escaner" onchange="toggleFalla('escaner')">
              Escáner
            </label>

            <label class="switch-label" id="lbl-telefonia">
              <input type="checkbox" id="chk-telefonia" name="tipos_falla[]" value="telefonia" onchange="toggleFalla('telefonia')">
              Telefonía IP
            </label>

            <label class="switch-label" id="lbl-ups">
              <input type="checkbox" id="chk-ups" name="tipos_falla[]" value="ups" onchange="toggleFalla('ups')">
              UPS
            </label>

            <label class="switch-label" id="lbl-televisor">
              <input type="checkbox" id="chk-televisor" name="tipos_falla[]" value="televisor" onchange="toggleFalla('televisor')">
              Televisor
            </label>

            <label class="switch-label" id="lbl-sala_audiencia">
              <input type="checkbox" id="chk-sala_audiencia" name="tipos_falla[]" value="sala_audiencia" onchange="toggleFalla('sala_audiencia')">
              Equipos de Sala de Audiencia
            </label>
          </div>

          <!-- Bloques Dinámicos para Observaciones y Evidencias -->
          <div class="falla-details" id="detalles-conectividad">
            <h4>Detalles: Conectividad</h4>
            <div class="row">
              <div class="col-12">
                <label>Observaciones (Describa el problema de red o internet):</label>
                <textarea name="obs_conectividad" class="form-control" placeholder="Ej. No hay conexión a internet desde esta mañana, aparece un ícono amarillo en la red..."></textarea>
              </div>
              <div class="col-12">
                <label>Evidencia (Foto de pantalla, mensaje de error, etc.):</label>
                <div class="file-input-wrapper">
                  <span class="btn-upload">📎 Clic aquí para adjuntar archivo(s)</span>
                  <input type="file" name="evidencia_conectividad[]" multiple accept="image/*,.pdf,.doc,.docx">
                </div>
              </div>
            </div>
          </div>

          <div class="falla-details" id="detalles-computo">
            <h4>Detalles: Equipos de Cómputo</h4>
            <div id="computo-container"></div>
            <button type="button" class="btn-add" onclick="agregarEquipo()">+ Agregar otro equipo</button>
          </div>

          <div class="falla-details" id="detalles-impresoras">
            <h4>Detalles: Impresoras</h4>
            <div id="impresoras-container"></div>
            <button type="button" class="btn-add" onclick="agregarItem('impresoras', 'Ej. Kyocera, HP', 'Ej. La impresora mancha la hoja...')">+ Agregar impresora</button>
          </div>

          <div class="falla-details" id="detalles-escaner">
            <h4>Detalles: Escáner</h4>
            <div id="escaner-container"></div>
            <button type="button" class="btn-add" onclick="agregarItem('escaner', 'Ej. Fujitsu, Kodak', 'Ej. Error de digitalización...')">+ Agregar escáner</button>
          </div>

          <div class="falla-details" id="detalles-telefonia">
            <h4>Detalles: Telefonía IP</h4>
            <div id="telefonia-container"></div>
            <button type="button" class="btn-add" onclick="agregarItem('telefonia', 'Ej. Cisco, Avaya', 'Ej. Sin tono...')">+ Agregar teléfono</button>
          </div>

          <div class="falla-details" id="detalles-ups">
            <h4>Detalles: UPS</h4>
            <div id="ups-container"></div>
            <button type="button" class="btn-add" onclick="agregarItem('ups', 'Ej. APC, Tripp Lite', 'Ej. Alarma constante...')">+ Agregar UPS</button>
          </div>

          <div class="falla-details" id="detalles-televisor">
            <h4>Detalles: Televisor</h4>
            <div id="televisor-container"></div>
            <button type="button" class="btn-add" onclick="agregarItem('televisor', 'Ej. Samsung, LG', 'Ej. No da imagen, líneas en pantalla...')">+ Agregar Televisor</button>
          </div>

          <div class="falla-details" id="detalles-sala_audiencia">
            <h4>Detalles: Equipos de Sala de Audiencia</h4>
            <div id="sala_audiencia-container"></div>
            <button type="button" class="btn-add" onclick="agregarItem('sala_audiencia', 'Ej. Shure, Logitech', 'Ej. Micrófono no funciona, cámara borrosa...')">+ Agregar Equipo de Sala</button>
          </div>

        </fieldset>

        <button type="submit" class="btn-primary corp-btn" id="btn-submit">
            <span id="btn-text">ENVIAR REPORTE DE DAÑOS</span>
            <span id="btn-spinner" style="display:none;">⏳ Procesando (esto puede tardar)...</span>
        </button>

      </form>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
  document.addEventListener("DOMContentLoaded", function() {
      bindFileInputs();
  });

  function mostrarCargando() {
      const btn = document.getElementById('btn-submit');
      const text = document.getElementById('btn-text');
      const spinner = document.getElementById('btn-spinner');
      
      // Mostrar estado de carga
      btn.disabled = true;
      btn.style.opacity = '0.7';
      btn.style.cursor = 'not-allowed';
      text.style.display = 'none';
      spinner.style.display = 'inline-block';

      // Restaurar el botón después de 120 segundos (2 minutos) por si falla la conexión
      setTimeout(() => {
          btn.disabled = false;
          btn.style.opacity = '1';
          btn.style.cursor = 'pointer';
          text.style.display = 'inline-block';
          spinner.style.display = 'none';
          alert('El envío está tomando demasiado tiempo. Es posible que la red esté inestable o que esté subiendo demasiadas imágenes muy pesadas. Puede volver a intentar.');
      }, 120000);
  }

  // Script para manejar la visibilidad dinámica de los detalles de falla
  function toggleFalla(tipo) {
    const checkbox = document.getElementById('chk-' + tipo);
    const label = document.getElementById('lbl-' + tipo);
    const details = document.getElementById('detalles-' + tipo);

    if (checkbox.checked) {
      label.classList.add('active');
      details.classList.add('visible');
      
      // Auto-agregar el primer elemento si la categoría está vacía
      if (tipo !== 'conectividad') {
          const container = document.getElementById(tipo + '-container');
          if (container && container.children.length === 0) {
              if (tipo === 'computo') agregarEquipo();
              else if (tipo === 'impresoras') agregarItem('impresoras', 'Ej. Kyocera, HP', 'Ej. La impresora mancha la hoja...');
              else if (tipo === 'escaner') agregarItem('escaner', 'Ej. Fujitsu, Kodak', 'Ej. Error de digitalización...');
              else if (tipo === 'telefonia') agregarItem('telefonia', 'Ej. Cisco, Avaya', 'Ej. Sin tono...');
              else if (tipo === 'ups') agregarItem('ups', 'Ej. APC, Tripp Lite', 'Ej. Alarma constante...');
              else if (tipo === 'televisor') agregarItem('televisor', 'Ej. Samsung, LG', 'Ej. No da imagen, líneas en pantalla...');
              else if (tipo === 'sala_audiencia') agregarItem('sala_audiencia', 'Ej. Shure, Logitech', 'Ej. Micrófono no funciona, cámara borrosa...');
          }
      }
    } else {
      label.classList.remove('active');
      details.classList.remove('visible');
    }
  }

  // --- LÓGICA DE ELEMENTOS DINÁMICOS ---
  
  let itemCounts = {
      computo: 1,
      impresoras: 1,
      escaner: 1,
      telefonia: 1,
      ups: 1,
      televisor: 1,
      sala_audiencia: 1
  };

  // Búsqueda de empleado por cédula
  document.getElementById('cedula_funcionario').addEventListener('blur', function() {
      const cedula = this.value;
      const nombreInput = document.getElementById('nombre');
      const despachoInput = document.getElementById('despacho');
      const codJuzgadoInput = document.getElementById('codigo_juzgado');
      
      if (cedula.length > 3) {
          nombreInput.placeholder = "Buscando empleado...";
          fetch(`{{ route('reporte.danos.buscar_empleado') }}?cedula=${cedula}`)
              .then(response => response.json())
              .then(data => {
                  if (data.encontrado) {
                      nombreInput.value = data.nombre_completo;
                      nombreInput.classList.add('is-valid');
                      nombreInput.classList.remove('is-invalid');
                      nombreInput.setAttribute('readonly', true);
                      nombreInput.style.backgroundColor = '#f1f5f9';
                      nombreInput.style.cursor = 'not-allowed';
                      
                      // Autocompletar despacho
                      if(data.juzgado) {
                          despachoInput.value = data.juzgado;
                          codJuzgadoInput.value = data.codigo_juzgado;
                      }
                  } else {
                      nombreInput.value = "";
                      nombreInput.placeholder = "No encontrado. Escriba su nombre manualmente...";
                      nombreInput.classList.add('is-invalid');
                      nombreInput.classList.remove('is-valid');
                      nombreInput.removeAttribute('readonly');
                      nombreInput.style.backgroundColor = '#ffffff';
                      nombreInput.style.cursor = 'text';
                      codJuzgadoInput.value = "";
                  }
              })
              .catch(error => {
                  console.error('Error:', error);
                  nombreInput.placeholder = "Error al buscar";
              });
      }
  });

  function agregarEquipo() {
      agregarItem('computo', 'Ej. HP, Dell, Lenovo', 'Ej. El computador no enciende, emite un pitido...');
  }

  function agregarItem(categoria, placeholderMarca, placeholderObs) {
      const container = document.getElementById(`${categoria}-container`);
      const count = itemCounts[categoria];
      const html = `
      <div class="equipo-item" id="item-${categoria}-${count}">
          <button type="button" class="btn-remove" onclick="removerItem('${categoria}', ${count})" title="Eliminar">×</button>
          <div class="row">
              <input type="hidden" name="id_${categoria}[]" value="${count}">
              <div class="col">
                  <label>Marca:</label>
                  <input type="text" name="marca_${categoria}[]" class="form-control" placeholder="${placeholderMarca}">
              </div>
              <div class="col">
                  <label>Placa/Activo Fijo:</label>
                  <input type="text" name="placa_${categoria}[]" class="form-control" placeholder="Ej. 049581">
              </div>
              <div class="col-12">
                  <label>Observaciones:</label>
                  <textarea name="obs_${categoria}_dinamico[]" class="form-control" placeholder="${placeholderObs}"></textarea>
              </div>
              <div class="col-12">
                  <label>Evidencia (Fotos):</label>
                  <div class="file-input-wrapper">
                  <span class="btn-upload">📎 Clic aquí para adjuntar foto(s)</span>
                  <input type="file" name="evidencia_${categoria}_dinamica_${count}[]" multiple accept="image/*,.pdf">
                  </div>
              </div>
          </div>
      </div>`;
      container.insertAdjacentHTML('beforeend', html);
      itemCounts[categoria]++;
      bindFileInputs(); // re-bind para los nuevos inputs
  }

  function removerItem(categoria, id) {
      const item = document.getElementById(`item-${categoria}-${id}`);
      if(item) item.remove();
  }

  // Script para actualizar el texto del botón de adjunto cuando seleccionan archivos
  function bindFileInputs() {
    document.querySelectorAll('input[type="file"]').forEach(input => {
      // Evitar bindear múltiples veces
      input.removeEventListener('change', updateFileText);
      input.addEventListener('change', updateFileText);
    });
  }

  function updateFileText(e) {
      const span = this.previousElementSibling;
      if (this.files && this.files.length > 0) {
        if (this.files.length === 1) {
          span.textContent = '✅ 1 archivo seleccionado: ' + this.files[0].name;
        } else {
          span.textContent = '✅ ' + this.files.length + ' archivos seleccionados';
        }
        span.style.background = '#f0fdf4';
        span.style.borderColor = '#38a169';
        span.style.color = '#38a169';
      } else {
        span.textContent = '📎 Clic aquí para adjuntar foto(s)';
        span.style.background = '#f8fafd';
        span.style.borderColor = '#0088cc';
        span.style.color = '#0088cc';
      }
  }

  // Inicializar listeners al cargar la página
  document.addEventListener('DOMContentLoaded', function() {
      bindFileInputs();
  });
</script>
@endpush

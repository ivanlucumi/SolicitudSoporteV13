<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="keywords" content="Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design, SIRIS CALI, DISAJCALI, siriscali, disajcali, mision, vision, consejo superior de la judicatura, directorio teléfonico disajcali"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>FIRMA ONSITE</title>

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">
  <link rel="shortcut icon" href="{{asset('img/icono.png')}}">
  <link rel="stylesheet" href="/adminlte/bower_components/select2/dist/css/select2.min.css">

  <style>
    *, *::before, *::after { box-sizing: border-box; }

    :root {
      --brand:       #004182;
      --brand-light: #e8f0fb;
      --brand-dark:  #002d5a;
      --accent:      #f59e0b;
      --accent-dark: #d97706;
      --success:     #16a34a;
      --danger:      #dc2626;
      --gray-50:     #f9fafb;
      --gray-100:    #f3f4f6;
      --gray-200:    #e5e7eb;
      --gray-400:    #9ca3af;
      --gray-600:    #4b5563;
      --gray-800:    #1f2937;
      --radius:      12px;
      --shadow-sm:   0 1px 3px rgba(0,0,0,.08);
      --shadow:      0 4px 16px rgba(0,0,0,.10);
      --shadow-lg:   0 8px 32px rgba(0,0,0,.14);
    }

    html { position: relative; min-height: 100%; }
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(145deg, #f0f4ff 0%, #e8f0fb 100%);
      color: var(--gray-800);
      margin: 0;
      padding: 0 0 80px;
      min-height: 100vh;
    }

    /* ── Header ── */
    .page-header {
      background: var(--brand);
      box-shadow: 0 2px 8px rgba(0,65,130,.35);
      padding: 16px 0;
    }
    .page-header img { max-height: 52px; }
    .page-header .header-text {
      color: #fff;
      font-size: .82rem;
      font-weight: 500;
      line-height: 1.4;
      text-align: center;
    }
    .page-header .header-text strong { font-size: .92rem; display: block; }

    /* ── Card ── */
    .main-card {
      background: #fff;
      border-radius: var(--radius);
      box-shadow: var(--shadow);
      overflow: hidden;
      margin-top: 28px;
      margin-bottom: 28px;
    }
    .card-banner {
      background: linear-gradient(90deg, var(--brand) 0%, #0067cc 100%);
      color: #fff;
      padding: 20px 28px;
      text-align: center;
    }
    .card-banner h2 {
      font-size: 1.1rem;
      font-weight: 700;
      letter-spacing: .04em;
      text-transform: uppercase;
      margin: 0 0 4px;
    }
    .card-banner .case-badge {
      display: inline-block;
      background: rgba(255,255,255,.18);
      border: 1px solid rgba(255,255,255,.35);
      border-radius: 20px;
      padding: 4px 16px;
      font-size: .82rem;
      font-weight: 600;
      letter-spacing: .03em;
    }
    .card-body-pad { padding: 28px; }

    /* ── Section title ── */
    .section-label {
      display: flex;
      align-items: center;
      gap: 10px;
      font-weight: 600;
      font-size: .9rem;
      color: var(--brand);
      text-transform: uppercase;
      letter-spacing: .06em;
      margin-bottom: 14px;
    }
    .section-label::after {
      content: '';
      flex: 1;
      height: 1px;
      background: var(--gray-200);
    }

    /* ── Textarea ── */
    textarea.form-control {
      border-radius: 8px;
      border: 1.5px solid var(--gray-200);
      font-size: .9rem;
      resize: vertical;
      min-height: 120px;
      transition: border-color .2s;
    }
    textarea.form-control:focus {
      border-color: var(--brand);
      box-shadow: 0 0 0 3px rgba(0,65,130,.12);
      outline: none;
    }

    /* ── Rating table ── */
    .rating-table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      font-size: .85rem;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: var(--shadow-sm);
    }
    .rating-table thead th {
      background: var(--brand);
      color: #fff;
      padding: 10px 8px;
      text-align: center;
      font-weight: 600;
      font-size: .78rem;
      letter-spacing: .04em;
    }
    .rating-table thead th:first-child { text-align: left; padding-left: 14px; }
    .rating-table tbody tr { transition: background .15s; }
    .rating-table tbody tr:nth-child(odd) { background: var(--gray-50); }
    .rating-table tbody tr:nth-child(even) { background: #fff; }
    .rating-table tbody tr:hover { background: var(--brand-light); }
    .rating-table td, .rating-table th[scope="row"] {
      padding: 10px 8px;
      border-bottom: 1px solid var(--gray-100);
      vertical-align: middle;
      text-align: center;
    }
    .rating-table th[scope="row"]:first-child {
      text-align: left;
      padding-left: 14px;
      font-weight: 500;
      color: var(--gray-800);
    }

    /* Radio star style */
    .star-radio { position: relative; display: inline-flex; }
    .star-radio input[type="radio"] { opacity: 0; position: absolute; width: 0; height: 0; }
    .star-radio label {
      width: 30px;
      height: 30px;
      display: flex;
      align-items: center;
      justify-content: center;
      cursor: pointer;
      font-size: 1.15rem;
      color: var(--gray-300, #d1d5db);
      transition: color .15s, transform .1s;
      user-select: none;
    }
    .star-radio input[type="radio"]:checked + label { color: var(--accent); transform: scale(1.15); }
    .star-radio label:hover { color: var(--accent-dark); }

    /* ── Signature area ── */
    .signature-wrapper {
      border: 2px dashed var(--gray-200);
      border-radius: var(--radius);
      padding: 20px;
      background: var(--gray-50);
      transition: border-color .2s, background .2s;
    }
    .signature-wrapper.has-sig {
      border-color: var(--success);
      background: #f0fdf4;
    }
    .signature-tip {
      font-size: .78rem;
      color: var(--gray-400);
      text-align: center;
      margin-bottom: 10px;
    }
    #draw-canvas {
      display: block;
      width: 100%;
      max-width: 420px;
      height: 200px;
      border-radius: 8px;
      border: 1.5px solid var(--gray-200);
      background: #fff;
      touch-action: none;
      cursor: crosshair;
      margin: 0 auto;
    }
    .signature-wrapper.has-sig #draw-canvas {
      border-color: var(--success);
      opacity: .85;
    }

    .sig-actions {
      display: flex;
      gap: 10px;
      margin-top: 12px;
      justify-content: center;
      flex-wrap: wrap;
    }

    /* ── Buttons ── */
    .btn-save-sig {
      background: var(--brand);
      color: #fff;
      border: none;
      border-radius: 8px;
      padding: 10px 22px;
      font-size: .88rem;
      font-weight: 600;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 8px;
      transition: background .2s, transform .1s, box-shadow .2s;
    }
    .btn-save-sig:hover:not(:disabled) {
      background: var(--brand-dark);
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(0,65,130,.3);
    }
    .btn-save-sig:disabled {
      background: var(--success);
      cursor: default;
      transform: none;
      box-shadow: none;
    }

    .btn-clear-sig {
      background: transparent;
      color: var(--gray-600);
      border: 1.5px solid var(--gray-200);
      border-radius: 8px;
      padding: 10px 18px;
      font-size: .88rem;
      font-weight: 500;
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 6px;
      transition: border-color .2s, color .2s;
    }
    .btn-clear-sig:hover { border-color: var(--danger); color: var(--danger); }

    /* ── Sig status badge ── */
    .sig-status {
      display: none;
      align-items: center;
      gap: 8px;
      font-size: .82rem;
      font-weight: 600;
      color: var(--success);
      margin-top: 10px;
      justify-content: center;
    }
    .sig-status.visible { display: flex; }
    .sig-status svg { flex-shrink: 0; }

    /* ── Footer ── */
    footer {
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
      background: var(--brand);
      color: rgba(255,255,255,.75);
      font-size: .72rem;
      text-align: center;
      padding: 8px;
      z-index: 100;
    }

    /* ── Responsive ── */
    @media (max-width: 576px) {
      .card-body-pad { padding: 16px; }
      .card-banner { padding: 16px; }
      .card-banner h2 { font-size: .95rem; }
      #draw-canvas { height: 160px; }
      .rating-table { font-size: .78rem; }
      .rating-table th[scope="row"]:first-child { font-size: .75rem; }
    }
  </style>

  @stack('style')
</head>

<body>

  <!-- Header -->
  <header class="page-header">
    <div class="container">
      <div class="row align-items-center g-2">
        <div class="col-5 col-md-3">
          <img src="/img/logoLargo.png" class="img-fluid" alt="Logo Judicatura">
        </div>
        <div class="col-7 col-md-9">
          <div class="header-text">
            <strong>Consejo Superior de la Judicatura</strong>
            Dirección Ejecutiva Seccional de Administración Judicial
          </div>
        </div>
      </div>
    </div>
  </header>

  <main class="container" style="max-width:860px;">

    @include('alerts.flash-message')
    @include('../alerts.success')
    @include('../alerts.request')
    @include('alerts.errors')

    <div class="main-card">

      <!-- Banner -->
      <div class="card-banner">
        <h2>Firma Reporte de Diagnóstico Onsite</h2>
        <span class="case-badge">Caso N° <strong>{{$soporte->num_caso}}</strong></span>
      </div>

      <div class="card-body-pad">
        <form id="firmaForm" action="{{ route('firma.firma.servicio.publico',$soporte->id) }}" method="POST">
          @csrf
          @method('PUT')

          <!-- ── Observación ── -->
          <div class="section-label">Observación del cliente</div>
          <p style="font-size:.84rem; color:var(--gray-600); margin-bottom:14px;">
            Por favor, seleccione la calificación para cada aspecto del servicio: 1 mínima — 5 máxima.
          </p>

          <div class="row g-3 mb-4">
            <div class="col-12 col-md-5">
              <label class="form-label" for="observacion_cliente" style="font-weight:500; font-size:.87rem;">Comentarios adicionales</label>
              <textarea id="observacion_cliente"
                class="form-control @error('observacion_cliente') is-invalid @enderror"
                placeholder="Escriba aquí sus observaciones sobre el servicio recibido…"
                name="observacion_cliente"
                rows="5">{{ old('observacion_cliente', $soporte->observacion_cliente ?? '') }}</textarea>
              @error('observacion_cliente')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="col-12 col-md-7">
              <label class="form-label" style="font-weight:500; font-size:.87rem;">Calificación del servicio</label>
              <div class="table-responsive">
                <table class="rating-table">
                  <thead>
                    <tr>
                      <th style="min-width:160px;">Aspecto evaluado</th>
                      <th>1</th><th>2</th><th>3</th><th>4</th><th>5</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row">Disposición para atención del ingeniero</th>
                      @for($i=1;$i<=5;$i++)
                      <td>
                        <div class="star-radio">
                          <input class="form-check-input" type="radio" name="disposicion" id="disposicion_{{$i}}" value="{{$i}}">
                          <label for="disposicion_{{$i}}" title="{{$i}}">★</label>
                        </div>
                      </td>
                      @endfor
                    </tr>
                    <tr>
                      <th scope="row">Conocimiento técnico del ingeniero</th>
                      @for($i=1;$i<=5;$i++)
                      <td>
                        <div class="star-radio">
                          <input class="form-check-input" type="radio" name="conocimiento_tec" id="conocimiento_tec_{{$i}}" value="{{$i}}">
                          <label for="conocimiento_tec_{{$i}}" title="{{$i}}">★</label>
                        </div>
                      </td>
                      @endfor
                    </tr>
                    <tr>
                      <th scope="row">Tiempo de atención y solución</th>
                      @for($i=1;$i<=5;$i++)
                      <td>
                        <div class="star-radio">
                          <input class="form-check-input" type="radio" name="tiempo_aten" id="tiempo_aten_{{$i}}" value="{{$i}}">
                          <label for="tiempo_aten_{{$i}}" title="{{$i}}">★</label>
                        </div>
                      </td>
                      @endfor
                    </tr>
                    <tr>
                      <th scope="row">Información del avance del caso</th>
                      @for($i=1;$i<=5;$i++)
                      <td>
                        <div class="star-radio">
                          <input class="form-check-input" type="radio" name="avance_caso" id="avance_caso_{{$i}}" value="{{$i}}">
                          <label for="avance_caso_{{$i}}" title="{{$i}}">★</label>
                        </div>
                      </td>
                      @endfor
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <hr style="border-color:var(--gray-200); margin:28px 0;">

          <!-- ── Firma ── -->
          <div class="section-label">Firma de aceptación</div>

          <div class="row g-4 align-items-start">
            <div class="col-12 col-md-7">
              <div class="signature-wrapper" id="sig-wrapper">
                <p class="signature-tip">✏️ Firme en el recuadro — funciona con dedo o mouse</p>
                <canvas id="draw-canvas" width="840" height="400">Su navegador no soporta canvas.</canvas>
                <div class="sig-actions">
                  <button type="button" id="draw-submitBtn" class="btn-save-sig">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                    Guardar firma y enviar
                  </button>
                  <button type="button" id="draw-clearBtn" class="btn-clear-sig">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="1 4 1 10 7 10"/><path d="M3.51 15a9 9 0 1 0 .49-3.6"/></svg>
                    Volver a firmar
                  </button>
                </div>
                <div class="sig-status" id="sig-status">
                  <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
                  Firma guardada correctamente
                </div>
              </div>
            </div>

            <div class="col-12 col-md-5 d-flex align-items-center justify-content-center" style="min-height:240px;">
              <div style="text-align:center;">
                <p style="font-size:.85rem; color:var(--gray-600); margin-bottom:16px; line-height:1.5;">
                  Al guardar su firma, se le pedirá confirmación antes de enviar el documento. Una vez enviado <strong>no podrá modificarlo</strong>.
                </p>
                <div style="background:var(--brand-light); border-radius:10px; padding:18px; font-size:.8rem; color:var(--brand); font-weight:500;">
                  <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:6px;"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                  <br>
                  Recuerde completar la calificación del servicio antes de firmar.
                </div>
              </div>
            </div>
          </div>

          <input type="hidden" name="firma" id="imagen" value="" required>

        </form>
      </div><!-- /card-body-pad -->
    </div><!-- /main-card -->
  </main>

  <footer>Consejo Superior de la Judicatura &mdash; Sistema de Gestión de Soporte Onsite</footer>

  <script src="js/jquery-3.2.1.min.js"></script>
  <script src="adminlte/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="adminlte/bower_components/select2/dist/js/select2.full.min.js"></script>

  <script>
  /* ─────────────────────────────────────────
     Canvas de firma — compatibilidad completa
     mouse + touch, desktop + mobile
  ───────────────────────────────────────── */
  (function () {
    var canvas    = document.getElementById('draw-canvas');
    var ctx       = canvas.getContext('2d');
    var wrapper   = document.getElementById('sig-wrapper');
    var clearBtn  = document.getElementById('draw-clearBtn');
    var submitBtn = document.getElementById('draw-submitBtn');
    var sigStatus = document.getElementById('sig-status');
    var imagenInput = document.getElementById('imagen');

    var drawing  = false;
    var lastPos  = { x: 0, y: 0 };
    var mousePos = { x: 0, y: 0 };

    // ── RAF loop ──
    window.requestAnimFrame = (function () {
      return window.requestAnimationFrame ||
             window.webkitRequestAnimationFrame ||
             window.mozRequestAnimationFrame ||
             function (cb) { window.setTimeout(cb, 1000 / 60); };
    })();

    function getPos(canvasDom, clientX, clientY) {
      var rect = canvasDom.getBoundingClientRect();
      var scaleX = canvasDom.width  / rect.width;
      var scaleY = canvasDom.height / rect.height;
      return {
        x: (clientX - rect.left) * scaleX,
        y: (clientY - rect.top)  * scaleY
      };
    }

    // Mouse
    canvas.addEventListener('mousedown', function (e) {
      drawing = true;
      lastPos = getPos(canvas, e.clientX, e.clientY);
    });
    canvas.addEventListener('mouseup',   function () { drawing = false; });
    canvas.addEventListener('mouseleave',function () { drawing = false; });
    canvas.addEventListener('mousemove', function (e) {
      mousePos = getPos(canvas, e.clientX, e.clientY);
    });

    // Touch
    canvas.addEventListener('touchstart', function (e) {
      e.preventDefault();
      var t = e.touches[0];
      drawing = true;
      lastPos = getPos(canvas, t.clientX, t.clientY);
      mousePos = lastPos;
    }, { passive: false });

    canvas.addEventListener('touchend', function (e) {
      e.preventDefault();
      drawing = false;
    }, { passive: false });

    canvas.addEventListener('touchcancel', function (e) {
      e.preventDefault();
      drawing = false;
    }, { passive: false });

    canvas.addEventListener('touchmove', function (e) {
      e.preventDefault();
      var t = e.touches[0];
      mousePos = getPos(canvas, t.clientX, t.clientY);
    }, { passive: false });

    // Draw
    function renderCanvas() {
      if (drawing) {
        ctx.strokeStyle = '#111';
        ctx.lineWidth   = 2.5;
        ctx.lineCap     = 'round';
        ctx.lineJoin    = 'round';
        ctx.beginPath();
        ctx.moveTo(lastPos.x, lastPos.y);
        ctx.lineTo(mousePos.x, mousePos.y);
        ctx.stroke();
        ctx.closePath();
        lastPos = mousePos;
      }
    }

    function clearCanvas() {
      ctx.clearRect(0, 0, canvas.width, canvas.height);
    }

    function isCanvasBlank() {
      var blank = document.createElement('canvas');
      blank.width  = canvas.width;
      blank.height = canvas.height;
      return canvas.toDataURL() === blank.toDataURL();
    }

    (function loop() {
      requestAnimFrame(loop);
      renderCanvas();
    })();

    // ── Limpiar firma ──
    clearBtn.addEventListener('click', function () {
      clearCanvas();
      imagenInput.value = '';
      wrapper.classList.remove('has-sig');
      sigStatus.classList.remove('visible');
      submitBtn.disabled = false;
      submitBtn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg> Guardar firma y enviar';
      submitBtn.style.background = '';
    });

    // ── Guardar firma → confirmar → enviar ──
    submitBtn.addEventListener('click', function () {
      if (isCanvasBlank()) {
        Swal.fire({
          title: 'Firma vacía',
          text: 'Por favor realice su firma en el recuadro antes de continuar.',
          icon: 'warning',
          confirmButtonText: 'Entendido',
          confirmButtonColor: '#004182'
        });
        return;
      }

      // Validar calificaciones
      var disposicion    = document.querySelector('input[name="disposicion"]:checked');
      var conocimiento   = document.querySelector('input[name="conocimiento_tec"]:checked');
      var tiempo         = document.querySelector('input[name="tiempo_aten"]:checked');
      var avance         = document.querySelector('input[name="avance_caso"]:checked');

      if (!disposicion || !conocimiento || !tiempo || !avance) {
        Swal.fire({
          title: 'Calificación incompleta',
          text: 'Debe calificar todos los aspectos del servicio antes de enviar.',
          icon: 'warning',
          confirmButtonText: 'Entendido',
          confirmButtonColor: '#004182'
        });
        return;
      }

      // Guardar imagen en el input oculto
      imagenInput.value = canvas.toDataURL();
      wrapper.classList.add('has-sig');
      sigStatus.classList.add('visible');

      // Mostrar confirmación y enviar
      Swal.fire({
        title: '¿Está seguro?',
        html: 'Una vez enviado, <strong>no podrá modificar</strong> su firma ni calificación.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#004182',
        cancelButtonColor:  '#dc2626',
        confirmButtonText:  'Sí, enviar documento',
        cancelButtonText:   'Cancelar'
      }).then(function (result) {
        if (result.isConfirmed) {
          submitBtn.disabled = true;
          submitBtn.innerHTML = '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg> Enviando…';
          document.getElementById('firmaForm').submit();
        } else {
          // Si cancela, limpiar para re-firmar
          imagenInput.value = '';
          wrapper.classList.remove('has-sig');
          sigStatus.classList.remove('visible');
        }
      });
    });

  })();

  /* ─────────────────────────────────────────
     Verificar si ya está firmado al cargar
  ───────────────────────────────────────── */
  document.addEventListener('DOMContentLoaded', function () {
    @if($soporte->firma_cliente)
      var submitBtn = document.getElementById('draw-submitBtn');
      submitBtn.disabled = true;
      submitBtn.innerHTML = '✔ Documento ya firmado';
      submitBtn.style.background = '#6b7280';

      Swal.fire({
        title: 'Documento ya firmado',
        text: 'Este documento ya ha sido firmado anteriormente y no puede modificarse.',
        icon: 'info',
        confirmButtonText: 'Entendido',
        confirmButtonColor: '#004182'
      });
    @endif
  });
  </script>

  @stack('scripts')
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, minimal-ui">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Mi Carnet">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="apple-touch-icon" href="{{ asset('Logo/Siris.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('Logo/Siris.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('Logo/Siris.png') }}">
    <link rel="apple-touch-icon" sizes="167x167" href="{{ asset('Logo/Siris.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('Logo/Siris.png') }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('Logo/Siris.png') }}">
    <link rel="shortcut icon" href="{{ asset('Logo/Siris.png') }}">
    <meta name="theme-color" content="#003f74">
    <title>Carnet Digital | {{ strtoupper($empleado->nameE . ' ' . $empleado->lastnameE) }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: #f1f5f9;
        }

        /* ─── HEADER ─── */
        .site-header {
            background: #003f74;
            padding: 12px 28px;
            display: flex;
            align-items: center;
            gap: 14px;
            box-shadow: 0 2px 10px rgba(0,0,0,.25);
            position: sticky;
            top: 0;
            z-index: 50;
        }
        .site-header img {
            height: 42px;
            width: auto;
            filter: brightness(0) invert(1);
        }
        .site-header .ht strong {
            display: block;
            color: #fff;
            font-size: .92rem;
            font-weight: 700;
            line-height: 1.25;
        }
        .site-header .ht span {
            color: rgba(255,255,255,.78);
            font-size: .76rem;
        }

        /* ─── HERO (Fondo verde arriba) ─── */
        .hero {
            background: linear-gradient(135deg, #003f74 0%, #00569d 55%, #0072bc 100%);
            padding: 48px 16px 90px;
            text-align: center;
            color: #fff;
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
        }
        .hero h1 {
            font-size: 1.6rem;
            font-weight: 800;
            margin-bottom: 6px;
        }
        .hero p {
            font-size: .92rem;
            opacity: .85;
        }

        /* ─── CONTENIDO ─── */
        .main-content {
            flex: 1;
            background: #f8fafc;
            margin-top: -64px;
            padding-bottom: 60px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* ─── CARNET GLASSMORPHISM ─── */
        .carnet {
            width: 350px;
            max-width: 90%;
            /* Efecto Glassmorphism */
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            padding: 20px;
            border-radius: 20px;
            text-align: center;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1), inset 0 0 0 1px rgba(255,255,255,0.2);
            position: relative;
            transition: transform .3s ease, box-shadow .3s ease;
            user-select: none;
            cursor: pointer;
            margin-bottom: 30px;
            overflow: hidden;
        }
        .carnet::before {
            content: "";
            position: absolute;
            top: -50px; left: -50px;
            width: 150px; height: 150px;
            background: rgba(0, 123, 255, 0.1);
            filter: blur(40px);
            border-radius: 50%;
            z-index: 0;
            pointer-events: none;
        }
        .carnet:hover {
            transform: scale(1.02) translateY(-5px);
            box-shadow: 0 20px 45px rgba(0,0,0,0.15);
        }

        /* Watermark animado */
        .watermark {
            position: absolute;
            inset: 0;
            background-image: url('https://www.disajcali.gov.co/img/logoLargo.png');
            background-repeat: repeat;
            background-size: 30px;
            opacity: .05;
            pointer-events: none;
            border-radius: 20px;
            animation: wm-move 20s linear infinite;
        }
        @keyframes wm-move {
            0%   { background-position: 0 0; }
            100% { background-position: 100px 100px; }
        }

        /* Holograma */
        .hologram {
            position: absolute;
            top: 15px; right: 15px;
            width: 40px; height: 40px;
            background: radial-gradient(circle, rgba(0,123,255,.3), transparent);
            border-radius: 50%;
            opacity: .6;
            animation: holo 2.5s ease-in-out infinite;
        }
        @keyframes holo {
            0%, 100% { transform: scale(1);   opacity: .4; }
            50%       { transform: scale(1.3); opacity: .7; }
        }

        .carnet-logo {
            width: 80%;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
        }
        .foto-container {
            position: relative;
            display: inline-block;
            margin-bottom: 15px;
            z-index: 1;
        }
        .foto {
            width: 160px; height: 160px;
            border-radius: 50%;
            object-fit: cover;
            object-position: top center;
            border: 4px solid rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 15px rgba(0,0,0,.15);
            background: #fff;
            margin: 0 auto;
            display: block;
        }
        .avatar-initials {
            width: 160px; height: 160px;
            border-radius: 50%;
            background: #003f74; color: white;
            display: flex; align-items: center; justify-content: center;
            font-size: 50px; font-weight: bold;
            border: 4px solid rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 15px rgba(0,0,0,.15);
            margin: 0 auto;
        }
        .status-badge {
            position: absolute;
            bottom: 8px;
            right: 8px;
            background: #16a34a;
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 3px solid #fff;
            font-size: 12px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            z-index: 2;
        }
        .emp-name {
            font-size: 1.15rem;
            font-weight: 800;
            color: #1a1a2e;
            margin: 10px 0 6px;
            position: relative;
            z-index: 1;
            line-height: 1.2;
        }
        .dato {
            font-size: .92rem;
            color: #334155;
            margin: 4px 0;
            position: relative;
            z-index: 1;
        }
        .dato strong { color: #0f172a; font-weight: 700; }

        .barcode {
            display: flex;
            justify-content: center;
            margin-top: 20px;
            position: relative;
            z-index: 1;
            background: white;
            padding: 5px;
            border-radius: 8px;
            width: 170px;
            margin-left: auto;
            margin-right: auto;
        }
        .barcode img { width: 160px; height: 50px; }

        .footer-carnet {
            background: linear-gradient(135deg, #003f74 0%, #0072bc 100%);
            color: #fff;
            padding: 10px;
            font-weight: 700;
            border-radius: 12px;
            margin-top: 15px;
            font-size: 11px;
            line-height: 1.4;
            position: relative;
            z-index: 1;
        }

        /* ─── ACCIONES ─── */
        .acciones {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            justify-content: center;
            margin-top: 10px;
            padding: 0 15px;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            border-radius: 12px;
            font-size: .9rem;
            font-weight: 700;
            cursor: pointer;
            text-decoration: none;
            border: none;
            transition: all .2s;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .btn-pwa { background: #003f74; color: white; width: 100%; justify-content: center; font-size: 1rem; padding: 14px;}
        .btn-pwa:hover { background: #004d43; }

        @keyframes pulseRed {
            0% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(239, 68, 68, 0); }
            100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
        }
        .btn-print { background: #3b82f6; color: white; }
        .btn-back { background: white; color: #475569; border: 2px solid #e2e8f0; }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 6px 12px rgba(0,0,0,0.15); }

        /* ─── MODAL ─── */
        .modal {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 1000;
            background: rgba(15, 23, 42, 0.75);
            backdrop-filter: blur(4px);
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .modal-content {
            background: #fff;
            padding: 30px;
            border-radius: 24px;
            width: 100%;
            max-width: 400px;
            text-align: center;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            animation: modalIn .3s cubic-bezier(0.34, 1.56, 0.64, 1);
        }
        @keyframes modalIn {
            from { opacity: 0; transform: scale(0.9) translateY(20px); }
            to { opacity: 1; transform: scale(1) translateY(0); }
        }
        .modal-header {
            margin-bottom: 20px;
        }
        .modal-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }
        .status-ok { color: #059669; }
        .status-nok { color: #dc2626; }
        
        .modal h3 { font-size: 1.5rem; font-weight: 800; color: #1e293b; margin-bottom: 15px; }
        .modal-info { text-align: left; background: #f8fafc; padding: 20px; border-radius: 16px; margin-bottom: 20px; }
        .modal-info p { font-size: 0.95rem; margin-bottom: 8px; color: #475569; border-bottom: 1px solid #e2e8f0; padding-bottom: 6px; }
        .modal-info p:last-child { border-bottom: none; }
        .modal-info strong { color: #0f172a; font-weight: 600; width: 100px; display: inline-block; }

        .btn-close {
            width: 100%;
            padding: 14px;
            background: #1e293b;
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
        }

        /* Loading */
        .loading-spinner {
            display: none;
            font-size: 24px;
            color: #fff;
            margin-bottom: 10px;
        }

        @keyframes secure-check-spin {
            0% { transform: perspective(400px) rotateY(0deg); color: #4ade80; } /* verde claro */
            50% { transform: perspective(400px) rotateY(180deg); color: #064e3b; } /* verde oscuro */
            100% { transform: perspective(400px) rotateY(360deg); color: #4ade80; }
        }
        .secure-check-spin {
            animation: secure-check-spin 2.5s infinite linear;
            display: inline-block;
        }

        @media print {
            .site-header, .hero, .acciones, .site-header, .btn-close { display: none !important; }
            body, .main-content { background: #fff !important; margin: 0; padding: 0; }
            .carnet { margin: 0; box-shadow: none; border: 1px solid #eee; }
            .main-content { margin-top: 0; }
        }
    </style>
</head>
<body oncontextmenu="return false;">

    <header class="site-header">
        <img src="https://www.disajcali.gov.co/img/logoLargo.png" alt="DISAJ">
        <div class="ht">
            <strong>Dirección Seccional de Administración Judicial</strong>
            <span>Cali – Valle del Cauca</span>
        </div>
    </header>

    <div class="hero">
        <h1>Carnet Digital Generado</h1>
        <p>Tu carnet está listo. Guárdalo en tu dispositivo para acceso rápido u offline.</p>
    </div>

    <main class="main-content">
        <div class="carnet" id="carnetCanvas" onclick="validateIdentity()" title="Haz clic para validar">
            <div class="watermark"></div>
            <div class="hologram"></div>

            <img class="carnet-logo" src="https://www.disajcali.gov.co/img/logoLargo.png" alt="Logo">

            <div class="foto-container">
                <img class="foto" id="imgFoto"
                     src="https://www.disajcali.gov.co/img/carnet/{{ $empleado->foto }}" 
                     alt="Foto"
                     onerror="showInitials(this)">
                @if($empleado->estaActivo())
                    <span class="status-badge"><i class="fa-solid fa-check"></i></span>
                @else
                    <span class="status-badge" style="background:#dc2626;"><i class="fa-solid fa-xmark"></i></span>
                @endif
            </div>

            <h2 class="emp-name">{{ strtoupper($empleado->nameE) }} {{ strtoupper($empleado->lastnameE) }}</h2>

            <p class="dato"><strong>Cédula:</strong> {{ $empleado->cedulaE }}</p>
            <p class="dato"><strong>Cargo:</strong> {{ strtoupper($empleado->cargo_titular ?? $empleado->clase_nombramiento ?? 'EMPLEADO JUDICIAL') }}</p>
            
            @if(!empty($empleado->observacion))
                <p class="dato"><strong>Obs:</strong> {{ $empleado->observacion }}</p>
            @endif

            <div class="barcode">
                @php
                    $barcodeUrl = "https://barcode.tec-it.com/barcode.ashx?data={$empleado->cedulaE}&code=Code128";
                @endphp
                <img src="{{ $barcodeUrl }}" alt="Código de Barras">
            </div>

            <div class="footer-carnet">
                DIRECCIÓN SECCIONAL DE ADMINISTRACIÓN JUDICIAL<br>
                CALI, VALLE DEL CAUCA
            </div>
        </div>

        <div class="acciones">
            @if(empty($empleado->dispositivo_id))
                <button class="btn btn-pwa" id="btnSaveToPhone" onclick="saveToPhone()" style="background-color: #ef4444 !important; font-weight: 900; letter-spacing: 0.5px; border: 2px solid #b91c1c; box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4); animation: pulseRed 2s infinite;">
                    <i class="fa-solid fa-triangle-exclamation"></i> OBLIGATORIO: GUARDAR CARNET EN MÓVIL
                </button>
            @else
                <div style="background-color: #fffbeb; border: 1px solid #f59e0b; padding: 15px; border-radius: 12px; width: 100%; margin-bottom: 15px; color: #b45309; text-align: left; font-size: 0.9rem;">
                    <i class="fa-solid fa-triangle-exclamation"></i> <strong>Instalación Protegida:</strong> Este carnet ya se encuentra instalado. Comunícate con Sistemas (DISAJ) si necesitas generar uno nuevo.
                </div>
            @endif
            
            <a href="{{ route('carnet.consulta') }}" class="btn btn-back">
                <i class="fa-solid fa-arrow-left"></i> Otra consulta
            </a>
        </div>
    </main>

    <!-- Modal de Validación en Tiempo Real -->
    <div id="validationModal" class="modal">
        <div class="modal-content" id="modalContent">
            <div class="loading-state" id="loadingState">
                <img id="modalSpinPhoto" src="" class="fa-spin" style="width: 90px; height: 90px; border-radius: 50%; object-fit: cover; border: 4px solid #059669; display: none; margin: 0 auto; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                <div id="modalSpinInitials" class="fa-spin" style="width: 90px; height: 90px; border-radius: 50%; background: #003f74; color: white; display: none; align-items: center; justify-content: center; font-size: 36px; font-weight: bold; border: 4px solid #00569d; margin: 0 auto; box-shadow: 0 4px 10px rgba(0,0,0,0.1);"></div>
                <i class="fa-solid fa-circle-notch fa-spin status-ok" id="loadingIconFallback" style="font-size: 50px;"></i>
                <h3 style="margin-top:20px;">Validando Identidad...</h3>
            </div>
            
            <div id="resultState" style="display:none;">
                <div class="modal-icon" id="modalIcon"></div>
                <h3 id="modalTitle">Estado del Carnet</h3>
                
                <div class="modal-info">
                    <p><strong>Empleado:</strong> <span id="valNombre"></span></p>
                    <p><strong>Cédula:</strong> <span id="valCedula"></span></p>
                    <p><strong>Vigencia:</strong> <span id="valVigencia"></span></p>
                    <p><strong>Observación:</strong> <span id="valObs"></span></p>
                </div>
                
                <div id="finalMessage" style="font-weight: 800; margin-bottom: 25px; padding: 15px; border-radius: 12px;"></div>
                
                <button class="btn-close" id="btnCloseModal" onclick="closeModal()">Entendido</button>
            </div>
        </div>
    </div>

    <!-- Modal Instrucciones de Instalación iOS/Android -->
    <div id="installGuideModal" class="modal">
        <div class="modal-content" style="text-align:center;">
            <i class="fa-solid fa-arrow-up-from-bracket" style="font-size: 40px; color: #3b82f6; margin-bottom:15px;"></i>
            <h3 style="font-size:1.3rem; margin-bottom: 10px;">Instala tu Carnet</h3>
            <p style="font-size:0.95rem; color:#475569; margin-bottom:20px; text-align:left;">
                Para que funcione como una App independiente y disponible sin internet, debes añadirla a la pantalla de inicio:
                <br><br>
                <strong>📱 En iPhone (Chrome):</strong> Toca el ícono de "Compartir" en la parte superior y luego selecciona <strong>"Agregar a Inicio"</strong>.
                <br><br>
                <strong>🤖 En Android (Chrome):</strong> Toca los tres puntos (menú superior derecho) y selecciona <strong>"Agregar a la pantalla principal"</strong> o "Instalar aplicación".
            </p>
            <p style="font-size:0.85rem; color:#dc2626; margin-bottom:20px;"><em>* Si estás probando en una red no segura (sin HTTPS), esta es la única forma de instalarlo.</em></p>
            <button class="btn btn-pwa" onclick="window.location.href='/mi-carnet?token={{ $empleado->carnet_token }}" style="width:100%; justify-content:center;">
                <i class="fa-solid fa-check"></i> Entendido, ir a Mi Carnet
            </button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Registrar Service Worker para la PWA
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register("{{ asset('sw.js') }}").then(reg => {
                    console.log('SW Registrado', reg);
                }).catch(err => console.log('Error registro SW', err));
            });
        }

        function showInitials(imgObj) {
            imgObj.style.display = 'none';
            if (!document.getElementById('css_initials')) {
                const initDiv = document.createElement('div');
                initDiv.id = 'css_initials';
                initDiv.className = 'avatar-initials';
                initDiv.innerText = '{{ substr($empleado->nameE, 0, 1) }}{{ substr($empleado->lastnameE, 0, 1) }}';
                imgObj.parentElement.insertBefore(initDiv, imgObj.parentElement.firstChild);
            }
        }

        let deferredPrompt;
        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
        });

        function saveToPhone() {
            // Guardar datos en LocalStorage
            const carnetData = {
                nombre: "{{ strtoupper($empleado->nameE) }} {{ strtoupper($empleado->lastnameE) }}",
                iniciales: "{{ substr($empleado->nameE, 0, 1) }}{{ substr($empleado->lastnameE, 0, 1) }}",
                cedula: "{{ $empleado->cedulaE }}",
                cargo: "{{ strtoupper($empleado->cargo_titular ?? $empleado->clase_nombramiento ?? 'EMPLEADO JUDICIAL') }}",
                foto: document.getElementById('imgFoto').src,
                observacion: "{{ $empleado->observacion }}",
                esActivo: {{ $empleado->estaActivo() ? 'true' : 'false' }}
            };
            
            localStorage.setItem('carnet_pwa_data', JSON.stringify(carnetData));
            
            // REDIRIGIR INMEDIATAMENTE AL HUB OFFLINE PARA QUE EL "AGREGAR A INICIO" APUNTE A /MI-CARNET (evitando historial)
            window.location.replace("{{ route('carnet.pwa') }}?token={{ $empleado->carnet_token }}&install=1");
        }

        // Validación estricta con servidor
        function validateIdentity() {
            const modal = document.getElementById('validationModal');
            const loading = document.getElementById('loadingState');
            const result = document.getElementById('resultState');
            const cedula = '{{ $empleado->cedulaE }}';

            // Configurar la foto o iniciales girando
            const imgFoto = document.getElementById('imgFoto');
            const cssInitials = document.getElementById('css_initials');
            
            if (imgFoto && window.getComputedStyle(imgFoto).display !== 'none') {
                document.getElementById('modalSpinPhoto').src = imgFoto.src;
                document.getElementById('modalSpinPhoto').style.display = 'block';
                document.getElementById('modalSpinInitials').style.display = 'none';
                document.getElementById('loadingIconFallback').style.display = 'none';
            } else if (cssInitials) {
                document.getElementById('modalSpinInitials').innerText = cssInitials.innerText;
                document.getElementById('modalSpinInitials').style.display = 'flex';
                document.getElementById('modalSpinPhoto').style.display = 'none';
                document.getElementById('loadingIconFallback').style.display = 'none';
            }

            modal.style.display = 'flex';
            loading.style.display = 'block';
            result.style.display = 'none';

            // Consultar a la API en tiempo real
            $.ajax({
                url: '{{ route("api.carnet.validar") }}',
                method: 'GET',
                data: { cedula: cedula },
                success: function(response) {
                    loading.style.display = 'none';
                    result.style.display = 'block';

                    document.getElementById('valNombre').innerText = response.nombre;
                    document.getElementById('valCedula').innerText = response.cedula;
                    document.getElementById('valVigencia').innerText = response.vigencia;
                    document.getElementById('valObs').innerText = response.observacion || 'Ninguna';

                    const iconDiv = document.getElementById('modalIcon');
                    const titleH = document.getElementById('modalTitle');
                    const msgDiv = document.getElementById('finalMessage');

                    if (response.activo) {
                        iconDiv.innerHTML = '<i class="fa-solid fa-circle-check status-ok secure-check-spin"></i>';
                        titleH.innerText = 'Carnet Válido';
                        msgDiv.innerText = '✅ IDENTIDAD VERIFICADA Y ACTIVA';
                        msgDiv.style.background = '#ecfdf5';
                        msgDiv.style.color = '#065f46';
                    } else {
                        iconDiv.innerHTML = '<i class="fa-solid fa-circle-xmark status-nok"></i>';
                        titleH.innerText = 'Carnet Inválido';
                        msgDiv.innerText = '❌ ESTADO: INACTIVO / VENCIDO';
                        msgDiv.style.background = '#fef2f2';
                        msgDiv.style.color = '#991b1b';
                        
                        // Eliminar datos locales para que no se siga mostrando
                        localStorage.removeItem('carnet_pwa_data');
                        
                        // Cambiar comportamiento del botón de cierre para forzar salida
                        document.getElementById('btnCloseModal').onclick = function() {
                            alert("Este carnet se encuentra inactivo y ha sido revocado del dispositivo.");
                            window.location.href = "{{ route('carnet.consulta') }}";
                        };
                    }
                },
                error: function() {
                    alert('MODO OFFLINE: No se pudo verificar con el servidor en este momento. Se muestra la última validación guardada.');
                    closeModal();
                }
            });
        }

        function closeModal() {
            document.getElementById('validationModal').style.display = 'none';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('validationModal');
            if (event.target === modal) closeModal();
        };

        // --- PROTECCIÓN DE SEGURIDAD ---
        document.addEventListener('keydown', function(e) {
            // F12
            if (e.keyCode === 123) {
                e.preventDefault();
                return false;
            }
            // Ctrl+Shift+I / J / C
            if (e.ctrlKey && e.shiftKey && (e.keyCode === 73 || e.keyCode === 74 || e.keyCode === 67)) {
                e.preventDefault();
                return false;
            }
            // Ctrl+U (Ver código fuente)
            if (e.ctrlKey && e.keyCode === 85) {
                e.preventDefault();
                return false;
            }
            // Print Screen (Imprimir Pantalla en PC)
            if (e.keyCode === 44) {
                e.preventDefault();
                navigator.clipboard.writeText('');
                alert("La captura de pantalla está deshabilitada por seguridad.");
                return false;
            }
        });

        // Evitar Copiar
        document.addEventListener('copy', function(e) {
            e.preventDefault();
            return false;
        });

        // Ocultar contenido al perder el foco (mitigar capturas en segundo plano)
        document.addEventListener('visibilitychange', function() {
            if (document.hidden) {
                document.body.style.opacity = '0';
            } else {
                document.body.style.opacity = '1';
            }
        });
    </script>
</body>
</html>

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
    <title>Mi Carnet</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @keyframes pulseRed {
            0% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7); }
            70% { box-shadow: 0 0 0 10px rgba(239, 68, 68, 0); }
            100% { box-shadow: 0 0 0 0 rgba(239, 68, 68, 0); }
        }

        /* Mismos estilos base que carnet_resultado */
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            background: #f1f5f9;
        }

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

        .hero {
            background: linear-gradient(135deg, #003f74 0%, #00569d 55%, #0072bc 100%);
            padding: 48px 16px 90px;
            text-align: center;
            color: #fff;
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
        }
        .hero h1 { font-size: 1.6rem; font-weight: 800; margin-bottom: 6px; }
        .hero p { font-size: .92rem; opacity: .85; }

        .main-content {
            flex: 1;
            background: #f8fafc;
            margin-top: -64px;
            padding-bottom: 60px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* CARNET GLASSMORPHISM */
        .carnet {
            width: 350px;
            max-width: 90%;
            background: rgba(255, 255, 255, 0.85);
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
            display: none; /* Oculto por defecto hasta cargar js */
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
        
        .watermark {
            position: absolute; inset: 0;
            background-image: url('https://www.disajcali.gov.co/img/logoLargo.png');
            background-repeat: repeat; background-size: 30px;
            opacity: .05; pointer-events: none; border-radius: 20px;
            animation: wm-move 20s linear infinite;
        }
        @keyframes wm-move { 0% { background-position: 0 0; } 100% { background-position: 100px 100px; } }

        .hologram {
            position: absolute; top: 15px; right: 15px; width: 40px; height: 40px;
            background: radial-gradient(circle, rgba(0,123,255,.3), transparent);
            border-radius: 50%; opacity: .6;
            animation: holo 2.5s ease-in-out infinite;
        }
        @keyframes holo { 0%, 100% { transform: scale(1); opacity: .4; } 50% { transform: scale(1.3); opacity: .7; } }

        .carnet-logo { width: 80%; margin-bottom: 20px; position: relative; z-index: 1; }
        .foto-container { position: relative; display: inline-block; margin-bottom: 15px; z-index: 1; }
        .foto { width: 160px; height: 160px; border-radius: 50%; object-fit: cover; object-position: top center; border: 4px solid rgba(255,255,255,0.9); box-shadow: 0 4px 15px rgba(0,0,0,.15); background:#fff; margin: 0 auto; display: block; }
        .avatar-initials { width: 160px; height: 160px; border-radius: 50%; background: #003f74; color: white; display: flex; align-items: center; justify-content: center; font-size: 50px; font-weight: bold; border: 4px solid rgba(255, 255, 255, 0.9); box-shadow: 0 4px 15px rgba(0,0,0,.15); margin: 0 auto; }
        .status-badge {
            position: absolute; bottom: 8px; right: 8px; background: #16a34a; color: white;
            width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center;
            border: 3px solid #fff; font-size: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.2); z-index: 2;
        }
        .emp-name { font-size: 1.15rem; font-weight: 800; color: #1a1a2e; margin: 10px 0 6px; position: relative; z-index: 1; line-height: 1.2; }
        .dato { font-size: .92rem; color: #334155; margin: 4px 0; position: relative; z-index: 1; }
        .dato strong { color: #0f172a; font-weight: 700; }
        .barcode { display: flex; justify-content: center; margin-top: 20px; position: relative; z-index: 1; background: white; padding: 5px; border-radius: 8px; width: 170px; margin-left: auto; margin-right: auto; }
        .barcode img { width: 160px; height: 50px; }
        .footer-carnet { background: linear-gradient(135deg, #003f74 0%, #0072bc 100%); color: #fff; padding: 10px; font-weight: 700; border-radius: 12px; margin-top: 15px; font-size: 11px; line-height: 1.4; position: relative; z-index: 1; }

        .acciones { display: flex; flex-wrap: wrap; gap: 12px; justify-content: center; margin-top: 10px; padding: 0 15px; }
        .btn { display: inline-flex; align-items: center; gap: 8px; padding: 12px 20px; border-radius: 12px; font-size: .9rem; font-weight: 700; cursor: pointer; text-decoration: none; border: none; transition: all .2s; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .btn-danger { background: #dc2626; color: white; }
        .btn-refresh { background: #3b82f6; color: white; }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 6px 12px rgba(0,0,0,0.15); }

        .empty-state {
            display: none;
            text-align: center;
            padding: 40px 20px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            max-width: 90%;
            margin-top: 20px;
        }
        .empty-state i { font-size: 4rem; color: #94a3b8; margin-bottom: 15px; }
        .empty-state h3 { font-size: 1.25rem; color: #334155; margin-bottom: 10px; }
        .empty-state p { color: #64748b; margin-bottom: 20px; font-size: 0.95rem; }

        /* --- Modals --- */
        .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); backdrop-filter: blur(4px); align-items: center; justify-content: center; }
        .modal-content { background: white; padding: 30px; border-radius: 20px; width: 90%; max-width: 350px; text-align: center; animation: popIn 0.3s cubic-bezier(0.18, 0.89, 0.32, 1.28); }
        @keyframes popIn { 0% { transform: scale(0.8); opacity: 0; } 100% { transform: scale(1); opacity: 1; } }
        .loading-state { color: #003f74; }
        .status-ok { color: #16a34a; }
        .status-error { color: #dc2626; }
        .result-state h2 { margin: 10px 0; font-size: 1.5em; }
        .btn-close { background: #003f74; color: white; border: none; padding: 12px 25px; border-radius: 25px; font-weight: 600; width: 100%; cursor: pointer; }

        .modal-icon { font-size: 48px; margin-bottom: 15px; }
        .modal-info { text-align: left; background: #f8fafc; padding: 20px; border-radius: 16px; margin-bottom: 20px; }
        .modal-info p { font-size: 0.95rem; margin-bottom: 8px; color: #475569; border-bottom: 1px solid #e2e8f0; padding-bottom: 6px; }
        .modal-info p:last-child { border-bottom: none; }
        .modal-info strong { color: #0f172a; font-weight: 600; width: 100px; display: inline-block; }

        @keyframes secure-check-spin {
            0% { transform: perspective(400px) rotateY(0deg); color: #4ade80; } /* verde claro */
            50% { transform: perspective(400px) rotateY(180deg); color: #064e3b; } /* verde oscuro */
            100% { transform: perspective(400px) rotateY(360deg); color: #4ade80; }
        }
        .secure-check-spin {
            animation: secure-check-spin 2.5s infinite linear;
            display: inline-block;
        }

        /* --- Anti-Copia y Anti-Captura --- */
        body {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-touch-callout: none;
        }

        img {
            pointer-events: none;
            -webkit-user-drag: none;
        }

        .blur-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 63, 116, 0.95);
            z-index: 9999;
            color: white;
            text-align: center;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            font-size: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body oncontextmenu="return false;">

    <!-- Capa de bloqueo antirrobo visual para Multitarea -->
    <div id="blurScreenOverlay" class="blur-overlay">
        <i class="fa-solid fa-shield-halved" style="font-size: 60px; margin-bottom: 20px;"></i>
        <p>Por seguridad, el carnet está oculto.<br>Prohibida la captura de pantalla.</p>
    </div>
    <header class="site-header">
        <img src="https://www.disajcali.gov.co/img/logoLargo.png" alt="DISAJ">
        <div class="ht">
            <strong>Dirección Seccional de Administración Judicial</strong>
            <span>Cali – Valle del Cauca</span>
        </div>
    </header>

    <div class="hero">
        <h1>Mi Carnet Digital</h1>
        <p>"Fortaleciendo la justicia, promoviendo el bienestar de todos".</p>
    </div>

    <main class="main-content">
        
        <div class="empty-state" id="emptyState">
            <i class="fa-solid fa-id-card-clip"></i>
            <h3>No tienes un carnet guardado</h3>
            <p>Por favor, realiza una consulta y guárdalo en tu dispositivo.</p>
            <a href="{{ route('carnet.consulta') }}" class="btn btn-refresh">Ir a Consultar2</a>
        </div>

        <div class="carnet" id="carnetRender" onclick="validateIdentityServer()" title="Toca para verificar estado actual">
            <div class="watermark"></div>
            <div class="hologram"></div>
            <img class="carnet-logo" src="https://www.disajcali.gov.co/img/logoLargo.png" alt="Logo">

            <div class="foto-container">
                <img class="foto" id="c_foto" src="" alt="Foto">
                <span class="status-badge" id="c_badge"><i class="fa-solid fa-check"></i></span>
            </div>

            <h2 class="emp-name" id="c_nombre"></h2>
            <p class="dato"><strong>Cédula:</strong> <span id="c_cedula"></span></p>
            <p class="dato"><strong>Cargo:</strong> <span id="c_cargo"></span></p>
            <p class="dato" id="c_obs_container" style="display:none;"><strong>Obs:</strong> <span id="c_obs"></span></p>

            <div class="barcode">
                <img id="c_barcode" src="" alt="Código de Barras">
            </div>

            <div class="footer-carnet">
                DIRECCIÓN SECCIONAL DE ADMINISTRACIÓN JUDICIAL<br>CALI, VALLE DEL CAUCA
            </div>
        </div>

        <div class="acciones" id="accionesContainer" style="display:none; justify-content: center;">
            <button class="btn btn-refresh" onclick="validateIdentityServer()" id="btnValidar" style="width: 100%;">
                <i class="fa-solid fa-rotate"></i> Validar Identidad
            </button>
        </div>
    </main>

    <!-- Modal de Validación PWA -->
    <div id="validationModal" class="modal">
        <div class="modal-content" id="modalContent">
            <div class="loading-state" id="loadingState">
                <img id="modalSpinPhoto" src="" class="fa-spin" style="width: 90px; height: 90px; border-radius: 50%; object-fit: cover; border: 4px solid #059669; display: none; margin: 0 auto; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                <div id="modalSpinInitials" class="fa-spin" style="width: 90px; height: 90px; border-radius: 50%; background: #003f74; color: white; display: none; align-items: center; justify-content: center; font-size: 36px; font-weight: bold; border: 4px solid #00569d; margin: 0 auto; box-shadow: 0 4px 10px rgba(0,0,0,0.1);"></div>
                <i class="fa-solid fa-circle-notch fa-spin status-ok" id="loadingIconFallback" style="font-size: 50px;"></i>
                <h3 style="margin-top:20px;">VERIFICANDO FUNCIONARIO...</h3>
            </div>
            
            <div id="resultState" style="display:none;">
                <div class="modal-icon" id="modalIcon"></div>
                <h3 id="resultTitle" style="font-size: 1.5rem; font-weight: 800; color: #1e293b; margin-bottom: 15px;">Estado del Carnet</h3>
                
                <div style="text-align:center; margin-bottom: 15px;">
                    <img id="valFotoResult" src="" style="width: 90px; height: 90px; border-radius: 50%; object-fit: cover; border: 3px solid #059669; display: none; margin: 0 auto; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                    <div id="valInitialsResult" style="width: 90px; height: 90px; border-radius: 50%; background: #003f74; color: white; display: none; align-items: center; justify-content: center; font-size: 36px; font-weight: bold; border: 3px solid #00569d; margin: 0 auto; box-shadow: 0 4px 10px rgba(0,0,0,0.1);"></div>
                </div>

                <div class="modal-info">
                    <p><strong>Empleado:</strong> <span id="valNombre"></span></p>
                    <p><strong>Cédula:</strong> <span id="valCedula"></span></p>
                    <p><strong>Vigencia:</strong> <span id="valVigencia"></span></p>
                    <p><strong>Observación:</strong> <span id="valObs"></span></p>
                </div>
                
                <div id="resultMessage" style="font-weight: 800; margin-bottom: 25px; padding: 15px; border-radius: 12px; font-size: 14px;"></div>
                
                <button class="btn-close" id="btnCloseModal" onclick="closeModal()">Entendido</button>
            </div>
        </div>
    </div>

    <!-- Modal Instrucciones de Instalación iOS/Android -->
    <div id="installGuideModal" class="modal">
        <div class="modal-content" style="text-align:center;">
            <i class="fa-solid fa-arrow-up-from-bracket" style="font-size: 40px; color: #3b82f6; margin-bottom:15px;"></i>
            <h3 style="font-size:1.3rem; margin-bottom: 10px;">Añadir PWA al Inicio</h3>
            <p style="font-size:0.95rem; color:#475569; margin-bottom:20px; text-align:left;">
                Para que tu carnet funcione como una App independiente offline, añádelo ahora a tu inicio:
                <br><br>
                <strong>📱 En iPhone (Safari):</strong> Toca el ícono de "Compartir" en la barra inferior y luego <strong>"Agregar a Inicio"</strong>.
                <br><br>
                <strong>🤖 En Android (Chrome):</strong> Toca el botón verde de abajo, o en los tres puntos (arriba derecha) escoge <strong>"Agregar a la pantalla principal"</strong>.
            </p>
            <button class="btn btn-refresh" id="btnAndroidInstall" style="width:100%; justify-content:center; display:none; background:#ef4444 !important; color:white; font-weight:900; letter-spacing:0.5px; border: 2px solid #b91c1c; box-shadow:0 4px 15px rgba(239, 68, 68, 0.4); animation: pulseRed 2s infinite; margin-bottom: 15px;">
                <i class="fa-solid fa-triangle-exclamation"></i> OBLIGATORIO: Instalar App Automáticamente
            </button>
            <button class="btn-close" onclick="document.getElementById('installGuideModal').style.display='none'" style="width:100%; justify-content:center;">
                Cerrar este aviso
            </button>
        </div>
    </div>

    <script>
        // Registrar Service Worker para PWA
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register("{{ asset('sw.js') }}").then(reg => {
                    console.log('SW Registrado en PWA', reg);
                });
            });
        }

        let deferredPrompt;
        window.addEventListener('beforeinstallprompt', (e) => {
            e.preventDefault();
            deferredPrompt = e;
            const btn = document.getElementById('btnAndroidInstall');
            if(btn) {
                btn.style.display = 'flex';
                btn.onclick = () => {
                    deferredPrompt.prompt();
                    deferredPrompt.userChoice.then((choiceResult) => {
                        deferredPrompt = null;
                        document.getElementById('installGuideModal').style.display='none';
                    });
                };
            }
        });

        // IndexedDB Wrapper para Persistencia en iOS
        const DB_NAME = 'CarnetPWA_DB';
        const STORE_NAME = 'data_store';

        function initDB() {
            return new Promise((resolve, reject) => {
                const req = indexedDB.open(DB_NAME, 1);
                req.onupgradeneeded = e => {
                    e.target.result.createObjectStore(STORE_NAME);
                };
                req.onsuccess = e => resolve(e.target.result);
                req.onerror = e => reject(e.target.error);
            });
        }

        async function setDbVal(key, val) {
            try {
                const db = await initDB();
                await new Promise((resolve, reject) => {
                    const tx = db.transaction(STORE_NAME, "readwrite");
                    const store = tx.objectStore(STORE_NAME);
                    store.put(val, key);
                    tx.oncomplete = () => resolve();
                    tx.onerror = () => reject(tx.error);
                });
            } catch (err) {
                // Fallback a localStorage si falla IndexedDB
                localStorage.setItem(key, val);
            }
        }

        async function getDbVal(key) {
            try {
                const db = await initDB();
                return await new Promise((resolve, reject) => {
                    const tx = db.transaction(STORE_NAME, "readonly");
                    const store = tx.objectStore(STORE_NAME);
                    const req = store.get(key);
                    req.onsuccess = () => resolve(req.result);
                    req.onerror = () => reject(req.error);
                });
            } catch (err) {
                console.warn('IndexedDB read fallback', err);
                return localStorage.getItem(key);
            }
        }

        async function removeDbVal(key) {
            try {
                const db = await initDB();
                await new Promise((resolve, reject) => {
                    const tx = db.transaction(STORE_NAME, "readwrite");
                    const store = tx.objectStore(STORE_NAME);
                    store.delete(key);
                    tx.oncomplete = () => resolve();
                    tx.onerror = () => reject(tx.error);
                });
            } catch (err) {
                localStorage.removeItem(key);
            }
        }

        let savedData = null;

        async function getDeviceId() {
            let did = await getDbVal('carnet_device_id');
            if(!did) {
                did = localStorage.getItem('carnet_device_id');
            }
            if(!did) {
                did = 'dev-' + Math.random().toString(36).substring(2, 10) + '-' + Date.now();
                await setDbVal('carnet_device_id', did);
                localStorage.setItem('carnet_device_id', did); // Backup
            }
            return did;
        }

        document.addEventListener('DOMContentLoaded', async () => {
            await loadCarnetFromLocal();
        });

        async function loadCarnetFromLocal() {
            const urlParams = new URLSearchParams(window.location.search);
            const token = urlParams.get('token');
            const isInstall = urlParams.get('install');

            let dataStr = await getDbVal('carnet_pwa_data') || localStorage.getItem('carnet_pwa_data');
            
            if (!dataStr && token) {
                // Modo iOS: Al abrir un PWA en la pantalla de inicio, puede perder el LocalStorage original de Safari.
                // Descargamos los datos nuevamente validándolos por el token.
                document.getElementById('emptyState').style.display = 'none';
                const isStandalone = (window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone) ? '1' : '0';
                
                const devId = await getDeviceId();
                fetch(`/api/carnet/token/${token}?device_id=${devId}&standalone=${isStandalone}`)
                    .then(r => {
                        if (r.status === 403) throw new Error("another_device");
                        if (!r.ok) throw new Error("Carnet no encontrado");
                        return r.json();
                    })
                    .then(async data => {
                        savedData = data;
                        await setDbVal('carnet_pwa_data', JSON.stringify(data));
                        localStorage.setItem('carnet_pwa_data', JSON.stringify(data)); // doble backup
                        
                        // Limpiar param de instalación pero mantener TOKEN absoluto para ancla iOS
                        window.history.replaceState({}, document.title, window.location.pathname + '?token=' + token);
                        
                        renderCarnet(savedData);
                        validateIdentityServer(true);

                        if (isInstall === '1' && isStandalone !== '1') {
                            document.getElementById('installGuideModal').style.display = 'flex';
                        }
                    })
                    .catch(e => {
                        if (e.message === "another_device") {
                             alert("ACCESO DENEGADO:\nEste enlace del carnet ya fue instalado y vinculado a otro teléfono. Por seguridad no puede abrirse en múltiples lugares.");
                        } else {
                             alert("No pudimos sincronizar el carnet en tu dispositivo. Asegúrate de tener internet al abrirlo por primera vez.");
                        }
                        window.location.href = "{{ route('carnet.consulta') }}";
                    });
                return;
            }

            if (dataStr) {
                // Save to IndexedDB if it was pulled from localStorage fallback
                await setDbVal('carnet_pwa_data', dataStr);

                savedData = JSON.parse(dataStr);
                renderCarnet(savedData);
                await validateIdentityServer(true); 

                // Si viene de "Generar PWA", mostrar guiador si no es standalone
                const isStandaloneModal = (window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone);
                if (isInstall === '1') {
                    window.history.replaceState({}, document.title, window.location.pathname + '?token=' + (token || savedData.carnet_token));
                    if (!isStandaloneModal) {
                        document.getElementById('installGuideModal').style.display = 'flex';
                    }
                }
            } else {
                // Si no hay datos, redirigimos a la consulta
                window.location.href = "{{ route('carnet.consulta') }}";
            }
        }

        function renderCarnet(data) {
            document.getElementById('emptyState').style.display = 'none';
            document.getElementById('carnetRender').style.display = 'block';
            document.getElementById('accionesContainer').style.display = 'flex';

            const fotoEl = document.getElementById('c_foto');
            let imgSrc = data.foto;
            // Si guarda solo el nombre del archivo (ej. 123.jpg), asegurar la ruta correcta:
            if (imgSrc && !imgSrc.startsWith('http') && !imgSrc.startsWith('/') && !imgSrc.includes('img/carnet')) {
                imgSrc = '/img/carnet/' + imgSrc;
            }
            fotoEl.src = imgSrc;
            fotoEl.onerror = function() {
                this.style.display = 'none';
                if (!document.getElementById('c_initials')) {
                    const initialsDiv = document.createElement('div');
                    initialsDiv.id = 'c_initials';
                    initialsDiv.className = 'avatar-initials';
                    initialsDiv.innerText = data.iniciales || 'RJ';
                    this.parentElement.insertBefore(initialsDiv, this.parentElement.firstChild);
                }
            };

            document.getElementById('c_nombre').innerText = data.nombre;
            document.getElementById('c_cedula').innerText = data.cedula;
            document.getElementById('c_cargo').innerText = data.cargo;
            
            if (data.observacion) {
                document.getElementById('c_obs_container').style.display = 'block';
                document.getElementById('c_obs').innerText = data.observacion;
            }

            document.getElementById('c_barcode').src = `https://barcode.tec-it.com/barcode.ashx?data=${data.cedula}&code=Code128`;

            const badge = document.getElementById('c_badge');
            if (data.esActivo) {
                badge.style.background = '#16a34a';
                badge.innerHTML = '<i class="fa-solid fa-check"></i>';
            } else {
                badge.style.background = '#dc2626';
                badge.innerHTML = '<i class="fa-solid fa-xmark"></i>';
            }
        }

        function deleteCarnet() {
            if(confirm("¿Estás seguro de que deseas eliminar tu carnet digital de este dispositivo?")) {
                if (savedData && savedData.cedula) {
                    const btn = document.querySelector('.btn-danger');
                    if (btn) {
                        btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Eliminando...';
                        btn.disabled = true;
                    }

                    fetch('/api/carnet/revocar', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ cedula: savedData.cedula })
                    })
                    .finally(async () => {
                        await removeDbVal('carnet_pwa_data');
                        localStorage.removeItem('carnet_pwa_data');
                        window.location.href = "{{ route('carnet.consulta') }}";
                    });
                } else {
                    removeDbVal('carnet_pwa_data');
                    localStorage.removeItem('carnet_pwa_data');
                    window.location.href = "{{ route('carnet.consulta') }}";
                }
            }
        }

        function closeModal() {
            document.getElementById('validationModal').style.display = 'none';
        }

        // Validación estricta con servidor
        async function validateIdentityServer(silentMode = false) {
            if (!savedData) return;
            
            const modal = document.getElementById('validationModal');
            const loading = document.getElementById('loadingState');
            const result = document.getElementById('resultState');
            
            const btn = document.getElementById('btnValidar');
            if(btn && !silentMode) {
                btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Validando...';
                btn.disabled = true;
            }

            if (!silentMode) {
                // 1. Prioridad Búsqueda Local
                loading.style.display = 'none'; // Ya no usamos el estado de "Cargando" girando
                result.style.display = 'block';
                modal.style.display = 'flex';
                
                // Mostrar de inmediato los datos locales almacenados
                document.getElementById('valNombre').innerText = savedData.nombre;
                document.getElementById('valCedula').innerText = savedData.cedula;
                document.getElementById('valVigencia').innerText = savedData.vigencia || 'N/A';
                document.getElementById('valObs').innerText = savedData.observacion || 'Ninguna';
                
                // Configurar foto para corroborar que sea el mismo
                const imgFoto = document.getElementById('c_foto');
                const cssInitials = document.getElementById('c_initials');
                if (imgFoto && window.getComputedStyle(imgFoto).display !== 'none') {
                    document.getElementById('valFotoResult').src = imgFoto.src;
                    document.getElementById('valFotoResult').style.display = 'block';
                    document.getElementById('valInitialsResult').style.display = 'none';
                } else if (cssInitials) {
                    document.getElementById('valInitialsResult').innerText = cssInitials.innerText;
                    document.getElementById('valInitialsResult').style.display = 'flex';
                    document.getElementById('valFotoResult').style.display = 'none';
                }

                // Mostrar mensaje de espera de internet
                document.getElementById('modalIcon').innerHTML = '<i class="fa-solid fa-satellite-dish fa-beat" style="color: #3b82f6;"></i>';
                document.getElementById('resultTitle').innerText = 'Verificación Local';
                document.getElementById('resultTitle').style.color = '#3b82f6';
                document.getElementById('resultMessage').innerText = '⏳ Cargando datos almacenados...\nEn espera de internet para validación web.';
                document.getElementById('resultMessage').style.background = '#eff6ff';
                document.getElementById('resultMessage').style.color = '#1e3a8a';
            }

            const devId = await getDeviceId();
            const isStandalone = (window.matchMedia('(display-mode: standalone)').matches || window.navigator.standalone) ? '1' : '0';
            fetch(`/api/carnet/validar?cedula=${savedData.cedula}&device_id=${devId}&standalone=${isStandalone}`)
                .then(response => {
                    if (!response.ok) throw new Error("Fallo en la red");
                    return response.json();
                })
                .then(async data => {
                    // Si se logra validar exitosamente con internet, se reinicia el contador
                    await resetOfflineCount();

                    if (!silentMode) {
                        // Ya no ocultamos loading ni mostramos result porque ya lo hicimos arriba.

                        document.getElementById('valNombre').innerText = data.nombre || savedData.nombre;
                        document.getElementById('valCedula').innerText = data.cedula || savedData.cedula;
                        document.getElementById('valVigencia').innerText = data.vigencia || 'N/A';
                        document.getElementById('valObs').innerText = data.observacion || 'Ninguna';
                    }

                    // Sincronizar silenciosamente cambios en la data maestra si llegaron (por si actualizan datos o fotos)
                    let updated = false;
                    if (data.foto && data.foto !== savedData.foto) { savedData.foto = data.foto; updated = true; }
                    if (data.nombre && data.nombre !== savedData.nombre) { savedData.nombre = data.nombre; updated = true; }
                    if (data.cargo && data.cargo !== savedData.cargo) { savedData.cargo = data.cargo; updated = true; }
                    if (data.vigencia && data.vigencia !== savedData.vigencia) { savedData.vigencia = data.vigencia; updated = true; }
                    
                    if (updated) {
                        setDbVal('carnet_pwa_data', JSON.stringify(savedData)).then(() => {
                            localStorage.setItem('carnet_pwa_data', JSON.stringify(savedData));
                            renderCarnet(savedData); // Actualiza la vista de inmediato (foto y datos visuales)
                        });
                    }

                    if(btn && !silentMode) {
                        btn.innerHTML = '<i class="fa-solid fa-rotate"></i> Validar Estado';
                        btn.disabled = false;
                    }

                    if (data.activo === false || data.status === 'error') {
                        removeDbVal('carnet_pwa_data');
                        localStorage.removeItem('carnet_pwa_data');
                        if (!silentMode) {
                            document.getElementById('modalIcon').innerHTML = '<i class="fa-solid fa-circle-xmark status-error"></i>';
                            document.getElementById('resultTitle').innerText = 'Carnet Inválido';
                            document.getElementById('resultTitle').style.color = '#1e293b';
                            document.getElementById('resultMessage').innerText = data.message || data.mensaje || '❌ ESTADO: INACTIVO / VENCIDO';
                            document.getElementById('resultMessage').style.background = '#fef2f2';
                            document.getElementById('resultMessage').style.color = '#991b1b';
                            document.getElementById('btnCloseModal').onclick = function() { window.location.href = "{{ route('carnet.consulta') }}"; };
                        } else {
                           alert("⚠️ SESIÓN REVOCADA:\nTu carnet ha sido desactivado o no está vigente. Se eliminará del dispositivo por seguridad.");
                            window.location.href = "{{ route('carnet.consulta') }}";
                        }
                    } else if (!silentMode) {
                        if (data.status === 'warning') {
                            document.getElementById('modalIcon').innerHTML = '<i class="fa-solid fa-triangle-exclamation status-error" style="color: #f59e0b;"></i>';
                            document.getElementById('resultTitle').innerText = '¡Alerta de Ingreso!';
                            document.getElementById('resultTitle').style.color = '#f59e0b';
                            document.getElementById('resultMessage').innerText = data.message;
                            document.getElementById('resultMessage').style.background = '#fffbeb';
                            document.getElementById('resultMessage').style.color = '#b45309';
                            if (data.action === 'purge_required') {
                                removeDbVal('carnet_pwa_data');
                                localStorage.removeItem('carnet_pwa_data');
                                document.getElementById('btnCloseModal').onclick = function() { window.location.href = "{{ route('carnet.consulta') }}"; };
                            }
                        } else {
                            document.getElementById('modalIcon').innerHTML = '<i class="fa-solid fa-circle-check status-ok secure-check-spin"></i>';
                            document.getElementById('resultTitle').innerText = 'Carnet Válido';
                            document.getElementById('resultTitle').style.color = '#1e293b';
                            document.getElementById('resultMessage').innerText = '✅ IDENTIDAD VERIFICADA Y ACTIVA';
                            document.getElementById('resultMessage').style.background = '#ecfdf5';
                            document.getElementById('resultMessage').style.color = '#065f46';
                        }
                    }
                })
                .catch(async error => {
                    console.error("Error al validar con servidor:", error);
                    let count = await incrementOfflineCount();

                    if (!silentMode) {
                        // Actualizar estado a "Modo Sin Conexión" ya que falló la web

                        document.getElementById('valNombre').innerText = savedData.nombre;
                        document.getElementById('valCedula').innerText = savedData.cedula;
                        document.getElementById('valVigencia').innerText = 'N/A';
                        document.getElementById('valObs').innerText = savedData.observacion || 'Ninguna';

                        document.getElementById('modalIcon').innerHTML = '<i class="fa-solid fa-wifi" style="color: #94a3b8;"></i>';
                        document.getElementById('resultTitle').innerText = 'Modo Sin Conexión';
                        document.getElementById('resultTitle').style.color = '#1e293b';
                        document.getElementById('resultMessage').innerText = "No tienes internet.\nApertura offline #" + count;
                        document.getElementById('resultMessage').style.background = '#f8fafc';
                        document.getElementById('resultMessage').style.color = '#475569';
                    } else {
                        // Silent mode: Aplicar penalidad de conteo
                        if (count <= 2) {
                            const Toast = Swal.mixin({
                                toast: true, position: 'top-end', showConfirmButton: false, timer: 4000
                            });
                            Toast.fire({
                                icon: 'warning',
                                title: 'No se puede validar, en espera de conexión (' + count + '/2)'
                            });
                        } else {
                            // Cambiar insignia del carnet
                            const badge = document.getElementById('c_badge');
                            if (badge) {
                                badge.style.background = '#f59e0b';
                                badge.innerHTML = '<i class="fa-solid fa-clock" style="font-size:14px; position:relative;"></i><span style="position:absolute; bottom:-12px; right: -25px; font-size:10px; background:#fff; color:#f59e0b; padding:2px 5px; border-radius:5px; border:1px solid #f59e0b; white-space:nowrap; box-shadow:0 2px 4px rgba(0,0,0,0.2); font-weight:bold;">En espera de validación</span>';
                                
                                const Toast = Swal.mixin({
                                    toast: true, position: 'bottom-end', showConfirmButton: false, timer: 5000
                                });
                                Toast.fire({
                                    icon: 'info',
                                    title: 'Límite offline superado. Requiere conexión a internet.'
                                });
                            }
                        }
                    }

                    if(btn && !silentMode) {
                        btn.innerHTML = '<i class="fa-solid fa-rotate"></i> Validar Estado';
                        btn.disabled = false;
                    }
                });
        }

        // ==========================================
        // MANEJO DE CONEXIÓN A INTERNET
        // ==========================================
        window.addEventListener('online', () => {
            // Cuando detecte que volvió el internet, intentar validar de forma silenciosa
            if (savedData) {
                const Toast = Swal.mixin({
                    toast: true, position: 'top-end', showConfirmButton: false, timer: 3000
                });
                Toast.fire({
                    icon: 'success',
                    title: 'Se recuperó la conexión. Validando...'
                });
                validateIdentityServer(true); // silentMode = true
            }
        });

        async function getOfflineCount() {
            let count = parseInt(await getDbVal('offline_count')) || parseInt(localStorage.getItem('offline_count')) || 0;
            return count;
        }

        async function incrementOfflineCount() {
            let count = await getOfflineCount();
            count++;
            await setDbVal('offline_count', count);
            localStorage.setItem('offline_count', count);
            return count;
        }

        async function resetOfflineCount() {
            await setDbVal('offline_count', 0);
            localStorage.setItem('offline_count', 0);
        }

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
                Swal.fire({
                    icon: 'error',
                    title: 'Seguridad',
                    text: 'La captura de pantalla está deshabilitada por configuración de la entidad.',
                    confirmButtonColor: '#003f74'
                });
                return false;
            }
            // Evitar impresión (Ctrl+P) o Guardado (Ctrl+S)
            if ((e.ctrlKey && (e.key === 'p' || e.key === 's' || e.key === 'P' || e.key === 'S')) || 
                (e.metaKey && e.shiftKey && (e.key === 's' || e.key === 'S')) ) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Acción Bloqueada',
                    text: 'Imprimir o guardar la página directamente está prohibido.',
                    confirmButtonColor: '#003f74'
                });
                return false;
            }
        });

        // Ocultar carnet en modo Multitarea / Background (iOS / Android) para evitar screenshot nativo
        document.addEventListener("visibilitychange", function() {
            if (document.hidden) {
                document.getElementById('blurScreenOverlay').style.display = 'flex';
            } else {
                document.getElementById('blurScreenOverlay').style.display = 'none';
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

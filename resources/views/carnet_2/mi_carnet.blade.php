<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <link rel="apple-touch-icon" href="{{ asset('Logo/LogoSiris.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('Logo/LogoSiris.png') }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('Logo/LogoSiris.png') }}">
    <link rel="shortcut icon" href="{{ asset('Logo/LogoSiris.png') }}">
    <meta name="theme-color" content="#002147">
    <title>Mi Carnet Digital</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
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
            background: #002147;
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
            background: linear-gradient(135deg, #002147 0%, #003580 55%, #1a5276 100%);
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
        .foto { width: 130px; height: 130px; border-radius: 50%; object-fit: cover; border: 5px solid rgba(255,255,255,0.8); box-shadow: 0 4px 15px rgba(0,0,0,.15); background:#fff; margin: 0 auto;}
        .avatar-initials { width: 130px; height: 130px; border-radius: 50%; background: #002147; color: white; display: flex; align-items: center; justify-content: center; font-size: 50px; font-weight: bold; border: 5px solid rgba(255, 255, 255, 0.8); box-shadow: 0 4px 15px rgba(0,0,0,.15); margin: 0 auto; }
        .status-badge {
            position: absolute; bottom: 5px; right: 5px; background: #16a34a; color: white;
            width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center;
            border: 3px solid #fff; font-size: 12px; box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }
        .emp-name { font-size: 1.15rem; font-weight: 800; color: #1a1a2e; margin: 10px 0 6px; position: relative; z-index: 1; line-height: 1.2; }
        .dato { font-size: .92rem; color: #334155; margin: 4px 0; position: relative; z-index: 1; }
        .dato strong { color: #0f172a; font-weight: 700; }
        .barcode { display: flex; justify-content: center; margin-top: 20px; position: relative; z-index: 1; background: white; padding: 5px; border-radius: 8px; width: 170px; margin-left: auto; margin-right: auto; }
        .barcode img { width: 160px; height: 50px; }
        .footer-carnet { background: linear-gradient(135deg, #002147 0%, #1a5276 100%); color: #fff; padding: 10px; font-weight: 700; border-radius: 12px; margin-top: 15px; font-size: 11px; line-height: 1.4; position: relative; z-index: 1; }

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
        .loading-state { color: #002147; }
        .status-ok { color: #16a34a; }
        .status-error { color: #dc2626; }
        .result-state h2 { margin: 10px 0; font-size: 1.5em; }
        .btn-close { background: #002147; color: white; border: none; padding: 12px 25px; border-radius: 25px; font-weight: 600; width: 100%; cursor: pointer; }
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
        <h1>Mi Carnet Digital</h1>
        <p>Tu identificación oficial, siempre disponible en tu móvil.</p>
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

        <div class="acciones" id="accionesContainer" style="display:none;">
            <button class="btn btn-refresh" onclick="validateIdentityServer()" id="btnValidar">
                <i class="fa-solid fa-rotate"></i> Validar Estado
            </button>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Registrar Service Worker para PWA con auto-actualización
        if ('serviceWorker' in navigator) {
            navigator.serviceWorker.register("{{ asset('sw.js') }}")
                .then(registration => {
                    registration.addEventListener('updatefound', () => {
                        const newWorker = registration.installing;
                        newWorker.addEventListener('statechange', () => {
                            if (
                                newWorker.state === 'installed' &&
                                navigator.serviceWorker.controller
                            ) {
                                // Nueva versión detectada: recargar para aplicar cambios
                                window.location.reload();
                            }
                        });
                    });
                })
                .catch(err => console.error('Error al registrar SW:', err));
        }

        let savedData = null;

        document.addEventListener('DOMContentLoaded', () => {
            loadCarnetFromLocal();
        });

        function loadCarnetFromLocal() {
            const dataStr = localStorage.getItem('carnet_pwa_data');
            if (dataStr) {
                savedData = JSON.parse(dataStr);
                renderCarnet(savedData);
                // Validar de fondo siempre que inicie la app para evitar inactivos
                validateIdentityServer(true); 
            } else {
                document.getElementById('emptyState').style.display = 'block';
                document.getElementById('carnetRender').style.display = 'none';
                document.getElementById('accionesContainer').style.display = 'none';
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
            // En la vista del carnet: si no es Juez ni Director Seccional, mostrar "Empleado Judicial"
            const cargoLower = (data.cargo || '').toLowerCase();
            const cargoDisplay = (cargoLower.includes('juez') || cargoLower.includes('director seccional'))
                ? data.cargo
                : 'Empleado Judicial';
            document.getElementById('c_cargo').innerText = cargoDisplay;
            
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
                    .finally(() => {
                        localStorage.removeItem('carnet_pwa_data');
                        window.location.reload();
                    });
                } else {
                    localStorage.removeItem('carnet_pwa_data');
                    window.location.reload();
                }
            }
        }

        function closeModal() {
            // Compatibilidad por si queda alguna referencia
            Swal.close();
        }

        // Validación con SweetAlert2 — muestra ficha completa del funcionario
        function validateIdentityServer(silentMode = false) {
            if (!savedData) return;

            const btn = document.getElementById('btnValidar');
            if (btn && !silentMode) {
                btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Validando...';
                btn.disabled = true;
            }

            // Mostrar SweetAlert de carga (solo en modo explícito)
            if (!silentMode) {
                const fotoSrc = (() => {
                    const imgEl = document.getElementById('c_foto');
                    if (imgEl && window.getComputedStyle(imgEl).display !== 'none' && imgEl.src) {
                        return `<img src="${imgEl.src}" onerror="this.style.display='none'" 
                                     style="width:90px;height:90px;border-radius:50%;object-fit:cover;
                                            border:4px solid #002147;box-shadow:0 4px 12px rgba(0,0,90,.25);
                                            animation:swal-spin 1.2s linear infinite;margin:0 auto;display:block;">`;
                    }
                    const initEl = document.getElementById('c_initials');
                    const txt = initEl ? initEl.innerText : (savedData.iniciales || '?');
                    return `<div style="width:90px;height:90px;border-radius:50%;background:#002147;color:#fff;
                                        display:flex;align-items:center;justify-content:center;
                                        font-size:36px;font-weight:bold;border:4px solid #002147;
                                        box-shadow:0 4px 12px rgba(0,0,90,.25);
                                        animation:swal-spin 1.2s linear infinite;margin:0 auto;">${txt}</div>`;
                })();

                Swal.fire({
                    title: 'Validando identidad…',
                    html: `<style>
                        @keyframes swal-spin{0%{box-shadow:0 0 0 0 rgba(0,33,71,.4)}70%{box-shadow:0 0 0 10px rgba(0,33,71,0)}100%{box-shadow:0 0 0 0 rgba(0,33,71,0)}}
                    </style>${fotoSrc}`,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    didOpen: () => Swal.showLoading()
                });
            }

            fetch(`/api/carnet/validar?cedula=${savedData.cedula}`)
                .then(response => response.json())
                .then(data => {

                    if (btn && !silentMode) {
                        btn.innerHTML = '<i class="fa-solid fa-rotate"></i> Validar Estado';
                        btn.disabled = false;
                    }

                    // Construir foto para el resultado
                    let fotoHtml = '';
                    const fotoUrl = data.foto || savedData.foto || '';
                    let fotoSrc = fotoUrl;
                    if (fotoSrc && !fotoSrc.startsWith('http') && !fotoSrc.startsWith('/') && !fotoSrc.includes('img/carnet')) {
                        fotoSrc = '/img/carnet/' + fotoSrc;
                    }

                    // Estado y colores
                    const activo = data.activo !== false && data.status !== 'error';
                    const esWarning = data.status === 'warning';

                    const estadoColor  = activo ? (esWarning ? '#f59e0b' : '#16a34a') : '#dc2626';
                    const estadoTexto  = activo ? (esWarning ? 'CON ALERTA' : 'VIGENTE') : 'REVOCADO';
                    const estadoIcon   = activo ? (esWarning ? '⚠️' : '✅') : '🚫';
                    const fotoAvatarBorder = `border:4px solid ${estadoColor};`;

                    if (fotoSrc) {
                        fotoHtml = `<img src="${fotoSrc}" 
                            onerror="this.outerHTML='<div style=\'width:100px;height:100px;border-radius:50%;background:#002147;color:#fff;display:flex;align-items:center;justify-content:center;font-size:38px;font-weight:bold;${fotoAvatarBorder}box-shadow:0 4px 14px rgba(0,0,0,.18);margin:0 auto;\'>${savedData.iniciales || '?'}</div>'" 
                            style="width:100px;height:100px;border-radius:50%;object-fit:cover;${fotoAvatarBorder}box-shadow:0 4px 14px rgba(0,0,0,.18);margin:0 auto;display:block;">`;
                    } else {
                        const ini = savedData.iniciales || '?';
                        fotoHtml = `<div style="width:100px;height:100px;border-radius:50%;background:#002147;color:#fff;display:flex;align-items:center;justify-content:center;font-size:38px;font-weight:bold;${fotoAvatarBorder}box-shadow:0 4px 14px rgba(0,0,0,.18);margin:0 auto;">${ini}</div>`;
                    }

                    const nombre   = data.nombre   || savedData.nombre   || '—';
                    const cedula   = data.cedula   || savedData.cedula   || '—';
                    const cargo    = data.cargo    || savedData.cargo    || '—';
                    const vigencia = data.vigencia || savedData.vigencia || 'No especificada';

                    const fichaHtml = `
                        <style>
                            .swal-ficha-wrap { font-family:'Inter',sans-serif; }
                            .swal-ficha-foto { margin-bottom:14px; }
                            .swal-estado-badge {
                                display:inline-flex;align-items:center;gap:6px;
                                padding:5px 16px;border-radius:20px;font-weight:700;
                                font-size:.82rem;letter-spacing:.05em;margin-bottom:14px;
                                background:${estadoColor}22;color:${estadoColor};
                                border:1.5px solid ${estadoColor};
                            }
                            .swal-ficha-table { width:100%;border-collapse:collapse;margin-top:4px;text-align:left; }
                            .swal-ficha-table tr td { padding:7px 8px;font-size:.87rem;border-bottom:1px solid #f0f0f0; }
                            .swal-ficha-table tr td:first-child { color:#64748b;font-weight:600;width:40%;white-space:nowrap; }
                            .swal-ficha-table tr td:last-child  { color:#1e293b;font-weight:500; }
                            .swal-ficha-table tr:last-child td  { border-bottom:none; }
                        </style>
                        <div class="swal-ficha-wrap">
                            <div class="swal-ficha-foto">${fotoHtml}</div>
                            <div class="swal-estado-badge">${estadoIcon} ${estadoTexto}</div>
                            <table class="swal-ficha-table">
                                <tr><td><i class="fa-solid fa-id-card" style="margin-right:5px;"></i>Cédula</td><td>${cedula}</td></tr>
                                <tr><td><i class="fa-solid fa-user" style="margin-right:5px;"></i>Nombre</td><td>${nombre}</td></tr>
                                <tr><td><i class="fa-solid fa-briefcase" style="margin-right:5px;"></i>Cargo</td><td>${cargo}</td></tr>
                                <tr><td><i class="fa-solid fa-calendar-check" style="margin-right:5px;"></i>Vigencia</td><td>${vigencia}</td></tr>
                            </table>
                            ${data.message ? `<p style="margin-top:12px;font-size:.82rem;color:#64748b;">${data.message}</p>` : ''}
                        </div>`;

                    if (!activo) {
                        localStorage.removeItem('carnet_pwa_data');
                        if (!silentMode) {
                            Swal.fire({
                                title: 'Acceso Denegado',
                                html: fichaHtml,
                                icon: 'error',
                                confirmButtonText: 'Entendido',
                                confirmButtonColor: '#dc2626',
                                allowOutsideClick: false
                            }).then(() => window.location.reload());
                        } else {
                            Swal.fire({
                                title: '⚠️ Sesión Revocada',
                                text: 'Tu carnet ha sido desactivado. Se eliminará del dispositivo.',
                                icon: 'error',
                                confirmButtonText: 'Aceptar',
                                confirmButtonColor: '#dc2626'
                            }).then(() => window.location.reload());
                        }

                    } else if (!silentMode) {
                        if (esWarning) {
                            if (data.action === 'purge_required') {
                                localStorage.removeItem('carnet_pwa_data');
                            }
                            Swal.fire({
                                title: '¡Alerta de Ingreso!',
                                html: fichaHtml,
                                icon: 'warning',
                                confirmButtonText: 'Entendido',
                                confirmButtonColor: '#f59e0b',
                                allowOutsideClick: false
                            }).then(() => {
                                if (data.action === 'purge_required') window.location.reload();
                            });
                        } else {
                            Swal.fire({
                                title: 'Verificación Exitosa',
                                html: fichaHtml,
                                icon: 'success',
                                confirmButtonText: 'Cerrar',
                                confirmButtonColor: '#002147'
                            });
                        }
                    }
                })
                .catch(() => {
                    if (btn && !silentMode) {
                        btn.innerHTML = '<i class="fa-solid fa-rotate"></i> Validar Estado';
                        btn.disabled = false;
                    }
                    if (!silentMode) {
                        Swal.fire({
                            title: 'Modo Sin Conexión',
                            html: `
                                <div style="text-align:center;">
                                    <i class="fa-solid fa-wifi-exclamation" style="font-size:3rem;color:#94a3b8;margin-bottom:12px;"></i>
                                    <p style="color:#475569;margin:0;">No hay conexión a internet.<br>Mostrando el último estado guardado en el dispositivo.</p>
                                </div>`,
                            icon: 'info',
                            confirmButtonText: 'Cerrar',
                            confirmButtonColor: '#002147'
                        });
                    }
                });
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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Validador de Carnets - DISAJ</title>

    <!-- PWA Meta Tags -->
    <meta name="theme-color" content="#003f74">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    
    <!-- Google Fonts & FontAwesome -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- HTML5 QRCode Scanner -->
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <style>
        :root {
            --primary: #003f74;
            --primary-light: #0056b3;
            --accent: #f39c12;
            --success: #004182;
            --danger: #dc3545;
            --bg-color: #f0f2f5;
            --text-color: #1a1a1a;
            --card-bg: #ffffff;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-color);
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* --- Header --- */
        .header {
            background-color: var(--primary);
            color: white;
            padding: 10px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 1000;
        }

        .header .logo-box {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .header img {
            height: 35px;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2));
        }

        .header h1 {
            margin: 0;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .header .nav-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .header .btn-nav {
            color: rgba(255, 255, 255, 0.7);
            font-size: 18px;
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            text-decoration: none;
            transition: all 0.2s;
            background: rgba(255, 255, 255, 0.1);
        }

        .header .btn-nav:hover {
            color: white;
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
        }

        .header .btn-nav.active {
            color: var(--accent);
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 0 10px rgba(243, 156, 18, 0.3);
        }

        .header .btn-home {
            color: white;
            font-size: 20px;
            margin-left: 5px;
        }

        /* --- Main Content Layout --- */
        .container {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 30px 20px;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
            box-sizing: border-box;
        }

        /* Removed .mode-switcher styles */

        /* --- Scanner Card --- */
        .validator-card {
            background: var(--card-bg);
            width: 100%;
            max-width: 500px;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            position: relative;
            display: flex;
            flex-direction: column;
        }

        .scanner-view {
            width: 100%;
            aspect-ratio: 1 / 1;
            background: #000;
            position: relative;
        }

        #reader {
            width: 100%;
            height: 100%;
            border: none !important;
        }

        /* html5-qrcode overrides */
        #reader video {
            object-fit: cover !important;
        }

        .scanner-overlay {
            position: absolute;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 8px 16px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
            z-index: 10;
            backdrop-filter: blur(4px);
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: var(--danger);
        }

        .status-dot.active {
            background-color: var(--success);
            box-shadow: 0 0 8px var(--success);
        }

        /* --- Controls Area --- */
        .controls-panel {
            padding: 25px;
            background: #fff;
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .btn-round {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-accent {
            background-color: var(--accent);
            color: white;
        }

        .btn-round:hover { transform: scale(1.1); }
        .btn-round:active { transform: scale(0.9); }

        /* --- Responsive Adjustments --- */
        @media (max-width: 480px) {
            .container { padding: 0; }
            .validator-card { 
                border-radius: 0; 
                max-width: none;
                flex: 1;
                box-shadow: none;
            }
            .mode-switcher { 
                margin: 15px auto; 
                width: 90%;
            }
            .scanner-view {
                flex: 1;
                aspect-ratio: auto;
            }
            .header img { height: 30px; }
            .header h1 { font-size: 14px; }
        }

        /* Custom Swal for results */
        .user-swal-popup { border-radius: 20px !important; }
    </style>
</head>
<body>

    <header class="header">
        <div class="logo-box">
            <img src="{{ asset('Logo/Siris.png') }}" alt="Logo">
            <h1>Validador de Carnets</h1>
        </div>
        <div class="nav-actions">
            <a href="{{ route('admin.carnet.validador') }}" class="btn-nav active" title="Escanear QR">
                <i class="fa-solid fa-camera"></i>
            </a>
            <a href="{{ route('admin.carnet.validador_manual') }}" class="btn-nav" title="Ingreso Manual">
                <i class="fa-solid fa-keyboard"></i>
            </a>
            <a href="/" class="btn-nav btn-home" title="Inicio">
                <i class="fa-solid fa-house"></i>
            </a>
        </div>
    </header>

    <main class="container">
        <!-- Validator Card -->
        <div class="validator-card">
            <div class="scanner-view">
                <div class="scanner-overlay">
                    <div class="status-dot" id="cameraStatus"></div>
                    <span id="cameraStatusText">Iniciando cámara...</span>
                </div>
                <div id="reader"></div>
            </div>

            <div class="controls-panel">
                <button class="btn-round btn-primary" id="btnToggleScanner" onclick="toggleScanner()" title="Play/Pause">
                    <i class="fa-solid fa-play" id="iconToggle"></i>
                </button>
                <a href="{{ route('admin.carnet.validador_manual') }}" class="btn-round btn-accent" title="Ingreso Manual">
                    <i class="fa-solid fa-keyboard"></i>
                </a>
            </div>
        </div>
    </main>

    <script>
        let html5QrCode;
        let isScanning = false;

        document.addEventListener("DOMContentLoaded", () => {
            html5QrCode = new Html5Qrcode("reader");
            // Small delay for mobile browsers to stabilize
            setTimeout(startScanner, 500);
        });

        // Lifecycle management
        document.addEventListener("visibilitychange", () => {
            if (document.hidden && isScanning) stopScanner();
        });

        function updateToggleBtn() {
            const icon = document.getElementById('iconToggle');
            icon.className = isScanning ? 'fa-solid fa-pause' : 'fa-solid fa-play';
        }

        function toggleScanner() {
            isScanning ? stopScanner() : startScanner();
        }

        function startScanner() {
            if (isScanning) return;
            
            const statusText = document.getElementById('cameraStatusText');
            const statusDot = document.getElementById('cameraStatus');

            statusText.innerText = "Solicitando cámara...";

            // Robust Camera start for Mobile
            Html5Qrcode.getCameras().then(devices => {
                if (devices && devices.length) {
                    // Try to find environment camera
                    const backCamera = devices.find(device => device.label.toLowerCase().includes('back') || device.label.toLowerCase().includes('entorno') || device.label.toLowerCase().includes('rear'));
                    const cameraId = backCamera ? backCamera.id : devices[0].id;

                    const containerWidth = document.getElementById('reader').clientWidth;
                    const qrBoxSize = Math.min(containerWidth * 0.7, 300);

                    const config = { 
                        fps: 15, 
                        qrbox: { width: qrBoxSize, height: qrBoxSize },
                        aspectRatio: 1.0,
                        supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA]
                    };

                    html5QrCode.start(cameraId, config, (decodedText) => {
                        if (!isScanning) return;
                        stopScanner();
                        verifyCarnet(decodedText);
                    }, undefined)
                    .then(() => {
                        isScanning = true;
                        statusText.innerText = "Escáner Activo";
                        statusDot.classList.add('active');
                        updateToggleBtn();
                    })
                    .catch(err => handleCameraError(err));
                } else {
                    handleCameraError("No se detectaron cámaras.");
                }
            }).catch(err => handleCameraError(err));
        }

        function handleCameraError(err) {
            console.error(err);
            const statusText = document.getElementById('cameraStatusText');
            const statusDot = document.getElementById('cameraStatus');
            
            statusText.innerText = "Cámara No Disponible";
            statusDot.classList.remove('active');

            let msg = 'No se pudo acceder a la cámara.';
            if (location.protocol !== 'https:' && location.hostname !== 'localhost') {
                msg = 'Error de Seguridad: La cámara requiere una conexión segura (HTTPS).';
            } else if (err.name === 'NotAllowedError' || err === 'Permission denied') {
                msg = 'Permiso denegado: Por favor, permite el acceso a la cámara en los ajustes del navegador.';
            }

            Swal.fire({
                icon: 'warning',
                title: 'Acceso a Cámara',
                text: msg,
                confirmButtonText: 'Entendido',
                footer: '<a href="javascript:location.reload()">Reintentar Cargar Página</a>'
            });
        }

        function stopScanner() {
            if (isScanning && html5QrCode) {
                html5QrCode.stop().then(() => {
                    isScanning = false;
                    document.getElementById('cameraStatusText').innerText = "Escaneo Pausado";
                    document.getElementById('cameraStatus').classList.remove('active');
                    updateToggleBtn();
                });
            }
        }

        function verifyCarnet(data) {
            // Basic extraction if it's a URL or raw ID
            let cedula = data;
            if (data.includes('?token=')) {
                try { cedula = new URL(data).searchParams.get('token'); } catch(e) {}
            }
            
            Swal.fire({
                title: 'Verificando...',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            // Endpoint logic remains the same
            const url = data.includes('?token=') ? `/api/carnet/token/${cedula}` : `/api/carnet/validar?cedula=${cedula.replace(/\D/g,'')}`;

            fetch(url)
                .then(res => res.json())
                .then(data => {
                    if (data.encontrado || data.cedula) {
                        showResult(data);
                    } else {
                        showError("Documento no válido o no encontrado.");
                    }
                })
                .catch(() => showError("Error de conexión con el servidor."));
        }

        function showResult(data) {
            const isVigente = data.activo !== false && data.esActivo !== false;
            
            Swal.fire({
                icon: isVigente ? 'success' : 'error',
                title: isVigente ? 'ACTIVO' : 'INACTIVO',
                html: `
                    <div style="text-align:center; padding: 10px 0;">
                        <h3 style="margin:0; color:var(--primary);">${data.nombre}</h3>
                        <p style="margin:8px 0; font-weight:600;">CC: ${data.cedula}</p>
                        <p style="margin:5px 0; color:#555;">${data.cargo || ''}</p>
                        <hr style="margin: 15px 0; border:0; border-top: 1px solid #eee;">
                        <p style="margin:0; font-size: 13px; color: #777;">${data.sede || ''}</p>
                        <p style="margin:5px 0; font-size: 13px; color: #777;">${data.vigencia || ''}</p>
                    </div>
                `,
                confirmButtonText: 'Continuar',
                confirmButtonColor: isVigente ? '#003f74' : '#dc3545',
                customClass: { popup: 'user-swal-popup' }
            }).then(() => startScanner());
        }

        function showError(msg) {
            Swal.fire({
                icon: 'warning',
                title: 'Aviso',
                text: msg,
                confirmButtonText: 'Reintentar'
            }).then(() => startScanner());
        }
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Validador Manual - DISAJ</title>

    <!-- Google Fonts & FontAwesome -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

        /* --- Manual Input Card --- */
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
            padding: 40px 30px;
            box-sizing: border-box;
            text-align: center;
        }

        .validator-card i.main-icon {
            font-size: 60px;
            color: var(--primary);
            margin-bottom: 25px;
            display: block;
        }

        .validator-card h2 {
            margin: 0 0 10px;
            font-size: 22px;
            font-weight: 700;
            color: var(--primary);
        }

        .validator-card p {
            color: #666;
            margin-bottom: 30px;
            font-size: 15px;
        }

        .form-group {
            margin-bottom: 25px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            font-size: 14px;
            color: #444;
        }

        .input-group {
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
        }

        .form-control {
            width: 100%;
            padding: 15px 15px 15px 45px;
            border-radius: 12px;
            border: 2px solid #eee;
            font-size: 18px;
            font-weight: 600;
            box-sizing: border-box;
            transition: all 0.3s;
            outline: none;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(0, 63, 116, 0.1);
        }

        .btn-validate {
            background-color: var(--primary);
            color: white;
            border: none;
            width: 100%;
            padding: 16px;
            border-radius: 12px;
            font-size: 16px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            box-shadow: 0 4px 15px rgba(0, 63, 116, 0.3);
        }

        .btn-validate:hover {
            background-color: var(--primary-light);
            transform: translateY(-2px);
        }

        /* --- Footer Link --- */
        .footer-link {
            margin-top: 25px;
        }

        .btn-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: color 0.2s;
        }

        .btn-link:hover { color: var(--accent); }

        /* --- Responsive Adjustments --- */
        @media (max-width: 480px) {
            .container { padding: 0; }
            .validator-card { 
                border-radius: 0; 
                max-width: none;
                flex: 1;
                box-shadow: none;
                background: transparent;
                padding-top: 20px;
            }
            .mode-switcher { 
                margin: 15px auto; 
                width: 90%;
            }
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
            <a href="{{ route('admin.carnet.validador') }}" class="btn-nav" title="Escanear QR">
                <i class="fa-solid fa-camera"></i>
            </a>
            <a href="{{ route('admin.carnet.validador_manual') }}" class="btn-nav active" title="Ingreso Manual">
                <i class="fa-solid fa-keyboard"></i>
            </a>
            <a href="/" class="btn-nav btn-home" title="Inicio">
                <i class="fa-solid fa-house"></i>
            </a>
        </div>
    </header>

    <main class="container">
        <!-- Manual Input Card -->
        <div class="validator-card">
            <i class="fa-solid fa-id-card-clip main-icon"></i>
            <h2>Validación Manual</h2>
            <p>Ingrese el número de documento para verificar el estado de vigencia.</p>

            <form id="formManual" onsubmit="handleValidate(event)">
                <div class="form-group">
                    <label for="cedula">Cédula del Funcionario</label>
                    <div class="input-group">
                        <i class="fa-solid fa-user-tag"></i>
                        <input type="tel" id="cedula" class="form-control" placeholder="Ej: 12345678" required autofocus>
                    </div>
                </div>

                <button type="submit" class="btn-validate">
                    <i class="fa-solid fa-magnifying-glass"></i> Validar Documento
                </button>
            </form>

            <div class="footer-link">
                <a href="{{ route('admin.carnet.validador') }}" class="btn-link">
                    <i class="fa-solid fa-camera"></i> O prefiero usar el escáner de cámara
                </a>
            </div>
        </div>
    </main>

    <script>
        function handleValidate(event) {
            event.preventDefault();
            const cedula = document.getElementById('cedula').value.trim();
            if (!cedula) return;

            verifyCarnet(cedula);
        }

        function verifyCarnet(cedula) {
            Swal.fire({
                title: 'Verificando...',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });

            fetch(`/api/carnet/validar?cedula=${cedula.replace(/\D/g,'')}`)
                .then(res => res.json())
                .then(data => {
                    if (data.encontrado || data.cedula) {
                        showResult(data);
                    } else {
                        showError("Documento no encontrado o no autorizado");
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
                confirmButtonText: 'Nueva Consulta',
                confirmButtonColor: isVigente ? '#003f74' : '#dc3545',
                customClass: { popup: 'user-swal-popup' }
            }).then(() => {
                document.getElementById('cedula').value = '';
                document.getElementById('cedula').focus();
            });
        }

        function showError(msg) {
            Swal.fire({
                icon: 'warning',
                title: 'Aviso',
                text: msg,
                confirmButtonText: 'Reintentar'
            });
        }
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Consulta tu carnet digital - Dirección Seccional de Administración Judicial Cali">
    <title>Consulta Carnet Digital | DISAJ Cali</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --verde:   #004182;
            --verde-d: #005a4e;
            --verde-l: #00a38f;
            --dorado:  #c8a84b;
            --fondo:   #f0f4f3;
            --blanco:  #ffffff;
            --gris:    #6b7280;
            --error:   #ef4444;
            --radio:   14px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--fondo);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* ── Header institucional ── */
        header {
            width: 100%;
            background: var(--verde);
            padding: 18px 32px;
            display: flex;
            align-items: center;
            gap: 20px;
            box-shadow: 0 4px 18px rgba(0,0,0,.25);
        }
        header img { height: 52px; filter: brightness(0) invert(1); }
        header .header-text { color: #fff; }
        header .header-text h1 { font-size: 1rem; font-weight: 700; line-height: 1.3; }
        header .header-text span { font-size: .8rem; opacity: .85; }

        /* ── Hero ── */
        .hero {
            width: 100%;
            background: linear-gradient(135deg, var(--verde-d) 0%, var(--verde) 55%, var(--verde-l) 100%);
            padding: 56px 20px 80px;
            text-align: center;
            color: #fff;
            position: relative;
            overflow: hidden;
        }
        .hero::before {
            content: '';
            position: absolute; inset: 0;
            background-image: radial-gradient(circle at 20% 50%, rgba(255,255,255,.07) 0%, transparent 60%),
                              radial-gradient(circle at 80% 20%, rgba(200,168,75,.15) 0%, transparent 50%);
        }
        .hero .icon-badge {
            width: 80px; height: 80px;
            background: rgba(255,255,255,.15);
            border: 2px solid rgba(255,255,255,.3);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 20px;
            font-size: 2rem;
            backdrop-filter: blur(6px);
        }
        .hero h2 { font-size: 2rem; font-weight: 700; margin-bottom: 8px; position: relative; }
        .hero p  { font-size: 1rem; opacity: .88; position: relative; }

        /* ── Tarjeta formulario ── */
        .card-wrap {
            width: 100%;
            max-width: 520px;
            margin: -48px auto 40px;
            padding: 0 16px;
        }
        .card {
            background: var(--blanco);
            border-radius: 20px;
            padding: 40px 36px;
            box-shadow: 0 20px 60px rgba(0,0,0,.12);
            animation: slideUp .5s ease both;
        }
        @keyframes slideUp {
            from { opacity:0; transform:translateY(30px); }
            to   { opacity:1; transform:translateY(0);    }
        }

        .card-title {
            font-size: 1.15rem;
            font-weight: 700;
            color: #1a1a2e;
            margin-bottom: 6px;
        }
        .card-subtitle {
            font-size: .85rem;
            color: var(--gris);
            margin-bottom: 28px;
        }
        .divider {
            height: 3px;
            background: linear-gradient(90deg, var(--verde), var(--dorado));
            border-radius: 2px;
            margin-bottom: 28px;
        }

        /* ── Campos ── */
        .field { margin-bottom: 22px; }
        label {
            display: block;
            font-size: .82rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 7px;
            text-transform: uppercase;
            letter-spacing: .5px;
        }
        .input-wrap {
            position: relative;
            display: flex;
            align-items: center;
        }
        .input-wrap .icon {
            position: absolute;
            left: 14px;
            color: var(--verde);
            font-size: 1rem;
            pointer-events: none;
        }
        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 13px 14px 13px 42px;
            border: 2px solid #e2e8f0;
            border-radius: var(--radio);
            font-size: .95rem;
            font-family: 'Inter', sans-serif;
            color: #1a202c;
            background: #f8fafc;
            transition: border .25s, box-shadow .25s, background .25s;
            outline: none;
        }
        input:focus {
            border-color: var(--verde);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(0,125,110,.15);
        }
        .field-hint {
            font-size: .78rem;
            color: var(--gris);
            margin-top: 5px;
        }

        /* ── Errores ── */
        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            border-left: 4px solid var(--error);
            border-radius: var(--radio);
            padding: 14px 16px;
            margin-bottom: 20px;
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }
        .alert-error i { color: var(--error); margin-top: 2px; }
        .alert-error ul { list-style: none; }
        .alert-error ul li { font-size: .88rem; color: #b91c1c; }

        /* ── Botón ── */
        .btn-consultar {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, var(--verde), var(--verde-l));
            color: #fff;
            font-size: 1rem;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            border: none;
            border-radius: var(--radio);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: transform .2s, box-shadow .2s, filter .2s;
            box-shadow: 0 6px 20px rgba(0,125,110,.4);
            letter-spacing: .4px;
            margin-top: 6px;
        }
        .btn-consultar:hover  { transform: translateY(-2px); filter: brightness(1.08); box-shadow: 0 10px 28px rgba(0,125,110,.5); }
        .btn-consultar:active { transform: translateY(0);    }

        /* ── Seguridad notice ── */
        .notice {
            margin-top: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--gris);
            font-size: .78rem;
            background: #f1f5f9;
            padding: 10px 14px;
            border-radius: 10px;
        }
        .notice i { color: var(--verde); }

        /* ── Footer ── */
        footer {
            margin-top: auto;
            padding: 20px;
            text-align: center;
            font-size: .78rem;
            color: var(--gris);
        }

        @media(max-width: 480px) {
            .card { padding: 28px 20px; }
            .hero h2 { font-size: 1.5rem; }
        }
    </style>
</head>
<body>

<header>
    <img src="https://www.disajcali.gov.co/img/logoLargo.png" alt="DISAJ Cali" onerror="this.style.display='none">
    <div class="header-text">
        <h1>Dirección Seccional de Administración Judicial</h1>
        <span>Cali – Valle del Cauca</span>
    </div>
</header>

<div class="hero">
    <div class="icon-badge"><i class="fa-solid fa-id-card"></i></div>
    <h2>Consulta tu Carnet Digital</h2>
    <p>Ingresa tu cédula y fecha de expedición para verificar y visualizar tu carnet institucional</p>
</div>

<div class="card-wrap">
    <div class="card">
        <p class="card-title"><i class="fa-solid fa-magnifying-glass" style="color:var(--verde);margin-right:8px;"></i>Datos de consulta</p>
        <p class="card-subtitle">Todos los campos son obligatorios</p>
        <div class="divider"></div>

        {{-- Errores de validación --}}
        @if($errors->any())
        <div class="alert-error">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Error de búsqueda (empleado no encontrado) --}}
        @if(session('error'))
        <div class="alert-error">
            <i class="fa-solid fa-triangle-exclamation"></i>
            <ul><li>{{ session('error') }}</li></ul>
        </div>
        @endif

        <form action="{{ route('carnet.consultar') }}" method="POST" id="formCarnet" autocomplete="off">
            @csrf

            <div class="field">
                <label for="cedula"><i class="fa-solid fa-fingerprint" style="margin-right:5px;"></i>Número de Cédula</label>
                <div class="input-wrap">
                    <i class="icon fa-solid fa-id-badge"></i>
                    <input
                        type="text"
                        id="cedula"
                        name="cedula"
                        placeholder="Ej: 1001234567"
                        maxlength="15"
                        pattern="[0-9]+"
                        value="{{ old('cedula') }}"
                        required
                        inputmode="numeric"
                    >
                </div>
                <p class="field-hint">Solo números, sin puntos ni espacios</p>
            </div>

            <div class="field">
                <label for="fecha_expedicion"><i class="fa-solid fa-calendar-day" style="margin-right:5px;"></i>Fecha de Expedición</label>
                <div class="input-wrap">
                    <i class="icon fa-solid fa-calendar-check"></i>
                    <input
                        type="date"
                        id="fecha_expedicion"
                        name="fecha_expedicion"
                        max="{{ date('Y-m-d') }}"
                        value="{{ old('fecha_expedicion') }}"
                        required
                    >
                </div>
                <p class="field-hint">Fecha de expedición de la cédula tal como aparece en el documento</p>
            </div>

            <button type="submit" class="btn-consultar" id="btnConsultar">
                <i class="fa-solid fa-search"></i>
                Consultar Carnet
            </button>
        </form>

        <div class="notice">
            <i class="fa-solid fa-shield-halved"></i>
            <span>Tus datos se procesan de forma segura y no son almacenados en esta consulta.</span>
        </div>
    </div>
</div>

<footer>
    &copy; {{ date('Y') }} Dirección Seccional de Administración Judicial · Cali, Valle del Cauca
</footer>

<script>
    // Auto-format cédula (solo dígitos)
    document.getElementById('cedula').addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '');
    });

    // Loading state en el botón
    document.getElementById('formCarnet').addEventListener('submit', function() {
        const btn = document.getElementById('btnConsultar');
        btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Consultando...';
        btn.disabled = true;
    });
</script>
</body>
</html>

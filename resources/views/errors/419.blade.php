<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Error 419 | Sesión expirada</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            min-height: 100vh;
            overflow: hidden;
            color: #1f2937;
        }

        /* Fondo simbólico justicia */
        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background-image: url("https://www.transparenttextures.com/patterns/diagmonds-light.png");
            opacity: 0.08;
            z-index: 0;
        }

        .error-container {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }

        .card-error {
            max-width: 420px;
            width: 100%;
            padding: 2.8rem 2.5rem;
            border-radius: 18px;
            text-align: center;
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            box-shadow:
                0 20px 40px rgba(0, 0, 0, 0.25),
                inset 0 1px 0 rgba(255, 255, 255, 0.6);
            animation: fadeIn 0.8s ease;
        }

        .card-error img {
            width: 90px;
            margin-bottom: 1.5rem;
            filter: drop-shadow(0 6px 10px rgba(0,0,0,0.25));
        }

        .error-code {
            letter-spacing: 4px;
            font-size: 0.85rem;
            font-weight: 600;
            color: #6b7280;
        }

        .card-error h2 {
            font-weight: 600;
            color: #111827;
        }

        .card-error p {
            color: #4b5563;
            font-size: 0.95rem;
        }

        .btn-justice {
            background: linear-gradient(135deg, #1e3c72, #2a5298);
            border: none;
            padding: 0.65rem 1.8rem;
            font-weight: 500;
            border-radius: 10px;
            color: #fff;
            box-shadow: 0 10px 20px rgba(30, 60, 114, 0.35);
            transition: all 0.3s ease;
        }

        .btn-justice:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(30, 60, 114, 0.45);
            color: #fff;
        }

        .redirect-info {
            margin-top: 1.2rem;
            font-size: 0.8rem;
            color: #6b7280;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

<div class="error-container">
    <div class="card-error">
        <img src="{{ asset('img/Error419.png') }}" alt="Error 419">

        <div class="error-code mb-2">ERROR 419</div>

        <h2 class="mb-3">Sesión expirada</h2>

        <p class="mb-4">
            Por motivos de seguridad, tu sesión fue cerrada automáticamente
            debido a inactividad prolongada.
        </p>

        <a href="{{ route('logout.redirect') }}" class="btn btn-justice">
            Volver a iniciar sesión
        </a>

        <div class="redirect-info">
            Serás redirigido automáticamente en unos segundos…
        </div>
    </div>
</div>

<script>
    setTimeout(() => {
        window.location.href = "{{ route('logout.redirect') }}";
    }, 5000);
</script>

</body>
</html>




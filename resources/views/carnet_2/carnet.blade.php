<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{asset('img/icono.png')}}">
    <title>Carnet de Identificación</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f4f8;
            margin: 0;
            overflow: hidden;
        }

        .carnet {
            width: 350px;
            background: linear-gradient(135deg, #ffffff, #e6f0ff);
            padding: 20px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
            position: relative;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            user-select: none;
            cursor: pointer;
        }

        .carnet:hover {
            transform: scale(1.03);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }

        .logo {
            width: 80%;
            margin-bottom: 15px;
        }

        .foto {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #007bff;
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
        }

        .barcode img {
            width: 120px;
            height: 50px;
        }

        .barcode {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 15px;
        }

        .footer {
            background: linear-gradient(to right, #007bff, #0056b3);
            color: white;
            padding: 8px;
            font-weight: bold;
            border-radius: 8px;
            margin-top: 12px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            font-size: 12px;
            line-height: 1.4;
        }

        .watermark {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://www.disajcali.gov.co/img/logoLargo.png');
            background-repeat: repeat;
            background-size: 30px;
            opacity: 0.08;
            pointer-events: none;
            animation: watermark-move 20s linear infinite;
        }

        @keyframes watermark-move {
            0% { background-position: 0 0; }
            100% { background-position: 100px 100px; }
        }

        .hologram {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 50px;
            height: 50px;
            background: radial-gradient(circle, rgba(0,123,255,0.3), transparent);
            border-radius: 50%;
            opacity: 0.5;
            animation: hologram-glow 2s ease-in-out infinite;
        }

        @keyframes hologram-glow {
            0% { transform: scale(1); opacity: 0.5; }
            50% { transform: scale(1.2); opacity: 0.8; }
            100% { transform: scale(1); opacity: 0.5; }
        }

        /* Sección Google Wallet */
        .wallet-section {
            margin-top: 25px;
            text-align: center;
        }

        .btn-google img {
            width: 180px;
            vertical-align: middle;
            transition: transform 0.2s ease;
        }

        .btn-google img:hover {
            transform: scale(1.05);
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 10;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.4);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fefefe;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 320px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 22px;
            font-weight: bold;
            cursor: pointer;
        }

        .close:hover {
            color: black;
        }

        .valid-text {
            font-size: 13px;
            margin-top: 10px;
        }
    </style>
</head>
<body oncontextmenu="return false;">

    <!-- CARNET INTERACTIVO -->
    <div class="carnet" onclick="showValidation()">
        <div class="watermark"></div>
        <div class="hologram"></div>

        <img class="logo" src="https://www.disajcali.gov.co/img/logoLargo.png" alt="Logo">
        <img class="foto" src="{{ $carnet->user->foto ?? 'https://www.disajcali.gov.co/img/carnet/prueba_carnet.jpg' }}" alt="Foto">

        <h2>{{ strtoupper($carnet->user->nameE) }} {{ strtoupper($carnet->user->lastnameE) }}</h2>
        <p><strong>Cédula:</strong> {{ $carnet->user->cedulaE }}</p>
        <p><strong>Cargo:</strong> {{ strtoupper($carnet->user->cargo_titular) }}</p>

        <div class="barcode">
            @php
                $barcodeUrl = "https://barcode.tec-it.com/barcode.ashx?data={$carnet->user->cedulaE}&code=Code128";
            @endphp
            <img src="{{ $barcodeUrl }}" alt="Código de Barras">
        </div>

        <div class="footer">
            DIRECCIÓN SECCIONAL DE ADMINISTRACIÓN JUDICIAL<br>
            CALI, VALLE DEL CAUCA
        </div>

        <p class="valid-text">Toca el carnet para validar su autenticidad.</p>
    </div>

    <!-- Sección separada para Google Wallet -->
    <div class="wallet-section">
        <p><strong>Agregar carnet a tu billetera digital:</strong></p>
        <a class="btn btn-google" href="{{ $googleWalletLink }}" target="_blank">
            <img src="https://developers.google.com/wallet/images/save-to-google-wallet-button.svg" alt="Guardar en Google Wallet">
        </a>
    </div>

    <!-- Modal de validación -->
    <div id="validationModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h3>Validación del Carnet</h3>
            <p><strong>Fecha de Vigencia:</strong> {{ $carnet->valid_from ?? 'No disponible' }}</p>
            <p><strong>Estado:</strong> {{ $carnet->activo ? 'Activo' : 'Inactivo' }}</p>

            @if($carnet->activo && strtotime($carnet->valid_until) >= time())
                <p style="color: green;">✅ El carnet es válido.</p>
            @else
                <p style="color: red;">❌ El carnet no es válido o ha expirado.</p>
            @endif
        </div>
    </div>

    <script>
        function showValidation() {
            document.getElementById('validationModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('validationModal').style.display = 'none';
        }

        window.onclick = function(event) {
            const modal = document.getElementById('validationModal');
            if (event.target === modal) modal.style.display = 'none';
        };
    </script>

</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carnet de Identificación</title>
    <style>
        /* ... copia exacta de tu CSS ... */
        body { font-family: Arial, sans-serif; display:flex; justify-content:center; align-items:center; height:100vh; background-color:#f5f5f5; }
        .carnet{ width:350px; background:white; padding:20px; border-radius:10px; text-align:center; box-shadow:0 0 10px rgba(0,0,0,0.2); position:relative;}
        .logo{ width:80%; margin-bottom:10px; }
        .foto{ width:120px; height:120px; border-radius:50%; object-fit:cover; border:5px solid blue; }
        .qr{ display:flex; justify-content:center; align-items:center; margin-top:15px; }
        .qr img{ width:80px; height:80px; }
        .barcode img{ width:120px; height:50px; }
        .barcode{ display:flex; justify-content:center; align-items:center; margin-top:15px; }
        .footer{ background:blue; color:white; padding:6px; font-weight:bold; border-radius:5px; margin-top:12px; }
        .watermark{ position:absolute; top:0; left:0; width:100%; height:100%; background-image:url('https://www.disajcali.gov.co/img/logoLargo.png'); background-repeat:repeat; background-size:20px; opacity:0.1; pointer-events:none; }
        .wallet-btn{ margin-top:10px; display:inline-block; padding:10px 12px; background:#0F9D58; color:white; text-decoration:none; border-radius:6px; font-weight:bold;}
    </style>
</head>
<body>

    <div class="carnet">
        <div class="watermark"></div>
        <img class="logo" src="https://www.disajcali.gov.co/img/logoLargo.png" alt="Logo">
        
        <img class="foto" src="{{ $carnet->foto_url ?? 'https://www.disajcali.gov.co/img/carnet/prueba_carnet.jpg' }}" alt="Foto"> 

        <h2>{{ strtoupper($carnet->user->name) }}</h2>
        <p><strong>Cédula:</strong> {{ $carnet->cedula }}</p>
        <p><strong>Cargo:</strong> {{ $carnet->cargo }}</p>
        
        <div class="barcode">
            <img src="{{ $barcodeUrl }}" alt="Código de Barras">
        </div>

        <div class="qr">
          <img src="{{ $qrUrl }}" alt="QR Code">
        </div>
        
        <div class="footer">
            <p style="font-family: Arial; font-size: 13px; color: white; font-weight:bold;">
                DIRECCIÓN SECCIONAL DE ADMINISTRACIÓN JUDICIAL<br>
                CALI, VALLE DEL CAUCA
            </p>
        </div>

        <div style="margin-top:8px;">
            validar carnet: <a href="https://www.disajcali.gov.co/carnet" target="_blank">www.disajcali.gov.co/carnet</a>
        </div>

        {{-- Botón para añadir a Google Wallet --}}
        <div style="margin-top:12px;">
            <a class="wallet-btn" href="{{ $saveUrl }}" target="_blank" rel="noopener">
                Añadir a Google Wallet
            </a>
        </div>
    </div>

    
    <script>
        async function obtenerSaveUrl(carnetId){
          const res = await fetch(`/wallet/carnet/${carnetId}/save-url`, { credentials: 'same-origin' });
          const json = await res.json();
          if (res.ok && json.saveUrl) {
            // abre la URL para que el usuario añada a Google Wallet
            window.open(json.saveUrl, '_blank');
          } else {
            alert(json.error || 'No se pudo generar el enlace a Google Wallet.');
          }
        }
        </script>
        
        <!-- Botón -->
        <a class="wallet-btn" href="javascript:void(0)" onclick="obtenerSaveUrl({{ $carnet->id }})">Añadir a Google Wallet</a>
        

</body>
</html>

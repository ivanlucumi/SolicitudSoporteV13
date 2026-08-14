<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carnet de Identificación</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
        }
        .carnet {
            width: 350px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            position: relative;
        }
        .logo {
            width: 80%;
            margin-bottom: 10px;
        }
        .foto {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid blue;
        }
        .qr {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 15px;
        }
        .qr img {
            width: 80px;
            height: 80px;
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
            background: blue;
            color: white;
            padding: 6px;
            font-weight: bold;
            border-radius: 5px;
            margin-top: 12px;
        }
         /* Marcas de agua */
        .watermark {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://www.disajcali.gov.co/img/logoLargo.png'); /* Logo en marca de agua */
            background-repeat: repeat;
            background-size: 20px; /* Tamaño de cada marca */
            opacity: 0.1; /* Transparencia de la marca de agua */
            pointer-events: none; /* Evita que interfiera con el contenido */
        }
    </style>
</head>
<body>

    <div class="carnet">
        <div class="watermark"></div> <!-- Capa de marca de agua -->
        <img class="logo" src="https://www.disajcali.gov.co/img/logoLargo.png" alt="Logo">
        
        <img class="foto" src="https://www.disajcali.gov.co/img/carnet/prueba_carnet.jpg" alt="Foto"> 

        <h2>WILLIAN RIVERA LUNA</h2>
        <p><strong>Cédula:</strong> 462532566</p>
        <p><strong>Cargo:</strong> EMPLEADO JUDICIAL</p>
        
        <div class="barcode">
            @php
            $codigo = "462532566"; // Usa la cédula o un valor por defecto
            $barcodeUrl = "https://barcode.tec-it.com/barcode.ashx?data={$codigo}&code=Code128&translate-esc=on";
            @endphp
            
            <img src="{{ $barcodeUrl }}" alt="Código de Barras">
        </div>

        <!--div class="qr">
          @php
          $texto = "10101010101-IVAN CAMILO LUCUMI GARCIA"; // Texto o URL a codificar
          $tamano = 200;
          $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size={$tamano}x{$tamano}&data=" . urlencode($texto);
          @endphp
          
          <img src="{{ $qrUrl }}" alt="QR Code">
          
        </div-->
        
        <div class="footer">
            <p style="font-family: Arial; font-size: 13px; color: white; font-weight: bold;">
                DIRECCIÓN SECCIONAL DE ADMINISTRACIÓN JUDICIAL<br>
                CALI, VALLE DEL CAUCA
            </p>
        </div>
        <FONT  SIZE=3 COLOR="black">
            validar carnet: <a href="www.disajcali.gov.co/carnet" target="_blank"></a>www.disajcali.gov.co/carnet </FONT>

        
        
    </div>

</body>
</html>

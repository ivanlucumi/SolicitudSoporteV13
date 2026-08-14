@extends('layouts.ensayo')

<!--ponerle titulo a la paginga-->

@section('title', 'Generar Código QR')



@section('content') 

    <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex, nofollow">

 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para iconos -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- Librería para generar QR -->
    <script src="https://cdn.rawgit.com/davidshimjs/qrcodejs/gh-pages/qrcode.min.js"></script>
    <style>
        body {
            background: #f5f5f5;
            font-family: 'Helvetica Neue', Arial, sans-serif;
            padding-top: 40px;
            padding-bottom: 40px;
        }
        .qr-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }
        .qr-image-container {
            padding: 20px;
            background: #f9f9f9;
            border-radius: 4px;
            margin: 25px 0;
            border: 1px solid #eee;
            text-align: center;
            min-height: 256px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .qr-title {
            color: #337ab7;
            margin-bottom: 30px;
            text-align: center;
            font-weight: 300;
        }
        .btn-action {
            transition: all 0.3s ease;
            padding: 10px 20px;
            font-size: 16px;
        }
        .btn-generate {
            background: #5bc0de;
            color: white;
            border: none;
        }
        .btn-generate:hover {
            background: #46b8da;
            color: white;
        }
        .btn-download {
            background: #5cb85c;
            color: white;
            border: none;
            margin-left: 10px;
        }
        .btn-download:hover {
            background: #449d44;
            color: white;
        }
        .qr-footer {
            margin-top: 30px;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #eee;
            padding-top: 15px;
            text-align: center;
        }
        #qrcode img {
            max-width: 100%;
            height: auto;
            margin: 0 auto;
            display: block;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .instructions {
            margin: 20px 0;
            padding: 15px;
            background: #f8f9fa;
            border-left: 4px solid #5bc0de;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="qr-container">
            <h2 class="qr-title">
                <i class="fa fa-qrcode"></i> Generador de Códigos QR
            </h2>
            
            <div class="instructions">
                <p><strong>Instrucciones:</strong> Ingresa el texto o URL que deseas codificar en el QR y haz clic en "Generar QR".</p>
            </div>
            
            <div class="form-group">
                <label for="qrContent">Contenido para el QR:</label>
                <input type="text" class="form-control" id="qrContent" placeholder="Ej: https://ejemplo.com o tu texto" value="">
            </div>
            
            <div class="qr-image-container">
                <div id="qrcode"></div>
                <p id="emptyMessage" class="text-muted">El código QR aparecerá aquí</p>
            </div>
            
            <div class="text-center">
                <button id="generateBtn" class="btn btn-generate btn-action">
                    <i class="fa fa-refresh"></i> Generar QR
                </button>
                <button id="downloadBtn" class="btn btn-download btn-action" disabled>
                    <i class="fa fa-download"></i> Descargar QR
                </button>
            </div>
            
            <div class="qr-footer">
                <p>Sistema de generación de códigos QR &copy; <span id="currentYear"></span></p>
            </div>
        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap 3 JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Mostrar año actual
            $('#currentYear').text(new Date().getFullYear());
            
            // Variables
            let qrCode = null;
            const qrContainer = document.getElementById('qrcode');
            const emptyMessage = document.getElementById('emptyMessage');
            const downloadBtn = document.getElementById('downloadBtn');
            
            // Función para generar el QR
            function generateQR() {
                const content = $('#qrContent').val().trim();
                
                if (!content) {
                    alert('Por favor ingresa un texto o URL para generar el QR');
                    return;
                }
                
                // Limpiar contenedor
                qrContainer.innerHTML = '';
                emptyMessage.style.display = 'none';
                
                // Crear nuevo QR
                qrCode = new QRCode(qrContainer, {
                    text: content,
                    width: 256,
                    height: 256,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.H
                });
                
                // Habilitar botón de descarga
                downloadBtn.disabled = false;
            }
            
            // Función para descargar el QR con borde
            function downloadQR() {
                if (!qrCode) {
                    alert('Primero genera un código QR');
                    return;
                }
                
                const canvas = document.querySelector('#qrcode canvas');
                if (!canvas) {
                    alert('No se pudo generar la imagen para descargar');
                    return;
                }
                
                // Crear un nuevo canvas con borde
                const borderedCanvas = document.createElement('canvas');
                const borderSize = 20; // Tamaño del borde en píxeles
                const borderedWidth = canvas.width + borderSize * 2;
                const borderedHeight = canvas.height + borderSize * 2;
                
                borderedCanvas.width = borderedWidth;
                borderedCanvas.height = borderedHeight;
                
                const ctx = borderedCanvas.getContext('2d');
                
                // Rellenar con color blanco (borde)
                ctx.fillStyle = '#ffffff';
                ctx.fillRect(0, 0, borderedWidth, borderedHeight);
                
                // Dibujar el QR centrado
                ctx.drawImage(canvas, borderSize, borderSize);
                
                // Crear enlace de descarga
                const link = document.createElement('a');
                link.href = borderedCanvas.toDataURL('image/png');
                link.download = 'codigo-qr-' + new Date().toISOString().slice(0, 10) + '.png';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
            
            // Event Listeners
            $('#generateBtn').click(generateQR);
            $('#downloadBtn').click(downloadQR);
            
            // Generar QR al cargar la página con valor por defecto
            generateQR();
        });
    </script>

@endsection
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR generado - Descarga tu código</title>
    <!-- Bootstrap 3 CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para iconos -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
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
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .qr-image-container {
            padding: 15px;
            background: #f9f9f9;
            border-radius: 4px;
            margin: 20px 0;
            border: 1px solid #eee;
        }
        .qr-title {
            color: #337ab7;
            margin-bottom: 25px;
        }
        .btn-download {
            background: #5cb85c;
            color: white;
        }
        .btn-download:hover {
            background: #449d44;
            color: white;
        }
        .status-message {
            display: none;
            margin-top: 15px;
            padding: 10px;
            border-radius: 4px;
        }
        .success {
            background: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
        }
        .error {
            background: #f2dede;
            color: #a94442;
            border: 1px solid #ebccd1;
        }
        .qr-footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="qr-container">
            <h2 class="qr-title text-center">
                <i class="fa fa-qrcode"></i> Código QR Generado
            </h2>
            
            <div class="text-center qr-image-container">
                <img id="qrImage" src="{{ $qrUrl }}" alt="Código QR" class="img-responsive center-block" style="max-width: 100%;">
            </div>
            
            <div id="statusMessage" class="status-message text-center"></div>
            
            <div class="row">
                <div class="col-sm-6">
                    <a href="{{ route('googleqrcode.form') }}" class="btn btn-default btn-block">
                        <i class="fa fa-refresh"></i> Generar otro QR
                    </a>
                </div>
                <div class="col-sm-6">
                    <button id="downloadBtn" class="btn btn-download btn-block">
                        <i class="fa fa-download"></i> Descargar QR
                    </button>
                </div>
            </div>
            
            <div class="qr-footer text-center">
                <p>Este código QR fue generado el {{ date('d/m/Y') }}. Válido por tiempo indefinido.</p>
            </div>
        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap 3 JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <script>
        $(document).ready(function() {
            // Mostrar mensaje de éxito
            function showSuccess(message) {
                var status = $('#statusMessage');
                status.removeClass('error').addClass('success').text(message).fadeIn();
                setTimeout(function() {
                    status.fadeOut();
                }, 5000);
            }
            
            // Mostrar mensaje de error
            function showError(message) {
                var status = $('#statusMessage');
                status.removeClass('success').addClass('error').text(message).fadeIn();
                setTimeout(function() {
                    status.fadeOut();
                }, 5000);
            }
            
            // Función para descargar la imagen
            function downloadImage() {
                var img = document.getElementById('qrImage');
                var canvas = document.createElement('canvas');
                var context = canvas.getContext('2d');
                
                // Verificar si la imagen ya está cargada
                if (!img.complete) {
                    showError('La imagen no se ha cargado completamente. Por favor, intente nuevamente.');
                    return;
                }
                
                try {
                    canvas.width = img.naturalWidth;
                    canvas.height = img.naturalHeight;
                    context.drawImage(img, 0, 0);
                    
                    var link = document.createElement('a');
                    link.href = canvas.toDataURL('image/png');
                    link.download = 'codigo-qr-' + new Date().toISOString().slice(0, 10) + '.png';
                    
                    // Simular click para descarga
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    
                    showSuccess('¡Descarga iniciada! El código QR se ha guardado.');
                } catch (e) {
                    showError('Error al generar la descarga: ' + e.message);
                    console.error(e);
                }
            }
            
            // Evento para el botón de descarga
            $('#downloadBtn').click(function() {
                downloadImage();
            });
            
            // Intentar descarga automática al cargar (opcional)
            try {
                downloadImage();
                showSuccess('Descarga automática iniciada. Si no funciona, use el botón de descarga.');
            } catch (e) {
                console.log('Descarga automática no disponible. Use el botón de descarga.');
            }
        });
    </script>
</body>
</html>
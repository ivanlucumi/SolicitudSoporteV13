$b64 = Get-Content -Raw "c:\laragon\www\SolicitudSoporteVer13\storage\base64_logo.txt"
$b64 = $b64.Trim()
$html = "<img src='data:image/png;base64,$b64' style='max-width: 180px; height: auto;'>"

$carro = Get-Content -Raw "c:\laragon\www\SolicitudSoporteVer13\resources\views\monitoreo\conductores\pdf_carro.blade.php"
$carro = $carro -replace '(?s)@php.*?@endif', $html
Set-Content -Path "c:\laragon\www\SolicitudSoporteVer13\resources\views\monitoreo\conductores\pdf_carro.blade.php" -Value $carro -Encoding UTF8

$moto = Get-Content -Raw "c:\laragon\www\SolicitudSoporteVer13\resources\views\monitoreo\conductores\pdf_moto.blade.php"
$moto = $moto -replace '(?s)@php.*?@endif', $html
Set-Content -Path "c:\laragon\www\SolicitudSoporteVer13\resources\views\monitoreo\conductores\pdf_moto.blade.php" -Value $moto -Encoding UTF8

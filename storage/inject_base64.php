<?php
$b64 = base64_encode(file_get_contents('c:\laragon\www\SolicitudSoporteVer13\public\img\logoLargo.png'));
$html = '<img src="data:image/png;base64,' . $b64 . '" style="max-width: 180px; height: auto;">';

$files = [
    'c:\laragon\www\SolicitudSoporteVer13\resources\views\monitoreo\conductores\pdf_carro.blade.php',
    'c:\laragon\www\SolicitudSoporteVer13\resources\views\monitoreo\conductores\pdf_moto.blade.php'
];

foreach ($files as $file) {
    $content = file_get_contents($file);
    // Remove the whole @php ... @endif block
    $content = preg_replace('/@php\s+\$logoPath.*?@endif/s', $html, $content);
    file_put_contents($file, $content);
}
echo "Done";

<p style="margin-top:0pt; margin-bottom:8pt; text-align:center; line-height:108%; font-size:20pt;"><strong><span style="font-family:'Arial Black';">REPORTE GENERADO DESDE SIRISCALI</span></strong></p>
<p style="margin-top:0pt; margin-bottom:8pt; text-align:center; line-height:108%; font-size:10pt;"><strong><span style="font-family:'Arial Black';">www.disajcali.gov.co</span></strong></p>
<p style="margin-top:0pt; margin-bottom:8pt; text-align:center; line-height:108%; font-size:18pt;"><strong><span style="font-family:'Arial Black';">NORMALIZACI&Oacute;N DE EXPEDIENTES</span></strong></p>
<p style="margin-top:0pt; margin-bottom:8pt; text-align:center; line-height:108%; font-size:18pt;"><strong><span style="font-family:'Arial Black';">&nbsp;</span></strong></p>
<p style="margin-top:0pt; margin-bottom:8pt; text-align:justify; line-height:108%; font-size:12pt;"><strong><span style="font-family:Arial;">REALIZADO POR:&nbsp;{{$Normalizaciones[0]->revisado_por}}</span></strong><span style="font-family:Arial;"></span></p>
<p style="margin-top:0pt; margin-bottom:8pt; text-align:justify; line-height:108%; font-size:12pt;"><strong><span style="font-family:Arial;">FECHA REPORTE:&nbsp; <?php echo date('Y-m-d'); ?></span></strong></p>
<p style="margin-top:0pt; margin-bottom:8pt; text-align:justify; line-height:108%; font-size:12pt;"><strong><span style="font-family:Arial;">REPORTE CORRESPONDE AL MES DE :&nbsp; {{$mes_reporte}} 2024</span></strong></p>
<p style="margin-top:0pt; margin-bottom:8pt; text-align:justify; line-height:108%; font-size:12pt;"><strong><span style="font-family:Arial;">TOTAL REVISADOS:&nbsp; {{$cantidad}}</span></strong></p>
<p style="margin-top:0pt; margin-bottom:8pt; text-align:justify; line-height:108%; font-size:12pt;"><strong><span style="font-family:Arial;">&nbsp;</span></strong></p>
<table cellspacing="0" cellpadding="0" style="width:550.7pt; border-collapse:collapse;">
    <tbody>
        <tr style="height:14.6pt;">
            <td style="width:6%; border-style:solid; border-width:1pt; padding-right:3pt; padding-left:3pt; vertical-align:bottom; background-color:#e7e6e6;">
                <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt;">#</p>
            </td>
            <td style="width:30%; border-style:solid; border-width:1pt; padding-right:3pt; padding-left:3pt; vertical-align:bottom; background-color:#e7e6e6;">
                <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt;">RADICADO</p>
            </td>
            <td style="width:40%; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; padding-right:3pt; padding-left:3.5pt; vertical-align:bottom; background-color:#e7e6e6;">
                <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt;">DESPACHO</p>
            </td>
            <td style="width:12%; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; padding-right:3pt; padding-left:3.5pt; vertical-align:bottom; background-color:#e7e6e6;">
                <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt;">FOLIOS</p>
            </td>
            <td style="width:12%; border-top-style:solid; border-top-width:1pt; border-right-style:solid; border-right-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; padding-right:3pt; padding-left:3.5pt; vertical-align:bottom; background-color:#e7e6e6;">
                <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt;">FECHA REVISION</p>
            </td>
            
        </tr>
        @foreach($Normalizaciones as $reporte)
        <tr style="height:14.6pt;">
            <td style="width:5%; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; padding-right:3pt; padding-left:3pt; vertical-align:bottom;">
                <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt;">{{ $loop->iteration }}</p>
            </td>
           <td style="width:30%; border-right-style:solid; border-right-width:1pt; border-left-style:solid; border-left-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; padding-right:3pt; padding-left:3pt; vertical-align:bottom;">
                <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt;">{{$reporte->radicacion}}</p>
            </td>
            <td style="width:40%; border-right-style:solid; border-right-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; padding-right:3pt; padding-left:3.5pt; vertical-align:bottom;">
                <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt;">{{$reporte->despacho}}</p>
            </td>
            <td style="width:15%; border-right-style:solid; border-right-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; padding-right:3pt; padding-left:3.5pt; vertical-align:bottom;">
                <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt;">{{$reporte->folios}}</p>
            </td>
            <td style="width:15%; border-right-style:solid; border-right-width:1pt; border-bottom-style:solid; border-bottom-width:1pt; padding-right:3pt; padding-left:3.5pt; vertical-align:bottom;">
                <p style="margin-top:0pt; margin-bottom:0pt; font-size:11pt;">{{$reporte->fecha_revision}}</p>
            </td>
            
        </tr>
        @endforeach
    </tbody>
</table>
<p style="margin-top:0pt; margin-bottom:8pt; text-align:justify; line-height:108%; font-size:12pt;"><strong><span style="font-family:Arial;">&nbsp;</span></strong></p>
<div style="color: red; font-size: 12px; width: 600px; margin: 0 auto; text-align: center;">REALIZADO EN SIRIS - <a href="https://www.disajcali.gov.co/">SIRISCALI</a>.</div>
<table class="TableGrid" cellspacing="0" cellpadding="0" align="center" width="104%"
        style="border-collapse:collapse; border:1pt solid #231f20; font-family:Arial, Helvetica, sans-serif; font-size:9pt;">
        <tbody>
            <tr>
                <!-- Logo DISA -->
                <td rowspan="3" valign="middle"
                    style="width:25%; border:1pt solid #231f20; text-align:center; padding:0; vertical-align:top;">
                    <div style="width:90%; height:130px; display:flex; align-items:center; justify-content:center; padding:3px;">
                        <img src="{{ asset('img/logoLargo.png') }}" 
                             alt="Logo DISA"
                             style="width:100%; height:320%; object-fit:contain; display:block;">
                    </div>
                </td>
    
    
                <!-- Título del formato -->
                <td rowspan="3" valign="middle"
                    style="width:40%; border-top:1pt solid #231f20; border-bottom:1pt solid #231f20; border-right:1pt solid #231f20; border-left:none; text-align:center; padding:4px;">
                    <strong style="font-size:11pt;">FORMATO REPORTE DE <br> DIAGNÓSTICO</strong>
                </td>
    
                <!-- Código -->
                <td valign="top"
                    style="width:20%; border-top:1pt solid #231f20; border-bottom:1pt solid #231f20; border-right:1pt solid #231f20; border-left:none; padding:4px;">
                    <p style="margin:0; font-size:9pt;">Código: <strong>FOR_OPR_3</strong></p>
                </td>
    
                <!-- Logo ETB -->
                <td rowspan="3" valign="middle"
                    style="width:15%; border:1pt solid #231f20; border-left:none; text-align:center; padding:4px;">
                    <img src="{{ asset('img/Onsite/etb.png') }}" 
                         alt="Logo ETB" 
                         style="max-width:90%; height:auto; display:block; margin:0 auto;">
                </td>
            </tr>
    
            <!-- Versión -->
            <tr>
                <td valign="top"
                    style="border-top:none; border-bottom:1pt solid #231f20; border-right:1pt solid #231f20; border-left:none; padding:4px;">
                    <p style="margin:0; font-size:9pt;">Versión: <strong>3</strong></p>
                </td>
            </tr>
    
            <!-- Fecha de versión -->
            <tr>
                <td valign="top"
                    style="border-top:none; border-bottom:1pt solid #231f20; border-right:1pt solid #231f20; border-left:none; padding:4px;">
                    <p style="margin:0; font-size:9pt;">Fecha Versión: <strong>15/12/2025</strong></p>
                </td>
            </tr>
        </tbody>
    </table>
<p style="margin-top:0pt; margin-bottom:0pt; line-height:108%; font-size:11pt;"><span style="font-weight:normal;">&nbsp;</span></p>
<table cellspacing="0" cellpadding="0" style="width:568.75pt; margin-left:0.65pt; border-collapse:collapse;">
    <tbody>
        <tr style="height:12.15pt;">
            <td colspan="16" style="width:543.8pt; border-top:1pt solid #231f20; border-left:1pt solid #231f20; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.6pt; vertical-align:top; background-color:#ededee;">
                <p style="margin-top:0pt; margin-left:23.3pt; margin-bottom:0pt; text-align:center; line-height:108%; font-size:10pt;"><strong>Informaci&oacute;n del Servicio&nbsp;</strong></p>
            </td>
            <td style="width:20.25pt; border-top:1pt solid #231f20; border-right:1pt solid #231f20; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.1pt; vertical-align:top; background-color:#ededee;">
                <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:6pt;"><strong>&nbsp;</strong></p>
            </td>
        </tr>
        <tr style="height:12.65pt;">
            <td colspan="16" style="width:543.8pt; border-top:1pt solid #231f20; border-left:1pt solid #231f20; border-bottom-style:solid; border-bottom-width:0.75pt; padding-top:1.7pt; padding-right:1.6pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">No. Caso Diagn&oacute;stico: {{$soporte->num_caso}} <span style="width:8.96pt; display:inline-block;">&nbsp;</span>&nbsp; <span style="width:30.44pt; display:inline-block;">&nbsp;</span></p>
            </td>
            <td style="width:20.25pt; border-top:1pt solid #231f20; border-right:1pt solid #231f20; border-bottom-style:solid; border-bottom-width:0.75pt; padding-top:1.7pt; padding-right:1.1pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:6pt;"><strong>&nbsp;</strong></p>
            </td>
        </tr>
        <tr style="height:12.6pt;">
            <td colspan="2" style="width:103.75pt; border-top:1pt solid #231f20; border-right-style:solid; border-right-width:0.75pt; border-left:1pt solid #231f20; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.4pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">Fecha y hora de Solicitud</p>
            </td>
            <td colspan="14" style="width:438.08pt; border-top-style:solid; border-top-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.6pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.2pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">&nbsp;{{$soporte->fecha_solicitud}} {{$soporte->hora_solicitud}}</p>
            </td>
            <td style="width:20.25pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:6pt;"><strong></strong></p>
            </td>
        </tr>
        <tr style="height:12.35pt;">
            <td colspan="16" style="width:543.8pt; border-top:1pt solid #231f20; border-left:1pt solid #231f20; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.6pt; vertical-align:top; background-color:#ededee;">
                <p style="margin-top:0pt; margin-left:23.75pt; margin-bottom:0pt; text-align:center; line-height:108%; font-size:10pt;"><strong>Datos de Usuario</strong></p>
            </td>
            <td style="width:20.25pt; border-top:1pt solid #231f20; border-right:1pt solid #231f20; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.1pt; vertical-align:top; background-color:#ededee;">
                <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:6pt;"><strong>&nbsp;</strong></p>
            </td>
        </tr>
        <tr style="height:12.2pt;">
            <td style="width:86.3pt; border-top:1pt solid #231f20; border-right:0.75pt solid #231f20; border-left:1pt solid #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.4pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">Seccional</p>
            </td>
            <td colspan="4" style="width:129.22pt; border-top:1pt solid #231f20; border-right:0.75pt solid #231f20; border-left:0.75pt solid #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.2pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">&nbsp;{{$soporte->seccional}}</p>
            </td>
            <td colspan="7" style="width:245.78pt; border-top:1pt solid #231f20; border-right-style:solid; border-right-width:0.75pt; border-left:0.75pt solid #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">Nombre de Contacto</p>
            </td>
            <td colspan="4" style="width:76.58pt; border-top:1pt solid #231f20; border-left-style:solid; border-left-width:0.75pt; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.6pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.2pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">{{$soporte->nombre}} {{$soporte->apellido}}&nbsp;</p>
            </td>
            <td style="width:20.25pt; border-top:1pt solid #231f20; border-right-style:solid; border-right-width:0.75pt; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:6pt;"><strong>&nbsp;</strong></p>
            </td>
        </tr>
        <tr style="height:12pt;">
            <td style="width:86.3pt; border-top:0.75pt solid #231f20; border-right:0.75pt solid #231f20; border-left:1pt solid #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.4pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">N&uacute;mero de C&eacute;dula</p>
            </td>
            <td colspan="4" style="width:129.22pt; border:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.2pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">&nbsp;{{$soporte->cedula}}</p>
            </td>
            <td colspan="7" style="width:245.78pt; border-top:0.75pt solid #231f20; border-right-style:solid; border-right-width:0.75pt; border-left:0.75pt solid #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">Ciudad</p>
            </td>
            <td colspan="4" style="width:76.58pt; border-top:0.75pt solid #231f20; border-left-style:solid; border-left-width:0.75pt; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.6pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.2pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">{{$soporte->ciudad}}&nbsp;</p>
            </td>
            <td style="width:20.25pt; border-top:0.75pt solid #231f20; border-right:1pt solid #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.1pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:6pt;"><strong>&nbsp;</strong></p>
            </td>
        </tr>
        <tr style="height:12.05pt;">
            <td style="width:86.3pt; border-top:0.75pt solid #231f20; border-right:0.75pt solid #231f20; border-left:1pt solid #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.4pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">Direcci&oacute;n</p>
            </td>
            <td colspan="4" style="width:129.22pt; border:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.2pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">{{$soporte->direccion}}&nbsp;</p>
            </td>
            <td colspan="7" style="width:245.78pt; border-top:0.75pt solid #231f20; border-right-style:solid; border-right-width:0.75pt; border-left:0.75pt solid #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">Tel&eacute;fono/ Celular</p>
            </td>
            <td colspan="4" style="width:76.58pt; border-top:0.75pt solid #231f20; border-left-style:solid; border-left-width:0.75pt; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.6pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.2pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">{{$soporte->telefono}}&nbsp;</p>
            </td>
            <td style="width:20.25pt; border-top:0.75pt solid #231f20; border-right:1pt solid #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.1pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:6pt;"><strong>&nbsp;</strong></p>
            </td>
        </tr>
        <tr style="height:12.45pt;">
            <td style="width:86.3pt; border-top:0.75pt solid #231f20; border-right:0.75pt solid #231f20; border-left:1pt solid #231f20; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.4pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">Correo Electr&oacute;nico</p>
            </td>
            <td colspan="6" style="width:199.68pt; border-top:0.75pt solid #231f20; border-right-style:solid; border-right-width:0.75pt; border-left:0.75pt solid #231f20; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.2pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">{{$soporte->correo_empleado}}&nbsp;</p>
            </td>
            <td colspan="5" style="width:175.32pt; border-top:0.75pt solid #231f20; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.2pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">Oficina o Juzgado</p>
            </td>
            <td colspan="4" style="width:76.58pt; border-top:0.75pt solid #231f20; border-left-style:solid; border-left-width:0.75pt; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.6pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.2pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">{{$soporte->despacho}}&nbsp;</p>
            </td>
            <td style="width:20.25pt; border-top:0.75pt solid #231f20; border-right:1pt solid #231f20; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.1pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:6pt;"><strong>&nbsp;</strong></p>
            </td>
        </tr>
        <tr style="height:12.15pt;">
            <td colspan="16" style="width:543.8pt; border-top:1pt solid #231f20; border-left:1pt solid #231f20; border-bottom-style:solid; border-bottom-width:0.75pt; padding-top:1.7pt; padding-right:1.6pt; vertical-align:top; background-color:#ededee;">
                <p style="margin-top:0pt; margin-left:23.4pt; margin-bottom:0pt; text-align:center; line-height:108%; font-size:10pt;"><strong>Falla Reportada&nbsp;</strong></p>
            </td>
            <td style="width:20.25pt; border-top:1pt solid #231f20; border-right:1pt solid #231f20; border-bottom-style:solid; border-bottom-width:0.75pt; padding-top:1.7pt; padding-right:1.1pt; vertical-align:top; background-color:#ededee;">
                <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:6pt;"><strong>&nbsp;</strong></p>
            </td>
        </tr>
        <tr style="height:12.05pt;">
            <td colspan="16" style="width:543.92pt; border-top-style:solid; border-top-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-top:1.7pt; padding-right:1.6pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.15pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">{{$soporte->falla_reportada}}&nbsp;</p>
            </td>
            <td style="width:20.25pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:6pt;"><strong>&nbsp;</strong></p>
            </td>
        </tr>
        <tr style="height:12.15pt;">
            <td colspan="16" style="width:543.8pt; border-top:1pt solid #231f20; border-left:1pt solid #231f20; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.6pt; vertical-align:top; background-color:#ededee;">
                <p style="margin-top:0pt; margin-left:23.6pt; margin-bottom:0pt; text-align:center; line-height:108%; font-size:10pt;"><strong>Ingeniero, t&eacute;cnico o agente que atendi&oacute; el caso en sitio</strong></p>
            </td>
            <td style="width:20.25pt; border-top:1pt solid #231f20; border-right:1pt solid #231f20; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.1pt; vertical-align:top; background-color:#ededee;">
                <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:6pt;"><strong>&nbsp;</strong></p>
            </td>
        </tr>
        <tr style="height:12.7pt;">
            <td colspan="3" style="width:124.85pt; border:1pt solid #231f20; padding-top:1.7pt; padding-right:1.1pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.4pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">Fecha y hora de Atenci&oacute;n</p>
            </td>
            <td colspan="13" style="width:416.85pt; border-top:1pt solid #231f20; border-left:1pt solid #231f20; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.6pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.7pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">&nbsp;{{$soporte->fecha_atencion}} {{$soporte->hora_atencion}}</p>
            </td>
            <td style="width:20.25pt; border-top:1pt solid #231f20; border-right:1pt solid #231f20; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.1pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:6pt;"><strong>&nbsp;</strong></p>
            </td>
        </tr>
        <tr style="height:12.55pt;">
            <td colspan="3" style="width:124.85pt; border:1pt solid #231f20; padding-top:1.7pt; padding-right:1.1pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.4pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">Nombre</p>
            </td>
            <td colspan="13" style="width:416.85pt; border-top:1pt solid #231f20; border-left:1pt solid #231f20; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.6pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.7pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">{{$soporte->nombre_tecnico}}&nbsp;</p>
            </td>
            <td style="width:20.25pt; border-top:1pt solid #231f20; border-right:1pt solid #231f20; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.1pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:6pt;"><strong>&nbsp;</strong></p>
            </td>
        </tr>
        <tr style="height:12.4pt;">
            <td colspan="16" style="width:543.8pt; border-top:1pt solid #231f20; border-left:1pt solid #231f20; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.6pt; vertical-align:top; background-color:#ededee;">
                <p style="margin-top:0pt; margin-left:23.7pt; margin-bottom:0pt; text-align:center; line-height:108%; font-size:10pt;"><strong>Datos de Equipo&nbsp;</strong></p>
            </td>
            <td style="width:20.25pt; border-top:1pt solid #231f20; border-right:1pt solid #231f20; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.1pt; vertical-align:top; background-color:#ededee;">
                <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:6pt;"><strong>&nbsp;</strong></p>
            </td>
        </tr>
        <tr style="height:12.2pt;">
            <td style="width:86.3pt; border-top:1pt solid #231f20; border-right:0.75pt solid #231f20; border-left:1pt solid #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.4pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">Placa Equipo</p>
            </td>
            <td colspan="4" style="width:129.22pt; border-top:1pt solid #231f20; border-right:0.75pt solid #231f20; border-left:0.75pt solid #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.2pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">{{$soporte->placa}}&nbsp;</p>
            </td>
            <td colspan="3" style="width:97.12pt; border-top:1pt solid #231f20; border-right-style:solid; border-right-width:0.75pt; border-left:0.75pt solid #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">Serial Equipo</p>
            </td>
            <td colspan="8" style="width:225.22pt; border-top:1pt solid #231f20; border-left-style:solid; border-left-width:0.75pt; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.6pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.2pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">{{$soporte->serial_equipo}}&nbsp;</p>
            </td>
            <td style="width:20.25pt; border-top:1pt solid #231f20; border-right:1pt solid #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.1pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:6pt;"><strong>&nbsp;</strong></p>
            </td>
        </tr>
        <tr style="height:12pt;">
            <td style="width:86.3pt; border-top:0.75pt solid #231f20; border-right:0.75pt solid #231f20; border-left:1pt solid #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.4pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">Marca equipo</p>
            </td>
            <td colspan="4" style="width:129.22pt; border:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.2pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">{{$soporte->marca_equipo}}&nbsp;</p>
            </td>
            <td colspan="3" style="width:97.12pt; border-top:0.75pt solid #231f20; border-right-style:solid; border-right-width:0.75pt; border-left:0.75pt solid #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">Modelo Equipo</p>
            </td>
            <td colspan="8" style="width:225.22pt; border-top:0.75pt solid #231f20; border-left-style:solid; border-left-width:0.75pt; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.6pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.2pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">{{$soporte->modelo_equipo}}&nbsp;</p>
            </td>
            <td style="width:20.25pt; border-top:0.75pt solid #231f20; border-right:1pt solid #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.1pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:6pt;"><strong>&nbsp;</strong></p>
            </td>
        </tr>
        <tr style="height:15.6pt;">
            <td colspan="16" style="width:543.8pt; border-top:0.75pt solid #231f20; border-left:1pt solid #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.6pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:24pt; margin-bottom:0pt; text-align:center; line-height:108%; font-size:10pt;"><strong>Lista de Verificaci&oacute;n (&uacute;nicamente para equipos de c&oacute;mputo)&nbsp;</strong></p>
            </td>
            <td style="width:20.25pt; border-top:0.75pt solid #231f20; border-right:1pt solid #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.1pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:6pt;"><strong>&nbsp;</strong></p>
            </td>
        </tr>
        <tr style="height:22.4pt;">
            <td style="width:86.3pt; border-top:0.75pt solid #231f20; border-right:0.75pt solid #231f20; border-left:1pt solid #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.4pt; margin-bottom:0pt; line-height:108%; font-size:10pt;"><span style="line-height:108%; font-size:9pt;">Versi&oacute;n Sistema Operativo</span>:</p>
            </td>
            <td colspan="4" style="width:129.22pt; border:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:middle;">
                <p style="margin-top:0pt; margin-left:0.2pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">{{$soporte->sistema_operativo}}&nbsp;</p>
            </td>
            <td colspan="3" style="width:97.12pt; border-top:0.75pt solid #231f20; border-right-style:solid; border-right-width:0.75pt; border-left:0.75pt solid #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:middle;">
                <p style="margin-top:0pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">Antivirus Actualizado:</p>
            </td>
            <td style="width:61.68pt; border-top:0.75pt solid #231f20; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:middle;">
                <p style="margin-top:0pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">&nbsp;<span style="width:28.22pt; display:inline-block;">&nbsp;</span>{{$soporte->antivirus}}</p>
            </td>
            <td colspan="3" style="width:83.02pt; border-top:0.75pt solid #231f20; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:middle;">
                <p style="margin-top:0pt; margin-left:0.2pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">Versi&oacute;n Antivirus</p>
            </td>
            <td colspan="4" style="width:76.58pt; border-top:0.75pt solid #231f20; border-left-style:solid; border-left-width:0.75pt; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.6pt; vertical-align:middle;">
                <p style="margin-top:0pt; margin-left:0.2pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">{{$soporte->ver_antivirus}}&nbsp;&nbsp;</p>
            </td>
            <td style="width:20.25pt; border-top:0.75pt solid #231f20; border-right:1pt solid #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.1pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:6pt;"><strong>&nbsp;</strong></p>
            </td>
        </tr>
        <tr style="height:23.85pt;">
            <td style="width:86.3pt; border-top:0.75pt solid #231f20; border-right:0.75pt solid #231f20; border-left:1pt solid #231f20; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:middle;">
                <p style="margin-top:0pt; margin-left:0.4pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">Agente Ivanti</p>
            </td>
            <td colspan="4" style="width:129.22pt; border-top:0.75pt solid #231f20; border-right:0.75pt solid #231f20; border-left:0.75pt solid #231f20; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">&nbsp;<span style="width:59.22pt; display:inline-block;">{{$soporte->agente_ivanti}}&nbsp;</span></p>
            </td>
            <td colspan="3" style="width:97.12pt; border-top:0.75pt solid #231f20; border-right-style:solid; border-right-width:0.75pt; border-left:0.75pt solid #231f20; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:middle;">
                <p style="margin-top:0pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">Office 365:</p>
            </td>
            <td style="width:61.68pt; border-top:0.75pt solid #231f20; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:middle;">
                <p style="margin-top:0pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">&nbsp;<span style="width:27.27pt; display:inline-block;">{{$soporte->office}}&nbsp;</span></p>
            </td>
            <td colspan="3" style="width:83.02pt; border-top:0.75pt solid #231f20; border-right-style:solid; border-right-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.2pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">Equipo en Dominio:</p>
            </td>
            <td colspan="4" style="width:76.58pt; border-top:0.75pt solid #231f20; border-left-style:solid; border-left-width:0.75pt; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.6pt; vertical-align:middle;">
                <p style="margin-top:0pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">&nbsp;<span style="width:43.22pt; display:inline-block;">{{$soporte->equipo_dominio}}&nbsp;</span></p>
            </td>
            <td style="width:20.25pt; border-top:0.75pt solid #231f20; border-right:1pt solid #231f20; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.1pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:6pt;"><strong>&nbsp;</strong></p>
            </td>
        </tr>
        <tr style="height:12.35pt;">
            <td colspan="6" style="width:282.3pt; border:1pt solid #231f20; padding-top:1.7pt; padding-right:1.1pt; vertical-align:top; background-color:#ededee;">
                <p style="margin-top:0pt; margin-left:1.35pt; margin-bottom:0pt; text-align:center; line-height:108%; font-size:10pt;"><strong>Requiere Repuesto (Marque X)&nbsp;</strong></p>
            </td>
            <td colspan="10" style="width:259.4pt; border-top:1pt solid #231f20; border-left:1pt solid #231f20; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.6pt; vertical-align:top; background-color:#ededee;">
                <p style="margin-top:0pt; margin-left:37.1pt; margin-bottom:0pt; line-height:108%; font-size:10pt;"><strong>Requiere Equipo de Continuidad (Marque X)&nbsp;</strong></p>
            </td>
            <td style="width:20.25pt; border-top:1pt solid #231f20; border-right:1pt solid #231f20; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.1pt; vertical-align:top; background-color:#ededee;">
                <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:6pt;"><strong>&nbsp;</strong></p>
            </td>
        </tr>
        <tr style="height:12.55pt;">
            <td colspan="4" style="width:139.85pt; border:1pt solid #231f20; padding-top:1.7pt; padding-right:1.1pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:1.5pt; margin-bottom:0pt; text-align:center; line-height:108%; font-size:10pt;">SI</p>
            </td>
            <td colspan="2" style="width:140.35pt; border:1pt solid #231f20; padding-top:1.7pt; padding-right:1.1pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:4.2pt; margin-bottom:0pt; text-align:center; line-height:108%; font-size:10pt;">&nbsp;
                		<span style="font-size:10pt; line-height:107%; font-family:Arial, Helvetica, sans-serif; font-weight:normal;">
                            @if (trim(strtoupper($soporte->elementos_de_soporte)) === 'SI')
                                <span style="color:#1F1F1F; font-weight:bold;">X</span>
                            @endif
                        </span>
                </p>
            </td>
            <td colspan="4" style="width:139.75pt; border:1pt solid #231f20; padding-top:1.7pt; padding-right:1.1pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:1.4pt; margin-bottom:0pt; text-align:center; line-height:108%; font-size:10pt;">SI</p>
            </td>
            <td colspan="6" style="width:117.55pt; border-top:1pt solid #231f20; border-left:1pt solid #231f20; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.6pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:26.6pt; margin-bottom:0pt; text-align:center; line-height:108%; font-size:10pt;">
                    <span style="font-size:10pt; line-height:107%; font-family:Arial, Helvetica, sans-serif; font-weight:normal;">
                            @if (trim(strtoupper($soporte->requiere_repuesto)) === 'SI')
                                <span style="color:#1F1F1F; font-weight:bold;">X</span>
                            @endif
                        </span>
                    &nbsp;</p>
            </td>
            <td style="width:20.25pt; border-top:1pt solid #231f20; border-right:1pt solid #231f20; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.1pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:6pt;"><strong>&nbsp;</strong></p>
            </td>
        </tr>
        <tr style="height:12.75pt;">
            <td colspan="4" style="width:139.85pt; border:1pt solid #231f20; padding-top:1.7pt; padding-right:1.1pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:1.2pt; margin-bottom:0pt; text-align:center; line-height:108%; font-size:10pt;">NO</p>
            </td>
            <td colspan="2" style="width:140.35pt; border:1pt solid #231f20; padding-top:1.7pt; padding-right:1.1pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:4.2pt; margin-bottom:0pt; text-align:center; line-height:108%; font-size:10pt;">
                    <span style="font-size:10pt; line-height:107%; font-family:Arial, Helvetica, sans-serif; font-weight:normal;">
                            @if (trim(strtoupper($soporte->elementos_de_soporte)) === 'NO')
                                <span style="color:#1F1F1F; font-weight:bold;">X</span>
                            @endif
                        </span>
                    &nbsp;</p>
            </td>
            <td colspan="4" style="width:139.75pt; border:1pt solid #231f20; padding-top:1.7pt; padding-right:1.1pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:1.5pt; margin-bottom:0pt; text-align:center; line-height:108%; font-size:10pt;">NO</p>
            </td>
            <td colspan="6" style="width:117.55pt; border-top:1pt solid #231f20; border-left:1pt solid #231f20; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.6pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:26.6pt; margin-bottom:0pt; text-align:center; line-height:108%; font-size:10pt;">
                    <span style="font-size:10pt; line-height:107%; font-family:Arial, Helvetica, sans-serif; font-weight:normal;">
                            @if (trim(strtoupper($soporte->requiere_repuesto)) === 'NO')
                                <span style="color:#1F1F1F; font-weight:bold;">X</span>
                            @endif
                        </span>
                    &nbsp;</p>
            </td>
            <td style="width:20.25pt; border-top:1pt solid #231f20; border-right:1pt solid #231f20; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.1pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:6pt;"><strong>&nbsp;</strong></p>
            </td>
        </tr>
        <tr style="height:12.15pt;">
            <td colspan="16" style="width:543.8pt; border-top:1pt solid #231f20; border-left:1pt solid #231f20; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.6pt; vertical-align:top; background-color:#ededee;">
                <p style="margin-top:0pt; margin-left:23.5pt; margin-bottom:0pt; text-align:center; line-height:108%; font-size:10pt;"><strong>Descripci&oacute;n del Servicio&nbsp;</strong></p>
            </td>
            <td style="width:20.25pt; border-top:1pt solid #231f20; border-right:1pt solid #231f20; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.1pt; vertical-align:top; background-color:#ededee;">
                <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:6pt;"><strong>&nbsp;</strong></p>
            </td>
        </tr>
        <tr style="height:12.45pt;">
            <td colspan="16" style="width:543.8pt; border-top:1pt solid #231f20; border-left:1pt solid #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.6pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.4pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">Informaci&oacute;n de Diagn&oacute;stico:&nbsp;&nbsp;{{$soporte->diagnostico}}</p>
            </td>
            <td style="width:20.25pt; border-top:1pt solid #231f20; border-right:1pt solid #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.1pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:6pt;"><strong>&nbsp;</strong></p>
            </td>
        </tr>
        <tr style="height:12pt;">
            <td colspan="16" style="width:543.8pt; border-top:0.75pt solid #231f20; border-left:1pt solid #231f20; border-bottom-style:solid; border-bottom-width:0.75pt; padding-top:1.7pt; padding-right:1.6pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.4pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">Soluci&oacute;n entregada y/o Observaciones: 
                {{$soporte->solucion}}<br>
                {{$soporte->observacion_tecnico}}</p>
            </td>
            <td style="width:20.25pt; border-top:0.75pt solid #231f20; border-right:1pt solid #231f20; border-bottom-style:solid; border-bottom-width:0.75pt; padding-top:1.7pt; padding-right:1.1pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:6pt;"><strong>
                    
                    &nbsp;</strong></p>
            </td>
        </tr>
        <tr style="height:12.75pt;">
            <td colspan="5" rowspan="6" style="width:217.5pt; border-top:1pt solid #231f20; border-right:2.25pt double #231f20; border-left:1pt solid #231f20; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:0.48pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.4pt; margin-bottom:0pt; line-height:108%; font-size:10pt;"><strong>Calificaci&oacute;n del Servicio:&nbsp;</strong></p>
                <p style="margin-top:0pt; margin-left:0.4pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">&nbsp;</p>
                <p style="margin-top:0pt; margin-left:0.4pt; margin-bottom:0pt; font-size:10pt;">Por favor marque con una X las siguientes preguntas considerando 1 como la m&iacute;nima calificaci&oacute;n y 5 como la m&aacute;xima calificaci&oacute;n de acuerdo con el grado de satisfacci&oacute;n que se encuentra con el servicio prestado.</p>
                <p style="margin-top:0pt; margin-left:0.4pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">&nbsp;</p>
                <p style="margin-top:0pt; margin-left:0.4pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">&nbsp;</p>
            </td>
            <td colspan="6" style="width:219.82pt; border-top:1pt solid #231f20; border-right:0.75pt solid #231f20; border-left:2.25pt double #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top; background-color:#ededee;">
                <p style="margin-top:0pt; margin-left:1.45pt; margin-bottom:0pt; text-align:center; line-height:108%; font-size:10pt;">PREGUNTAS</p>
            </td>
            <td colspan="2" style="width:27.67pt; border-top:1pt solid #231f20; border-right:0.75pt solid #231f20; border-left:0.75pt solid #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top; background-color:#ededee;">
                <p style="margin-top:0pt; margin-left:1.5pt; margin-bottom:0pt; text-align:center; line-height:108%; font-size:10pt;">1</p>
            </td>
            <td style="width:20.22pt; border-top:1pt solid #231f20; border-right:0.75pt solid #231f20; border-left:0.75pt solid #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top; background-color:#ededee;">
                <p style="margin-top:0pt; margin-left:1.4pt; margin-bottom:0pt; text-align:center; line-height:108%; font-size:10pt;">2</p>
            </td>
            <td style="width:21.72pt; border-top:1pt solid #231f20; border-right:0.75pt solid #231f20; border-left:0.75pt solid #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top; background-color:#ededee;">
                <p style="margin-top:0pt; margin-left:1.45pt; margin-bottom:0pt; text-align:center; line-height:108%; font-size:10pt;">3</p>
            </td>
            <td style="width:26.22pt; border-top:1pt solid #231f20; border-right:0.75pt solid #231f20; border-left:0.75pt solid #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top; background-color:#ededee;">
                <p style="margin-top:0pt; margin-left:1.45pt; margin-bottom:0pt; text-align:center; line-height:108%; font-size:10pt;">4</p>
            </td>
            <td style="width:19.88pt; border-top:1pt solid #231f20; border-right:1.25pt solid #231f20; border-left:0.75pt solid #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:0.98pt; vertical-align:top; background-color:#ededee;">
                <p style="margin-top:0pt; margin-left:7.9pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">5</p>
            </td>
        </tr>
        <tr style="height:12.05pt;">
            <td colspan="6" style="width:219.82pt; border-top:0.75pt solid #231f20; border-right:0.75pt solid #231f20; border-left:2.25pt double #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.7pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">Disposici&oacute;n para atenci&oacute;n de servicio del ingeniero.</p>
            </td>
            <td colspan="2" style="width:27.67pt; border:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.2pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">@if($soporte->disposicion == 1) &nbsp;X @endif&nbsp;</p>
            </td>
            <td style="width:20.22pt; border:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.15pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">@if($soporte->disposicion == 2) &nbsp;X @endif&nbsp;</p>
            </td>
            <td style="width:21.72pt; border:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.15pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">@if($soporte->disposicion == 3) &nbsp;X @endif&nbsp;</p>
            </td>
            <td style="width:26.22pt; border:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.3pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">@if($soporte->disposicion == 4) &nbsp;X @endif&nbsp;</p>
            </td>
            <td style="width:19.88pt; border-top:0.75pt solid #231f20; border-right:1.25pt solid #231f20; border-left:0.75pt solid #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:0.98pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.3pt; margin-bottom:0pt; text-align:justify; line-height:108%; font-size:10pt;">@if($soporte->disposicion == 5)&nbsp;X @endif&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            </td>
        </tr>
        <tr style="height:12pt;">
            <td colspan="6" style="width:219.82pt; border-top:0.75pt solid #231f20; border-right:0.75pt solid #231f20; border-left:2.25pt double #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.7pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">Conocimiento t&eacute;cnico del ingeniero.</p>
            </td>
            <td colspan="2" style="width:27.67pt; border:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.2pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">@if($soporte->conocimiento_tec == 1) &nbsp;X @endif&nbsp;</p>
            </td>
            <td style="width:20.22pt; border:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.15pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">@if($soporte->conocimiento_tec == 2) &nbsp;X @endif&nbsp;</p>
            </td>
            <td style="width:21.72pt; border:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.15pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">@if($soporte->conocimiento_tec == 3) &nbsp;X @endif&nbsp;</p>
            </td>
            <td style="width:26.22pt; border:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.3pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">@if($soporte->conocimiento_tec == 4) &nbsp;X @endif&nbsp;</p>
            </td>
            <td style="width:19.88pt; border-top:0.75pt solid #231f20; border-right:1.25pt solid #231f20; border-left:0.75pt solid #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:0.98pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.3pt; margin-bottom:0pt; text-align:justify; line-height:108%; font-size:10pt;">@if($soporte->conocimiento_tec == 5) &nbsp;X @endif&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            </td>
        </tr>
        <tr style="height:12pt;">
            <td colspan="6" style="width:219.82pt; border-top:0.75pt solid #231f20; border-right:0.75pt solid #231f20; border-left:2.25pt double #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.7pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">Tiempo de atenci&oacute;n y soluci&oacute;n.</p>
            </td>
            <td colspan="2" style="width:27.67pt; border:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.2pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">@if($soporte->tiempo_aten == 1) &nbsp;X @endif&nbsp;</p>
            </td>
            <td style="width:20.22pt; border:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.15pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">@if($soporte->tiempo_aten == 2) &nbsp;X @endif&nbsp;</p>
            </td>
            <td style="width:21.72pt; border:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.15pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">@if($soporte->tiempo_aten == 3) &nbsp;X @endif&nbsp;</p>
            </td>
            <td style="width:26.22pt; border:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.3pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">@if($soporte->tiempo_aten == 4) &nbsp;X @endif&nbsp;</p>
            </td>
            <td style="width:19.88pt; border-top:0.75pt solid #231f20; border-right:1.25pt solid #231f20; border-left:0.75pt solid #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:0.98pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.3pt; margin-bottom:0pt; text-align:justify; line-height:108%; font-size:10pt;">@if($soporte->tiempo_aten == 5) &nbsp;X @endif&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            </td>
        </tr>
        <tr style="height:12pt;">
            <td colspan="6" style="width:219.82pt; border-top:0.75pt solid #231f20; border-right:0.75pt solid #231f20; border-left:2.25pt double #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.7pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">Informaci&oacute;n del avance del caso.</p>
            </td>
            <td colspan="2" style="width:27.67pt; border:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.2pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">@if($soporte->avance_caso == 1) &nbsp;X @endif&nbsp;</p>
            </td>
            <td style="width:20.22pt; border:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.15pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">@if($soporte->avance_caso == 2) &nbsp;X @endif&nbsp;</p>
            </td>
            <td style="width:21.72pt; border:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.15pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">@if($soporte->avance_caso == 3) &nbsp;X @endif&nbsp;</p>
            </td>
            <td style="width:26.22pt; border:0.75pt solid #231f20; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.3pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">@if($soporte->avance_caso == 4) &nbsp;X @endif&nbsp;</p>
            </td>
            <td style="width:19.88pt; border-top:0.75pt solid #231f20; border-right:1.25pt solid #231f20; border-left:0.75pt solid #231f20; border-bottom:0.75pt solid #231f20; padding-top:1.7pt; padding-right:0.98pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.3pt; margin-bottom:0pt; text-align:justify; line-height:108%; font-size:10pt;">@if($soporte->avance_caso == 5) &nbsp;X @endif&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
            </td>
        </tr>
        <tr style="height:42.85pt;">
            <td colspan="11" style="width:324.2pt; border-top:0.75pt solid #231f20; border-left:1pt solid #231f20; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.6pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-left:0.25pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">Observaciones Cliente (Opcional):&nbsp;{{$soporte->observacion_cliente}}</p>
            </td>
            <td style="width:20.25pt; border-top:0.75pt solid #231f20; border-right:1pt solid #231f20; border-bottom:1pt solid #231f20; padding-top:1.7pt; padding-right:1.1pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:6pt;"><strong>&nbsp;</strong></p>
            </td>
        </tr>
        <tr style="height:12.1pt;">
            <td colspan="16" style="width:543.8pt; border-top:1pt solid #231f20; border-left:1pt solid #414042; border-bottom-style:solid; border-bottom-width:0.75pt; padding-top:1.7pt; padding-right:1.6pt; vertical-align:top; background-color:#e6e7e8;">
                <p style="margin-top:0pt; margin-left:26.3pt; margin-bottom:0pt; text-align:center; line-height:108%; font-size:10pt;">&nbsp;</p>
            </td>
            <td style="width:20.25pt; border-top:1pt solid #231f20; border-right:1pt solid #414042; border-bottom-style:solid; border-bottom-width:0.75pt; padding-top:1.7pt; padding-right:1.1pt; vertical-align:top; background-color:#e6e7e8;">
                <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:6pt;"><strong>&nbsp;</strong></p>
            </td>
        </tr>
        <tr style="height:81.1pt;">
            <td colspan="8" style="width:316.72pt; border-style:solid; border-width:0.75pt; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <div style="text-align:center;">
                <img src="{{ $soporte->firma_tecnico }}" 
                         alt="Firma del Ingeniero"
                         style="display:inline-block; width:160pt; height:60pt; object-fit:contain; margin:0 auto;">
                </div>
                <p style="margin-top:0pt; margin-left:112.25pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">&nbsp;</p>
                <p style="margin:0pt 139pt 0pt 0.15pt; line-height:108%; font-size:10pt;">_______________________________<br> Firma del Ingeniero <br>C&eacute;dula: {{ $soporte->cedula_tec }}</p>
            </td>
            <td colspan="8" style="width:225.22pt; border-top-style:solid; border-top-width:0.75pt; border-left-style:solid; border-left-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-top:1.7pt; padding-right:1.6pt; vertical-align:top;">
                <div style="text-align:center;">
                    <img src="{{ $soporte->firma }}" 
                         alt="Firma del Cliente"
                         style="display:inline-block; width:160pt; height:60pt; object-fit:contain; margin:0 auto;">
                </div>
                <p style="margin-top:0pt; margin-left:0.2pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">&nbsp;</p>
                <p style="margin-top:0pt; margin-left:0.2pt; margin-bottom:0pt; line-height:108%; font-size:10pt;">_______________________</p>
                <p style="margin:0pt 112.35pt 0pt 0.2pt; line-height:108%; font-size:10pt;">Firma del Cliente <br>C&eacute;dula: {{ $soporte->cedula }}</p>
            </td>
            <td style="width:20.25pt; border-top-style:solid; border-top-width:0.75pt; border-right-style:solid; border-right-width:0.75pt; border-bottom-style:solid; border-bottom-width:0.75pt; padding-top:1.7pt; padding-right:1.23pt; vertical-align:top;">
                <p style="margin-top:0pt; margin-bottom:8pt; line-height:108%; font-size:6pt;"><strong>&nbsp;</strong></p>
            </td>
        </tr>
        <tr style="height:0pt;">
            <td style="width:88.4pt;"><br></td>
            <td style="width:17.45pt;"><br></td>
            <td style="width:21.1pt;"><br></td>
            <td style="width:15pt;"><br></td>
            <td style="width:77.65pt;"><br></td>
            <td style="width:64.8pt;"><br></td>
            <td style="width:5.65pt;"><br></td>
            <td style="width:28.65pt;"><br></td>
            <td style="width:63.65pt;"><br></td>
            <td style="width:43.9pt;"><br></td>
            <td style="width:15.9pt;"><br></td>
            <td style="width:25.2pt;"><br></td>
            <td style="width:4.45pt;"><br></td>
            <td style="width:22.2pt;"><br></td>
            <td style="width:23.7pt;"><br></td>
            <td style="width:28.2pt;"><br></td>
            <td style="width:21.85pt;"><br></td>
        </tr>
    </tbody>
</table>


<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 6.5pt;
        margin: 0;
        padding: 0;
    }

    /* CONTENEDOR GENERAL */
    .habeas-container {
        width: 104%;
        border-top: 10px solid #000;
        padding-top: 6px;
    }

    /* TITULO */
    .habeas-title {
        font-size: 7.5pt;
        font-weight: bold;
        margin-bottom: 4px;
    }

    /* TEXTO LEGAL */
    .habeas-text {
        text-align: justify;
        line-height: 1.25;
    }
</style>
<div class="container-fluid habeas-container">
    <div class="habeas-title">
        Hábeas Data, Ley 1581 de 2012
    </div>

    <div class="habeas-text">
        Este documento contiene información de carácter confidencial exclusivamente dirigida a su destinatario o destinatarios. 
        Si no es Ud. el destinatario indicado, queda notificado que la lectura, utilización, divulgación y/o copia sin autorización 
        está prohibida en virtud de la legislación vigente. Evite imprimir este documento si no es estrictamente necesario.
    </div>
</div>
<div style="display:flex; justify-content:flex-end; margin-top:4px;">
                <p class="Footer" style="margin:0; color:#00c4ee; font-size:4pt; font-family: Arial, Helvetica, sans-serif; text-align:left;">
                    <a href="https://www.disajcali.gov.co" target="_blank" style="color:#00c4ee; text-decoration:none;">
                        www.disajcali.gov.co
                    </a>
                </p>
            </div>
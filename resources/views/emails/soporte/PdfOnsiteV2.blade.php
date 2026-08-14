<div class="WordSection1">
	<table class="TableGrid" cellspacing="0" cellpadding="0" align="center" width="104%"
        style="border-collapse:collapse; border:1pt solid #231f20; font-family:Arial, Helvetica, sans-serif; font-size:10pt;">
        <tbody>
            <tr>
                <!-- Logo DISA -->
                <td rowspan="3" valign="middle"
                    style="width:25%; border:1pt solid #231f20; text-align:center; padding:0; vertical-align:top;">
                    <div style="width:100%; height:170px; display:flex; align-items:center; justify-content:center; padding:3px;">
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
                         style="max-width:100%; height:auto; display:block; margin:0 auto;">
                </td>
            </tr>
    
            <!-- Versión -->
            <tr>
                <td valign="top"
                    style="border-top:none; border-bottom:1pt solid #231f20; border-right:1pt solid #231f20; border-left:none; padding:4px;">
                    <p style="margin:0; font-size:9pt;">Versión: <strong>2</strong></p>
                </td>
            </tr>
    
            <!-- Fecha de versión -->
            <tr>
                <td valign="top"
                    style="border-top:none; border-bottom:1pt solid #231f20; border-right:1pt solid #231f20; border-left:none; padding:4px;">
                    <p style="margin:0; font-size:9pt;">Fecha Versión: <strong>25-08-2024</strong></p>
                </td>
            </tr>
        </tbody>
    </table>

	<p class="MsoNormal" align="left" style="margin-bottom:0in;text-align:left; line-height:107%;"</p>
	    <span
		style="font-size: 11pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">&nbsp;
		</span>
		
	<table class="TableGrid" border="0" cellspacing="0" cellpadding="0" width="757"
		style="width:567.95pt;margin-left:.65pt;border-collapse:collapse;">
		<tbody>
			<tr style="height:11.75pt;">
				<td colspan="15" valign="top"
					style="width: 757px; border: 1pt solid rgb(35, 31, 32); background: rgb(237, 237, 238); padding: 0.2pt 1.3pt 0in 0in; height: 11.75pt;">
					<p class="MsoNormal" align="center"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.95pt;text-align:center;line-height:107%;">
						<span
							style="font-size: 10pt; line-height: 107%; font-family: Arial, Helvetica, sans-serif;"><strong>Informaci&oacute;n
								del Servicio</strong></span></p>
				</td>
			</tr>
			<tr style="height:12.3pt;">
				<td colspan="15" valign="top"
					style="width: 757px; border-top: none; border-left: 1pt solid rgb(35, 31, 32); border-bottom: 1pt solid black; border-right: 1pt solid rgb(35, 31, 32); padding: 0.2pt 1.3pt 0in 0in; height: 12.3pt;">
					<p class="MsoNormal" align="left" style="margin-bottom:0in;text-align:left; line-height:107%;"><span
							style="font-size: 8pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">No.
							Caso Diagn&oacute;stico &nbsp;&nbsp;
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</span> {{$soporte->num_caso}}</p>
				</td>
			</tr>
			<tr style="height:12.45pt;">
				<td colspan="2" valign="top"
					style="width: 141px; border-top: none; border-left: 1pt solid rgb(35, 31, 32); border-bottom: 1pt solid rgb(35, 31, 32); border-right: 1pt solid black; padding: 0.2pt 1.3pt 0in 0in; height: 12.45pt;">
					<p class="MsoNormal"
						style="margin-top:0in;margin-right:0in;margin-bottom:0in; margin-left:.4pt;line-height:107%;">
						<span
							style="font-size: 10pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">Fecha
							y hora de Solicitud</span></p>
				</td>
				<td colspan="13" valign="top"
					style="width: 616px; border-top: none; border-left: none; border-bottom: 1pt solid rgb(35, 31, 32); border-right: 1pt solid black; padding: 0.2pt 1.3pt 0in 0in; height: 12.45pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.25pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 8pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">&nbsp;</span>{{$soporte->fecha_solicitud}} {{$soporte->hora_solicitud}}
					</p>
				</td>
			</tr>
			<tr style="height:11.75pt;">
				<td colspan="15" valign="top"
					style="width: 757px; border-right: 1pt solid rgb(35, 31, 32); border-bottom: 1pt solid rgb(35, 31, 32); border-left: 1pt solid rgb(35, 31, 32); border-image: initial; border-top: none; background: rgb(237, 237, 238); padding: 0.2pt 1.3pt 0in 0in; height: 11.75pt;">
					<p class="MsoNormal" align="center"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:1.25pt;text-align:center;line-height:107%;">
						<span
							style="font-size: 10pt; line-height: 107%; font-family: Arial, Helvetica, sans-serif;"><strong>Datos
								de Usuario</strong></span></p>
				</td>
			</tr>
			<tr style="height:12.15pt;">
				<td valign="top"
					style="width: 118px; border-right: 1pt solid rgb(35, 31, 32); border-bottom: 1pt solid rgb(35, 31, 32); border-left: 1pt solid rgb(35, 31, 32); border-image: initial; border-top: none; padding: 0.2pt 1.3pt 0in 0in; height: 12.15pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.4pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 10pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">Seccional</span>
					</p>
				</td>
				<td colspan="4" valign="top"
					style="width: 195px; border-top: none; border-left: none; border-bottom: 1pt solid rgb(35, 31, 32); border-right: 1pt solid rgb(35, 31, 32); padding: 0.2pt 1.3pt 0in 0in; height: 12.15pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.25pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 8pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">&nbsp;</span>{{$soporte->seccional}}
					</p>
				</td>
				<td colspan="5" valign="top"
					style="width: 302px; border-top: none; border-left: none; border-bottom: 1pt solid rgb(35, 31, 32); border-right: 1pt solid black; padding: 0.2pt 1.3pt 0in 0in; height: 12.15pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:-.45pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 10pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">Nombre
							de Contacto</span></p>
				</td>
				<td colspan="5" valign="top"
					style="width: 143px; border-top: none; border-left: none; border-bottom: 1pt solid rgb(35, 31, 32); border-right: 1pt solid black; padding: 0.2pt 1.3pt 0in 0in; height: 12.15pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.25pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 8pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">&nbsp;</span>{{$soporte->nombre}} {{$soporte->apellido}}
					</p>
				</td>
			</tr>
			<tr style="height:11.75pt;">
				<td valign="top"
					style="width: 118px; border-right: 1pt solid rgb(35, 31, 32); border-bottom: 1pt solid rgb(35, 31, 32); border-left: 1pt solid rgb(35, 31, 32); border-image: initial; border-top: none; padding: 0.2pt 1.3pt 0in 0in; height: 11.75pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.4pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 10pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">N&uacute;mero
							de C&eacute;dula</span></p>
				</td>
				<td colspan="4" valign="top"
					style="width: 195px; border-top: none; border-left: none; border-bottom: 1pt solid rgb(35, 31, 32); border-right: 1pt solid rgb(35, 31, 32); padding: 0.2pt 1.3pt 0in 0in; height: 11.75pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.25pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 8pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">&nbsp;</span>{{$soporte->cedula}}
					</p>
				</td>
				<td colspan="5" valign="top"
					style="width: 302px; border-top: none; border-left: none; border-bottom: 1pt solid rgb(35, 31, 32); border-right: 1pt solid black; padding: 0.2pt 1.3pt 0in 0in; height: 11.75pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:-.45pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 10pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">Ciudad</span>
					</p>
				</td>
				<td colspan="5" valign="top"
					style="width: 143px; border-top: none; border-left: none; border-bottom: 1pt solid rgb(35, 31, 32); border-right: 1pt solid rgb(35, 31, 32); padding: 0.2pt 1.3pt 0in 0in; height: 11.75pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.25pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 8pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">&nbsp;</span>{{$soporte->ciudad}}
					</p>
				</td>
			</tr>
			<tr style="height:11.5pt;">
				<td valign="top"
					style="width: 118px; border-right: 1pt solid rgb(35, 31, 32); border-bottom: 1pt solid rgb(35, 31, 32); border-left: 1pt solid rgb(35, 31, 32); border-image: initial; border-top: none; padding: 0.2pt 1.3pt 0in 0in; height: 11.5pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.4pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 10pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">Direcci&oacute;n</span>
					</p>
				</td>
				<td colspan="4" valign="top"
					style="width: 195px; border-top: none; border-left: none; border-bottom: 1pt solid rgb(35, 31, 32); border-right: 1pt solid rgb(35, 31, 32); padding: 0.2pt 1.3pt 0in 0in; height: 11.5pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.25pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 8pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">&nbsp;</span>{{$soporte->direccion}}
					</p>
				</td>
				<td colspan="5" valign="top"
					style="width: 302px; border-top: none; border-left: none; border-bottom: 1pt solid rgb(35, 31, 32); border-right: 1pt solid black; padding: 0.2pt 1.3pt 0in 0in; height: 11.5pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:-.45pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 10pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">Tel&eacute;fono/
							Celular</span></p>
				</td>
				<td colspan="5" valign="top"
					style="width: 143px; border-top: none; border-left: none; border-bottom: 1pt solid rgb(35, 31, 32); border-right: 1pt solid rgb(35, 31, 32); padding: 0.2pt 1.3pt 0in 0in; height: 11.5pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.25pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 8pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">&nbsp;</span>{{$soporte->telefono}}
					</p>
				</td>
			</tr>
			<tr style="height:12.15pt;">
				<td valign="top"
					style="width: 118px; border-right: 1pt solid rgb(35, 31, 32); border-bottom: 1pt solid rgb(35, 31, 32); border-left: 1pt solid rgb(35, 31, 32); border-image: initial; border-top: none; padding: 0.2pt 1.3pt 0in 0in; height: 12.15pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.4pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 10pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">Correo
							Electr&oacute;nico</span></p>
				</td>
				<td colspan="6" valign="top"
					style="width: 355px; border-top: none; border-left: none; border-bottom: 1pt solid rgb(35, 31, 32); border-right: 1pt solid black; padding: 0.2pt 1.3pt 0in 0in; height: 12.15pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.25pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 8pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">&nbsp;</span>{{$soporte->correo_empleado}}
					</p>
				</td>
				<td colspan="3" valign="top"
					style="width: 141px; border-top: none; border-left: none; border-bottom: 1pt solid rgb(35, 31, 32); border-right: 1pt solid black; padding: 0.2pt 1.3pt 0in 0in; height: 12.15pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.25pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 10pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">Oficina
							o Juzgado</span></p>
				</td>
				<td colspan="5" valign="top"
					style="width: 143px; border-top: none; border-left: none; border-bottom: 1pt solid rgb(35, 31, 32); border-right: 1pt solid rgb(35, 31, 32); padding: 0.2pt 1.3pt 0in 0in; height: 12.15pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.25pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 8pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">&nbsp;</span>{{$soporte->despacho}}
					</p>
				</td>
			</tr>
			<tr style="height:11.8pt;">
				<td colspan="15" valign="top"
					style="width: 757px; border-top: none; border-left: 1pt solid rgb(35, 31, 32); border-bottom: 1pt solid black; border-right: 1pt solid rgb(35, 31, 32); background: rgb(237, 237, 238); padding: 0.2pt 1.3pt 0in 0in; height: 11.8pt;">
					<p class="MsoNormal" align="center"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.75pt;text-align:center;line-height:107%;">
						<span
							style="font-size: 10pt; line-height: 107%; font-family: Arial, Helvetica, sans-serif;"><strong>Falla
								Reportada</strong></span></p>
				</td>
			</tr>
			<tr style="height:12.15pt;">
				<td colspan="15" valign="top"
					style="width: 757px; border-top: none; border-left: 1pt solid black; border-bottom: 1pt solid rgb(35, 31, 32); border-right: 1pt solid black; padding: 0.2pt 1.3pt 0in 0in; height: 12.15pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.15pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 8pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">&nbsp;</span>{{$soporte->falla_reportada}}
					</p>
				</td>
			</tr>
			<tr style="height:12.0pt;">
				<td colspan="15" valign="top"
					style="width: 757px; border-right: 1pt solid rgb(35, 31, 32); border-bottom: 1pt solid rgb(35, 31, 32); border-left: 1pt solid rgb(35, 31, 32); border-image: initial; border-top: none; background: rgb(237, 237, 238); padding: 0.2pt 1.3pt 0in 0in; height: 12pt;">
					<p class="MsoNormal" align="center"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.6pt;text-align:center;line-height:107%;">
						<span
							style="font-size: 10pt; line-height: 107%; font-family: Arial, Helvetica, sans-serif;"><strong>Ingeniero,
								t&eacute;cnico o agente que atendi&oacute; el caso en sitio</strong></span></p>
				</td>
			</tr>
			<tr style="height:12.15pt;">
				<td colspan="4" valign="top"
					style="width: 170px; border-right: 1pt solid rgb(35, 31, 32); border-bottom: 1pt solid rgb(35, 31, 32); border-left: 1pt solid rgb(35, 31, 32); border-image: initial; border-top: none; padding: 0.2pt 1.3pt 0in 0in; height: 12.15pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.4pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 10pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">Fecha
							y hora de Atenci&oacute;n</span></p>
				</td>
				<td colspan="11" valign="top"
					style="width: 588px; border-top: none; border-left: none; border-bottom: 1pt solid rgb(35, 31, 32); border-right: 1pt solid rgb(35, 31, 32); padding: 0.2pt 1.3pt 0in 0in; height: 12.15pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.5pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 8pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">&nbsp;</span>{{$soporte->fecha_atencion}} {{$soporte->hora_atencion}}
					</p>
				</td>
			</tr>
			<tr style="height:12.4pt;">
				<td colspan="4" valign="top"
					style="width: 170px; border-right: 1pt solid rgb(35, 31, 32); border-bottom: 1pt solid rgb(35, 31, 32); border-left: 1pt solid rgb(35, 31, 32); border-image: initial; border-top: none; padding: 0.2pt 1.3pt 0in 0in; height: 12.4pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.4pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 10pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">Nombre</span>
					</p>
				</td>
				<td colspan="11" valign="top"
					style="width: 588px; border-top: none; border-left: none; border-bottom: 1pt solid rgb(35, 31, 32); border-right: 1pt solid rgb(35, 31, 32); padding: 0.2pt 1.3pt 0in 0in; height: 12.4pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.5pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 8pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">&nbsp;</span>{{$soporte->nombre_tecnico}}
					</p>
				</td>
			</tr>
			<tr style="height:12.0pt;">
				<td colspan="15" valign="top"
					style="width: 757px; border-right: 1pt solid rgb(35, 31, 32); border-bottom: 1pt solid rgb(35, 31, 32); border-left: 1pt solid rgb(35, 31, 32); border-image: initial; border-top: none; background: rgb(237, 237, 238); padding: 0.2pt 1.3pt 0in 0in; height: 12pt;">
					<p class="MsoNormal" align="center"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:1.0pt;text-align:center;line-height:107%;">
						<span
							style="font-size: 10pt; line-height: 107%; font-family: Arial, Helvetica, sans-serif;"><strong>Datos
								de Equipo</strong></span></p>
				</td>
			</tr>
			<tr style="height:12.15pt;">
				<td valign="top"
					style="width: 118px; border-right: 1pt solid rgb(35, 31, 32); border-bottom: 1pt solid rgb(35, 31, 32); border-left: 1pt solid rgb(35, 31, 32); border-image: initial; border-top: none; padding: 0.2pt 1.3pt 0in 0in; height: 12.15pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.4pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 10pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">Placa
							Equipo</span></p>
				</td>
				<td colspan="4" valign="top"
					style="width: 195px; border-top: none; border-left: none; border-bottom: 1pt solid rgb(35, 31, 32); border-right: 1pt solid rgb(35, 31, 32); padding: 0.2pt 1.3pt 0in 0in; height: 12.15pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.25pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 7pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">&nbsp;</span>{{$soporte->placa}}
					</p>
				</td>
				<td valign="top"
					style="width: 112px; border-top: none; border-left: none; border-bottom: 1pt solid rgb(35, 31, 32); border-right: 1pt solid black; padding: 0.2pt 1.3pt 0in 0in; height: 12.15pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:-.45pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 10pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">Serial
							Equipo</span></p>
				</td>
				<td colspan="9" valign="top"
					style="width: 332px; border-top: none; border-left: none; border-bottom: 1pt solid rgb(35, 31, 32); border-right: 1pt solid rgb(35, 31, 32); padding: 0.2pt 1.3pt 0in 0in; height: 12.15pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.25pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 7pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">&nbsp;</span>{{$soporte->serial_equipo}}
					</p>
				</td>
			</tr>
			<tr style="height:11.5pt;">
				<td valign="top"
					style="width: 118px; border-right: 1pt solid rgb(35, 31, 32); border-bottom: 1pt solid rgb(35, 31, 32); border-left: 1pt solid rgb(35, 31, 32); border-image: initial; border-top: none; padding: 0.2pt 1.3pt 0in 0in; height: 11.5pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.4pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 10pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">Marca
							equipo</span></p>
				</td>
				<td colspan="4" valign="top"
					style="width: 195px; border-top: none; border-left: none; border-bottom: 1pt solid rgb(35, 31, 32); border-right: 1pt solid rgb(35, 31, 32); padding: 0.2pt 1.3pt 0in 0in; height: 11.5pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.25pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 7pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">&nbsp;</span>{{$soporte->marca_equipo}}
					</p>
				</td>
				<td valign="top"
					style="width: 112px; border-top: none; border-left: none; border-bottom: 1pt solid rgb(35, 31, 32); border-right: 1pt solid black; padding: 0.2pt 1.3pt 0in 0in; height: 11.5pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:-.45pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 10pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">Modelo
							Equipo</span></p>
				</td>
				<td colspan="9" valign="top"
					style="width: 332px; border-top: none; border-left: none; border-bottom: 1pt solid rgb(35, 31, 32); border-right: 1pt solid rgb(35, 31, 32); padding: 0.2pt 1.3pt 0in 0in; height: 11.5pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.25pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 7pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">&nbsp;</span>{{$soporte->modelo_equipo}}
					</p>
				</td>
			</tr>
			<tr style="height:12.15pt;">
				<td valign="top"
					style="width: 118px; border-right: 1pt solid rgb(35, 31, 32); border-bottom: 1pt solid rgb(35, 31, 32); border-left: 1pt solid rgb(35, 31, 32); border-image: initial; border-top: none; padding: 0.2pt 1.3pt 0in 0in; height: 12.15pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.4pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 10pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">Sistema
							Operativo</span></p>
				</td>
				<td colspan="4" valign="top"
					style="width: 195px; border-top: none; border-left: none; border-bottom: 1pt solid rgb(35, 31, 32); border-right: 1pt solid rgb(35, 31, 32); padding: 0.2pt 1.3pt 0in 0in; height: 12.15pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.25pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 5pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">&nbsp;</span>{{$soporte->sistema_operativo}}
					</p>
				</td>
				<td valign="top"
					style="width: 112px; border-top: none; border-left: none; border-bottom: 1pt solid rgb(35, 31, 32); border-right: 1pt solid black; padding: 0.2pt 1.3pt 0in 0in; height: 12.15pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:-.45pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 10pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">Antivirus</span>
					</p>
				</td>
				<td colspan="3" valign="top"
					style="width: 66px; border-top: none; border-left: none; border-bottom: 1pt solid rgb(35, 31, 32); border-right: 1pt solid black; padding: 0.2pt 1.3pt 0in 0in; height: 12.15pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.25pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 6pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">&nbsp;</span>{{$soporte->antivirus}}
					</p>
				</td>
				<td colspan="4" valign="top"
					style="width: 123px; border-top: none; border-left: none; border-bottom: 1pt solid rgb(35, 31, 32); border-right: 1pt solid black; padding: 0.2pt 1.3pt 0in 0in; height: 12.15pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.25pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 10pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">&nbsp;&nbsp;&nbsp;&nbsp;
							Versi&oacute;n Antivirus</span></p>
				</td>
				<td colspan="2" valign="top"
					style="width: 143px; border-top: none; border-left: none; border-bottom: 1pt solid rgb(35, 31, 32); border-right: 1pt solid rgb(35, 31, 32); padding: 0.2pt 1.3pt 0in 0in; height: 12.15pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.25pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 8pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">&nbsp;&nbsp;</span>{{$soporte->ver_antivirus}}
					</p>
				</td>
			</tr>
			<tr style="height:12.0pt;">
				<td colspan="15" valign="top"
					style="width: 757px; border-right: 1pt solid rgb(35, 31, 32); border-bottom: 1pt solid rgb(35, 31, 32); border-left: 1pt solid rgb(35, 31, 32); border-image: initial; border-top: none; background: rgb(237, 237, 238); padding: 0.2pt 1.3pt 0in 0in; height: 12pt;">
					<p class="MsoNormal" align="center"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:1.4pt;text-align:center;line-height:107%;">
						<span
							style="font-size: 10pt; line-height: 107%; font-family: Arial, Helvetica, sans-serif;"><strong>Requiere
								equipo de continuidad</strong></span></p>
				</td>
			</tr>
			<tr style="height:12.15pt;">
				<td colspan="3" valign="top"
					style="width: 151px; border-right: 1pt solid rgb(35, 31, 32); border-bottom: 1pt solid rgb(35, 31, 32); border-left: 1pt solid rgb(35, 31, 32); border-image: initial; border-top: none; padding: 0.2pt 1.3pt 0in 0in; height: 12.15pt;">
					<p class="MsoNormal" align="center"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:1.15pt;text-align:center;line-height:107%;">
						<span
							style="font-size: 10pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">Si</span>
					</p>
				</td>
				<td colspan="12" valign="top"
					style="width: 607px; border-top: none; border-left: none; border-bottom: 1pt solid rgb(35, 31, 32); border-right: 1pt solid rgb(35, 31, 32); padding: 0.2pt 1.3pt 0in 0in; height: 12.15pt;">
					<p class="MsoNormal" align="center"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:3.95pt;text-align:center;line-height:107%;">
						<span style="font-size:10pt; line-height:107%; font-family:Arial, Helvetica, sans-serif; font-weight:normal;">
                            @if (trim(strtoupper($soporte->elementos_de_soporte)) === 'SI')
                                <span style="color:#1F1F1F; font-weight:bold;">X</span>
                            @endif
                        </span>
                    </p>
				</td>
			</tr>
			<tr style="height:12.4pt;">
				<td colspan="3" valign="top"
					style="width: 151px; border-right: 1pt solid rgb(35, 31, 32); border-bottom: 1pt solid rgb(35, 31, 32); border-left: 1pt solid rgb(35, 31, 32); border-image: initial; border-top: none; padding: 0.2pt 1.3pt 0in 0in; height: 12.4pt;">
					<p class="MsoNormal" align="center"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:1.1pt;text-align:center;line-height:107%;">
						<span
							style="font-size: 10pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">No</span>
					</p>
				</td>
				<td colspan="12" valign="top"
					style="width: 607px; border-top: none; border-left: none; border-bottom: 1pt solid rgb(35, 31, 32); border-right: 1pt solid rgb(35, 31, 32); padding: 0.2pt 1.3pt 0in 0in; height: 12.4pt;">
					<p class="MsoNormal" align="center"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:3.95pt;text-align:center;line-height:107%;">
						<span style="font-size:10pt; line-height:107%; font-family:Arial, Helvetica, sans-serif; font-weight:normal;">
                            @if (trim(strtoupper($soporte->elementos_de_soporte)) === 'NO')
                                <span style="color:#1F1F1F; font-weight:bold;">X</span>
                            @endif
                        </span>
					</p>
				</td>
			</tr>
			<tr style="height:12.0pt;">
				<td colspan="15" valign="top"
					style="width: 757px; border-right: 1pt solid rgb(35, 31, 32); border-bottom: 1pt solid rgb(35, 31, 32); border-left: 1pt solid rgb(35, 31, 32); border-image: initial; border-top: none; background: rgb(237, 237, 238); padding: 0.2pt 1.3pt 0in 0in; height: 12pt;">
					<p class="MsoNormal" align="center"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.7pt;text-align:center;line-height:107%;">
						<span
							style="font-size: 10pt; line-height: 107%; font-family: Arial, Helvetica, sans-serif;"><strong>Descripci&oacute;n
								del Servicio</strong></span></p>
				</td>
			</tr>
			<tr style="height:11.9pt;">
				<td colspan="15" valign="top"
					style="width: 757px; border-right: 1pt solid rgb(35, 31, 32); border-bottom: 1pt solid rgb(35, 31, 32); border-left: 1pt solid rgb(35, 31, 32); border-image: initial; border-top: none; padding: 0.2pt 1.3pt 0in 0in; height: 11.9pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.4pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 10pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">Informaci&oacute;n
							de Diagn&oacute;stico:&nbsp;&nbsp;</span> {{$soporte->diagnostico}}</p>
				</td>
			</tr>
			<tr style="height:11.5pt;">
				<td colspan="15" valign="top"
					style="width: 757px; border-top: none; border-left: 1pt solid rgb(35, 31, 32); border-bottom: 1pt solid black; border-right: 1pt solid rgb(35, 31, 32); padding: 0.2pt 1.3pt 0in 0in; height: 11.5pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.4pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 10pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;">Soluci&oacute;n
							entregada y/o Observaciones:</span>{{$soporte->solucion}}</p>
				</td>
			</tr>
		<tr style="height:60pt;">
                <!-- COLUMNA IZQUIERDA: OBSERVACIONES DEL INGENIERO -->
                <td colspan="5" rowspan="6" valign="top"
                    style="width: 310px; border-top:none; border-left:1pt solid #231f20; border-bottom:1pt solid #231f20; border-right:1.5pt solid #231f20; padding:4pt;">
                    <p style="margin:0; font-size:10pt; font-family:Arial, Helvetica, sans-serif;">
                        <strong>Recomendaciones preventivas (Observaciones del ingeniero):</strong>
                    </p>
                    <p style="margin:2pt 0 0 0; font-size:10pt; font-family:Arial, Helvetica, sans-serif; line-height:1.2;">
                        {{$soporte->observacion_tecnico}}
                    </p>
                </td>
            
                <!-- COLUMNA DERECHA: CALIFICACIÓN DEL SERVICIO -->
                <td colspan="10" valign="top"
                    style="width: 440px; border-top:none; border-left:none; border-bottom:1.5pt solid #231f20; border-right:1pt solid #231f20; padding:4pt;">
                    <p style="margin:0; font-size:10pt; font-family:Arial, Helvetica, sans-serif;">
                        <strong>Calificación del servicio</strong>
                    </p>
                    <p style="margin:3pt 0 0 0; font-size:10pt; font-family:Arial, Helvetica, sans-serif; line-height:1.2;">
                        Por favor marque con una X las siguientes preguntas considerando 1 como la mínima
                        calificación y 5 como la máxima, de acuerdo con el grado de satisfacción con el servicio prestado.
                    </p>
                </td>
            </tr>
            
            <!-- ENCABEZADO DE PREGUNTAS -->
            <tr style="height:14pt;">
                <td colspan="5" style="width:280px; border:1pt solid #231f20; background:#EDEDEE; text-align:center; font-weight:bold; padding:4px;">
                    PREGUNTAS
                </td>
                @for($i=1; $i<=5; $i++)
                    <td style="width:39px; border:1pt solid #231f20; background:#EDEDEE; text-align:center; font-weight:bold; padding:4px;">
                        {{ $i }}
                    </td>
                @endfor
            </tr>
            
            <!-- DISPOSICIÓN -->
            <tr style="height:12pt;">
                <td colspan="5" style="border:1pt solid #231f20; padding:3pt;">
                    Disposición para atención de servicio del ingeniero.
                </td>
                @for($i=1; $i<=5; $i++)
                    <td style="border:1pt solid #231f20; text-align:center; vertical-align:middle;">
                        @if($soporte->disposicion == "$i") X @endif
                    </td>
                @endfor
            </tr>
            
            <!-- CONOCIMIENTO TÉCNICO -->
            <tr style="height:12pt;">
                <td colspan="5" style="border:1pt solid #231f20; padding:3pt;">
                    Conocimiento técnico del ingeniero.
                </td>
                @for($i=1; $i<=5; $i++)
                    <td style="border:1pt solid #231f20; text-align:center; vertical-align:middle;">
                        @if($soporte->conocimiento_tec == "$i") X @endif
                    </td>
                @endfor
            </tr>
            
            <!-- TIEMPO DE ATENCIÓN -->
            <tr style="height:12pt;">
                <td colspan="5" style="border:1pt solid #231f20; padding:3pt;">
                    Tiempo de atención y solución.
                </td>
                @for($i=1; $i<=5; $i++)
                    <td style="border:1pt solid #231f20; text-align:center; vertical-align:middle;">
                        @if($soporte->tiempo_aten == "$i") X @endif
                    </td>
                @endfor
            </tr>
            
            <!-- INFORMACIÓN DEL CASO -->
            <tr style="height:12pt;">
                <td colspan="5" style="border:1pt solid #231f20; padding:3pt;">
                    Información del avance del caso. 
                </td>
                @for($i=1; $i<=5; $i++)
                    <td style="border:1pt solid #231f20; text-align:center; vertical-align:middle;">
                        @if($soporte->avance_caso == "$i") X @endif
                    </td>
                @endfor
            </tr>


			<tr style="height:12.1pt;">
				<td colspan="6" valign="top"
					style="width: 425px; border-top: none; border-left: 1pt solid rgb(65, 64, 66); border-bottom: 1pt solid black; border-right: 1pt solid rgb(35, 31, 32); background: rgb(230, 231, 232); padding: 0.2pt 1.3pt 0in 0in; height: 12.1pt;">
					<p class="MsoNormal" align="center"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.45pt;text-align:center;line-height:107%;">
						<span
							style="font-size: 10pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;"><strong>Nombre
								del Ingeniero</strong></span></p>
				</td>
				<td colspan="9" valign="top"
					style="width: 332px; border-top: none; border-left: none; border-bottom: 1pt solid black; border-right: 1pt solid rgb(65, 64, 66); background: rgb(230, 231, 232); padding: 0.2pt 1.3pt 0in 0in; height: 12.1pt;">
					<p class="MsoNormal" align="center"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:1.35pt;text-align:center;line-height:107%;">
						<span
							style="font-size: 10pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;"><strong>Nombre
								del cliente</strong></span></p>
				</td>
			</tr>
			<tr style="height:15.05pt;">
				<td colspan="6" valign="top"
					style="width: 425px; border-right: 1pt solid black; border-bottom: 1pt solid black; border-left: 1pt solid black; border-image: initial; border-top: none; padding: 0.2pt 1.3pt 0in 0in; height: 15.05pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.15pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 8pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;"><strong>&nbsp;</strong></span>
							{{$soporte->nombre_tecnico}}
							
					</p>
				</td>
				<td colspan="9" valign="top"
					style="width: 332px; border-top: none; border-left: none; border-bottom: 1pt solid black; border-right: 1pt solid black; padding: 0.2pt 1.3pt 0in 0in; height: 15.05pt;">
					<p class="MsoNormal" align="left"
						style="margin-top:0in;margin-right:0in; margin-bottom:0in;margin-left:.25pt;text-align:left;line-height:107%;">
						<span
							style="font-size: 8pt; line-height: 107%; font-weight: normal; font-family: Arial, Helvetica, sans-serif;"><strong>&nbsp;</strong></span>
							{{$soporte->nombre}} {{$soporte->apellido}}
					</p>
					
				</td>
			</tr>
			<tr style="height:67.8pt;">
        <!-- Firma del Ingeniero -->
        <td colspan="6" valign="top"
            style="width:380px; border:1pt solid black; border-top:none; padding:5pt; text-align:center; vertical-align:top;">
            
            <div style="text-align:center;">
                <img src="{{ $soporte->firma_tecnico }}" 
                     alt="Firma del Ingeniero"
                     style="display:inline-block; width:160pt; height:60pt; object-fit:contain; margin:0 auto;">
            </div>
    
            <p style="margin:2pt 0 0 0; line-height:100%; font-family:Arial, Helvetica, sans-serif; font-size:9pt;">
                <strong>________________________________</strong><br>
                <strong>Firma del Ingeniero</strong><br>
                Cédula: {{ $soporte->cedula_tec }}
            </p>
        </td>
    
        <!-- Firma del Cliente -->
        <td colspan="9" valign="top"
            style="width:380px; border-right:1pt solid black; border-bottom:1pt solid black; padding:5pt; text-align:center; vertical-align:top;">
            
            <div style="text-align:center;">
                <img src="{{ $soporte->firma }}" 
                     alt="Firma del Cliente"
                     style="display:inline-block; width:160pt; height:60pt; object-fit:contain; margin:0 auto;">
            </div>
    
            <p style="margin:2pt 0 0 0; line-height:100%; font-family:Arial, Helvetica, sans-serif; font-size:9pt;">
                <strong>________________________________</strong><br>
                <strong>Firma del Cliente</strong><br>
                Cédula: {{ $soporte->cedula }}
            </p>
        </td>
    </tr>

			<tr>
				<td style="border: none; width: 118px;"><span
						style="font-family: Arial, Helvetica, sans-serif;"><strong><br></strong></span></td>
				<td style="border: none; width: 23px;"><span
						style="font-family: Arial, Helvetica, sans-serif;"><strong><br></strong></span></td>
				<td style="border: none; width: 9px;"><span
						style="font-family: Arial, Helvetica, sans-serif;"><strong><br></strong></span></td>
				<td style="border: none; width: 19px;"><span
						style="font-family: Arial, Helvetica, sans-serif;"><strong><br></strong></span></td>
				<td style="border: none; width: 143px;"><span
						style="font-family: Arial, Helvetica, sans-serif;"><strong><br></strong></span></td>
				<td style="border: none; width: 112px;"><span
						style="font-family: Arial, Helvetica, sans-serif;"><strong><br></strong></span></td>
				<td style="border: none; width: 48px;"><span
						style="font-family: Arial, Helvetica, sans-serif;"><strong><br></strong></span></td>
				<td style="border: none; width: 18px;"><span
						style="font-family: Arial, Helvetica, sans-serif;"><strong><br></strong></span></td>
				<td style="border: none; width: 106px;"><span
						style="font-family: Arial, Helvetica, sans-serif;"><strong><br></strong></span></td>
				<td style="border: none; width: 17px;"><span
						style="font-family: Arial, Helvetica, sans-serif;"><strong><br></strong></span></td>
				<td style="border: none; width: 20px;"><span
						style="font-family: Arial, Helvetica, sans-serif;"><strong><br></strong></span></td>
				<td style="border: none; width: 28px;"><span
						style="font-family: Arial, Helvetica, sans-serif;"><strong><br></strong></span></td>
				<td style="border: none; width: 38px;"><span
						style="font-family: Arial, Helvetica, sans-serif;"><strong><br></strong></span></td>
				<td style="border: none; width: 28px;"><span
						style="font-family: Arial, Helvetica, sans-serif;"><strong><br></strong></span></td>
				<td style="border: none; width: 28px;"><span
						style="font-family: Arial, Helvetica, sans-serif;"><strong><br></strong></span></td>
			</tr>
		</tbody>
	</table>
	
      
            <hr style="border: 0; border-top: 1px solid #000; margin: 4px 0; width: 100%;">
        
            <p class="MsoNormal" style="margin:0; text-align:left; line-height:100%;">
                <span style="font-size: 9pt; font-family: Arial, Helvetica, sans-serif;">
                    <strong>H&aacute;beas Data, Ley 1581 de 2012</strong>
                </span>
            </p>
            
            <p class="MsoNormal" style="margin:4px 0; text-align:justify; line-height:100%;">
                <span style="font-size: 8.5pt; font-family: Arial, Helvetica, sans-serif;">
                    Este documento contiene informaci&oacute;n de car&aacute;cter confidencial exclusivamente dirigida a su destinatario o destinatarios. 
                    Si no es Ud. el destinatario indicado, queda notificado que la lectura, utilizaci&oacute;n, divulgaci&oacute;n y/o copia sin autorizaci&oacute;n 
                    est&aacute; prohibida en virtud de la legislaci&oacute;n vigente. Evite imprimir este documento si no es estrictamente necesario.
                </span>
            </p>
            
            <div style="display:flex; justify-content:flex-end; margin-top:4px;">
                <p class="Footer" style="margin:0; color:#00c4ee; font-size:8pt; font-family: Arial, Helvetica, sans-serif; text-align:right;">
                    <a href="https://www.disajcali.gov.co" target="_blank" style="color:#00c4ee; text-decoration:none;">
                        www.disajcali.gov.co
                    </a>
                </p>
            </div>
       



</div>

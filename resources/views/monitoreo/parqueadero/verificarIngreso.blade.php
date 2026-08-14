{{-- Modal principal: Vehículo encontrado – Sin ingreso activo hoy --}}
<div class="modal fade" id="VerificarIngreso" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document" style="max-width: 550px; margin: 40px auto;">
        <div class="modal-content" style="border-radius: 24px; border: none; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); overflow: hidden;">

            {{-- Header --}}
            <div class="modal-header" style="background: linear-gradient(135deg, #1e40af, #3b82f6); padding: 32px 32px; border: none; position: relative;">
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.8; font-size: 24px; position: absolute; right: 24px; top: 24px;">&times;</button>
                <div style="display: flex; align-items: center; gap: 20px;">
                    <div style="width: 64px; height: 64px; background: rgba(255,255,255,0.2); border-radius: 18px; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(4px);">
                        <i class="fa fa-car" style="color: #fff; font-size: 32px;"></i>
                    </div>
                    <div>
                        <h4 class="modal-title" style="color: #fff; font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 20px; margin: 0; text-transform: uppercase; letter-spacing: 0.5px;">Control de Acceso</h4>
                        <p style="color: rgba(255,255,255,0.8); margin: 4px 0 0; font-size: 13px; font-weight: 500;">Registro de nuevo ingreso al parqueadero</p>
                    </div>
                </div>
            </div>

            {{-- Body --}}
            <div class="modal-body" style="padding: 32px 32px; background: #fff;">
                <input type="hidden" id="id">

                {{-- Advertencia Seccional --}}
                <div id="advertencia_porteria_div" style="display: none; margin-bottom: 24px;">
                    <div style="background: #fffbeb; border: 1px solid #fde68a; border-left: 5px solid #f59e0b; border-radius: 12px; padding: 16px; display: flex; align-items: center; gap: 12px;">
                        <i class="fa fa-exclamation-triangle" style="color: #d97706; font-size: 18px;"></i>
                        <span id="advertencia_porteria_msg" style="color: #92400e; font-weight: 600; font-size: 13px;"></span>
                    </div>
                </div>

                {{-- Alerta Inspeccion Oficiales --}}
                <div id="alerta_inspeccion_ingreso" style="display: none; margin-bottom: 24px;">
                    <div style="background: #fee2e2; border: 1px solid #fca5a5; border-left: 5px solid #ef4444; border-radius: 12px; padding: 16px; display: flex; align-items: center; gap: 12px;">
                        <i class="fa fa-ban" style="color: #dc2626; font-size: 18px;"></i>
                        <span id="msj_inspeccion_ingreso" style="color: #991b1b; font-weight: 600; font-size: 13px;"></span>
                    </div>
                </div>

                {{-- Main Info Card --}}
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 20px; padding: 24px; margin-bottom: 24px;">
                    <div style="display: flex; gap: 20px;">
                        <div style="flex: 1;">
                            <div style="display: flex; justify-content: space-between; gap: 20px; margin-bottom: 20px;">
                                <div style="flex: 1;">
                                    <small style="color: #64748b; font-weight: 700; text-transform: uppercase; font-size: 11px; letter-spacing: 1px;">Identificaci&oacute;n</small>
                                    <input type="text" id="identificacion" readonly style="border: none; background: transparent; width: 100%; font-size: 16px; font-weight: 700; color: #475569; padding: 0; outline: none;">
                                </div>
                                <div style="flex: 1; text-align: right;">
                                    <small style="color: #64748b; font-weight: 700; text-transform: uppercase; font-size: 11px; letter-spacing: 1px;">Estado</small>
                                    <div style="margin-top: 4px;"><span class="label label-success" style="border-radius: 99px; padding: 5px 12px; font-size: 11px; text-transform: uppercase;">ACTIVO</span></div>
                                </div>
                            </div>
                            
                            <div style="margin-bottom: 20px;">
                                <small style="color: #64748b; font-weight: 700; text-transform: uppercase; font-size: 11px; letter-spacing: 1px;">Funcionario / Usuario</small>
                                <input type="text" id="nombre" readonly style="border: none; background: transparent; width: 100%; font-size: 18px; font-weight: 800; color: #dc2626; text-transform: uppercase; padding: 0; outline: none; margin-top: 4px;">
                            </div>
                        </div>
                        
                        <div id="div_foto_empleado" style="display: none; width: 105px; flex-shrink: 0;">
                            <div style="border: 3px solid #e2e8f0; border-radius: 8px; padding: 3px; background: #fff; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                                <img id="img_foto_empleado" src="" alt="Foto" style="width: 100%; height: 135px; border-radius: 4px; object-fit: cover; display: block;">
                            </div>
                        </div>
                    </div>

                    <div id="div_empresa" style="display: none; margin-bottom: 16px;">
                        <small style="color: #64748b; font-weight: 700; text-transform: uppercase; font-size: 11px; letter-spacing: 1px;">Empresa / Entidad</small>
                        <input type="text" id="empresa_modal" readonly style="border: none; background: transparent; width: 100%; font-size: 14px; font-weight: 600; color: #475569; padding: 0; outline: none; margin-top: 4px;">
                    </div>

                    <div style="padding-top: 20px; border-top: 1px solid #e2e8f0; margin-top: 10px;">
                        <small style="color: #64748b; font-weight: 700; text-transform: uppercase; font-size: 11px; letter-spacing: 1px;">Dependencia / Despacho</small>
                        <input type="text" id="despacho" readonly style="border: none; background: transparent; width: 100%; font-size: 13px; font-weight: 600; color: #64748b; text-transform: uppercase; padding: 0; outline: none; margin-top: 4px;">
                    </div>
                    <div style="background: #eff6ff; border: 2px solid #dbeafe; border-radius: 16px; padding: 12px; text-align: center;">
                        <small style="color: #1e40af; font-weight: 700; text-transform: uppercase; font-size: 16px; letter-spacing: 0.5px; display: block; margin-bottom: 4px;">Placa</small>
                        <input type="text" id="placa" readonly style="border: none; background: transparent; width: 100%; font-size: 24px; font-weight: 800; color: #dc2626; letter-spacing: 1px; text-align: center; outline: none;">
                    </div>
                </div>

                {{-- Descripción del Vehículo (Nuevo campo solicitado) --}}
                <div style="margin-bottom: 24px; background: #f0f9ff; border: 1px solid #bae6fd; border-radius: 16px; padding: 16px; display: flex; align-items: center; gap: 12px;">
                    <div style="width: 40px; height: 40px; background: #fff; border-radius: 10px; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
                        <i class="fa fa-info-circle" style="color: #0284c7; font-size: 18px;"></i>
                    </div>
                    <div style="flex: 1;">
                        <small style="color: #0369a1; font-weight: 700; text-transform: uppercase; font-size: 10px; letter-spacing: 0.5px; display: block; margin-bottom: 2px;">Descripci&oacute;n del Veh&iacute;culo</small>
                        <input type="text" id="caract" readonly style="border: none; background: transparent; width: 100%; font-size: 14px; font-weight: 700; color: #0c4a6e; padding: 0; outline: none;" placeholder="SIN DESCRIPCIÓN REGISTRADA">
                    </div>
                </div>

                {{-- Vehicle Details Grid --}}
                <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 12px; margin-bottom: 24px;">
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 16px; padding: 12px; text-align: center;">
                        <small style="color: #64748b; font-weight: 700; text-transform: uppercase; font-size: 10px; letter-spacing: 0.5px; display: block; margin-bottom: 4px;">Tipo</small>
                        <input type="text" id="tipo" readonly style="border: none; background: transparent; width: 100%; font-size: 14px; font-weight: 700; color: #334155; text-align: center; outline: none;">
                    </div>
                    <div style="background: #fef2f2; border: 1px solid #fee2e2; border-radius: 16px; padding: 12px; text-align: center;">
                        <small style="color: #991b1b; font-weight: 700; text-transform: uppercase; font-size: 10px; letter-spacing: 0.5px; display: block; margin-bottom: 4px;">Puesto</small>
                        <input type="text" id="ubicacion_detalle" readonly style="border: none; background: transparent; width: 100%; font-size: 14px; font-weight: 800; color: #dc2626; text-align: center; outline: none;">
                    </div>
                    <div style="background: #fefce8; border: 1px solid #fef08a; border-radius: 16px; padding: 12px; text-align: center;">
                        <small style="color: #a16207; font-weight: 700; text-transform: uppercase; font-size: 10px; letter-spacing: 0.5px; display: block; margin-bottom: 4px;">Ocupaci&oacute;n</small>
                        <input type="text" id="capacidad_info" readonly style="border: none; background: transparent; width: 100%; font-size: 14px; font-weight: 800; color: #ca8a04; text-align: center; outline: none;">
                    </div>
                </div>

                {{-- Novedades Field --}}
                <div class="form-group" style="margin-bottom: 0;">
                    <label style="color: #1e293b; font-weight: 700; font-size: 13px; margin-bottom: 10px; display: block;">Novedades / Observaciones de Ingreso:</label>
                    <textarea id="novedades" class="form-control" rows="2" 
                              style="border-radius: 12px; border: 2px solid #f1f5f9; background: #f8fafc; padding: 14px; font-size: 14px; transition: all 0.2s; outline: none; resize: none;"
                              placeholder="Ej: Veh&iacute;culo con da&ntilde;o visible..."
                              onfocus="this.style.borderColor='#3b82f6'; this.style.background='#fff';"
                              onblur="this.style.borderColor='#f1f5f9'; this.style.background='#f8fafc';"></textarea>
                </div>
            </div>

            {{-- Footer --}}
            <div class="modal-footer" style="padding: 24px 32px; background: #f8fafc; border-top: 1px solid #f1f5f9;">
                <div style="display: flex; gap: 16px;">
                    {{-- Botón Ingreso --}}
                    <button type="button" id="BotonRegistrarIngreso" 
                            style="flex: 2; background: #2563eb; color: #fff; border: none; border-radius: 14px; font-weight: 700; font-size: 14px; padding: 18px; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; justify-content: center; gap: 10px; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);">
                        <i class="fa fa-check-circle" style="font-size: 18px;"></i> REGISTRAR INGRESO
                    </button>
                    
                    {{-- Botón Salida (Oculto por defecto, manejado por JS) --}}
                    <a href="{{ route('parqueadero.registar.salida.cedula', ':CEDULA_ID') }}"
                       id="BotonRegistrarSalida"
                       style="flex: 2; background: #dc2626; color: #fff; border: none; border-radius: 14px; font-weight: 700; font-size: 14px; padding: 18px; cursor: pointer; transition: all 0.2s; display: none; align-items: center; justify-content: center; gap: 10px; text-decoration: none; box-shadow: 0 4px 12px rgba(220, 38, 38, 0.2);">
                        <i class="fa fa-sign-out" style="font-size: 18px;"></i> REGISTRAR SALIDA
                    </a>

                    {{-- Botón Cerrar --}}
                    <button type="button" class="btn" data-dismiss="modal" 
                            style="flex: 1; background: #fff; color: #64748b; border: 2px solid #e2e8f0; border-radius: 14px; font-weight: 700; font-size: 14px; padding: 18px; transition: all 0.2s;">
                        CERRAR
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
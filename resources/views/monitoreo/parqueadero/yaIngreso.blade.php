{{-- Modal: Ya tiene ingreso registrado hoy --}}
<div class="modal fade" id="ResultadoConsultaI" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-md" role="document" style="max-width: 500px; margin: 50px auto;">
        <div class="modal-content" style="border-radius: 24px; border: none; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); overflow: hidden;">
            
            {{-- Header con gradiente azul --}}
            <div class="modal-header" style="background: linear-gradient(135deg, #1e40af, #3b82f6); padding: 32px 28px; border: none; position: relative;">
                <button type="button" class="close" data-dismiss="modal" style="color: #fff; opacity: 0.8; font-size: 24px; position: absolute; right: 24px; top: 24px;">&times;</button>
                <div style="display: flex; align-items: center; gap: 20px;">
                    <div style="width: 64px; height: 64px; background: rgba(255,255,255,0.2); border-radius: 18px; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(4px);">
                        <i class="fa fa-info-circle" style="color: #fff; font-size: 32px;"></i>
                    </div>
                    <div>
                        <h4 class="modal-title" style="color: #fff; font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 20px; margin: 0; text-transform: uppercase; letter-spacing: 0.5px;">Estado del Vehículo</h4>
                        <p style="color: rgba(255,255,255,0.8); margin: 4px 0 0; font-size: 13px; font-weight: 500;">El vehículo ya se encuentra registrado adentro</p>
                    </div>
                </div>
            </div>

            <div class="modal-body" style="padding: 32px 28px; background: #fff;">
                <input type="hidden" id="id__">
                
                {{-- Info Card --}}
                <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 20px; padding: 24px; margin-bottom: 24px;">
                    <div style="display: flex; gap: 20px;">
                        <div style="flex: 1;">
                            <div style="display: flex; justify-content: space-between; gap: 20px; margin-bottom: 20px;">
                                <div style="flex: 1;">
                                    <small style="color: #64748b; font-weight: 700; text-transform: uppercase; font-size: 11px; letter-spacing: 1px;">Placa</small>
                                    <input type="text" id="placa__" readonly style="border: none; background: transparent; width: 100%; font-size: 22px; font-weight: 800; color: #dc2626; letter-spacing: 2px; padding: 0; outline: none;">
                                </div>
                                <div style="flex: 1; text-align: right;">
                                    <small style="color: #64748b; font-weight: 700; text-transform: uppercase; font-size: 11px; letter-spacing: 1px;">Identificación</small>
                                    <input type="text" id="identificacion__" readonly style="border: none; background: transparent; width: 100%; font-size: 16px; font-weight: 700; color: #475569; padding: 0; outline: none; text-align: right;">
                                </div>
                            </div>
                            
                            <hr style="border-top: 1px solid #e2e8f0; margin: 0 0 20px;">
                            
                            <div>
                                <small style="color: #64748b; font-weight: 700; text-transform: uppercase; font-size: 11px; letter-spacing: 1px;">Funcionario / Propietario</small>
                                <input type="text" id="nombre__" readonly style="border: none; background: transparent; width: 100%; font-size: 16px; font-weight: 700; color: #dc2626; text-transform: uppercase; padding: 0; outline: none; margin-top: 4px;">
                            </div>
                        </div>

                        <div id="div_foto_empleado_ya" style="display: none; width: 105px; flex-shrink: 0;">
                            <div style="border: 3px solid #e2e8f0; border-radius: 8px; padding: 3px; background: #fff; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                                <img id="img_foto_empleado_ya" src="" alt="Foto" style="width: 100%; height: 135px; border-radius: 4px; object-fit: cover; display: block;">
                            </div>
                        </div>
                    </div>

                    <div style="margin-top: 16px; display: flex; gap: 20px;">
                        <div style="flex: 1;">
                            <small style="color: #64748b; font-weight: 700; text-transform: uppercase; font-size: 11px; letter-spacing: 1px;">Despacho</small>
                            <input type="text" id="despacho__" readonly style="border: none; background: transparent; width: 100%; font-size: 13px; font-weight: 600; color: #64748b; text-transform: uppercase; padding: 0; outline: none; margin-top: 4px;">
                        </div>
                        <div style="flex: 1;">
                            <small style="color: #64748b; font-weight: 700; text-transform: uppercase; font-size: 11px; letter-spacing: 1px;">Descripción Vehículo</small>
                            <input type="text" id="color__" readonly style="border: none; background: transparent; width: 100%; font-size: 13px; font-weight: 700; color: #1e293b; text-transform: uppercase; padding: 0; outline: none; margin-top: 4px;">
                        </div>
                    </div>

                    <div style="margin-top: 16px; display: flex; gap: 20px; background: #fefce8; border: 1px solid #fef08a; border-radius: 12px; padding: 12px;">
                        <div style="flex: 1; text-align: center;">
                            <small style="color: #a16207; font-weight: 700; text-transform: uppercase; font-size: 10px; letter-spacing: 0.5px; display: block; margin-bottom: 2px;">Ocupación del Puesto</small>
                            <input type="text" id="capacidad_info_ya" readonly style="border: none; background: transparent; width: 100%; font-size: 14px; font-weight: 800; color: #ca8a04; text-align: center; outline: none;">
                        </div>
                    </div>
                </div>

                {{-- Novedades Registradas --}}
                <div style="margin-bottom: 24px;">
                    <label style="color: #64748b; font-weight: 700; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; display: block;">
                        <i class="fa fa-history" style="margin-right: 6px;"></i> Novedades de Ingreso
                    </label>
                    <div id="novedades_anteriores_ya" style="background: #f1f5f9; border-radius: 12px; padding: 12px; font-size: 13px; color: #475569; min-height: 40px; border-left: 4px solid #cbd5e1;">—</div>
                </div>

                {{-- Input Novedades Salida --}}
                <div class="form-group" style="margin-bottom: 0;">
                    <label style="color: #1e293b; font-weight: 700; font-size: 13px; margin-bottom: 10px; display: block;">Novedades de Salida:</label>
                    <textarea id="novedades_ya" class="form-control" rows="3" 
                              style="border-radius: 12px; border: 2px solid #f1f5f9; background: #f8fafc; padding: 14px; font-size: 14px; transition: all 0.2s; outline: none; resize: none;"
                              placeholder="Ingrese observaciones de salida si aplica..."
                              onfocus="this.style.borderColor='#3b82f6'; this.style.background='#fff';"
                              onblur="this.style.borderColor='#f1f5f9'; this.style.background='#f8fafc';"></textarea>
                </div>
                
                {{-- Bloqueo Inspección --}}
                <div id="alerta_inspeccion_ya" style="display: none; margin-top: 15px; background: #fee2e2; border-left: 4px solid #ef4444; padding: 12px; border-radius: 8px;">
                    <strong style="color: #b91c1c;">Atención:</strong> <span id="msj_inspeccion_ya" style="color: #991b1b; font-size: 13px;"></span>
                </div>
            </div>

            {{-- Footer --}}
            <div class="modal-footer" style="padding: 24px 32px; background: #f8fafc; border-top: 1px solid #f1f5f9;">
                <div style="display: flex; gap: 16px;">
                    <button type="button" id="BotonRegistrarSalidaYa" 
                            style="flex: 2; background: #2563eb; color: #fff; border: none; border-radius: 14px; font-weight: 700; font-size: 14px; padding: 18px; cursor: pointer; transition: all 0.2s; display: flex; align-items: center; justify-content: center; gap: 10px; box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);">
                        <i class="fa fa-sign-out" style="font-size: 18px;"></i> REGISTRAR SALIDA
                    </button>
                    <button type="button" class="btn" data-dismiss="modal" 
                            style="flex: 1; background: #fff; color: #64748b; border: 2px solid #e2e8f0; border-radius: 14px; font-weight: 700; font-size: 14px; padding: 18px; transition: all 0.2s;">
                        CERRAR
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

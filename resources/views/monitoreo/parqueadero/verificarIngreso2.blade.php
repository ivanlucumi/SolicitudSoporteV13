  <!-- MODAl PARA EDITAR EL EVENTO-->

    <div class="modal fade" id="VerificarIngreso2" data-backdrop="static" data-keyboard="false" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" style="border-radius: 24px; border: none; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); overflow: hidden;">
                <div class="modal-header" style="background: linear-gradient(135deg, #1e40af, #3b82f6); color: white; padding: 32px;">
                    <button type="button" class="close" data-dismiss="modal" style="color: white; opacity: 0.8; font-size: 24px;">&times;</button>    
                    <div style="display: flex; align-items: center; gap: 20px;">
                        <div style="width: 60px; height: 60px; background: rgba(255,255,255,0.2); border-radius: 18px; display: flex; align-items: center; justify-content: center; backdrop-filter: blur(4px);">
                            <i class="fa fa-users" style="color: #fff; font-size: 28px;"></i>
                        </div>
                        <div>
                            <h4 class="modal-title" style="margin: 0; font-weight: 800; font-family: 'Outfit', sans-serif; text-transform: uppercase; letter-spacing: 0.5px;">Selección de Vehículo</h4>
                            <p style="margin: 4px 0 0; opacity: 0.8; font-size: 13px;">Se encontraron múltiples vehículos asociados a esta identificación</p>
                        </div>
                    </div>
                </div>

                <div class="modal-body" style="padding: 32px; background: #fff;">
                    <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 20px; padding: 20px; margin-bottom: 24px; display: flex; align-items: center;">
                        <div style="flex: 1; display: flex; justify-content: space-between; align-items: center;">
                            <div style="flex: 1;">
                                <small style="color: #64748b; font-weight: 700; text-transform: uppercase; font-size: 11px; letter-spacing: 1px;">Propietario / Funcionario</small>
                                <div id="nombre_multi_display" style="font-size: 18px; font-weight: 800; color: #1e293b; margin-top: 4px; text-transform: uppercase;">-</div>
                                <input type="hidden" id="identificacion1">
                            </div>
                            <div style="text-align: right;">
                                <small style="color: #64748b; font-weight: 700; text-transform: uppercase; font-size: 11px; letter-spacing: 1px;">Identificación</small>
                                <div id="cedula_multi_display" style="font-size: 15px; font-weight: 700; color: #475569; margin-top: 4px;">-</div>
                            </div>
                        </div>

                        <div id="div_foto_empleado_multi" style="display: none; width: 105px; flex-shrink: 0; margin-left: 20px;">
                            <div style="border: 3px solid #e2e8f0; border-radius: 8px; padding: 3px; background: #fff; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                                <img id="img_foto_empleado_multi" src="" alt="Foto" style="width: 100%; height: 135px; border-radius: 4px; object-fit: cover; display: block;">
                            </div>
                        </div>
                    </div>

                    <div style="margin-bottom: 24px;">
                        <label style="color: #1e293b; font-weight: 700; font-size: 13px; margin-bottom: 12px; display: block;">Elija el vehículo que va a ingresar:</label>
                        <div class="table-responsive" style="border: none;">
                            <table class="table" style="border-collapse: separate; border-spacing: 0 10px; margin-bottom: 0;" id="tabla_vehiculos_multi">
                                <thead>
                                    <tr style="color: #94a3b8; font-size: 11px; text-transform: uppercase; letter-spacing: 1.2px;">
                                        <th style="border: none; padding: 0 12px 10px;">Vehículo</th>
                                        <th style="border: none; padding: 0 12px 10px;">Placa</th>
                                        <th style="border: none; padding: 0 12px 10px; text-align: center;">Puesto</th>
                                        <th style="border: none; padding: 0 12px 10px; text-align: center;">Ocupación</th>
                                        <th style="border: none; padding: 0 12px 10px; text-align: center;">Estado</th>
                                        <th style="border: none; padding: 0 12px 10px; text-align: center;">Acción</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Se llena vía JS --}}
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <hr style="border-top: 1px solid #f1f5f9; margin: 24px 0;">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group" style="margin-bottom: 0;">
                                <label style="color: #64748b; font-weight: 700; font-size: 11px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 8px; display: block;">Novedades Anteriores:</label>
                                <div id="novedades_anteriores_multi_div" style="background: #f1f5f9; border-radius: 12px; padding: 12px; font-size: 13px; color: #475569; min-height: 50px; border-left: 4px solid #cbd5e1;">—</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" style="margin-bottom: 0;">
                                <label style="color: #1e293b; font-weight: 700; font-size: 13px; margin-bottom: 8px; display: block;">Registrar Nueva Novedad:</label>
                                <textarea id="novedades_multi" class="form-control" rows="2" 
                                          style="border-radius: 12px; border: 2px solid #f1f5f9; background: #f8fafc; padding: 12px; font-size: 14px; transition: all 0.2s; outline: none; resize: none; text-transform: uppercase;"
                                          placeholder="Ingrese observaciones si aplica..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer" style="padding: 24px 32px; background: #f8fafc; border-top: 1px solid #f1f5f9;">
                    <button type="button" class="btn" data-dismiss="modal" 
                            style="width: 150px; background: #fff; color: #64748b; border: 2px solid #e2e8f0; border-radius: 14px; font-weight: 700; font-size: 14px; padding: 12px; transition: all 0.2s;">
                        CANCELAR
                    </button>
                </div>
            </div>
        </div>
    </div>
          


       


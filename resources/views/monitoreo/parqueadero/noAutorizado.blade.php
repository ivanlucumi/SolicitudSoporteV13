{{-- Modal: Vehículo no autorizado / No encontrado --}}
<div class="modal fade" id="noAutorizado" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document" style="max-width: 400px; margin: 80px auto;">
        <div class="modal-content" style="border-radius: 24px; border: none; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.15); overflow: hidden;">
            <div class="modal-header" style="background: #fff; padding: 24px 28px; border-bottom: 1px solid #f1f5f9; text-align: center;">
                <button type="button" class="close" data-dismiss="modal" style="color: #64748b; opacity: 0.5;">&times;</button>
                <div style="width: 56px; height: 56px; background: #fee2e2; border-radius: 16px; display: flex; align-items: center; justify-content: center; margin: 8px auto 16px;">
                    <i class="fa fa-ban" style="color: #ef4444; font-size: 24px;"></i>
                </div>
                <h4 class="modal-title" style="color: #1e293b; font-family: 'Outfit', sans-serif; font-weight: 700; margin: 0; font-size: 18px; text-transform: uppercase;">Acceso Denegado</h4>
            </div>
            <div class="modal-body" style="padding: 24px 28px; text-align: center;">
                <p style="color: #64748b; font-size: 14px; line-height: 1.6; margin-bottom: 24px;">El funcionario no cuenta con una autorización activa para ingresar al parqueadero en esta sede.</p>
                <button type="button" class="btn btn-block" data-dismiss="modal" style="background: #2563eb; color: #fff; border: none; border-radius: 12px; font-weight: 700; padding: 14px; transition: all 0.2s;">
                    ENTENDIDO
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Modal: Vehículo No Autorizado (Placa no encontrada) --}}
<div class="modal fade" id="vehiculoNoAutorizado" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document" style="max-width: 400px; margin: 80px auto;">
        <div class="modal-content" style="border-radius: 24px; border: none; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.15); overflow: hidden;">
            <div class="modal-header" style="background: #fff; padding: 24px 28px; border-bottom: 1px solid #f1f5f9; text-align: center;">
                <button type="button" class="close" data-dismiss="modal" style="color: #64748b; opacity: 0.5;">&times;</button>
                <div style="width: 56px; height: 56px; background: #eff6ff; border-radius: 16px; display: flex; align-items: center; justify-content: center; margin: 8px auto 16px;">
                    <i class="fa fa-search" style="color: #3b82f6; font-size: 24px;"></i>
                </div>
                <h4 class="modal-title" style="color: #1e293b; font-family: 'Outfit', sans-serif; font-weight: 700; margin: 0; font-size: 18px; text-transform: uppercase;">Placa no Encontrada</h4>
            </div>
            <div class="modal-body" style="padding: 24px 28px; text-align: center;">
                <p style="color: #64748b; font-size: 14px; line-height: 1.6; margin-bottom: 24px;">La placa consultada no se encuentra registrada en el sistema. Verifique los datos o registre el vehículo si es visitante.</p>
                <button type="button" class="btn btn-block" data-dismiss="modal" style="background: #2563eb; color: #fff; border: none; border-radius: 12px; font-weight: 700; padding: 14px; transition: all 0.2s;">
                    CERRAR
                </button>
            </div>
        </div>
    </div>
</div>

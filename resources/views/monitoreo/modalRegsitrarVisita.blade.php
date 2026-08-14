  <!-- MODAl PARA EDITAR EL EVENTO-->

  <div class="modal fade" id="modal_registrar_visitas" data-backdrop="static" data-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-centered ">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title pull-center"><strong>REGISTRAR INGRESO DE VISITANTES</strong> </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">

            <span aria-hidden="true">&times;</span></button>
        </div>

        <div class="modal-body">
          <div class="container-fluid">
            <form action="{{ route('store.visitantes.registro.cedula') }}" method="POST">
    @csrf
            <div class="row">
              <div class="col-xs-12 col-sm-4 ">
                <div class="form-group">
                  <label>IDENTIFICACION:</label>
                  <input type="text" name="identificacion" value="{{ old('identificacion')}}" class="form-control" id="vis_identificacion" style="text-transform:uppercase;" onkeyup="javascript:this.value=this.value.toUpperCase();" placeholder="Ingrese Identificacion" autocomplete="off" readonly required />
                </div>
              </div>

              <div class="col-xs-12 col-sm-8  ">
                <div class="form-group">
                  <label>NOMBRE:</label>
                  <input type="text" name="fullname" value="{{ old('fullname')}}" class="form-control" id="vis_fullname" placeholder="Nombre Completo:" autocomplete="off" readonly required />
                  <input type="hidden" name="sexo" value="{{ old('sexo')}}" class="form-control" id="vis_sexo" placeholder="Ingrese Marca" autocomplete="off" readonly />
                  <input type="hidden" name="fecha_nacimiento" value="{{ old('fecha_nacimiento')}}" class="form-control" id="vis_fecha_nacimiento" placeholder="Ingrese Color" autocomplete="off" readonly />
                  <input type="hidden" name="tipo_sangre" value="{{ old('tipo_sangre')}}" class="form-control" id="vis_tipo_sangre" placeholder="Ingrese Color" autocomplete="off" readonly />

                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xs-12 col-sm-6 form-group">
                <label for="TORRE">SELECCIONE TORRE:</label><br>
                <select class="form-control @error('piso') is-invalid @enderror" name="piso" id="piso">
    <option value="">Seleccione Torre</option>
    @foreach($torres as $key => $value)
        <option value="{{ $key }}" @selected(old('piso') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('piso')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>

              </div>
              <div class="col-xs-12 col-sm-6 form-group">
                <label for="piso">SELECCIONE PISO:</label><br>
                <select class="form-control @error('piso') is-invalid @enderror" name="piso" id="piso">
    <option value="">Seleccione Piso</option>
    @foreach($pisos as $key => $value)
        <option value="{{ $key }}" @selected(old('piso') == $key)>{{ $value }}</option>
    @endforeach
</select>
@error('piso')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror<br>

              </div>

            </div>





          </div>
        </div>
        <div class="modal-footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-xs-12 col-sm-6">

                <button class="btn btn-success btn-block fa fa-times" type="submit">REGISTRAR INGRESO</button>
                </form>
              </div>
              <div class="col-xs-12 col-sm-6">
                <a href="#" class="btn btn-danger btn-block fa fa-times" id="BorrarVista" onClic="BCancelarIngreso">CANCELAR</a>


              </div>

            </div>
          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
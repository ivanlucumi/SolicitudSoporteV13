<div class="row">
    <div class="col-xs-12 col-sm-5">
        <div class="container">
        <div class="" style="text-align: center">
            <nav class="navbar navbar-light bg-light">
              
               <input class="form-group mr-sm-3 shadow" name="cedula" type="number"  placeholder="Buscar por Cedula" aria-label="Search" id="cedulaSalida" required autofocus>
                
                <a href="#" class="btn btn-success btn-sm 
                                    fa fa-plus-square" id="BcedulaSalida" title="Confirmar Temperatura 1"> Buscar</a>
              
            </nav>
          </div>
            
        </div>
    </div>
</div>
<hr>

<!--para temperatua 1-->
<form id="form-registro-salida" action="{{ route('monitoreo.verificacion.salida.cedula',':CEDULA_ID') }}" method="POST">
    @csrf
</form>

@push('scripts')
<script src="/js/ingreso/monitoreSalida.js"></script>
@endpush
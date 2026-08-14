@extends('layouts.expedientes')
<!--ponerle titulo a la paginga-->
@section('title', 'Historico Expedientes En Prestamo')
@section('cabecera', 'Historico Expedientes en Prestamo')



@section('content')

<div class="container-fluid">
<div class="row">
  <div class="col-xs-1">

  </div>
  <div class="col-xs-10">
    <div class="card mb-3" >
        <div class="row no-gutters">

          <div class="col-md-12">
            <div class="card-body">
              <p class="card-text"><h2><strong><center>LISTADO DE EXPEDIENTES EN PR&Eacute;STAMO </center></strong></h2> </p>
              <br>

             </div>
          </div>
        </div>
      </div>
  </div>
  <div class="col-xs-1">

  </div>
</div>

<div class="row">
        <div class="box-body">
          <div class="row">
            <div class="table-responsive">
                <table id="table9" class="table table-bordered table-striped" >
                  <thead class="shadow" style="background-color: #004182; color: #fff;">
                    <tr>
                      <th>RADICACI&Oacute;N</th>
                        <th>NI</th>
                        <th>PROCESADO</th>
                        <th>DELITO</th>
                        <th>SEDE</th>
                        <th>PREST&Oacute;</th>
                        <th>FECHA</th>
                        <th>OBSERVACIONES</th>
                        <th>QUIEN PRESTA</th>
                        <th>FECHA DEVOLUCI&Oacute;N</th>
                        <th>REGISTRA DEVOLUCI&Oacute;N</th>
                    </tr>
                  </thead>


                  @if($prestamos != null)
                      @foreach($prestamos as $prestamo)
                              <tbody data-id="{!!$prestamo->id!!}"  class="buscar">
                                      <tr class="table-light">
                                        <th scope="row"> {{$prestamo->Expediente->radicado}} </th>
                                          <th scope="row"> {{$prestamo->Expediente->ni}} </th>
                                          <th scope="row">
                                            {{$prestamo->Expediente->cedula_procesado}}<br>
                                            {{$prestamo->Expediente->nombre_procesado}}
                                          </th>
                                          <th scope="row"> {{$prestamo->Expediente->delito}} </th>
                                          <th scope="row"> {{$prestamo->Expediente->sede}} </th>
                                          <th scope="row"> {{$prestamo->prestado_a_nombre}} </th>
                                          <th scope="row">
                                            {{$prestamo->prestado_a_fecha}}<br>
                                            {{$prestamo->prestado_a_despacho}}
                                          </th>
                                          <th scope="row"> {{$prestamo->observaciones}} </th>
                                          <th scope="row"> {{$prestamo->quien_presta}} </th>
                                          <th scope="row"> {{$prestamo->fecha_devolucion}} </th>
                                          <th scope="row"> {{$prestamo->quien_devuelve}} </th>

                                      </tr>
                              </tbody>

                      @endforeach
                    @else

                 @endif


                </table>
            </div>
            {{ $prestamos->links() }}
          </div>
        </div>
  </div>

</div>


<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterPrestamoHistorico.js"></script>


@endsection

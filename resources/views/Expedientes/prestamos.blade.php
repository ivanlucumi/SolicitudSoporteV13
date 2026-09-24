@extends('layouts.expedientes')
<!--ponerle titulo a la paginga-->
@section('title', 'Reportes de Expedientes En Prestamo')
@section('cabecera', 'Expedientes en Prestamo')



@section('content')
<div class="row">
    <div class="" style="text-align: center">
            <nav class="navbar navbar-light bg-light">
              <form action="{{ route('expediente.pestamo') }}" method="POST">
    @csrf
                <input class="form-group mr-sm-2 shadow @error('radicado') is-invalid @enderror" placeholder="Buscar por radicado" autocomplete="off" aria-label="Search" type="number" name="radicado" id="radicado" value="{{ old('radicado') }}">
@error('radicado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                <button class="form-group btn btn-warning my-2 my-sm-0 shadow" type="submit">BUSCAR EXPEDIENTE EN PR&Eacute;STAMO</button>
              </form>
            </nav>
          </div>
</div>
<hr>

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
                        <th>ACCI&Oacute;N</th>
                    </tr>
                  </thead>


                  @if($prestamos != null)
                      @foreach($prestamos as $solicitud)
                              <tbody data-id="{!!$solicitud->id!!}"  class="buscar">
                                      <tr class="table-light">
                                        <th scope="row"> {{$solicitud->Expediente->radicado}} </th>
                                          <th scope="row"> {{$solicitud->Expediente->ni}} </th>
                                          <th scope="row">
                                            {{$solicitud->Expediente->cedula_procesado}}<br>
                                            {{$solicitud->Expediente->nombre_procesado}}
                                        </th>
                                          <th scope="row"> {{$solicitud->Expediente->delito}} </th>
                                          <th scope="row"> {{$solicitud->Expediente->sede}} </th>
                                          <th scope="row"> {{$solicitud->prestado_a_nombre}} </th>
                                          <th scope="row">
                                            {{$solicitud->prestado_a_fecha}}<br>
                                            {{$solicitud->prestado_a_despacho}}

                                        </th>
                                          <th scope="row"> {{$solicitud->observaciones}} </th>
                                          <th scope="row"> {{$solicitud->quien_presta}} </th>
                                          <th scope="row">
                                            <!--a href="" data-target="#modal-entregar-{{$solicitud->id}}" data-toggle="modal"><button class="btn btn-danger fa fa-exchange trasladar"></button></a-->
                                            <a  class="btn btn-primary btn-group-sm col-lg-offset-2 active expedientes_entregar" id="{{ $solicitud->id }}"
                                                data-toggle="modal" href="#modal-entregar" data-product_id="{{$solicitud->id}}"
                                                data-expediente="{{$solicitud->Expediente->radicado}}"
                                                data-procesado="{{$solicitud->Expediente->nombre_procesado}}"
                                                > <i class="fa fa-exchange trasladar"></i>
                                            </a>
                                          </th>


                                      </tr>
                              </tbody>

                      @endforeach
                  @else

                        @endif


                </table>
            </div>
          </div>
        </div>
  </div>

</div>

@include('Expedientes.ModalDevolverExpediente')
@include('Expedientes.ModalRealizarPrestamo')


<!--CONSULTA INGRESO -->
<form id="form-reporte-incidente" action="{{ route('reporte.incidente',':ID_ID') }}" method="POST">
    @csrf
</form>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterPrestamo.js"></script>


<script>
$('a.expedientes_entregar').click(function () {
    let id = $(this).attr('id');
    var token = $('#token').val();
    console.log(id)

    $.ajax({
              headers: {'X-CSRF-TOKEN': token},
              url: '/registro/expedientes/consultar/expediente/'+id,
              type: 'GET',
              datatype: 'json',
              data: $('#form').serialize(),
              /*data: { 'asignatura': asignatura,
                      'personaAcargo':personaAcargo,
                      'programa': programa,
                      'salon': salon,
                      'fechaI': fechaI,

                    },*/
                success:function(data){
                console.log(data);
                $('#modal_devolver_expediente #id_expediente').val(id);
                $('#modal_devolver_expediente #procesado').val(data[0].expediente.cedula_procesado +" "+ data[0].expediente.nombre_procesado);
                $('#modal_devolver_expediente #expediente').val(data[0].expediente.radicado);
                $('#modal_devolver_expediente #prestado_a_despacho').val(data[0].prestado_a_despacho);
                $('#modal_devolver_expediente #prestado_a_cedula').val(data[0].prestado_a_cedula +" "+ data[0].prestado_a_nombre);
                $('#modal_devolver_expediente').modal('show');
              },

               error: function() {
                //window.location.reload();
                alert("No se encuentra informacion del expediente");
              }
            })
});

 /*$('#entregarExpediente').click(function (event) {
    console.log(event,"hola")
    var id = $(event.target).data('product_id');
    var expediente = $(event.target).data('expediente');
    var procesado = $(event.target).data('procesado');
    console.log(id,expediente,procesado)
    $('#id_expediente').val(id);
    $('#expediente').val(expediente);
    $('#procesado').val(procesado);

    $('#modal_devolver_expediente').modal('show');
});*/

</script>





@endsection

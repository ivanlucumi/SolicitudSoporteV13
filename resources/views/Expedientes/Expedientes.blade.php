@extends('layouts.expedientes')
<!--ponerle titulo a la paginga-->
@section('title', 'Reportes de Expedientes')
@section('cabecera', 'Expedientes')



@section('content')
<div class="row">
     <div class="col-xs-12 col-sm-2">
         <div class="" style="text-align: left">	
        	<a href="{!! route('expediente.registrar.expediente')!!}" class="btn btn-warning " >VER TODO</a>
        </div>
    </div>

    <div class="col-xs-12 col-sm-4">
        <div class="btn-group" role="group" style="margin-top: 8px;">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#ModalExpediente" data-whatever="@mdo"><i class="fa fa-plus"></i> NUEVO</button>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalImportarExcel"><i class="fa fa-file-excel-o"></i> IMPORTAR</button>
            <a href="{{ route('expediente.descargar.plantilla') }}" class="btn btn-info" title="Descargar Plantilla CSV"><i class="fa fa-download"></i> PLANTILLA</a>
        </div>
    </div>
   
    <div class="col-xs-12 col-sm-6">
        <div class="" style="text-align: right">

            <nav class="navbar navbar-light bg-light">
              <form action="{{ route('expediente.registrar.expediente') }}" method="POST">
    @csrf
                <input class="form-group mr-sm-2 shadow @error('radicado') is-invalid @enderror" placeholder="Buscar Por Radicado" autocomplete="off" aria-label="Search" type="number" name="radicado" id="radicado" value="{{ old('radicado') }}">
@error('radicado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                <input class="form-group mr-sm-2 shadow @error('ni') is-invalid @enderror" placeholder="Buscar Por Ni" autocomplete="off" aria-label="Search" type="number" name="ni" id="ni" value="{{ old('ni') }}">
@error('ni')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                <input class="form-group mr-sm-2 shadow @error('nombre_procesado') is-invalid @enderror" placeholder="Buscar Por Nombre Procesado" autocomplete="off" aria-label="Search" type="text" name="nombre_procesado" id="nombre_procesado" value="{{ old('nombre_procesado') }}">
@error('nombre_procesado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                <input class="form-group mr-sm-2 shadow @error('cedula_procesado') is-invalid @enderror" placeholder="Buscar Por Cedula Procesado" autocomplete="off" aria-label="Search" type="number" name="cedula_procesado" id="cedula_procesado" value="{{ old('cedula_procesado') }}">
@error('cedula_procesado')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                <input class="form-group mr-sm-2 shadow @error('no_caja') is-invalid @enderror" placeholder="Buscar No. Caja" autocomplete="off" aria-label="Search" type="text" name="no_caja" id="no_caja" value="{{ old('no_caja') }}">
@error('no_caja')
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
                <button class="form-group btn btn-warning my-2 my-sm-0 shadow" type="submit">BUSCAR EXPEDIENTE</button>
              </form>
            </nav>
          </div>
    </div>
</div>

<hr>

<div class="container-fluid">
<div class="row">
  <div class="col-xs-1">

  </div>
  <div class="col-xs-9">
    <div class="card mb-3" >
        <div class="row no-gutters">

          <div class="col-md-12">
            <div class="card-body">
              <p class="card-text"><h2><strong><center>LISTADO DE EXPEDIENTES</center></strong></h2> </p>
              <br>

             </div>
          </div>
        </div>
      </div>
  </div>
  <div class="col-xs-2">
      <p class="card-text"><h4><center>CANTIDAD EXPEDIENTES: <strong>{{$nume_expe}}</strong></center></h4> </p>
    
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
                        <th>EMPAQUE</th>
                        <th>No. CAJA</th>
                        <th>CUADERNOS</th>
                        <th>FOLIOS</th>
                        <th>TIPO EXPE</th>
                        <th>FECHA DIG</th>
                        <th>FECHA & ASUNTO ARC</th>
                        <th>OBSERVACIONES</th>
                        <th>ESTADO</th>
                        <th>PRESTAR</th>
                        <th>EDITAR</th>
                        <!-- <th>ELIMINAR</th> (Se oculta para evitar pérdida de historial) -->
                    </tr>
                  </thead>


                  @if($expedientes != null)
                      @foreach($expedientes as $expediente)
                              <tbody data-id="{!!$expediente->id!!}"  class="buscar">
                                      <tr class="table-light">
                                        <th scope="row"> {{$expediente->radicado}} </th>
                                          <th scope="row"> {{$expediente->ni}} </th>
                                          <th scope="row">
                                            {{$expediente->cedula_procesado}}<br>
                                            {{$expediente->nombre_procesado}}
                                        </th>
                                          <th scope="row"> {{$expediente->delito}} </th>
                                          <th scope="row"> {{$expediente->sede}} </th>
                                          <th scope="row"> {{$expediente->almacenado_en}} </th>
                                          <th scope="row"> {{$expediente->no_caja}} </th>
                                          <th scope="row"> {{$expediente->cuadernos}}</th>
                                          <th scope="row"> {{$expediente->folios}} </th>
                                          <th scope="row"> {{$expediente->tipo_expediente}} </th>
                                          <th scope="row"> {{$expediente->fecha_digitalizado}} </th>
                                          <th scope="row"> {{$expediente->fecha_archivo}}<br>{{$expediente->asunto_archivo}} </th>
                                          <th scope="row"> {{$expediente->observaciones}} </th>
                                          <th scope="row"> {{$expediente->estado}} </th>
                                          <th scope="row">
                                             @if($expediente->estado != "EN PRESTAMO")
                                                  <a  class="btn btn-success btn-group-sm col-lg-offset-2 active expedientes_entregar" id="{{ $expediente->id }}"
                                                    data-toggle="modal" href="#modal-entregar" data-product_id="{{$expediente->id}}"
                                                    data-expediente="{{$expediente->radicado}}"
                                                    data-procesado="{{$expediente->id}}"
                                                    > <i class="fa fa-exchange trasladar"></i>
                                                </a>
                                                
                                             @else
                                                <a  class="btn btn-danger btn-group-sm col-lg-offset-2 active " disabled
                                                    > <i class="fa fa-exchange trasladar"></i>
                                                </a>
                                             @endif
                                          </th>
                                          <th scope="row">
                                            <a href="{{ route('expediente.editar.expediente', $expediente->id) }}" class="btn btn-warning btn-block fa fa-pencil"> </a>
                                          </th>
                                          <!-- Eliminar oculto -->
                                          <!-- <th scope="row">
                                              <a  class=" active cambiar-tipo btn-sm " id="{{ $expediente->id }}"
                                                data-toggle="modal" href="#modal-entregar" data-id="{{$expediente->id}}"
                                                data-expediente="{{$expediente->radicado}}" data-target="#myModal" title="ELIMINAR RADICADO" > <i class="btn btn-danger fa fa-close"></i>
                                            </a>
                                          </th> -->


                                      </tr>
                              </tbody>
            
                      @endforeach
                  @else

                        @endif


                </table>
            </div>
          </div>
         <!--  ojo en APPS SERVICE PROVIDERS CONFIGURAR BOOSTRAP  -->
        </div>
  </div>

</div>

<!-- MODAL IMPORTAR EXCEL -->
<div class="modal fade" id="ModalImportarExcel" tabindex="-1" role="dialog" aria-labelledby="ModalImportarExcelLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{ route('expediente.importar.excel') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-header" style="background-color: #004182; color: #fff;">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff;"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="ModalImportarExcelLabel"><i class="fa fa-file-excel-o"></i> Importar Expedientes desde Excel</h4>
        </div>
        <div class="modal-body">
          <p>Seleccione un archivo de Excel o CSV para importar expedientes. Asegúrese de usar la estructura de la plantilla.</p>
          <div class="form-group">
            <label for="archivo_excel">Archivo (Excel / CSV)</label>
            <input type="file" class="form-control" name="archivo_excel" id="archivo_excel" accept=".xlsx, .xls, .csv" required>
          </div>
          <div class="alert alert-info">
            <i class="fa fa-info-circle"></i> Los expedientes con un Radicado y Sede que ya existan en la base de datos serán omitidos automáticamente para evitar duplicados.
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          <button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Subir e Importar</button>
        </div>
      </form>
    </div>
  </div>
</div>

@include('Expedientes.ModalExpedientes')

@include('Expedientes.ModalConsultaExpediente')

@include('Expedientes.Modaleliminar')


<!--CONSULTA INGRESO -->
<form id="form-reporte-incidente" action="{{ route('reporte.incidente',':ID_ID') }}" method="POST">
    @csrf
</form>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/filterPrestamoIndex.js"></script>


<script>
$('a.expedientes_entregar').click(function () {
    let id = $(this).attr('id');
    var token = $('#token').val();
    console.log(id)

    $.ajax({
              headers: {'X-CSRF-TOKEN': token},
              url: '/registro/expedientes/consultar/expediente/libre/'+id,
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
                $('#form-almacenar-detenido #id').val(data[0].id);
                $('#form-almacenar-detenido #radicado').val(data[0].radicado);
                $('#form-almacenar-detenido #ni').val(data[0].ni);
                $('#form-almacenar-detenido #nombre_procesado').val(data[0].nombre_procesado);
                $('#form-almacenar-detenido #cedula_procesado').val(data[0].cedula_procesado);
                $('#form-almacenar-detenido #sede').val(data[0].sede);
                $('#exampleModal').modal('show');
              },

               error: function() {
                //window.location.reload();
                alert("No se encuentra informacion del expediente");
              }
            })
});

$(document).ready(function() {
    //ACEPTAR SOLO NUMERO EN INPUTS
    //funcion para solo permitir ingreso de valores numericos
    let numerico = document.querySelector('#nProceso').addEventListener('keypress', validaNumericos);

    function validaNumericos(e) {
        var key = window.event ? e.which : e.keyCode;
        if (key < 48 || key > 57) {
            e.preventDefault();
        }
    }



    /*LIMITAR A SOLO 23 DIGITOS EL NUMERO DEL RADICADO DEL PROCESO*/
    var input = document.getElementById('nProceso');
    input.addEventListener('input', function() {
        if (this.value.length > 23)
            this.value = this.value.slice(0, 23);
    })


    //verificar los 23 digitos
    var input = document.getElementById('nProceso');
    input.addEventListener('input', function() {
        var maxLength = 23;
        if (this.value.length > 23) {
            document.getElementById("cantidad").innerHTML = '<strong> <span style="color: red;">' + this.value.length + ' de ' + maxLength + ' dígitos</span></strong>';
        }
        if (this.value.length === 23) {
            document.getElementById("cantidad").innerHTML = '<strong> <span style="color: green;">' + ' ' + maxLength + ' dígitos</span></strong>';
        } else {
            document.getElementById("cantidad").innerHTML = '<strong> <span style="color: red;">' + this.value.length + ' de ' + maxLength + ' dígitos</span></strong>';
        }
    })

});

</script>


<script>
$(document).ready(function () {
    $('.cambiar-tipo').click(function () {
        // Obtener los valores de los atributos data del bot贸n
        var id = $(this).data('id');
        var expediente = $(this).data('expediente');
        var id_2 = $(this).data('procesado');
    
        // Asignar los valores a los elementos del modal innerHTML = name
      
        
        document.getElementById("expediente").innerHTML=expediente;
        document.getElementById("id_expediente").value =($(this).data('id'))
        //$('#id').val($(this).data('id'));
        
        // Abrir el modal
        $('#modal-eliminar-radicado').modal('show');
    });
});
</script>





@endsection

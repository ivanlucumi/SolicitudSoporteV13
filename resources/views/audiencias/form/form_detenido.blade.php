<form action="{{ route('$url') }}" method="POST">
    @csrf  

{{--  <!--formulario para verificar q se haya guardado correctamente-->  --}}


@include('audiencias.form.form')
<hr>

<input type="hidden" name="id" id="id" value="{{ $solicitudAudiencia->id }}">


<div id="detenido">
    <div class="container container-fluid">

    <div class="col-xs-6">
      <a href="#" class="btn btn-primary boton_crear_detenido align-left" id="boton_crear_detenido">AGREGAR DETENIDO QUE ASISTIRÁ</a>

    </div>
    <br>

        <div class="row">

            
            <div class="col-md-9">

                <center><h2><strong> LISTA DE DETENIDOS QUE ASISTIRÁN</strong></h2></center>

                <table class="table text-center table-bordered" ><!--Creamos una tabla que mostrará todas las tareas-->

                        <thead style="background-color: #004182;">

                            <tr>

                                <th scope="col">NOMBRE</th>

                                <th scope="col">CIUDAD</th>

                                <th scope="col">NOMBRE ESTABLECIIENTO</th>

                                <th scope="col">Acciones</th>

                            </tr>

                        </thead>

                        @foreach($solicitudAudiencia->Detenidos as $detenido)

                            <tbody data-id="{!!$detenido->id!!}">

                            <tr>

                                <td>{{$detenido->nombre_interno}}</td>

                                <td>{{$detenido->ciudad}}</td>

                                <td>{{$detenido->nombre_estalecimiento}}</td> 

                                <td><button class="fa fa-trash btn-danger boton_delete_detenido" type="button"></button></td>

                            </tr>

                            </tbody>

                        @endforeach

                    </table>

            </div>

        </div>

    </div>

</div>

<hr>



<div class="row">

    <div class="col-xs-12 col-sm-4"></div>

    <div class="col-xs-12 col-sm-4">

        <button class="btn btn-success btn-block" style="background-color: #004182; color: #fff;" type="submit">FINALIZAR</button>

    </div>

    <div class="col-xs-12 col-sm-4"></div>                

</div>   

</form> 





<form id="form-delete-detenido" action="{{ route('virtual.audiencia.detenido.eliminar',':DETENIDO_ID') }}" method="POST">
    @csrf
    @method('DELETE')

</form>
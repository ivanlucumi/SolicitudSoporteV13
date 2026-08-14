@extends('layouts.usuarios')

<!--ponerle titulo a la paginga-->

@section('title', 'Solicitud Audiencia con detenidos')

@section('content') 

	<div class="row justify-content-md-center">

      <div class="row">

          <div class="col-xs-2">
          </div>

          <div class="col-xs-8">

            <div class="card mb-3" >

                <div class="row no-gutters">

                  <div class="col-md-4">

                   <center> <img src="/img/LOGO FORMULARIO.jfif" class="card-img" width="210em" height="190em"></center>

                  </div>

                  <div class="col-md-8">

                    <div class="card-body">

                      <p class="card-text"><h2><strong><center>SOLICITUD AUDIENCIA VIRTUAL DEL VALLE DEL CAUCA.</center></strong></h2> </p>

                      <p  align="justify"><h4>Por favor registrar los datos solicitados para agendar su solicitud de audiencia virtual, este registro esta sujeto a la disponibilidad de los equipos para la conexión, la cual sería confirmada mediante correo electronico.</h4></p>

                     </div>

                  </div>

                </div>

              </div>

          </div>        

      </div>

	</div>

    <hr>

    



    



    <div class="container-fluid">

       @include('audiencias.form.form_detenido',['detenido'=> $detenido,

                'url'=> 'virtual.audiencia.confirmar', 'method'=>'POST'])   

    </div>



    





    @include('audiencias.modal.modal_detenido',['detenido'=> $detenido,

    'url'=> 'virtual.audiencia.detenido', 'method'=>'POST'])  

   



 @push('scripts')

 <script src="/js/1configuracion.js"></script> 

<script src="/js/detenido.js"></script> 

@endpush





 

@endsection
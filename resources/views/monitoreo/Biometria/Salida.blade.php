@extends('layouts.monitoreo.parqueadero')
<!--ponerle titulo a la paginga-->
@section('title', 'Control Registro De Salida')
@section('cabecera', 'Control Registro De salida Desde Portería ')

@section('content') 
    <!--CONTAR USUARIOS -->
    <style> 
        #value {
    width:150px;
    float:right;
    text-align:right;
    padding:10px;
    background-color:#dadada;
    font-size:36px;
}
    </style>
    
    <div>
        <center>
            <p>
                <h1>
                    <strong>
                        {!! auth()->user()->name!!}
                    </strong>
                </h1>
            </p>
        </center>
    </div>

    <div class="row">
    <div class="col-xs-12 col-sm-5">
        <div class="container">
        <div class="" style="text-align: center">
            <nav class="navbar navbar-light bg-light">
              
               <input class="form-group mr-sm-3 shadow" name="cedula" type="number"  placeholder="Buscar por Cedula" aria-label="Search" id="cedulaSalida" min="1" required autofocus>
               <input class="form-group mr-sm-2 shadow" style="width : 1px; heigth : 1px">
               <input class="form-group mr-sm-2 shadow" style="width : 1px; heigth : 1px">
               <input class="form-group mr-sm-2 shadow" style="width : 1px; heigth : 1px">
               <input class="form-group mr-sm-2 shadow" style="width : 1px; heigth : 1px">
               <input class="form-group mr-sm-2 shadow" style="width : 1px; heigth : 1px">
               <input class="form-group mr-sm-2 shadow" style="width : 1px; heigth : 1px">
                
                <a href="#" class="btn btn-success btn-sm 
                                    fa fa-plus-square" id="BcedulaSalida" title="Confirmar Temperatura 1"> Buscar</a>
              
            </nav>
          </div>
            
        </div>
    </div>
</div>
<hr>

<!--para temperatua 1-->
<form id="form-registro-salida" action="{{ route('biometria.Parqueadero.salida',':CEDULA_ID') }}" method="POST">
    @csrf
</form>



@push('scripts')
<script>

$(document).click(function(){
   //autofocus
  document.getElementById("cedulaSalida").focus();
})

$(document).ready(function() {
 toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": true,
                    "progressBar": false,
                    "positionClass": "toast-top-center",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "1500",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }

//salid de personal

$('#BcedulaSalida').click(function(e) {
                    e.preventDefault();
                    var cedulaSal = $('#cedulaSalida').val();
                    
                    var form = $('#form-registro-salida');
                    var url = form.attr('action').replace(':CEDULA_ID', cedulaSal);
                    var data = form.serialize();
        
                    $.get(url, data, function(result) {
                       // console.log(result.mensaje);
                       
                       if(result.codigo ===1){
                        toastr.success('<br /> <strong> <h1>'+result.mensaje+'</h1>',"SALIDA REGISTRADA");    
                       }
                       if(result.codigo ===0){
                           toastr.error('<br /> <strong> <h1>'+result.mensaje+'</h1>',"ERROR AL REGISTRAR SALIDA"); 
                       }
                       
                       
               
        
                   //autofocus
                   document.getElementById("cedulaSalida").focus();
                   document.getElementById("cedulaSalida").value = "";
                   
                   
                    });
        
                });
    
 
  function ContarIngresos() {
       
    //focus
    document.getElementById("cedulaSalida").focus();
    
    }
    setInterval(ContarIngresos, 20000);   
   
   
});
</script>

@endpush
    

 
 
@endsection



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
                      toastr.success('<br /> <strong> <h1>'+result.mensaje+'</h1>',"SALIDA REGISTRADA");  
               
        
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
$(document).ready(function() {

//salid de personal

$('#BcedulaSalida').click(function(e) {
                    e.preventDefault();
                    var cedulaSal = $('#cedulaSalida').val();
                    console.log(cedulaSal);
                     console.log('1');
                    var form = $('#fform-registro-salida');
                    var url = form.attr('action').replace(':CEDULA_ID', cedulaSal);
                    var data = form.serialize();
        
                    console.log(url)
                    $.get(url, data, function(result) {
                        console.log(result);
                        
                       alert('hola')
               
        
                   //autofocus
                   document.getElementById("cedulaIngreso").focus();
                   document.getElementById("cedulaIngreso").value = "";
                   
                   
                    });
        
                });
                
});
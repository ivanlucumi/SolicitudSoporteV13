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

            //VERIFICAR PLACA DE VEHICULO PROVEEDOR
                
                $('#BcedulaIngreso').click(function(e) {
                    e.preventDefault();
                    var cedulaIng = $('#cedulaIngreso').val();
                    console.log(cedulaIng);
                     console.log('1');
                    var form = $('#form-consulta-ingreso');
                    var url = form.attr('action').replace(':CEDULA_ID', cedulaIng);
                    var data = form.serialize();
        
        
                    $.get(url, data, function(result) {
                        console.log(result);
                        
                        if(result[1] === null){
                            var resultado = false;
                        }else{
                            resultado = true; 
                        }
                        
                        
                        
                        if (Object.keys(result).length > 0) {
                            
                            if(result[0].ingreso === null){
                                
                               
                                
                                if(resultado){
                                    toastr.success('<br /> <strong> <h2> La persona y/o funcionario identificada con:   '+result[0].identificacion+' Tiene permitido el ingreso </h2> </strong><br /><h1>'+result[0].hora_ingreso+'</h1><br><h1>'+result[0].despacho+'</h1><br><strong> <h2> El Vehículo.<br>Tipo :'+result[1].tipo+' <br> Placa : '+result[1].placa+' <br> Marca : '+result[1].marca+'<br> Color : '+result[1].color+'  </h2> </strong>',"ACCESO PERMITIDO");
                                }else{
                                    toastr.success('<br /> <strong> <h2> La persona y/o funcionario identificada con:   '+result[0].identificacion+' Tiene permitido el ingreso </h2> </strong><br /><h1>'+result[0].hora_ingreso+'</h1><br><h1>'+result[0].despacho+'</h1>',"ACCESO PERMITIDO"); 
                                }
                            
                           
                            }else{
                                
                                
                                if(resultado){
                                    toastr.warning('<strong> <h2> La persona y/o funcionario identificada con:   '+result[0].identificacion+' Tiene permitido el ingreso </h2> </strong><br /><h1>'+result[0].hora_ingreso+'</h3><br><h1>'+result[0].despacho+'<br>Ya tiene ingreso registrado</h3><br><strong> <h2> El Vehículo.<br>Tipo :'+result[1].tipo+' <br> Placa : '+result[1].placa+' <br> Marca : '+result[1].marca+'<br> Color : '+result[1].color+'  </h2> </strong>',"ACCESO PERMITIDO");
                                }else{
                                    toastr.warning('<br /> <strong> <h2> La persona y/o funcionario identificada con:   '+result[0].identificacion+' Tiene permitido el ingreso </h2> </strong><br /><h1>'+result[0].hora_ingreso+'<br>Ya tiene ingreso registrado</h1><br><h1>'+result[0].despacho+'</h1>',"<h1>ACCESO PERMITIDO</h2>");
                                }
                                
                                
                                
                                
                            }
                            
                        }else{
                           toastr.error('<strong> <h2> La persona y/o funcionario identificada con:'+cedulaIng +'<br />  </h2><h1>NO TIENE ACCESO </h1> </strong>'); 
                        }
                     

               
        
                   //autofocus
                   document.getElementById("cedulaIngreso").focus();
                   document.getElementById("cedulaIngreso").value = "";
                   
                   
                    });
        
                });
                
   //VERIFICAR PLACA DE VEHICULO COORDINADOR
                
                $('#Bcedula').click(function(e) {
                    e.preventDefault();
                    var cedulaIng = $('#cedulaIngreso').val();
                    console.log(cedulaIng);
                     console.log('1');
                    var form = $('#form-consulta-ingreso-coordinacion');
                    var url = form.attr('action').replace(':CEDULA_ID', cedulaIng);
                    var data = form.serialize();
        
        
                    $.get(url, data, function(result) {
                        console.log(result);
                        
                        if(result[1] === null){
                            var resultado = false;
                        }else{
                            resultado = true; 
                        }
                        
                        
                        
                        if (Object.keys(result).length > 0) {
                            
                            if(result[0].ingreso === null){
                                
                               
                                
                                if(resultado){
                                    toastr.success('<br /> <strong> <h2> La persona y/o funcionario identificada con:   '+result[0].identificacion+' Tiene permitido el ingreso </h2> </strong><br /><h1>'+result[0].hora_ingreso+'</h1><br><h1>'+result[0].despacho+'</h1><br><strong> <h2> El Vehículo.<br>Tipo :'+result[1].tipo+' <br> Placa : '+result[1].placa+' <br> Marca : '+result[1].marca+'<br> Color : '+result[1].color+'  </h2> </strong>',"ACCESO PERMITIDO");
                                }else{
                                    toastr.success('<br /> <strong> <h2> La persona y/o funcionario identificada con:   '+result[0].identificacion+' Tiene permitido el ingreso </h2> </strong><br /><h1>'+result[0].hora_ingreso+'</h1><br><h1>'+result[0].despacho+'</h1>',"ACCESO PERMITIDO"); 
                                }
                            
                           
                            }else{
                                
                                
                                if(resultado){
                                    toastr.warning('<strong> <h2> La persona y/o funcionario identificada con:   '+result[0].identificacion+' Tiene permitido el ingreso </h2> </strong><br /><h1>'+result[0].hora_ingreso+'</h3><br><h1>'+result[0].despacho+'<br>Ya tiene ingreso registrado</h3><br><strong> <h2> El Vehículo.<br>Tipo :'+result[1].tipo+' <br> Placa : '+result[1].placa+' <br> Marca : '+result[1].marca+'<br> Color : '+result[1].color+'  </h2> </strong>',"ACCESO PERMITIDO");
                                }else{
                                    toastr.warning('<br /> <strong> <h2> La persona y/o funcionario identificada con:   '+result[0].identificacion+' Tiene permitido el ingreso </h2> </strong><br /><h1>'+result[0].hora_ingreso+'<br>Ya tiene ingreso registrado</h1><br><h1>'+result[0].despacho+'</h1>',"<h1>ACCESO PERMITIDO</h2>");
                                }
                                
                                
                                
                                
                            }
                            
                        }else{
                           toastr.error('<strong> <h2> La persona y/o funcionario identificada con:'+cedulaIng +'<br />  </h2><h1>NO TIENE ACCESO </h1> </strong>'); 
                        }
                     

               
        
                   //autofocus
                   document.getElementById("cedulaIngreso").focus();
                   document.getElementById("cedulaIngreso").value = "";
                   
                   
                    });
        
                });
                
   
  function ContarIngresos() {
        value = $('#value').text();
        $.ajax({
            type: "GET",
            url: "/monitoreo/contar/usuarios",
            success: function(data) {
                $('#value').text(data);
            }
        });
    //focus
    document.getElementById("cedulaIngreso").focus();
    
    }
    //setInterval(ContarIngresos, 3000);    
    


 //CONSULTA DE VEHICULO DESDE INDEX DE MONITOR
    
  
 
 //
 $('.placaVeh').click(function(e) { 
  e.preventDefault();           
  var row   = $(this).parents('tbody')
  var id    = row.data('id');
  //alert(id);
  var form  = $('#form-consulta-ingreso-vehiculo');
  var url   = form.attr('action').replace(':PLACA_ID', id);
  var data  = form.serialize();
  //alert(url);
  $.get(url,data, function(result){
      console.log(result)
    if (Object.keys(result).length > 0) {
                            
                toastr.success('<strong> <h2> El Vehículo.<br>Tipo :'+result.tipo+' <br> Placa : '+result.placa+' <br> Marca : '+result.marca+'<br> Color : '+result.color+'  </h2> </strong>');           
                            
            }
  });
});



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
                        
                       
               
        
                   //autofocus
                   document.getElementById("cedulaIngreso").focus();
                   document.getElementById("cedulaIngreso").value = "";
                   
                   
                    });
        
                });
    
    
  
  
  
  
});
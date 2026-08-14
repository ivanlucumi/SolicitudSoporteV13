$(document).ready(function() {
    
     toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": true,
                    "progressBar": false,
                    "positionClass": "toast-top-center",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "600",
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
                    //console.log(cedulaIng);
                    
                    var form = $('#form-consulta-ingreso');
                    var url = form.attr('action').replace(':CEDULA_ID', cedulaIng);
                    var data = form.serialize();
        
        
                    $.get(url, data, function(result) {
                        //console.log(result);
                        
                        if(result[1] === null){
                            var resultado = false;
                        }else{
                            resultado = true; 
                        }
                        
                        
                        
                        if (Object.keys(result).length > 0) {
                            
                            if(result[0].ingreso === null){
                                
                               
                                
                                if(resultado){
                                    //console.log(result[0])
                                        $('#id').val(result[0].id);      
                                        $('#identificacion').val(result[0].identificacion); 
                                        $('#nombre').val(result[0].fullname);
                                        $('#hora_ingreso').val(result[0].hora_ingreso);
                                        $('#despacho').val(result[0].despacho);
                                        $('#placa').val(result[1].placa);
                                         $('#tipo').val(result[1].tipo);
                                         $('#marca').val(result[1].marca);
                                         $('#color').val(result[1].color);
                                        
                                    $('#ResultadoConsulta').modal('show');
                                    }else{
                                        
                                        $('#identificacion_').val(result[0].identificacion); 
                                        $('#nombre_').val(result[0].fullname);
                                        $('#hora_ingreso_').val(result[0].hora_ingreso);
                                        $('#despacho_').val(result[0].despacho);
                                        
                                    $('#noAutorizado').modal('show');
                                   // toastr.success('<br /> <strong> <h2> La persona y/o funcionario '+result[0].fullname+ ' identificada con:   '+result[0].identificacion+' Tiene permitido el ingreso </h2> </strong><br /><h1>'+result[0].hora_ingreso+'</h1><br><h1>'+result[0].despacho+'</h1>',"ACCESO PERMITIDO"); 
                                }
                            
                           
                            }else{
                                
                                
                                if(resultado){
                                        $('#id__').val(result[0].id);      
                                        $('#identificacion__').val(result[0].identificacion); 
                                        $('#nombre__').val(result[0].fullname);
                                        $('#hora_ingreso__').val(result[0].hora_ingreso);
                                        $('#despacho__').val(result[0].despacho);
                                        $('#placa__').val(result[1].placa);
                                        $('#tipo__').val(result[1].tipo);
                                        $('#marca__').val(result[1].marca);
                                        $('#color__').val(result[1].color);
                                        
                                        $('#ResultadoConsultaI').modal('show');
                                }else{
                                        $('#identificacion___').val(result[0].identificacion); 
                                        $('#nombre___').val(result[0].fullname);
                                        $('#hora_ingreso___').val(result[0].hora_ingreso);
                                        $('#despacho___').val(result[0].despacho);
                                        
                                        $('#noAutorizadoI').modal('show');
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
                
                


      //  $(".BcedulaIngreso").on("keydown", function() {
    //	alert('hola');
//});         
                
                
   //VERIFICAR PLACA DE VEHICULO COORDINADOR
                
                $('#Bcedula').click(function(e) {
                    e.preventDefault();
                    var cedulaIng = $('#cedulaIngreso').val();
                    console.log(cedulaIng);
                     console.log('1');
                    var form = $('#form-consulta-ingreso-coordinacion');
                    var url = form.attr('action').replace(':CEDULA_ID', cedulaIng);
                    var data = form.serialize();
        
         alert('hola')
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
                                     
                                    toastr.success('<br /> <strong> <h2> La persona y/o funcionario '+result[0].fullname+ ' identificada con:   '+result[0].identificacion+' Tiene permitido el ingreso </h2> </strong><br /><h1>'+result[0].hora_ingreso+'</h1><br><h1>'+result[0].despacho+'</h1><br><strong> <h2> El Vehículo.<br>Tipo :'+result[1].tipo+' <br> Placa : '+result[1].placa+' <br> Marca : '+result[1].marca+'<br> Color : '+result[1].color+'  </h2> </strong>',"ACCESO PERMITIDO");
                                }else{
                                    toastr.success('<br /> <strong> <h2> La persona y/o funcionario '+result[0].fullname+ ' identificada con:   '+result[0].identificacion+' Tiene permitido el ingreso </h2> </strong><br /><h1>'+result[0].hora_ingreso+'</h1><br><h1>'+result[0].despacho+'</h1>',"ACCESO PERMITIDO"); 
                                }
                            
                           
                            }else{
                                
                                
                                if(resultado){
                                    toastr.warning('<strong> <h2> La persona y/o funcionario '+result[0].fullname+ ' identificada con:   '+result[0].identificacion+' Tiene permitido el ingreso </h2> </strong><br /><h1>'+result[0].hora_ingreso+'</h3><br><h1>'+result[0].despacho+'<br>Ya tiene ingreso registrado</h3><br><strong> <h2> El Vehículo.<br>Tipo :'+result[1].tipo+' <br> Placa : '+result[1].placa+' <br> Marca : '+result[1].marca+'<br> Color : '+result[1].color+'  </h2> </strong>',"ACCESO PERMITIDO");
                                }else{
                                    toastr.warning('<br /> <strong> <h2> La persona y/o funcionario '+result[0].fullname+ ' identificada con:   '+result[0].identificacion+' Tiene permitido el ingreso </h2> </strong><br /><h1>'+result[0].hora_ingreso+'<br>Ya tiene ingreso registrado</h1><br><h1>'+result[0].despacho+'</h1>',"<h1>ACCESO PERMITIDO</h2>");
                                }
                                
                                
                                
                                
                            }
                            
                        }else{
                            
                           toastr.error('<strong> <h2> La persona y/o funcionario identificada con:'+cedulaIng +'<br />  </h2><h1>NO TIENE ACCESO 11 </h1> </strong>'); 
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
            url: "/parqueadero/contar/usuarios",
            success: function(data) {
                $('#value').text(data);
            }
        });
    //focus
    document.getElementById("cedulaIngreso").focus();
    
    }
    setInterval(ContarIngresos, 100000);    
    


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
    
    
    
 
 //BotonAutorizar
  $('#BotonRegistrarIngreso').click(function(e) { 
  e.preventDefault();   
  
  var row   = $(this).parents('tbody')
  //var id    = row.data('id');
  var id = document.getElementById('id').value 
  //alert(id);
  var form  = $('#form-registrar-ingreso');
  var url   = form.attr('action').replace(':CEDULA_ID', id);
  var data  = form.serialize();
  
  
  $.get(url,data, function(result){
      //console.log(result)
      document.getElementById('id__').value = "";
      document.getElementById('identificacion__').value = "";
      document.getElementById('nombre__').value = "";
      document.getElementById('hora_ingreso__').value = "";
      document.getElementById('despacho__').value = "";
      document.getElementById('placa__').value = "";
      document.getElementById('marca__').value = "";
      document.getElementById('color__').value = "";
      document.getElementById('tipo__').value = "";
      
      $('#modal_autorizar').modal('hide');
      
      toastr.success('<br/> <strong> <h1>Ingreso Registrado</h1>',"AUTORIZACION VEHÍCULO");  
      
      window.location.reload();
      
  });
  
  });
  
   //BotonAutorizar
  $('#BotonRegistrarReingreso').click(function(e) { 
  e.preventDefault();   
  
  var row   = $(this).parents('tbody')
  //var id    = row.data('id');
  var id = document.getElementById('id__').value 
 // alert(id);
  var form  = $('#form-registrar-reingreso');
  var url   = form.attr('action').replace(':CEDULA_ID', id);
  var data  = form.serialize();
  
  
  $.get(url,data, function(result){
      //console.log(result)
     document.getElementById('id__').value = "";
      document.getElementById('identificacion__').value = "";
      document.getElementById('nombre__').value = "";
      document.getElementById('hora_ingreso__').value = "";
      document.getElementById('despacho__').value = "";
      document.getElementById('placa__').value = "";
      document.getElementById('marca__').value = "";
      document.getElementById('color__').value = "";
      document.getElementById('tipo__').value = "";
      
      $('#ResultadoConsultaI').modal('hide');
      
      toastr.success('<br/> <strong> <h1> Reingreso Exitoso</h1>',"REGISTRO DE REINGRESO");  
      
      window.location.reload();
      
  });
  
  });
  
   //BotonAutorizar
  $('#BotonRegistrarSalida').click(function(e) { 
  e.preventDefault();   
  
  var row   = $(this).parents('tbody')
  //var id    = row.data('id');
  var id = document.getElementById('id__').value 
  //alert(id);
  var form  = $('#form-registrar-salida');
  var url   = form.attr('action').replace(':CEDULA_ID', id);
  var data  = form.serialize();
  
  
  $.get(url,data, function(result){
      //console.log(result)
      document.getElementById('id__').value = "";
      document.getElementById('identificacion__').value = "";
      document.getElementById('nombre__').value = "";
      document.getElementById('hora_ingreso__').value = "";
      document.getElementById('despacho__').value = "";
      document.getElementById('placa__').value = "";
      document.getElementById('marca__').value = "";
      document.getElementById('color__').value = "";
      document.getElementById('tipo__').value = "";
      
      $('#ResultadoConsultaI').modal('hide');
      
      toastr.success('<br/> <strong> <h1> REGISTRO DE SALIDA </h1>',"SALIDA REGISTRADA");  
      
      window.location.reload();
      
  });
  
  });
  
  
  //Boton Denegar
  $('#BotonDenegar').click(function(e) { 
  e.preventDefault();   
  
  var row   = $(this).parents('tbody')
  //var id    = row.data('id');
  var id = document.getElementById('id').value 
  //alert(id);
  var form  = $('#form-denegar-ingreso');
  var url   = form.attr('action').replace(':PLACAING_ID', id);
  var data  = form.serialize();
  alert(url)
   //window.location.reload();
  $.get(url,data, function(result){
      //console.log(result)
      document.getElementById('id').value = "";
      document.getElementById('placa').value = "";
      document.getElementById('marca').value = "";
      document.getElementById('color').value = "";
      document.getElementById('tipo').value = "";
      
      $('#modal_autorizar').modal('hide');
      
      toastr.success('<br/> <strong> <h1>'+result.mensaje+'</h1>',"NEGAR INGRESO");  
      
      window.location.reload();
      
  });
   
   
});

  
  
  
});
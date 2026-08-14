$(document).ready(function() {
    
      /* toastr.options = {
                    "closeButton": false,
                    "debug": false,
                    "newestOnTop": true,
                    "progressBar": true,
                    "positionClass": "toast-top-center",
                    "preventDuplicates": true,
                    "onclick": null,
                    "showDuration": "10000",
                    "hideDuration": "1800",
                    "timeOut": "1500",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                }
    toastr.options = {
                  "closeButton": false,
                  "debug": false,
                  "newestOnTop": false,
                  "progressBar": true,
                  "positionClass": "toast-top-center",
                  "preventDuplicates": false,
                  "onclick": null,
                  "showDuration": "300",
                  "hideDuration": "1000",
                  "timeOut": "5000",
                  "extendedTimeOut": "1000",
                  "showEasing": "swing",
                  "hideEasing": "linear",
                  "showMethod": "fadeIn",
                  "hideMethod": "fadeOut"
                }*/

//Registrar ingreso de visitantes por la porteria  BVcedulaIngreso


//registrar
const regist = document.getElementById('tipo_sangre');

regist.addEventListener('change', registrarVisita);

function registrarVisita(e) {
    e.preventDefault();
    var cedulaIng = $('#cedulaIngreso').val();
    var primer_ap = $('#primer_ap').val();
    var segundo_ap = $('#segundo_ap').val();
    var primer_nomb = $('#primer_nomb').val();
    var segundo_nomb = $('#segundo_nomb').val();
    var sexo = $('#sexo').val();
    var fecha_nacimiento = $('#fecha_nacimiento').val();
    var tipo_sangre = $('#tipo_sangre').val();

    $('#vis_identificacion').val(parseInt(cedulaIng));
    $('#vis_fullname').val(primer_nomb.trimEnd()+" "+segundo_nomb.trimEnd()+" "+primer_ap.trimEnd()+" "+segundo_ap.trimEnd());       
    $('#vis_sexo').val(sexo); 
    $('#vis_fecha_nacimiento').val(fecha_nacimiento);
    $('#vis_tipo_sangre').val(tipo_sangre); 
    $('#modal_registrar_visitas').modal('show');

    //borrar valores
    $('#cedulaIngreso').val("");
    $('#primer_ap').val("");       
    $('#segundo_ap').val(""); 
    $('#primer_nomb').val("");
    $('#segundo_nomb').val(""); 
    $('#sexo').val(""); 
    $('#fecha_nacimiento').val(""); 
    $('#tipo_sangre').val(""); 
}

//otro
/*$('#BVcedulaIngreso').click(function(e) {
    e.preventDefault();
    var cedulaIng = $('#cedulaIngreso').val();
    var primer_ap = $('#primer_ap').val();
    var segundo_ap = $('#segundo_ap').val();
    var primer_nomb = $('#primer_nomb').val();
    var segundo_nomb = $('#segundo_nomb').val();
    var sexo = $('#sexo').val();
    var fecha_nacimiento = $('#fecha_nacimiento').val();
    var tipo_sangre = $('#tipo_sangre').val();

    $('#vis_identificacion').val(parseInt(cedulaIng));
    $('#vis_fullname').val(primer_nomb+ segundo_nomb+ primer_ap+ segundo_ap);       
    $('#vis_sexo').val(sexo); 
    $('#vis_fecha_nacimiento').val(fecha_nacimiento);
    $('#vis_tipo_sangre').val(tipo_sangre); 
    $('#modal_registrar_visitas').modal('show');

    //borrar valores
    $('#cedulaIngreso').val("");
    $('#primer_ap').val("");       
    $('#segundo_ap').val(""); 
    $('#primer_nomb').val("");
    $('#segundo_nomb').val(""); 
    $('#sexo').val(""); 
    $('#fecha_nacimiento').val(""); 
    $('#tipo_sangre').val(""); 
    
     
    var form = $('#form-registar-ingreso-visitante');
    var url = form.attr('action').replace(':CEDULA_ID', cedulaIng);
    var data = form.serialize();

    //alert(url)


    $.get(url, data, function(result) {
       console.log($.isEmptyObject(result));
       
       //alert(result)
        
       
        if($.isEmptyObject(result)){
            
              toastr.error('<strong> <h2> La persona y/o funcionario identificada con:'+cedulaIng +'<br />  </h2><h1>NO TIENE ACCESO </h1> </strong>'); 
          
        }else{
                    
             
             }
        
        
     



   //autofocus
   document.getElementById("cedulaIngreso").focus();
   document.getElementById("cedulaIngreso").value = "";
   
   
    });

});*/


            //VERIFICAR PLACA DE VEHICULO PROVEEDOR
                
 /*               $('#BcedulaIngreso').click(function(e) {
                    e.preventDefault();
                    var cedulaIng = $('#cedulaIngreso').val();
                    
                     
                    var form = $('#form-consulta-ingreso');
                    var url = form.attr('action').replace(':CEDULA_ID', cedulaIng);
                    var data = form.serialize();
        
        
                    $.get(url, data, function(result) {
                       console.log($.isEmptyObject(result));
                       
                       //alert(result)
                        
                       
                        if($.isEmptyObject(result)){
                            
                              toastr.error('<strong> <h2> La persona y/o funcionario identificada con:'+cedulaIng +'<br />  </h2><h1>NO TIENE ACCESO </h1> </strong>'); 
                          
                        }else{
                                    
                              if(result[0].impedimento ==="rest")  {
                                  toastr.warning('<strong> <h2> La persona y/o funcionario '+result[0].nombre +' con cédula :'+result[0].cedula +' tiene restriccion de ingreso<br />  </h2><h1>TRABAJO EN CASA</h1> </strong>',{timeOut: 50000}); 
                           
                                  
                              }  else{      
                                    
                                    
                                    
                                        if(result[0].tipo_solicitud === "VISITANTE"){
                                                    
                                                 if(result[0].ingreso_actual !== 0){
                                                        if(result[0].hora_ingreso === 0){
                                                            toastr.warning('<br /> <strong> <h2> La persona y/o funcionario identificada con:   '+result[0].identificacion +' '+  result[0].nombre+ ' HA PERDIDO LA CITA '+result[0].hora+'</h2> </strong><h1>'+result[0].despacho+'</h1><br><strong>  </strong>',"<h1>CITA PERDIDA</h1>");
                                                    
                                                               }else{
                                                                   toastr.success('<br /> <strong> <h2> La persona y/o funcionario identificada con:   '+result[0].identificacion +' '+  result[0].nombre+ ' Tiene permitido el ingreso </h2> </strong><h1>'+result[0].despacho+'</h1><br><strong>  </strong>',"ACCESO PERMITIDO");
                                                            
                                                                   
                                                               } 
                                                 }else{
                                                     
                                                      toastr.warning('<br /> <strong> <h2> La persona y/o funcionario identificada con:   '+result[0].identificacion +' '+  result[0].nombre+ 'No tiene permitido el ingreso en orario no laboral </h2> </strong><h1>'+result[0].despacho+'</h1><br><strong>  </strong>',"ACCESO HORARIO NO LABORAL");
                                                
                                                     
                                                 }    
                                                    
                                                   
                                                    
                                        }else{
                                                    
                                                  toastr.success('<br /> <strong> <h2> La persona y/o funcionario identificada con:   '+result[0].identificacion +' '+  result[0].nombre+ ' Tiene permitido el ingreso </h2> </strong><h1>'+result[0].despacho+'</h1><br><strong>  </strong>',"ACCESO PERMITIDO");
                                                
                                                }
                              }
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
                                    toastr.success('<br /> <strong> <h2> La persona y/o funcionario identificada con:   '+result[0].identificacion+' Tiene permitido el ingreso </h2> </strong><br /><h1>'+result[0].hora_ingreso+'</h1><br><h1>'+result[0].despacho+'</h1><br><strong>  </strong>',"ACCESO PERMITIDO");
                                }else{
                                    toastr.success('<br /> <strong> <h2> La persona y/o funcionario identificada con:   '+result[0].identificacion+' Tiene permitido el ingreso </h2> </strong><br /><h1>'+result[0].hora_ingreso+'</h1><br><h1>'+result[0].despacho+'</h1>',"ACCESO PERMITIDO"); 
                                }
                            
                           
                            }else{
                                
                                
                                if(resultado){
                                    toastr.warning('<strong> <h2> La persona y/o funcionario identificada con:   '+result[0].identificacion+' Tiene permitido el ingreso </h2> </strong><br /><h1>'+result[0].hora_ingreso+'</h3><br><h1>'+result[0].despacho+'<br>Ya tiene ingreso registrado</h3><br><strong>  </strong>',"ACCESO PERMITIDO");
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
            url: "/porteria/ingreso/contar/usuarios",
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
    
    
  */
  
  
  
});
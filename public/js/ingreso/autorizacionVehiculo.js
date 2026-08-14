$(document).ready(function() {
    
 

//CONSULTA DE VEHICULO DESDE INDEX DE MONITOR
    
  
 
 //BotonAutorizar
  $('#BotonAutorizar').click(function(e) { 
  e.preventDefault();   
  
  var row   = $(this).parents('tbody')
  //var id    = row.data('id');
  var id = document.getElementById('id').value 
  //alert(id);
  var form  = $('#form-autorizar-ingreso');
  var url   = form.attr('action').replace(':PLACAING_ID', id);
  var data  = form.serialize();
  
  
  $.get(url,data, function(result){
      //console.log(result)
      document.getElementById('id').value = "";
      document.getElementById('placa').value = "";
      document.getElementById('marca').value = "";
      document.getElementById('color').value = "";
      document.getElementById('tipo').value = "";
      
      $('#modal_autorizar').modal('hide');
      
      toastr.success('<br/> <strong> <h1>'+result.mensaje+'</h1>',"AUTORIZACION VEHÍCULO");  
      
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


 $('.AutorizacionVehiculo').click(function(e) { 
  e.preventDefault(); 
  //alert('hola')
  var row   = $(this).parents('tbody')
  var id    = row.data('id');
  //alert(id);
  var form  = $('#form-modal-ingreso');
  var url   = form.attr('action').replace(':PLACA_ID', id);
  var data  = form.serialize();
  //alert(url);
  $.get(url,data, function(result){
      //console.log(result.tipo)
        $('#id').val(id);
        $('#placa').val(result.placa);       
        $('#marca').val(result.marca); 
        $('#color').val(result.color);
        $('#tipo').val(result.tipo); 
        $('#modal_autorizar').modal('show');
  });
});






});
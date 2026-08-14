


<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()


  })
</script>


<script>
  $('#requerimiento').change(function(event)
  {
   
   if(event.target.value == 1)
   {

      document.getElementById('categ').style.display = 'block';
        //document.getElementById('elementos').style.display = 'block';
   }
   

  });
  
</script>

<script>
  $('#quiensolicita').change(function(event)
  {
    //alert(event.target.value);
    
    $.get("/selectEmpleado/"+event.target.value+"",function(response,empleados)
    {
      //console.log(response.name);
      $('#presenta').empty();

      $.each(response, function(idx, opt) {
                      
             $('#presenta').append('<label>'+opt.name+'</label>');
          
      });
       
                      
             
    });
  });
  
</script>

<script>
  $('#categoria').change(function(event)
  {
    //alert(event);
    document.getElementById('elementos').style.display = 'block';
    $.get("/selectCate/"+event.target.value+"",function(response,categoria)
    {


      if(response != null){
               $.each(response, function(idx, opt) {
                              
                      $('#contenido').append('<tr><td>'+ "<input type='checkbox' name='elemento[]' value="+opt.idInventario+"></input>" + '</td><td>' + opt.nombreElemento +  '</td><td>' + opt.marca + '</td><td>' + opt.modelo + '</td><td>' + opt.serial + '</td></tr>');
             
                  
              });
           }else{

            $.each(response, function(idx, opt) {
                              
                      $('#contenido').empty();
             
                  
              });

           }




    });
  });
  
</script>


  $('#juzgadoInv').change(function(event)
  {
    //alert(event.target.value);

    $.get("/selectInv/"+event.target.value+"",function(response,juzgado)
    {
      $('#contenidoinv').empty();
     // alert(response);
      if(response != null){
        $.each(response, function(idx, opt) {
          $('#contenidoinv').append('<tr><td>' + opt.elemento_i.nombreElemento +  
                                    '</td><td>' + opt.despacho_i.nombreDespacho + 
                                    '</td><td>' + opt.placaInventario + '</td><td>'+
                                    '<a href="inventarios/'+ opt.id +'"" class="btn btn-warning btn-block fa fa-eye fa-lg"></a>'

    //'<a href="{{ URL::to("/administrador/inventarios/show/'+ opt.id +'")}}"" class="btn btn-warning btn-block fa fa-eye fa-lg"></a>' 
                            
                               /*
                               
                                */                         
                          
                     
                        + '</td></tr>');
             
                  
              });
           }else{

            $.each(response, function(idx, opt) {
                              
                      $('#contenidoinv').empty();
             
                  
              });

           }

           //$.getScript("/js/inventario.js");


    });
  });
  
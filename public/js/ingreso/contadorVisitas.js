$(document).ready(function() {

  function ContarVisitas() {
        value = $('#value').text();
        $.ajax({
            type: "GET",
            url: "/contador/visitas/disaj",
            success: function(data) {
                
                $('#global').text(data[0].visitas);
                $('#diaria').text(data[1].visitas);
            }
        });
    
    
    
    }
    
    window.onload = ContarVisitas;
    
    
      
    
})
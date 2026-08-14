
function agregarFila(){
  document.getElementById("tablaDemandados").insertRow(1).innerHTML = '<tr><td><input type="number"   name="ceduladado[]" class="col-xs-12" ></td><td><input type="text"  name="nombredado[]" placeholder="Nombre Demandado" required></td><td><input type="text"  name="apellidodado[]"  ></td></tr>';
}

function eliminarFila(){
  var table = document.getElementById("tablaDemandados");
  var rowCount = table.rows.length;
  //console.log(rowCount);
  
  if(rowCount <= 1)
    alert('No se puede eliminar el encabezado');
  else
    table.deleteRow(rowCount -1);
}

function agregarFilaD(){
  document.getElementById("tablaDemandante").insertRow(1).innerHTML = '<tr><td><input type="number" value="old(ceduladte[])"   name="ceduladte[]" class="col-xs-12" required></td><td><input type="text"  name="nombredte[]" placeholder="Nombre Demandante"required ></td><td><input type="text"  name="apellidodte[]" required></td></tr>';
}

function eliminarFilaD(){
  var table = document.getElementById("tablaDemandante");
  var rowCount = table.rows.length;
  //console.log(rowCount);
  
  if(rowCount <= 1)
    alert('No se puede eliminar el encabezado');
  else
    table.deleteRow(rowCount -1);
}


var select = document.getElementById('espe');
select.addEventListener('change',
  function(){
    var selectedOption = this.options[select.selectedIndex];
    //console.log(selectedOption.value + ': ' + selectedOption.text);
    $.get("/formulario/reparto/grupo/" + selectedOption.value + "", function(response) {
            
            if (Object.keys(response).length > 0) {
                
                    $("#nombre_gr").empty();
                     $("#nombre_gr").append("<option value=''>Seleccione Grupo</option>");

                    for(i=0; i<response.length; i++){

                    $("#nombre_gr").append("<option value='"+"("+response[i].codigo+") "+" "+response[i].nombre_grupo+"'>"+"("+response[i].codigo+") "+response[i].nombre_grupo+"</option>");

                     }
                
                
            } else {
                document.getElementById('edad').value = "";
            }
        });
  });
  
 
 /* ceddte.oninput = function() {
    //result.innerHTML = ceddte.value;
    alert(ceddte.value);

  };*/

  //const input = document.querySelector('ceddte');
  const input = document.getElementById('demandadoD');
  const cdante = document.getElementById('demandanteT');
  var select = document.getElementById('espe');
  var selectgr = document.getElementById('nombre_gr');
//const log = document.getElementById('log');

input.addEventListener('change', updateValue);

function updateValue(e) {
 
  var especialidad = select.value;
  var nombre_grupo = selectgr.value;
  var ceddado = input.value;
  var ceddante = cdante.value;
 

  var dataString = 'especialidad=' + especialidad + '&nombre_grupo=' + nombre_grupo + '&ceddado=' + ceddado + '&ceddante=' + ceddante;

//alert(dataString)

   $.ajax({

    type: "GET",
    url: "/consultar/proceso/",
    data: dataString,
    dataType:"html",
    asycn:false,
    success: function(response){
      console.log(response)
     if(response == "True"){
      const swalWithBootstrapButtons = Swal.mixin({
          customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-danger'
          },
          buttonsStyling: false
        })

        swalWithBootstrapButtons.fire({
          title: 'Ya Presentó Documentos con los mismo Datos',
          text: "Desea continua?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Si, estoy seguro',
          cancelButtonText: 'No, Cancelar!',
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {
            /*swalWithBootstrapButtons.fire(
              'Deleted!',
              'Your file has been deleted.',
              'success'
            )*/
          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            location.href ="https://www.disajcali.gov.co/formulario/validacion";
           /* swalWithBootstrapButtons.fire(
              'Cancelled',
              'Your imaginary file is safe :)',
              'error'
            )*/
          }
        })

     }
      
      

    }
    });

    

}


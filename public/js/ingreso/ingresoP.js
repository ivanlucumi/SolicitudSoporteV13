 $(document).ready(function() {
     
     //PROVEEDOR

    var verifCedula = document.getElementById('nProceso4');
    verifCedula.addEventListener('input', function() {

        console.log(this.value.nombre);

        $.get("/usuarios/consulta/cedula/" + this.value + "", function(response, juzgado) {

            console.log(response)
            if (Object.keys(response).length > 0) {
                document.getElementById('nombreProveedor').value = response.nombre;
                document.getElementById('apellidoProveedor').value = response.apellidos;
            } else {
                document.getElementById('nombreProveedor').value = "";
                document.getElementById('apellidoProveedor').value = "";
            }
        });

    });
    
       let numerico4 = document.querySelector('#nProceso4').addEventListener('keypress', validaNumericos4);

    function validaNumericos4(e) {
        var key = window.event ? e.which : e.keyCode;
        if (key < 48 || key > 57) {
            e.preventDefault();
        }
    }


   //mostrar div de vehiculo proveedor
    let vehiculoProveedor = document.querySelector('#check_vehiculo_proveedor').addEventListener('click', ingresovehiculoProveedor);

    function ingresovehiculoProveedor(e) {
        if ($(this).is(':checked')) {

            div = document.getElementById('divvehiculoProveedor');
            div.style.display = '';
            document.getElementById("placaP").setAttribute("required", true);
            document.getElementById("marcaP").setAttribute("required", true);
            document.getElementById("colorP").setAttribute("required", true);
            document.getElementById("tipoP").setAttribute("required", true);


        } else {

            div = document.getElementById('divvehiculoProveedor');
            div.style.display = 'none';

            document.getElementById('placa').value = "";

            document.getElementById('marca').value = "";

            document.getElementById('color').value = "";

            document.getElementById('tipo').value = "";
            
            document.getElementById("placa").removeAttribute("required");
            document.getElementById("marca").removeAttribute("required");
            document.getElementById("color").removeAttribute("required");
            document.getElementById("tipo").removeAttribute("required");

        }
    }
    
    
//VERIFICAR PLACA DE VEHICULO PROVEEDOR

   var verifPlacaP = document.getElementById('placaP');
    verifPlacaP.addEventListener('input', function() {

        console.log(this.value);

        $.get("/usuarios/consulta/placa/" + this.value + "", function(response, vehiculo) {

            console.log(response)
            if (Object.keys(response).length > 0) {
                document.getElementById('tipoP').value = response.tipo;
                document.getElementById('marcaP').value = response.marca;
                document.getElementById('colorP').value = response.color;
            } else {
                document.getElementById('tipoP').value = "";
                document.getElementById('marcaP').value = "";
                document.getElementById('colorP').value = "";
            }
        });

    });
    
    
    
    




});
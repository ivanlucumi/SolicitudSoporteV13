$(document).ready(function() {
    //ACEPTAR SOLO NUMERO EN INPUTS
    //funcion para solo permitir ingreso de valores numericos
    let numerico = document.querySelector('#nProceso').addEventListener('keypress', validaNumericos);

    function validaNumericos(e) {
        var key = window.event ? e.which : e.keyCode;
        if (key < 48 || key > 57) {
            e.preventDefault();
        }
    }



    let numerico3 = document.querySelector('#nProceso3').addEventListener('keypress', validaNumericos3);

    function validaNumericos3(e) {
        var key = window.event ? e.which : e.keyCode;
        if (key < 48 || key > 57) {
            e.preventDefault();
        }
    }

 

    //VISITANTE

    var verifCedula = document.getElementById('nProceso2');
    verifCedula.addEventListener('input', function() {

        console.log(this.value.nombre);

        $.get("/usuarios/consulta/cedula/" + this.value + "", function(response, juzgado) {

            console.log(response)
            if (Object.keys(response).length > 0) {
                document.getElementById('nombreVisitante').value = response.nombre;
                document.getElementById('apellidoVisitante').value = response.apellidos;
            } else {
                document.getElementById('nombreVisitante').value = "";
                document.getElementById('apellidoVisitante').value = "";
            }
        });

    });

    //EMPLEADO

    var verifCedula = document.getElementById('nProceso3');
    verifCedula.addEventListener('input', function() {

        console.log(this.value.nombre);

        $.get("/usuarios/consulta/cedula/" + this.value + "", function(response, juzgado) {

            console.log(response)
            if (Object.keys(response).length > 0) {
                document.getElementById('nombreEmpleado').value = response.nombre;
                document.getElementById('apellidoEmpleado').value = response.apellidos;
            } else {
                document.getElementById('nombreEmpleado').value = "";
                document.getElementById('apellidoEmpleado').value = "";
            }
        });

    });
    
        //EMPLEADO

    var verifCedula5 = document.getElementById('nProceso5');
    verifCedula5.addEventListener('input', function() {

        //console.log(this.value.nombre);

        $.get("/usuarios/consulta/cedula/contratos/" + this.value + "", function(response, juzgado) {

            console.log(response)
            if (Object.keys(response).length > 0) {
                document.getElementById('nombreJ').value = response[0].nombre;
                document.getElementById('apellidoJ').value = response[0].apellidos;
                
                document.getElementById('no_parqueaderoJ').value = response[1].no_parqueadero;
                document.getElementById('placaJ').value = response[1].placa;
                document.getElementById('tipoJ').value = response[1].tipo_vehiculo;
                document.getElementById('marcaJ').value = response[1].descripcion_vehiculo;
            } else {
                document.getElementById('nombreF').value = "";
                document.getElementById('apellidoF').value = "";
                document.getElementById('no_parqueaderoJ').value = "";
                document.getElementById('placaJ').value = "";
                document.getElementById('tipoJ').value = "";
                document.getElementById('marcaJ').value = "";
            }
        });

    });
    
            //EMPLEADO

    var verifCedula6 = document.getElementById('nProceso6');
    verifCedula6.addEventListener('input', function() {

        console.log(this.value.nombre);

        $.get("/usuarios/consulta/cedula/contratos/" + this.value + "", function(response, juzgado) {

            console.log(response)
            if (Object.keys(response).length > 0) {
                document.getElementById('nombreF').value = response[0].nombre;
                document.getElementById('apellidoF').value = response[0].apellidos;
            } else {
                document.getElementById('nombreF').value = "";
                document.getElementById('apellidoF').value = "";
            }
        });

    });
    
    
     //mostrar div de vehiculo EMPLEADO
  
    let vehiculoEmpleado = document.querySelector('#check_vehiculo_empleado').addEventListener('click', ingresovehiculoEmpleado);

    function ingresovehiculoEmpleado(e) {
        alert('hola')
        if ($(this).is(':checked')) {

            div = document.getElementById('divvehiculoEmpleado');
            div.style.display = '';
            document.getElementById("placaE").setAttribute("required", true);
            document.getElementById("marcaE").setAttribute("required", true);
            document.getElementById("colorE").setAttribute("required", true);
            document.getElementById("tipoE").setAttribute("required", true);


        } else {

              div = document.getElementById('divvehiculoEmpleado');
            div.style.display = 'none';

            document.getElementById('placaE').value = "";

            document.getElementById('marcaE').value = "";

            document.getElementById('colorE').value = "";

            document.getElementById('tipoE').value = "";
            
            document.getElementById("placaE").removeAttribute("required");
            document.getElementById("marcaE").removeAttribute("required");
            document.getElementById("colorE").removeAttribute("required");
            document.getElementById("tipoE").removeAttribute("required");

        }
    }
     

 


 

//VERIFICAR PLACA DE VEHICULO EMPLEADO

   var verifPlaca = document.getElementById('placaE');
    verifPlaca.addEventListener('input', function() {

        console.log(this.value);

        $.get("/usuarios/consulta/placa/" + this.value + "", function(response, vehiculo) {

            console.log(response)
            if (Object.keys(response).length > 0) {
                document.getElementById('tipoE').value = response.tipo;
                document.getElementById('marcaE').value = response.marca;
                document.getElementById('colorE').value = response.color;
            } else {
                document.getElementById('tipoE').value = "";
                document.getElementById('marcaE').value = "";
                document.getElementById('colorE').value = "";
            }
        });

    });
    







});
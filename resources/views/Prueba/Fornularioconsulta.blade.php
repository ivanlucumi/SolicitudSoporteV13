<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Cédula</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; margin: 50px; }
        .container { width: 50%; margin: auto; padding: 20px; }
        input, button { padding: 10px; margin: 10px; }
        .resultado { margin-top: 20px; padding: 15px; border: 1px solid #ddd; background: #f9f9f9; text-align: left; }
    </style>
</head>
<body>

    <div class="container">
        <h1>Consulta de Cédula</h1>
        <input type="text" id="cedula" placeholder="Ingrese su cédula" required>
        <button onclick="consultarCedula()">Consultar</button>

        <div id="resultado" class="resultado" style="display: none;"></div>
    </div>

    <script>
        function consultarCedula() {
            let cedula = document.getElementById("cedula").value;
            if (!cedula) {
                alert("Por favor ingrese una cédula.");
                return;
            }

            let url = `https://siugj.ramajudicial.gov.co/principal/funcionesApoyo.php?funcion=1&id=${cedula}`;
            
            fetch(url)
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`Error en la consulta: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    let resultadoDiv = document.getElementById("resultado");
                    resultadoDiv.innerHTML = `<h3>Resultado:</h3><pre>${JSON.stringify(data, null, 2)}</pre>`;
                    resultadoDiv.style.display = "block";
                })
                .catch(error => {
                    alert("Ocurrió un error: " + error.message);
                });
        }
    </script>

</body>
</html>

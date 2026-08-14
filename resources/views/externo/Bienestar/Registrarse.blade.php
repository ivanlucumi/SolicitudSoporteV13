<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registro de Asistencia</title>
    
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <style>
        body {
            padding-top: 70px;
        }
        .panel-heading h3, .panel-heading h4 {
            margin: 0;
        }
        .acompanante-item {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        .acompanante-item:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <div id="app">
        @include('partials.navbar')
        
        <main class="py-4">
                
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3>Registro de Asistencia al Evento</h3>
                </div>
                <div class="panel-body">
                    <form method="POST" action="{{ route('asistencia.store') }}">
                        @csrf
                        
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4 class="panel-title">Datos del Funcionario Principal</h4>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nombre">Nombre Completo *</label>
                                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cedula">Cédula *</label>
                                            <input type="text" class="form-control" id="cedula" name="cedula" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="correo">Correo Electrónico *</label>
                                            <input type="email" class="form-control" id="correo" name="correo" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="telefono">Teléfono *</label>
                                            <input type="text" class="form-control" id="telefono" name="telefono" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cargo">Cargo *</label>
                                            <input type="text" class="form-control" id="cargo" name="cargo" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="despacho">Despacho *</label>
                                            <input type="text" class="form-control" id="despacho" name="despacho" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h4 class="panel-title">Acompañantes (Máximo 4)</h4>
                            </div>
                            <div class="panel-body" id="acompanantes-container">
                                <div class="acompanante-item">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Parentezco *</label>
                                                <input type="text" class="form-control" name="acompanantes[0][parentezco]" required>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>Nombre Completo *</label>
                                                <input type="text" class="form-control" name="acompanantes[0][nombre]" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Cédula *</label>
                                                <input type="text" class="form-control" name="acompanantes[0][cedula]" required>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <button type="button" class="btn btn-danger btn-remove" style="margin-top: 25px;">
                                                <i class="glyphicon glyphicon-trash"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <button type="button" class="btn btn-success" id="btn-add-acompanante">
                                    <i class="glyphicon glyphicon-plus"></i> Agregar Acompañante
                                </button>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="glyphicon glyphicon-floppy-disk"></i> Guardar Registro
                            </button>
                            <a href="{{ route('asistencia.index') }}" class="btn btn-default">
                                <i class="glyphicon glyphicon-arrow-left"></i> Cancelar
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
            </div>
        </div>
     </div>
     </div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let acompanantesCount = 1;
        const maxAcompanantes = 4;
        const container = document.getElementById('acompanantes-container');
        
        document.getElementById('btn-add-acompanante').addEventListener('click', function() {
            if (acompanantesCount >= maxAcompanantes) {
                alert('Solo se permiten máximo ' + maxAcompanantes + ' acompañantes.');
                return;
            }
            
            const newItem = document.createElement('div');
            newItem.className = 'acompanante-item';
            newItem.innerHTML = `
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" class="form-control" name="acompanantes[${acompanantesCount}][parentezco]" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <input type="text" class="form-control" name="acompanantes[${acompanantesCount}][nombre]" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <input type="text" class="form-control" name="acompanantes[${acompanantesCount}][cedula]" required>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="button" class="btn btn-danger btn-remove" style="margin-top: 25px;">
                            <i class="glyphicon glyphicon-trash"></i>
                        </button>
                    </div>
                </div>
            `;
            
            container.appendChild(newItem);
            acompanantesCount++;
        });
        
        container.addEventListener('click', function(e) {
            if (e.target.classList.contains('btn-remove') {
                const item = e.target.closest('.acompanante-item');
                item.remove();
                acompanantesCount--;
            }
        });
    });
</script>

 </main>
    </div>
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>






@endsection
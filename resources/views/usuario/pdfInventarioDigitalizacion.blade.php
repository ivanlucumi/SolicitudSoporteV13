<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Inventario Digitalizacion</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    
</head>

<body>
    <div class="container-fluid">
        <h2 class="text-center mb-3">Inventario Digitalizaci&oacute;n {{$inventario[0]->despacho}}</h2>

        <div class="d-flex justify-content-end">
        </div>

        <table class="table table-bordered mb-2">
            <thead>
                <tr class="table-primary">
                    <th scope="col">#</th>
                    <th scope="col">Radicado</th>
                    <th scope="col">Demandante</th>
                    <th scope="col">Demandado</th>
                    <th scope="col">Folios</th>
                    <th scope="col">Cuadernos</th>
                    <th scope="col">Tipo Expediente</th>
                    <th scope="col">Ciudad</th>
                    <th scope="col">Observaciones</th>
            </thead>
            <tbody>
                @foreach($inventario ?? '' as $key => $data)
                <tr>
                    <th scope="row">{{ $key+1 }}</th>
                    <td>{{ $data->radicado }}</td>
                    <td>{{ $data->demandante }}</td>
                    <td>{{ $data->demandado }}</td>
                    <td>{{ $data->folios }}</td>
                    <td>{{ $data->cuadernos }}</td>
                    <td>{{ $data->tipo_expediente }}</td>
                    <td>{{ $data->ciudad }}</td>
                    <td>{{ $data->observacion }}</td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    <script src="{{ asset('js/app.js') }}" type="text/js"></script>
</body>

</html>
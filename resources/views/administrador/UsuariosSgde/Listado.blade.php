@extends('layouts.admin')
@section('cabecera', 'Usuarios Registrados')

@section('content') 
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.bootstrap.min.css">


<!-- jQuery (requerido por Bootstrap 3) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap 3 JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap.min.js"></script>

<!-- Botones de exportación -->
<script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>


@include('../alerts.success')
@include('../alerts.request')

@section('title', 'Listado de Usuarios SGDE')

@section('content')
<div class="container-fluid">
    <div class="panel panel-primary">
        <div class="panel-heading text-center">
            <h3 class="panel-title">📋 Listado de Usuarios SGDE</h3>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table id="tabla-usuarios" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr class="info text-center">
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Cédula</th>
                            <th>Cargo</th>
                            <th>Usuario</th>
                            <th>Email Institucional</th>
                            <th>Correo Despacho</th>
                            <th>Despacho</th>
                            <th>Código Despacho</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usuarios as $index => $usuario)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>{{ $usuario->nombre }}</td>
                                <td>{{ $usuario->cedula }}</td>
                                <td>{{ $usuario->cargo }}</td>
                                <td>{{ $usuario->usuario }}</td>
                                <td>{{ $usuario->email }}</td>
                                <td>{{ $usuario->correo_despaho }}</td>
                                <td>{{ $usuario->despacho }}</td>
                                <td>{{ $usuario->codigo_despacho }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- DataTable config --}}
<script>
$('#tabla-usuarios').DataTable({
    dom: 'Blfrtip',
    buttons: [
        {
            extend: 'excelHtml5',
            text: '<span class="glyphicon glyphicon-download-alt"></span> Excel',
            title: 'Usuarios_SGDE'
        },
        {
            extend: 'pdfHtml5',
            text: '<span class="glyphicon glyphicon-file"></span> PDF',
            title: 'Usuarios_SGDE',
            orientation: 'landscape',
            pageSize: 'A4'
        },
        {
            extend: 'csvHtml5',
            text: '<span class="glyphicon glyphicon-export"></span> CSV',
            title: 'Usuarios_SGDE'
        },
        {
            extend: 'print',
            text: '<span class="glyphicon glyphicon-print"></span> Imprimir',
            title: 'Listado de Usuarios SGDE'
        }
    ],
    language: {
        url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
    }
});
</script>
@endsection

@extends('layouts.admin')
@section('title', 'Administracion de Reportes de Actividades')
@section('cabecera', 'Gestion de Reportes de Actividades')

@section('content')

<link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/dataTables.bootstrap.min.css">
<script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="//cdn.datatables.net/1.10.25/js/dataTables.bootstrap.min.js"></script>

@include('../alerts.success')
@include('../alerts.request')

<div class="container-fluid">
    <h2 class="text-center">Informes de Contratistas</h2>

   
    <div class="panel panel-primary">
        <div class="panel-heading">
            <strong>Resumen por Contratista</strong>
        </div>
        <div class="panel-body">
            <canvas id="graficoContratistas" height="100"></canvas>
        </div>
    </div>

   
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>Historial de Informes</strong>
        </div>
        <div class="panel-body table-responsive" style="max-height:500px; overflow-y:auto;">
           <table id="tabla-informes" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Contratista</th>
                        <th>Fecha Actividad</th>
                        <th>Plataforma</th>
                        <th>Descripci&oacute;n</th>
                        <th>Fecha Registro</th>
                    </tr>
                    <tr>
                        <th><input type="text" class="form-control input-sm" placeholder="Buscar contratista" /></th>
                        <th><input type="text" class="form-control input-sm" placeholder="Buscar fecha actividad" /></th>
                        <th><input type="text" class="form-control input-sm" placeholder="Buscar Plataforma" /></th>
                        <th><input type="text" class="form-control input-sm" placeholder="Buscar descripci&oacute;n" /></th>
                        <th><input type="text" class="form-control input-sm" placeholder="Buscar fecha registro" /></th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($activitiesHistory as $activity)
                        <tr>
                            <td>{{ $activity->user->name." ".$activity->user->lastname ?? 'No definido' }}</td>
                            <td>{{ $activity->activity_date->format('d/m/Y') }}</td>
                            <td>{{ $activity->plataforma }}</td>
                            <td>{!! $activity->description !!}</td>
                            <td>{{ $activity->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">No hay informes registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
        
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('graficoContratistas').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($conteoPorContratista->pluck('nombre')) !!},
            datasets: [{
                label: 'Cantidad de Informes',
                data: {!! json_encode($conteoPorContratista->pluck('total')) !!},
                backgroundColor: 'rgba(28, 30, 129 )'
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
    
</script>

<script>
    $(document).ready(function () {
        // Clona la fila de filtros (segunda fila del thead) para que funcione con búsqueda individual
        $('#tabla-informes thead tr:eq(1) th').each(function (i) {
            $('input', this).on('keyup change', function () {
                if (table.column(i).search() !== this.value) {
                    table
                        .column(i)
                        .search(this.value)
                        .draw();
                }
            });
        });

        var table = $('#tabla-informes').DataTable({
            orderCellsTop: true,
            fixedHeader: true,
            pageLength: 50,
            /*order: [[1, 'asc']],*/
            language: {
                search: "Buscar:",
                lengthMenu: "Mostrar _MENU_ registros",
                zeroRecords: "No se encontraron resultados",
                info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                infoEmpty: "No hay registros disponibles",
                infoFiltered: "(filtrado de _MAX_ registros totales)",
                paginate: {
                    first: "Primero",
                    last: "Último",
                    next: "Siguiente",
                    previous: "Anterior"
                }
            }
        });
    });
</script>



@endsection
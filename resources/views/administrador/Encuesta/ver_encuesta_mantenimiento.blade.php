@extends('layouts.mantenimiento')

@section('title','Panel Ejecutivo de Satisfacción')
@section('cabecera','Indicadores de Servicio')

@section('content')
<div class="container-fluid">

{{-- FILTROS --}}
<div class="panel panel-primary">
    <div class="panel-heading"><strong>Filtros</strong></div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-2">
                <input type="date" id="fecha_inicio" class="form-control">
            </div>
            <div class="col-md-2">
                <input type="date" id="fecha_fin" class="form-control">
            </div>
            <div class="col-md-2">
                <select id="categoria" class="form-control">
                    <option value="">Todas las Categorías</option>
                </select>
            </div>
            <div class="col-md-2">
                <select id="item" class="form-control">
                    <option value="">Todos los Items</option>
                </select>
            </div>
            <div class="col-md-2">
                <select id="estado" class="form-control">
                    <option value="">Todos</option>
                    <option value="REALIZADO">REALIZADO</option>
                </select>
            </div>
            <div class="col-md-2">
                <button id="btnFiltrar" class="btn btn-success btn-block">
                    Aplicar
                </button>
            </div>
            <div class="col-md-2">
                <button id="btnLimpiar" class="btn btn-default btn-block">
                    Limpiar
                </button>
            </div>
        </div>
    </div>
</div>

{{-- KPI --}}
<div class="row text-center">

    <div class="col-md-3">
        <div class="panel panel-info">
            <div class="panel-body">
                <h4>Casos</h4>
                <h2 id="totalCasos">0</h2>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="panel panel-info">
            <div class="panel-body">
                <h4>Casos Realizado</h4>
                <h2 id="casos_realizados">0</h2>
            </div>
        </div>
    </div>
    
    <div class="col-md-2">
    <div class="panel panel-default">
        <div class="panel-body">
            <h4>Casos Pendientes</h4>
            <h2 id="casosPendientes">0</h2>
        </div>
    </div>
</div>

    <div class="col-md-2">
        <div class="panel panel-success">
            <div class="panel-body">
                <h4>Encuestas Respondidas</h4>
                <h2 id="totalEncuestas">0</h2>
            </div>
        </div>
    </div>
    <div class="col-md-2">
        <div class="panel panel-danger">
            <div class="panel-body">
                <h4>% Cobertura</h4>
                <h2 id="cobertura">0%</h2>
            </div>
        </div>
    </div>
<hr>
    <div class="col-md-3">
        <div class="panel panel-primary">
            <div class="panel-body">
                <h5>Promedio General</h5>
                <h2 id="promedioGeneral">0</h2>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="panel panel-primary">
            <div class="panel-body">
                <h5>Tiempo Respuesta</h5>
                <h2 id="promedioTiempo">0</h2>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="panel panel-primary">
            <div class="panel-body">
                <h5>Atención Personal</h5>
                <h2 id="promedioAtencion">0</h2>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="panel panel-primary">
            <div class="panel-body">
                <h5>Calidad Técnica</h5>
                <h2 id="promedioCalidad">0</h2>
            </div>
        </div>
    </div>

</div>

{{-- LOADER --}}
<div id="loader" class="text-center" style="display:none; padding:20px;">
    <i class="fa fa-spinner fa-spin fa-3x text-primary"></i>
    <p>Cargando información...</p>
</div>

{{-- TABLA CATEGORIAS --}}
<div class="panel panel-default">
    <div class="panel-heading"><strong>Rendimiento por Categoría</strong></div>
    <div class="panel-body table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Categoría</th>
                    <th>Casos</th>
                    <th>Encuestas</th>
                    <th>Promedio</th>
                </tr>
            </thead>
            <tbody id="tablaCategorias">
                <tr><td colspan="4" class="text-center text-muted">Sin datos</td></tr>
            </tbody>
        </table>
    </div>
</div>

{{-- TABLA ITEMS --}}
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Categoría</th>
            <th>Item</th>
            <th>Casos</th>
            <th>Encuestas</th>
            <th>Tiempo</th>
            <th>Atención</th>
            <th>Calidad</th>
            <th>Promedio</th>
        </tr>
    </thead>
    <tbody id="tablaItems"></tbody>
</table>

</div>

{{-- ================= JS ================= --}}
<!-- jQuery 3 -->
<script src="adminlte/bower_components/jquery/dist/jquery.min.js"></script>
<script src="adminlte/bower_components/jquery/dist/jquery-3.2.1.min.js"></script>

<script>

function badgePromedio(valor){
    valor = parseFloat(valor);

    if(isNaN(valor)) return '<span class="label label-default">0</span>';

    if(valor >= 4)
        return '<span class="label label-success">'+valor.toFixed(2)+'</span>';

    if(valor >= 3)
        return '<span class="label label-warning">'+valor.toFixed(2)+'</span>';

    return '<span class="label label-danger">'+valor.toFixed(2)+'</span>';
}

function cargarPanel() {

    $('#loader').show();

    $.ajax({
        url: "{{ route('mantenimiento.encuestas.estadisticas.ajax') }}",
        type: "GET",
        dataType: "json",
        data: {
            fecha_inicio: $('#fecha_inicio').val(),
            fecha_fin: $('#fecha_fin').val(),
            categoria: $('#categoria').val(),
            item: $('#item').val(),
            estado: $('#estado').val()
        },
        success: function(res){

            $('#loader').hide();

            // ================= KPI =================

            var totalCasos      = parseInt(res.kpi.total_casos);
            var totalEncuestas  = parseInt(res.kpi.total_encuestas);
            var promedioGeneral = parseFloat(res.kpi.promedio_general);
            var casosPendientes = parseFloat(res.kpi.casos_pendientes);
            var casosRealizados = parseFloat(res.kpi.casos_realizados);
            
            var promedioTiempo     = parseFloat(res.kpi.promedio_tiempo) || 0;
            var promedioAtencion   = parseFloat(res.kpi.promedio_atencion) || 0;
            var promedioCalidad    = parseFloat(res.kpi.promedio_calidad) || 0;
            
            $('#promedioTiempo').html(badgePromedio(promedioTiempo));
            $('#promedioAtencion').html(badgePromedio(promedioAtencion));
            $('#promedioCalidad').html(badgePromedio(promedioCalidad));
            
            

            $('#totalCasos').text(totalCasos);
            $('#totalEncuestas').text(totalEncuestas);
            $('#promedioGeneral').html(badgePromedio(promedioGeneral));
            $('#casosPendientes').text(casosPendientes);
            $('#casos_realizados').text(casosRealizados);

            var cobertura = 0;
                if(totalCasos > 0){
                    cobertura = (totalEncuestas / totalCasos) * 100;
                }
                
                $('#cobertura').html(
                    cobertura >= 70 
                        ? '<span class="label label-success">'+cobertura.toFixed(1)+'%</span>'
                        : cobertura >= 40
                            ? '<span class="label label-warning">'+cobertura.toFixed(1)+'%</span>'
                            : '<span class="label label-danger">'+cobertura.toFixed(1)+'%</span>'
                );

           

            // ================= TABLA CATEGORIAS =================

            var filasCat = '';

            if(res.categorias.length > 0){

                for(var i = 0; i < res.categorias.length; i++){

                    var c = res.categorias[i];

                    filasCat += `
                        <tr>
                            <td><strong>${c.categoria}</strong></td>
                            <td>${c.total_casos}</td>
                            <td>${c.total_encuestas}</td>
                            <td>${badgePromedio(c.promedio)}</td>
                        </tr>
                    `;
                }

            } else {

                filasCat = `
                    <tr>
                        <td colspan="4" class="text-center text-muted">
                            No hay resultados
                        </td>
                    </tr>
                `;
            }

            $('#tablaCategorias').html(filasCat);


            // ================= TABLA ITEMS =================

            var filasItem = '';

            if(res.items.length > 0){

                for(var j = 0; j < res.items.length; j++){

                    var it = res.items[j];

                    filasItem += `
                        <tr>
                            <td>${it.categoria}</td>
                            <td>${it.item}</td>
                            <td>${it.total_casos}</td>
                            <td>${it.total_encuestas}</td>
                            <td>${badgePromedio(it.promedio_tiempo)}</td>
                            <td>${badgePromedio(it.promedio_atencion)}</td>
                            <td>${badgePromedio(it.promedio_calidad)}</td>
                            <td>${badgePromedio(it.promedio_general)}</td>
                            
                        </tr>
                    `;
                }

            } else {

                filasItem = `
                    <tr>
                        <td colspan="5" class="text-center text-muted">
                            No hay resultados
                        </td>
                    </tr>
                `;
            }

            $('#tablaItems').html(filasItem);

        },
        error: function(xhr){
            $('#loader').hide();
            console.log(xhr.responseText);
            alert("Error al cargar los datos.");
        }
    });
}

$(document).ready(function(){
    
    var hoy = new Date();
    var tresMesesAtras = new Date();
    tresMesesAtras.setMonth(hoy.getMonth() - 3);
    
    $('#fecha_inicio').val(tresMesesAtras.toISOString().split('T')[0]);
    $('#fecha_fin').val(hoy.toISOString().split('T')[0]);
    
    cargarPanel();

    $('#btnFiltrar').click(function(){
        cargarPanel();
    });
    
    $('#btnLimpiar').click(function(){

    // Limpiar selects
    $('#categoria').val('');
    $('#item').val('');
    $('#estado').val('');
    $('#fecha_inicio').val('');
    $('#fecha_fin').val('');

    // Limpiar fechas (volver a últimos 3 meses)
    var hoy = new Date();
    var tresMesesAtras = new Date();
    tresMesesAtras.setMonth(hoy.getMonth() - 3);

   // $('#fecha_inicio').val(tresMesesAtras.toISOString().split('T')[0]);
   // $('#fecha_fin').val(hoy.toISOString().split('T')[0]);

    // Recargar panel
    cargarPanel();
});
    
});
</script>

@endsection
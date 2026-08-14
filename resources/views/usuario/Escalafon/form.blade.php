@extends('layouts.usuarios')
<!--ponerle titulo a la paginga-->
@section('title', 'Escalafon')
@section('cabecera', 'Consulta Escalafon')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<div class="container">

    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>Consulta Carrera Judicial</strong>
        </div>

        <div class="panel-body">
            <form id="formConsulta">
                @csrf
                <div class="row">
                    <div class="col-md-4">
                        <label>Número de Cédula</label>
                        <input type="text" name="cedula" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label>Fecha de Expedición</label>
                        <input type="date" name="fecha_expedicion" class="form-control">
                    </div>

                    <div class="col-md-4" style="margin-top:25px">
                        <button class="btn btn-primary btn-block">
                            Consultar
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@include('usuario.Escalafon.modal')


@push('scripts')
<script>
$('#formConsulta').submit(function(e){
    e.preventDefault();

    // Loader mientras consulta
    Swal.fire({
        title: 'Consultando información',
        text: 'Por favor espere...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading()
        }
    });

    $.post("{{ route('consulta.buscar') }}", $(this).serialize())
    .done(function(resp){

        Swal.close();

        let html = `
            <p><strong>Cédula:</strong> ${resp.persona.cedula}</p>
            <p><strong>Nombre:</strong> ${resp.persona.nombres} ${resp.persona.apellidos}</p>
            <hr>
            <h4>Registro de Escalafón</h4>
            <table class="table table-bordered table-condensed">
                <thead>
                    <tr>
                        <th>Estado</th>
                        <th>Tipo</th>
                        <th>Despacho</th>
                        <th>Cargo</th>
                        <th>Número</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
        `;

        if(resp.escalafon.length === 0){
            html += `
                <tr>
                    <td colspan="6" class="text-center">
                        No se encontraron registros
                    </td>
                </tr>`;
        } else {
            resp.escalafon.forEach(e => {
                html += `
                    <tr>
                        <td>${e.estado_actual}</td>
                        <td>${e.tipo_acto}</td>
                        <td>${e.despacho.nombre}</td>
                        <td>${e.cargo.nombre}</td>
                        <td>${e.numero_acto}</td>
                        <td>${e.fecha_acto}</td>
                    </tr>
                `;
            });
        }

        html += `</tbody></table>`;

        $('#contenidoResultado').html(html);

        if(resp.pdf){
            $('#btnPdf')
                .attr('href', `/pdf/${resp.persona.cedula}.pdf`)
                .show();
        } else {
            $('#btnPdf').hide();
        }

        $('#modalResultado').modal('show');

    })
    .fail(function(xhr){

        Swal.close();

        let mensaje = 'No se encontraron registros';

        if(xhr.status === 422){
            mensaje = 'Debe ingresar una cédula válida';
        }

        Swal.fire({
            icon: 'warning',
            title: 'Sin resultados',
            text: mensaje,
            confirmButtonText: 'Aceptar'
        });
    });
});
</script>
@endpush


@endsection

@extends('layouts.encuesta')

@section('title', 'Realizar Llamada/Encuesta')

@section('content')
<div class="container-fluid">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4 class="card-title text-white mb-0">Realizar Llamada a {{ $llamada->nombre }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('encuestas_llamadas.guardar') }}" method="POST" id="form-encuesta">
                @csrf
                <input type="hidden" name="id" value="{{ $llamada->id }}">
                
                <div class="row">
                    <div class="col-md-4 form-group">
                        <label>Cédula</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="cedula" id="e_cedula" value="{{ $llamada->cedula }}" required>
                            <span class="input-group-btn">
                                <button type="button" class="btn btn-info" id="btn-buscar-cedula"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-8 form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" name="nombre" id="e_nombre" value="{{ $llamada->nombre }}" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Celular (Del CSV)</label>
                        <input type="text" class="form-control" name="celular" id="e_celular" value="{{ $llamada->celular }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Municipio (Del CSV)</label>
                        <input type="text" class="form-control" name="municipio" id="e_municipio" value="{{ $llamada->municipio }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Correo</label>
                        <input type="email" class="form-control" name="correo" id="e_correo" value="{{ $llamada->correo }}">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Despacho/Juzgado</label>
                        <input type="text" class="form-control" name="despacho" id="e_despacho" value="{{ $llamada->despacho }}">
                    </div>
                    <div class="col-md-12 form-group">
                        <label>Cargo</label>
                        <input type="text" class="form-control" name="cargo" id="e_cargo" value="{{ $llamada->cargo }}">
                    </div>
                    <div class="col-md-12 form-group">
                        <label>Observaciones de la Llamada</label>
                        <textarea class="form-control" name="observaciones" rows="4" required>{{ $llamada->observaciones }}</textarea>
                    </div>
                </div>
                
                <div class="row mt-4">
                    <div class="col-md-12 text-right">
                        <a href="{{ route('encuestas_llamadas.index') }}" class="btn btn-default">Volver (Dejar en proceso)</a>
                        <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Guardar y Finalizar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        function buscarEmpleado(cedula) {
            Swal.fire({ title: 'Buscando...', allowOutsideClick: false });
            Swal.showLoading();

            $.ajax({
                url: "{{ route('encuestas_llamadas.buscar') }}",
                type: "GET",
                data: { cedula: cedula },
                success: function(res) {
                    Swal.close();
                    if (res.ok) {
                        $('#e_despacho').val(res.data.despacho);
                        $('#e_cargo').val(res.data.cargo);
                        Toast.fire({ icon: 'success', title: 'Datos actualizados desde empleados' });
                    } else {
                        Toast.fire({ icon: 'warning', title: res.mensaje });
                    }
                },
                error: function() {
                    Swal.close();
                    Toast.fire({ icon: 'error', title: 'Error en la búsqueda' });
                }
            });
        }

        $('#btn-buscar-cedula').click(function() {
            let cedula = $('#e_cedula').val();
            if(cedula) {
                buscarEmpleado(cedula);
            }
        });

        // Buscar automáticamente al abrir la página si no tiene cargo asignado
        let cedulaActual = $('#e_cedula').val();
        let cargoActual = $('#e_cargo').val();
        if(cedulaActual && (!cargoActual || cargoActual.trim() === '')) {
            buscarEmpleado(cedulaActual);
        }
    });
</script>
@endpush

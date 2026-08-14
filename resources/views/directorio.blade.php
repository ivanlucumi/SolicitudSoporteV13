@extends('layouts.ensayo')

@section('title', 'Directorio Telefónico')

@section('content') 



<style>
    .directory-header {
        background: linear-gradient(90deg, #002147, #0056b3);
        color: white;
        padding: 15px 20px;
        border-radius: 8px 8px 0 0;
        display: flex;
        align-items: center;
    }
    .directory-header i {
        margin-right: 10px;
    }
    .directory-panel {
        border: 1px solid #d1d1d1;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        margin-top: 20px;
        background-color: #fff;
    }
    .table thead {
        background: linear-gradient(90deg, #002147, #0056b3);
        color: white;
    }
    .table-hover tbody tr:hover {
        background-color: #e6f0ff;
    }
    .search-box {
        margin-bottom: 15px;
    }
    
    .table tbody tr {
        transition: box-shadow 0.3s ease, background-color 0.3s ease;
    }
    
    .table tbody tr:hover {
        background-color: #e6f0ff;         /* fondo azul muy suave */
        box-shadow: 0 4px 8px rgba(0, 33, 71, 0.2);  /* sombra azul oscuro tenue */
        cursor: pointer;
    }
    
    #backToTop {
        position: fixed;
        bottom: 30px;
        right: 30px;
        z-index: 99;
        background: linear-gradient(95deg, #002147, #002149);
        color: white;
        padding: 12px 16px;
        border-radius: 50%;
        text-align: center;
        text-decoration: none;
        font-size: 20px;
        box-shadow: 0 4px 8px rgba(0, 33, 71, 0.3);
        display: none;
        transition: background 0.3s, transform 0.3s, box-shadow 0.3s;
    }
    
    #backToTop:hover {
        background: #0056b3;
        transform: scale(1.1);
        box-shadow: 0 6px 12px rgba(0, 33, 71, 0.4);
    }
    
    #backToTop i {
        vertical-align: middle;
    }


    
</style>
<div class="container-fluid">
    <div class="col-xs-12">
    
<div class="directory-panel">
    <div class="directory-header">
        <h4 class="mb-0">
            <i class="fa fa-phone"></i> Directorio Telefónico
        </h4>
    </div>

    <div class="p-3">
        
        <div class="table-responsive">
            <table  id="table9" class="table table-striped table-hover table-bordered">
                <thead>
                    <tr class="text-center">
                        <th><i class="fa fa-building"></i> DESPACHO</th>
                        <th><i class="fa fa-map-marker"></i> CIUDAD</th>
                        <th><i class="fa fa-map"></i> DIRECCIÓN</th>
                        <th><i class="fa fa-phone"></i> TELÉFONO</th>
                        <th><i class="fa fa-envelope"></i> EMAIL</th>
                        <th><i class="fa fa-phone-square"></i> EXTENSIÓN</th>
                        <th><i class="fa fa-sitemap"></i> CIRCUITO</th>
                        <th><i class="fa fa-globe"></i> DISTRITO</th>
                    </tr>
                </thead>
                <tbody>
                    @if($despacho && count($despacho))
                        @foreach($despacho as $dirto)
                            <tr>
                                <td><strong>{{ $dirto->nombreDespacho }}</strong></td>
                                <td>{{ $dirto->ciudad }}</td>
                                <td>{{ $dirto->direccion }}</td>
                                <td>{{ $dirto->telefono }}</td>
                                <td>
                                    @if($dirto->correoD)
                                        <a href="mailto:{{ $dirto->correoD }}">{{ $dirto->correoD }}</a>
                                    @else
                                        <span class="text-muted">No disponible</span>
                                    @endif    
                                </td>
                                <td>{{ $dirto->extension }}</td>
                                <td>{{ $dirto->circuito }}</td>
                                <td>{{ $dirto->districto }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8" class="text-center text-muted">
                                <p class="lead my-3">Actualmente esta sección no cuenta con información disponible. Lo invitamos a seguir navegando en las demás pestañas.</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<a href="#" id="backToTop" title="Volver arriba">
    <i class="fa fa-arrow-up"></i>
</a>
    <hr>
    
    </div>
</div>

<script src="/js/jquery.js"></script>
<script src="/tablefilter/tablefilter.js"></script>
<script src="/js/directorio.js"></script>



@endsection

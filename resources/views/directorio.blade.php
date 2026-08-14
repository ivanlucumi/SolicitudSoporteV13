@extends('layouts.ensayo')

@section('title', 'Directorio Telefónico')

@section('content') 

<style>
:root{
    --primary:#002147;
    --primary-light:#0056b3;
    --primary-soft:#eaf2ff;
    --shadow-lg:0 15px 35px rgba(0,33,71,.15);
    --shadow-md:0 8px 20px rgba(0,33,71,.12);
    --radius:18px;
}

/* Fondo */
body{
    background:#f5f8fc;
}

/* Panel principal */
.directory-panel{
    border:none;
    border-radius:var(--radius);
    overflow:hidden;
    background:#fff;
    box-shadow:var(--shadow-lg);
    animation:fadeIn .6s ease;
}

/* Header */
.directory-header{
    background:linear-gradient(
        135deg,
        #002147 0%,
        #003366 40%,
        #0056b3 100%
    );
    color:white;
    padding:22px 28px;
    position:relative;
    overflow:hidden;
}

.directory-header::before{
    content:'';
    position:absolute;
    width:250px;
    height:250px;
    border-radius:50%;
    background:rgba(255,255,255,.08);
    right:-80px;
    top:-120px;
}

.directory-header h4{
    font-size:22px;
    font-weight:700;
    letter-spacing:.5px;
    margin:0;
}

.directory-header i{
    margin-right:10px;
}

/* Contenido */
.p-3{
    padding:10px !important;
}

/* Tabla */
.table{
    margin-bottom:0;
    border-collapse:separate;
    border-spacing:0;
}

/* Encabezado */
.table thead th{
    background:linear-gradient(
        135deg,
        #002147,
        #004a99
    ) !important;
    color:#fff;
    border:none !important;
    font-size:10px;
    font-weight:600;
    letter-spacing:.2px;
    padding:8px 4px;
    white-space:normal; /* Permite que el texto baje a la siguiente línea */
    vertical-align:middle;
}

/* Filas */
.table tbody tr{
    transition:all .25s ease;
}

.table tbody td{
    padding:6px 4px;
    font-size:10px;
    vertical-align:middle;
    border-color:#edf2f7;
    word-break:break-word; /* Rompe palabras muy largas (como emails) si es necesario */
}

.table-hover tbody tr:hover{
    background:#f7fbff;
    transform:translateY(-2px);
    box-shadow:0 8px 18px rgba(0,33,71,.12);
}

/* Links */
.table a{
    color:#0056b3;
    font-weight:600;
    text-decoration:none;
}

.table a:hover{
    color:#002147;
}

/* Nombre despacho */
.table strong{
    color:#002147;
    font-weight:700;
}

/* Badges */
.badge-phone,
.badge-extension,
.badge-circuit{
    display:inline-block;
    padding:4px 8px;
    border-radius:20px;
    font-size:10px;
    font-weight:600;
    white-space:nowrap;
}

.badge-phone{
    background:#e8f1ff;
    color:#004a99;
}

.badge-extension{
    background:#eef7ff;
    color:#0066cc;
}

.badge-circuit{
    background:#f2f7fc;
    color:#002147;
}

/* Inputs de filtros */
input[type="text"],
select{
    border:1px solid #dbe5f0 !important;
    border-radius:12px !important;
    padding:10px 14px !important;
    box-shadow:none !important;
    transition:.3s;
}

input[type="text"]:focus,
select:focus{
    border-color:#0056b3 !important;
    box-shadow:0 0 0 4px rgba(0,86,179,.15) !important;
}

/* Scroll personalizado */
.table-responsive::-webkit-scrollbar{
    height:10px;
}

.table-responsive::-webkit-scrollbar-track{
    background:#edf2f7;
}

.table-responsive::-webkit-scrollbar-thumb{
    background:#002147;
    border-radius:10px;
}

/* Botón volver arriba */
#backToTop{
    position:fixed;
    bottom:25px;
    right:25px;
    width:55px;
    height:55px;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    background:linear-gradient(
        135deg,
        #002147,
        #0056b3
    );
    color:white;
    text-decoration:none;
    box-shadow:0 10px 25px rgba(0,33,71,.25);
    z-index:999;
    display:none;
    transition:.3s;
}

#backToTop:hover{
    transform:translateY(-4px) scale(1.05);
    box-shadow:0 15px 35px rgba(0,33,71,.35);
}

#backToTop i{
    font-size:20px;
}

/* DataTables */
.dataTables_wrapper{
    padding-top:10px;
}

.dataTables_filter input{
    border-radius:12px !important;
}

.dataTables_length select{
    border-radius:12px !important;
}

/* Paginación */
.pagination > li > a,
.pagination > li > span{
    border:none;
    margin:0 3px;
    border-radius:10px !important;
    color:#002147;
}

.pagination > .active > a,
.pagination > .active > span{
    background:#002147 !important;
    border-color:#002147 !important;
}

/* Zebra moderno */
.table-striped tbody tr:nth-of-type(odd){
    background-color:#fbfcfe;
}

/* Animación de entrada */
@keyframes fadeIn{
    from{
        opacity:0;
        transform:translateY(20px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

/* Responsive */
@media(max-width:768px){

    .directory-header{
        padding:18px;
    }

    .directory-header h4{
        font-size:18px;
    }

    .table thead th{
        font-size:10px;
        padding:6px;
    }

    .table tbody td{
        font-size:10px;
        padding:6px;
    }
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
                        <th><i class="fa fa-laptop"></i> CANAL ATENCI&Oacute;N VIRTUAL</th>
                        <th><i class="fa fa-map-marker"></i> SEDE</th>
                        <th><i class="fa fa-map"></i> DIRECCIÓN</th>
                        <th><i class="fa fa-phone"></i> TELÉFONO</th>
                        <th><i class="fa fa-envelope"></i> EMAIL</th>
                        <th><i class="fa fa-phone-square"></i> EXTENSIÓN</th>
                        <th><i class="fa fa-sitemap"></i> CIRCUITO</th>
                        <!--th><i class="fa fa-globe"></i> DISTRITO</th-->
                    </tr>
                </thead>
                <tbody>
                    @if($despacho && count($despacho))
                        @foreach($despacho as $dirto)
                            <tr>
                                <td><strong>{{ $dirto->nombreDespacho }}</strong></td>
                                <td>{{ $dirto->ciudad }}</td>
                                <td>
                                    @if($dirto->atencion_virtual)
                                        <a href="{{$dirto->atencion_virtual}}" target="_blank"><i class="fa fa-external-link"></i> Enlace</a>
                                    @endif
                                </td>
                                <td>{{ $dirto->sede }}</td>
                                <td>{{ $dirto->direccion }}</td>
                                <td>
                                    <span class="badge-phone">
                                        {{ $dirto->telefono }}
                                    </span>
                                </td>
                                <td>
                                    @if($dirto->correoD)
                                        <a href="mailto:{{ $dirto->correoD }}">{{ $dirto->correoD }}</a>
                                    @else
                                        <span class="text-muted">No disponible</span>
                                    @endif    
                                </td>
                                <td>
                                    <span class="badge-extension">
                                        {{ $dirto->extension }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge-circuit">
                                        {{ $dirto->circuito }}
                                    </span>
                                </td>
                                <!--td>{{ $dirto->districto }}</td-->
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="10" class="text-center text-muted">
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

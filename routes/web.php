<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\TecnicoSoporteMiddleware;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\DigitalizacionMiddleware;

use App\Http\Middleware\IngresoPorteriaMiddleware;

use App\Http\Middleware\AdministradorMiddleware;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Audiencias\SolicitudAudienciaController;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\Administrador\HistorialSolicitudesController;
use App\Http\Controllers\ControlDigitalizacionController;
use App\Http\Controllers\ControlDigitalizacionPDosController;
use App\Http\Controllers\Administrador\InstitucionalController as InstitucionalController;

//NORMALIZACION
use App\Http\Controllers\NormalizacionController;


use App\Http\Controllers\Administrador\DirectorioController;
use App\Http\Controllers\Administrador\BannerController;
use App\Http\Controllers\Administrador\NoticiasController;
use App\Http\Controllers\Administrador\EspecialController;
use App\Http\Controllers\Administrador\ComiteGeneroController;

//vista estadistica
use App\Http\Controllers\Administrador\EstadisticasController;

//copias seguridad
use App\Http\Controllers\Administrador\CopiaServidorDbController;

//COE CONTROLLER
use App\Http\Controllers\Coe\CoeController;


use App\Http\Controllers\Administrador\SstController;

use App\Http\Controllers\Administrador\DistribucionController;
use App\Http\Controllers\Administrador\ReservaSalasController; 
use App\Http\Controllers\Administrador\ExcelDespachoController;
use App\Http\Controllers\Administrador\ExcelActualizarDirectorioController;
use App\Http\Controllers\Administrador\ExcelSolicitudVirtualController;
use App\Http\Controllers\Administrador\ExcelEmpleadosController;
use App\Http\Controllers\Administrador\DigitalizacionExcelController;
use App\Http\Controllers\Administrador\ExcelContratosActivosController;
use App\Http\Controllers\Administrador\ExcelParqueaderoController;
use App\Http\Controllers\Administrador\ExcelRestriccionSaludController;
//Excel cambiar codigo despachos
use App\Http\Controllers\Administrador\CambioCodigoDespachoController;
use App\Http\Controllers\Administrador\FacturaCumplidoController;
use App\Http\Controllers\Administrador\AudienciasAdminController;
use App\Http\Controllers\modificacion\UpdateDespachosController;
use App\Http\Controllers\modificacion\UpdateUserController;
use App\Http\Controllers\Administrador\AdministradorController;
use App\Http\Controllers\Administrador\RolController;
use App\Http\Controllers\Administrador\UserController;
use App\Http\Controllers\Administrador\CiudadController;
use App\Http\Controllers\Administrador\EmpleadosController;
use App\Http\Controllers\Administrador\TipoRequerimientoController;
use App\Http\Controllers\Administrador\CategoriaController;
use App\Http\Controllers\Administrador\ElementoController;
use App\Http\Controllers\Administrador\InventarioController;
use App\Http\Controllers\Administrador\DespachoController;
use App\Http\Controllers\Administrador\SeccionalesController;
use App\Http\Controllers\Administrador\TiempoAtencionController;
use App\Http\Controllers\Administrador\EventoIntegracionController;
use App\Http\Controllers\Administrador\AdministradorSolicitudUsuarios;

//controlador de escalafon
use App\Http\Controllers\Administrador\EscalafonConsejoController;

//ESCALAFON ADMIN

Route::get('despachos/importar/escalafon', [EscalafonConsejoController::class, 'vistaImport'])->name('despachos.import.view.escalafon');

Route::post('despachos/importar.escalafon', [EscalafonConsejoController::class, 'importar'])->name('despachos.import.escalafon');
    
    
    Route::get('despachos/index.escalafon', [EscalafonConsejoController::class, 'index'])->name('despachos.index.escalafon');
    
    
    Route::get('despachos/show.escalafon', [EscalafonConsejoController::class, 'show'])->name('despachos.show.escalafon');
    
    //ensayo
    Route::get('despachos/importar/escalafon/ed', [EscalafonConsejoController::class, 'vistaImport'])->name('despachos.import.escalafon.edit');
    
    Route::get('despachos/show.escalafon/edit/{id}', [EscalafonConsejoController::class, 'edit'])->name('despachos.show.escalafon.edit');
    
    Route::get('despachos/show.escalafon/delete/{id}', [EscalafonConsejoController::class, 'delete'])->name('despachos.show.escalafon.delete');
    
    Route::post('despachos/importar.escalafon/update', [EscalafonConsejoController::class, 'update'])->name('despachos.import.escalafon.update');
    
    Route::post('/despachos/escalafon/ajax/despacho/{id}', [EscalafonConsejoController::class, 'storeDespachoAjax'])->name('despachos.escalafon.despachosAjax');
    
    
    
    

//Contratos
use App\Http\Controllers\Administrador\ContratoController;

//TELETRABAJO
use App\Http\Controllers\Teletrabajo\Teletrabajo2024Controller;


use App\Http\Controllers\ServisoftController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\EstadisticaDigitalizacionController;
use App\Http\Controllers\RegistroIpController;
use App\Http\Controllers\JornadaSaludController;
use App\Http\Controllers\ProgramacionCapcitacionController;
use App\Http\Controllers\RegistroIncidentesMercurioController;
use App\Http\Controllers\RepartoController;
use App\Http\Controllers\EventoIntegracionLController;
use App\Http\Controllers\OficinaJudicialRepartoController;
use App\Http\Controllers\BestDocController;

use App\Http\Controllers\tecnicos\TecnicosController;
use App\Http\Controllers\Audiencias\TecnicoAudienciaController;
use App\Http\Controllers\AyudaServisoft\AyudaController;
use App\Http\Controllers\Inpec\InpeController;
use App\Http\Controllers\Usuarios\SolicitudUsuarioController;
use App\Http\Controllers\Usuarios\UsuariosController;
use App\Http\Controllers\Usuarios\SolicitudUsuarioSoporteController;
use App\Http\Controllers\reg_ingreso\ControlIngresoController;
use App\Http\Controllers\SeguimientoPresencialidadController;
use App\Http\Controllers\Monitoreo\IngresoParqueaderoController;
use App\Http\Controllers\Monitoreo\RegistroIngreoEmpleadoController;
use App\Http\Controllers\Monitoreo\PorteriaParqueaderoController;
use App\Http\Controllers\Monitoreo\EntradaController;

use App\Http\Controllers\Monitoreo\MonitoreoIngresoController;
use App\Http\Controllers\Monitoreo\SalidaController;
use App\Http\Controllers\Monitoreo\CoordinadorIngresoController;
//reporte ascensores
use App\Http\Controllers\Monitoreo\ReporteAscensorControllerController;
//notificaionestelegram
use App\Http\Controllers\Monitoreo\NotificacionTelegramController;

use App\Http\Controllers\Usuarios\RegistroDigitalizacionController;
use App\Http\Controllers\Reservas\ReservasController;

use App\Http\Controllers\Mantenimiento\ReporteIncidenteController;
//use App\Http\Controllers\ReporteIncidenteController;
use App\Http\Controllers\Usuarios\EncuestaVacunaController;
use App\Http\Controllers\CambioPasswordController;
//solicitud de elementos a almacen
use App\Http\Controllers\SolicitudAlmacenController;

// CONTROLADOR ALMACEN
use App\Http\Controllers\Almacen\AlmacenController;
use App\Http\Controllers\Mantenimiento\OperarioController;

//comodato
use App\Http\Controllers\Comodato\ComodatoImpresoraController;
//todo en uno
use App\Http\Controllers\TodoEnUno\TodoUnoController;
//portatiles
use App\Http\Controllers\Comodato\PortatilesController;
//TODO EN UNO INSTALACION
use App\Http\Controllers\Comodato\TodoEnUnoController;


//elecciones
use App\Http\Controllers\EleccionController;

//soprtes en pdf
use App\Http\Controllers\SoporteUsuarioController;

//solicitudes de trabajo remoto

use App\Http\Controllers\Administrador\SolicitudController;


use App\Http\Controllers\SolicitudNotificacionController;

//notificaciones spa
use App\Http\Controllers\NotificacionSpaController;

//FICHA REMISION
use App\Http\Controllers\FichaController;
use App\Http\Controllers\FichaPreliminarPublicoController;
use App\Http\Controllers\FichaAdminController;


//RESERVA SALAS
use App\Http\Controllers\ReservaSalaAudienciaController;
use App\Http\Controllers\ReservaSalasAudienciaUsersController;

//SINIESTROS
use App\Http\Controllers\SiniestroController;

//INGRESO ARCHIVO
use App\Http\Controllers\IngresoArchivoJudicialController;

//prestamos expedientes

use App\Http\Controllers\EstadoExpedienteController;

//REQUERIMIENTOS DESPACHO

use App\Http\Controllers\RequerimientoDespachosController;

//COMPRAVENTA
use App\Http\Controllers\CompraVentaController;

//TANQUEO VEHICULOS
use App\Http\Controllers\TanqueoVehiculoController;

//ESCALAFON  EscalafonController
use App\Http\Controllers\Escalafon\EscalafonController;
use App\Http\Controllers\Escalafon\DespachoEscalafonController;

//BIOMETRIA INGRESO
use App\Http\Controllers\BiometriaIngresoController;

use App\Http\Controllers\Monitoreo\BiometriaParqueaderoController;

//RUTA LORA UBICACION GPS
use App\Http\Controllers\Lora\LoraController;

// REPORTE DE FALLAS Y DAÑOS
use App\Http\Controllers\ReporteFallasController;
use App\Http\Controllers\AdminReporteFallasController;

// PRÉSTAMO DE EQUIPOS
use App\Http\Controllers\PrestamoEquiposController;
use App\Http\Controllers\AdminPrestamoEquiposController;
// ==========================================
// MÓDULO SOLICITUD DE INGRESO
// ==========================================
use App\Http\Controllers\AutorizacionIngresoController;
use App\Http\Controllers\AdminAutorizacionIngresoController;

// Ruta pública para descargar el PDF de la solicitud de ingreso (Botón en correo y QR)
Route::get('/solicitud/ingreso/{seguimiento}/pdf', [AutorizacionIngresoController::class, 'descargarPdf'])->name('solicitud_ingreso.pdf');

// Rutas públicas para validar solicitud de ingreso
Route::get('/solicitud/ingreso/validar', [AutorizacionIngresoController::class, 'mostrarFormularioValidacion'])->name('solicitud_ingreso.validar_form');
Route::post('/solicitud/ingreso/validar', [AutorizacionIngresoController::class, 'procesarFormularioValidacion'])->name('solicitud_ingreso.validar_post');
Route::get('/solicitud/ingreso/validar/{seguimiento}', [AutorizacionIngresoController::class, 'validarQr'])->name('solicitud_ingreso.qr');

Route::middleware(['auth', 'usuario'])->group(function() {
    Route::get('/reporte-danos', [ReporteFallasController::class, 'index'])->name('reporte.danos.index');
    Route::post('/guardar-fallas', [ReporteFallasController::class, 'store'])->name('reporte.danos.store');
    Route::get('/reporte-danos/buscar-empleado', [ReporteFallasController::class, 'buscarEmpleado'])->name('reporte.danos.buscar_empleado');

    // PRÉSTAMO DE EQUIPOS (Usuario)
    Route::get('/prestamo-equipos', [PrestamoEquiposController::class, 'index'])->name('prestamo.equipos.index');
    Route::get('/prestamo-equipos/crear', [PrestamoEquiposController::class, 'create'])->name('prestamo.equipos.create');
    Route::post('/prestamo-equipos/guardar', [PrestamoEquiposController::class, 'store'])->name('prestamo.equipos.store');
    Route::get('/prestamo-equipos/pdf/{id}', [PrestamoEquiposController::class, 'descargarPdf'])->name('prestamo.equipos.pdf');
    Route::get('/prestamo-equipos/pdf-firmado/{id}', [PrestamoEquiposController::class, 'verPdfFirmado'])->name('prestamo.equipos.pdf_firmado');
    Route::post('/prestamo-equipos/subir-pdf/{id}', [PrestamoEquiposController::class, 'subirPdf'])->name('prestamo.equipos.subir_pdf');
    Route::get('/solicitud/ingreso/mis-solicitudes', [AutorizacionIngresoController::class, 'index'])->name('solicitud_ingreso.index');
    Route::get('/solicitud/ingreso', [AutorizacionIngresoController::class, 'create'])->name('solicitud_ingreso.create');
    Route::post('/solicitud/ingreso', [AutorizacionIngresoController::class, 'store'])->name('solicitud_ingreso.store');

});

// ADMINISTRADOR: VISUALIZACIÓN Y PDF DE REPORTE DE FALLAS
Route::middleware(['auth', 'administrador'])->group(function() {
    Route::get('/administrador/reporte-danos', [AdminReporteFallasController::class, 'index'])->name('admin.reporte.danos.index');
    Route::get('/administrador/reporte-danos/pdf/{id}', [AdminReporteFallasController::class, 'generarPDF'])->name('admin.reporte.danos.pdf');

    // PRÉSTAMO DE EQUIPOS (Administrador/Almacén)
    Route::get('/administrador/prestamo-equipos', [AdminPrestamoEquiposController::class, 'index'])->name('admin.prestamo.equipos.index');
    Route::post('/administrador/prestamo-equipos/estado/{id}', [AdminPrestamoEquiposController::class, 'actualizarEstado'])->name('admin.prestamo.equipos.estado');
});

// ALMACÉN: Gestión de solicitudes de préstamo de equipos
Route::middleware(['auth', 'almacen'])->group(function() {
    Route::get('/almacen/prestamo-equipos', [AdminPrestamoEquiposController::class, 'indexAlmacen'])->name('almacen.prestamo.equipos.index');
    Route::post('/almacen/prestamo-equipos/gestionar/{id}', [AdminPrestamoEquiposController::class, 'gestionarSolicitud'])->name('almacen.prestamo.equipos.gestionar');
    Route::get('/almacen/prestamo-equipos/pdf/{id}', [AdminPrestamoEquiposController::class, 'verPdf'])->name('almacen.prestamo.equipos.pdf');
    Route::get('/almacen/prestamo-equipos/excel', [AdminPrestamoEquiposController::class, 'descargarExcel'])->name('almacen.prestamo.equipos.excel');
    Route::post('/almacen/prestamo-equipos/marcar-elemento/{id}', [AdminPrestamoEquiposController::class, 'marcarElementoEntregado'])->name('almacen.prestamo.equipos.marcar_elemento');

    Route::get('/almacen/solicitud-ingreso', [AdminAutorizacionIngresoController::class, 'index'])->name('admin.solicitud_ingreso.index');
    Route::post('/almacen/solicitud-ingreso/{id}/responder', [AdminAutorizacionIngresoController::class, 'responder'])->name('admin.solicitud_ingreso.responder');
    Route::get('/almacen/solicitud-ingreso/{seguimiento}/pdf', [AdminAutorizacionIngresoController::class, 'descargarPdf'])->name('admin.solicitud_ingreso.pdf');

});





Route::get('/lora/datos/ubicacion/gps', [LoraController::class, 'Index'])->name('ubicacion.lora');


//RESPUESTA SERVICIOS JUDICIALES

use App\Http\Controllers\Usuarios\RespuestaServicioJudicialController;
Route::prefix('servicios-judiciales')->group(function() {
    Route::get('/responder', [RespuestaServicioJudicialController::class, 'create'])->name('servicios-judiciales.create');
    Route::post('/', [RespuestaServicioJudicialController::class, 'store'])->name('servicios-judiciales.store');
});

//CARNET Y BILLETERA GOOGLE
use App\Http\Controllers\CarnetController;


//backup de fotos biometria
use App\Http\Controllers\Administrador\AzureBiometriaController;

Route::get('/biometria/subir-azure', [AzureBiometriaController::class, 'subirFotosAzure']);

/*Route::get('/registro/ingreso/', [BiometriaIngresoController::class,'Index'])->name('biometria.index');
Route::get('/registro/biometria/save', [BiometriaIngresoController::class,'save'])->name('biometria.registro.save');
Route::post('/registro/biometria/save/foto', [BiometriaIngresoController::class,'store'])->name('biometria.registro.save.foto');
Route::post('/registro/biometria/cargar/foto', [BiometriaIngresoController::class,'cargarFoto'])->name('biometria.registro.cargar.foto');*/


//descargar de docuemntos de certificacion recursos Humanos
use App\Http\Controllers\RecursosHumanos\CertificacionController;
Route::get('/recursos/humanos/certificacion/', [CertificacionController::class, 'index'])->name('certificacion.form');
Route::post('/recursos/humanos/certificacion/enviar', [CertificacionController::class, 'enviar'])->name('certificacion.enviar');
Route::get('/recursos/humanos/certificacion/descargar/{cedula}', [CertificacionController::class, 'descargar'])
    ->name('certificacion.descargar')
    ->middleware('signed');
    
//DEscargar
    Route::get('/certificado/escalafon/descargar/{cedula}', [EscalafonConsejoController::class, 'descargar'])
    ->name('public.certificacion.escalafon.descargar')
   ->middleware('signed');





//GENERAR NUMEROS ALEATORIOS
Route::get('/numeros-aleatorios', [PrincipalController::class, 'numeroAleatorios'])->name('numeros.aleatorios');
Route::post('/generar-numeros', [PrincipalController::class, 'generateNumeroAleatorios']);

//PAGINA PUBLICA DE COE
Route::get('/coe', [CoeController::class, 'IndexCoe'])->name('index.coe.publico');


//TELETRABAJO PASTO
use App\Http\Controllers\Teletrabajo\ConsultaPastoController;
Route::get('/consulta/solicitudes/teletrabajo', [ConsultaPastoController::class, 'showEmailForm'])->name('email.form');
Route::post('/send-code', [ConsultaPastoController::class, 'sendCode'])->name('send.code');
Route::get('/validacion/teletrabajo', [ConsultaPastoController::class, 'Teletrabajo'])->name('validacion.teletrabajo.publico')->middleware('signed');


//ASISTENCIA TECNICOS
use App\Http\Controllers\AsistenciaTecnicoController;

//GENERAR QR EN SIRIS
use App\Http\Controllers\GoogleQrCodeController;

Route::get('/sirisqrcode', [GoogleQrCodeController::class, 'showForm'])->name('sirisqrcode.form');

//acortador de url SIRIS
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\UrlShortenerController;

Route::get('/acortador/url', [UrlShortenerController::class, 'index'])->name('acortador.url');
Route::post('/acortador/shorten', [UrlShortenerController::class, 'store'])->name('shorten');
//Route::get('/acortador/stats/{code}', [UrlShortenerController::class, 'showStats'])->name('stats');
Route::get('/a/{code}', [RedirectController::class, 'redirect']);


//amazon ses
use App\Http\Controllers\SesEmailController;
//Route::get('/send-email', [SesEmailController::class, 'sendEmail']);

//ENCUESTAS

use App\Http\Controllers\EncuestaController;
Route::get('/encuesta/satisfaccion', [EncuestaController::class, 'index'])->name('encuesta.satisfaccion');
Route::post('/encuesta/satisfaccion/save', [EncuestaController::class, 'store'])->name('encuesta.satisfaccion.store');

Route::get('/encuesta/satisfaccion/aplicativo', [EncuestaController::class, 'IndexEncuenta'])->name('encuesta.IndexEncuenta')->middleware(Authenticate::class);
Route::post('/encuesta/satisfaccion/aplicativo/save', [EncuestaController::class, 'saveEncuentas'])->name('encuesta.saveEncuentas')->middleware(Authenticate::class);

Route::get('/datos-clasificados', [EncuestaController::class, 'datosClasificados'])->name('encuesta.datosClasificados');
Route::get('/encuesta/datos-clasificados', [EncuestaController::class, 'show'])->name('encuesta.show')->middleware(AdministradorMiddleware::class);/**/
Route::get('/exportar-encuesta-detallada', [EncuestaController::class, 'exportarEncuestaDetallada'])->name('exportar.encuesta.detallada')->middleware(AdministradorMiddleware::class);

//ENCUESTA DE MANTENIMIENTO
Route::get('encuesta/satisfaccion/{consecutivo}', [EncuestaController::class, 'EncuestaMantenimiento'])->name('mantenimiento.encuesta.mostrar');
Route::post('encuesta/satisfaccion/save/{consecutivo}', [EncuestaController::class, 'guardarEncuestaMantenimiento'])->name('mantenimiento.encuesta.guardar');

Route::get('/ajax/encuesta/{consecutivo}', [EncuestaController::class, 'ajaxEncuesta'])->name('ajax.encuesta');
    





//DIA DE LA FAMILIA
use App\Http\Controllers\EventosRhController;
Route::get('/evento/dia/familia', [EventosRhController::class,'Index'])->name('dia.familia.index');
Route::get('/evento/dia/familia/listado/{id}', [EventosRhController::class,'Listado'])->name('mostrar.listado.dia.familia');
Route::get('/evento/dia/familia/listado/', [EventosRhController::class,'ListadoView'])->name('mostrar.listado.dia.familia.view');
    ///
Route::post('/evento/dia/familia/save', [EventosRhController::class,'Save'])->name('save.confirmacion.familia');


//BIENESTAR DIA DE LA FAMILIA

use App\Http\Controllers\Bienestar\AsistenciaController;

Route::prefix('/bienestar/dia_de_la_familia')->group(function() {
    Route::get('/', [AsistenciaController::class, 'index'])->name('asistencia.index');
    Route::get('/registrar', [AsistenciaController::class, 'create'])->name('asistencia.create');
    Route::post('/registrar', [AsistenciaController::class, 'store'])->name('asistencia.store');
    Route::get('/reporte/excel', [AsistenciaController::class, 'reporteExcel'])->name('asistencia.reporte.excel');
});



Route::get('/consultas/cedulas', function () {
    return view('Prueba.Fornularioconsulta'); 
   
});

Route::get('/ventanilla/digital', function () {
    return view('externo.VentanillaDigital.Index'); 
   
});

//consulta cedula siugj

//Route::get('/consultar/{cedula}', [PrincipalController::class, 'consultarCedula']);
Route::get('/consultarcat/', [PrincipalController::class, 'consultarCedula']);

Route::get('/JUSTICIA RESTAURATIVA Y TERAPEUTICA', function () {
    return view('Videos'); 
   
});

Route::post('/ruleta-novenas/datos', [BestDocController::class,'revision'])->name('publico.salas.carga.doc');

//Route::get('/ruleta-novenas', [PrincipalController::class,'ruleta1'])->name('publico.salas.ruleta');


//Consulta publica visita Siugj
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

// Fecha actual sin hora


Route::get('/visitas/siugj', function () {
    // Realizar la consulta
    $fecha = Carbon::now()->format('Y-m-d');
    $users = DB::table('programacion_visita_siugj')->where('fecha_visita', $fecha)->get(); // Obtén todos los usuarios de la tabla 'users'
    //dd($users);
    // Enviar los datos a la vista
    return view('ruleta.Siugj', ['users' => $users]);
});

//ejemplo carnets
/*Route::get('/ejemplo/carnet_digital', function () {
    return view('ruleta.carnet'); 
});*/
Route::get('carnet', function () {
   // return view('ruleta.carnet'); 
});

//── Módulo Consulta Carnet Digital ──────────────────────────────────────────
// Formulario de consulta (cédula + fecha de expedición)
Route::get('/ejemplo/carnet_digital',        [\App\Http\Controllers\CarnetController::class, 'redireccion'])->name('carnet.form');
Route::get('/carnet/consulta',        [\App\Http\Controllers\CarnetController::class, 'form'])->name('carnet.consulta');

// Nueva ruta base para la PWA (Soporte Offline)
Route::get('/mi-carnet', [\App\Http\Controllers\CarnetController::class, 'miCarnet'])->name('carnet.pwa');

// Procesa la consulta y muestra el carnet
Route::post('/carnet/consultar', [\App\Http\Controllers\CarnetController::class, 'consultarCarnet'])->name('carnet.consultar'); 

// Acceso directo al carnet por token público
Route::get('/carnet/ver/{token}', [\App\Http\Controllers\CarnetController::class, 'showPublic'])->name('carnet.public');

// --- MÓDULO PARQUEADERO CONTRATISTAS ---
use App\Http\Controllers\Monitoreo\ContratistaRegRegistroController;

// Sincronización de token para iOS PWA
Route::get('/api/carnet/token/{token}', [\App\Http\Controllers\CarnetController::class, 'getByToken'])->name('api.carnet.token');


// Revocar carnet (elimina su token de acceso público)
Route::post('/api/carnet/revocar', [\App\Http\Controllers\CarnetController::class, 'revocar'])->name('api.carnet.revocar');

// API de validación (JSON) por porteria y la pwa
Route::get('/api/carnet/validar', [\App\Http\Controllers\CarnetController::class, 'validar'])->name('api.carnet.validar');
// API de validación (JSON) - Protegida

    



Route::get('/ruleta-novena', function () {
   // return view('monitoreo.salida.RegistroSalidaNuevo'); 
    //return view('Coe.Coe'); 
    //return view('layouts.Bienestar'); 
    //return view('ruleta.carnet'); 
     return view('ruleta.ruleta'); 
    //return view('emails/soporte/pruebacorreo');
    $reporte = null;
    //return view('emails/soporte/CorreoComodato',compact('reporte'));
});




//CONSULTA DE PAGINA CONSEJO DE ESTADO

Route::get('/consulta/consejo/seccional', 
 function () {
    return view('ConsejoEstado.consulta'); 
})->name('consulta.consejo.estado')->middleware(Authenticate::class);


//salas audiencia
use App\Http\Controllers\SalaAudienciaController;

Route::get('/inventario/sala_audiencia', [SalaAudienciaController::class, 'index'])->name('inventario.index');
Route::post('/inventario/sala_audiencia', [SalaAudienciaController::class, 'store'])->name('inventario.store');

Route::get('/creacion/sala/audiencia/inventario', [SalaAudienciaController::class,'indexSala'])->name('salas.listado');
Route::post('/salas/create', [SalaAudienciaController::class,'storeSala'])->name('salas.creacion');
Route::delete('/elemento/inventario/sala/{id}', [SalaAudienciaController::class, 'destroy'])->name('inventario.sala.elemento.destroy');

Route::get('/admin/inventario/salas_audiencia', [SalaAudienciaController::class, 'AdminSalaAudiencia'])->name('admin.inventario.index');
Route::get('/inventario/sala_audiencia/export', [SalaAudienciaController::class, 'export'])->name('inventario.sala.audiencia.export');



use App\Http\Controllers\Administrador\AzureFichaRemisionController;

Route::get('/azure/upload/fichas', [AzureFichaRemisionController::class, 'subirDocumentos']);
//ALMACENAR LA SAS EN SIRIS DE FICHAS
Route::get('/fichaPreliminar/actualizar-sas', [PrincipalController::class, 'actualizarSas']);
//actualizarAnexosSas
Route::get('/fichaPreliminar/anexo/actualizar-sas', [PrincipalController::class, 'actualizarAnexosSas']);

Route::get('/fichaPreliminar/descargar/{filename}', [PrincipalController::class, 'descargarFichaPreliminar'])
     ->where('filename', '.*')
     ->name('fichaPreliminar.descargar');
     
//descargarFichaPreliminarAnexo
Route::get('/fichaPreliminar/descarga-documento/{filename}', [PrincipalController::class, 'descargarFichaPreAnexo'])->name('fichaPreliminar.descargar.anexo');
     
Route::get('/fichaPreliminar/descarga-acta/{filename}', [PrincipalController::class, 'descargarFichaPreActa'])->name('fichaPreliminar.descargar.acta');


use App\Http\Controllers\Administrador\AzureController;
Route::get('/upload-to-azure', [AzureController::class,'uploadFilesToAzure'])->name('index.azure');
Route::get('db/upload-to-azure',[AzureController::class,'subirBackup'])->name('index.azure.bk');
Route::get('db/biometria/ingreso',[AzureController::class,'uploadBase64Images'])->name('index.azure.bk.bio');


Route::get('/tanqueo', [TanqueoVehiculoController::class,'index'])->name('index.tanqueo');
Route::get('/registro/tanqueo', [TanqueoVehiculoController::class,'create'])->name('regsitro.tanqueo');

Route::get('/registro/vehiculo/{id}', [TanqueoVehiculoController::class,'show'])->name('regsitro.vehiculo.show');
    ///
Route::post('/registro/tanqueo/save', [TanqueoVehiculoController::class,'save'])->name('save.registro.tanqueo');

//FIRMA PUBLICO SOPORTE
use App\Http\Controllers\Usuarios\FirmaExternaController;
;
Route::get('/firma/documento/soporte/{id}/{numcaso}/{tecnico}/{fecha}',              [FirmaExternaController::class,'PendienteFirma'])->name('pendiente.firma.servicio.publico');
Route::put('/firma/documento/soporte/{id}',              [FirmaExternaController::class,'FirmaPublico'])->name('firma.firma.servicio.publico');




//TECNICOS PRESTAMO DE EXPEDIENTES
Route::group(['prefix' => 'registro/expedientes'], function()
{
    Route::get('/', [EstadoExpedienteController::class,'prestamos'])->name('expediente.pestamo');
    Route::get('/consultar/expediente/{id}', [EstadoExpedienteController::class,'consulta'])->name('expediente.consulta');
    Route::get('/consultar/expediente/libre/{id}', [EstadoExpedienteController::class,'consultaExpediente'])->name('expediente.consulta.libre');
    //
    Route::post('/terminar/prestamo', [EstadoExpedienteController::class,'finalizarPrestamo'])->name('soltar.prestamo');

    Route::post('/prestamo', [EstadoExpedienteController::class,'registro_prestamos'])->name('expediente.registrar.prestamo');
    Route::get('/expedientes', [EstadoExpedienteController::class,'registro_expedientes'])->name('expediente.registrar.expediente');
    Route::post('/registrar/expedientes', [EstadoExpedienteController::class,'save_registro_expedientes'])->name('expediente.save.expediente');
    Route::get('/editar/expedientes/{id}', [EstadoExpedienteController::class,'editar_registro_expedientes'])->name('expediente.editar.expediente');
    Route::put('/actualizar/expedientes/{id}', [EstadoExpedienteController::class,'update_registro_expedientes'])->name('expediente.actualizar.expediente');
    Route::get('/historial/prestamo', [EstadoExpedienteController::class,'historial_prestamos'])->name('expediente.historial.prestamo');
	Route::post('eliminar/expediente/',        [EstadoExpedienteController::class,'destroy'])->name('delete.registro.expediente');
});


///URL consulta RESERVA SALAS

Route::get('/consulta/reservas/salas/{edificio}/{ciudad}', [PrincipalController::class,'publicoReservaSalas'])->name('publico.salas.reserva');
Route::get('/ajax/consulta/reservas/salas/{edificio}/{ciudad}', [PrincipalController::class,'publicoReservaSalasAjax'])->name('publico.salas.reserva.ajax');


Route::get('/reservas/salas/cali', [PrincipalController::class,'publico'])->name('publico.salas');
Route::get('/reservas/salas/ajax', [PrincipalController::class,'publicoAjax'])->name('publico.salas.ajax');


Route::get('/reservas/salas/palmira', [PrincipalController::class,'publicoPalmira'])->name('publico.salas.palmira');
Route::get('/reservas/salas/ajax/palmira', [PrincipalController::class,'publicoAjaxPalmira'])->name('publico.salas.ajax.palmira');

Route::group(['prefix' => 'administracion'], function(){

      Route::get('/reserva/salas', [ReservaSalaAudienciaController::class,'index'])->name('reservas.reserva.index');
      Route::get('/reserva/sala/{sala}', [ReservaSalaAudienciaController::class,'Salas'])->name('reservas.reserva.salas');
      
      
      Route::get('/sala/{sala}', [ReservaSalaAudienciaController::class,'ReservarSalas'])->name('reservas.salas');
      Route::post('/sala/eliminar/', [ReservaSalaAudienciaController::class,'ReservarSalasEliminar'])->name('eliminar.reservas.salas');
      
      Route::post('/reservas/salas/store', [ReservaSalaAudienciaController::class,'store'])->name('reservas.store.salas');
      
      Route::get('/evento/salas/{sala}', [ReservaSalaAudienciaController::class,'Eventos'])->name('reservas.evento.salas');
      Route::get('/reservas/historial', [ReservaSalaAudienciaController::class,'ReservasSalas'])->name('reservas.all.salas');
      
      Route::get('/reservas/hoy', [ReservaSalaAudienciaController::class,'ReservasHoy'])->name('reservas.hoy.salas');
      
      Route::get('/reservas/publico', [ReservaSalaAudienciaController::class,'publico'])->name('reservas.publico.salas');
      
});




//RUTA DE LIMPIEZA
Route::get('limpiar', function(){
    //$php = Artisan::call('up');
   $php = Artisan::call('optimize:clear');
   $php6 = Artisan::call('config:cache'); 
   $php1 = Artisan::call('view:clear');
   $php2 = Artisan::call('cache:clear');
   $php3 = Artisan::call('route:clear');
   $php4 = Artisan::call('optimize:clear');
   return Redirect::to('/'); 
});


Route::get('/visualizacion/docuemnto/de', [IngresoArchivoJudicialController::class,'descarga'])->name('descargar.archivo.pdf');

Route::get('/visualizacion/docuemnto', function () {
    return view('usuario.archivo.DocPdf'); 
    //return view('emails/soporte/pruebacorreo');
});

Route::get('/formulario/censo/electoral', [EleccionController::class,'index'])->name('externo.censo.electoral');
Route::post('/formulario/censo/electoral', [EleccionController::class,'index'])->name('externo.censo.electoral.post');

//FICHA PRELIMINAR 
Route::get('/solicitud/ficha/preliminar', [FichaPreliminarPublicoController::class,'index'])->name('publico.ficha.preliminar.index');
Route::post('/solicitud/ficha/preliminar/save', [FichaPreliminarPublicoController::class,'Ficha_Preliminar_store'])->name('publico.ficha.preliminar.save');
Route::get('/consulta/ficha/preliminar/', [FichaPreliminarPublicoController::class,'Ficha_Preliminar_consulta'])->name('publico.ficha.preliminar.consulta');
Route::post('/consulta/ficha/preliminar/resultado', [FichaPreliminarPublicoController::class,'Ficha_Preliminar_consulta_resultado'])->name('publico.ficha.preliminar.consulta.resultado');



// auth()->routes();
//VIGILANCIA JUDICIAL 
use App\Http\Controllers\VigilanciaJudicial\VigilanciaJudicialController;
Route::get('/solicitud/vigilancia/judicial', [VigilanciaJudicialController::class,'Inicio'])->name('publico.vigilancia.judicial.index');
Route::post('/solicitud/vigilancia/judicial/save', [VigilanciaJudicialController::class,'SaveInicio'])->name('publico.vigilancia.judicial.save');


//descargar de archivos
Route::get('/vigilancia/descarga-documento/{filename}', [PrincipalController::class, 'descargarDocumentoVigilancia'])->name('Vigilancia.descargar.documento');

//ver correo de vigilancia

Route::get('/vistacorreo', function () {
    return view('emails.Vigilancia.RepartoVigilancia'); 
   
});

//REPARTO VIGILANCIA JUDICIAL
use App\Http\Controllers\VigilanciaJudicial\RepartoVigilanciaController;

Route::group(['prefix' => 'vigilancia/judicial/solicitudes'], function()
{
Route::get('/', [RepartoVigilanciaController::class,'Index'])->name('reparto.vigilancia.judicial.index');
Route::get('/reparto/{id}', [RepartoVigilanciaController::class,'Reparto'])->name('reparto.vigilancia.judicial.reparto');
Route::put('/asignar/{id}', [RepartoVigilanciaController::class,'AsignarReparto'])->name('reparto.vigilancia.judicial.asignar');
Route::get('/historico', [RepartoVigilanciaController::class,'Historico'])->name('reparto.vigilancia.judicial.historico');
    
});


Route::get('/formulario/validacion', [RepartoController::class,'index'])->name('externo.validacion');
Route::get('/formulario/reparto/grupo/{id}', [RepartoController::class,'consultaGrupo'])->name('externo.formulario.consulta');
//validar no soy robot
Route::post('/formulario/reparto/robot', [RepartoController::class,'robot'])->name('robot.informacion.reparto');

Route::get('/formulario/reparto/informacion/{oficinaReparto}/{email}', [RepartoController::class,'formulario'])->name('externo.informacion.reparto');
Route::post('/formulario/reparto', [RepartoController::class,'store'])->name('externo.reparto');
//consultar para ver si esta presentada	
Route::get('/consultar/proceso/',              [RepartoController::class,'consultar'])->name('consulta.existencia.proceso'); 

 
 //formulario evento de integracion
 //Route::get('/formulario/evento', [EventoIntegracionLController::class,'index']);
 
 Route::get('/listado/asistencia/evento', [EventoIntegracionLController::class,'listadoEvento'])->name('index.asistencia.evento');
 Route::post('/regsitrar/asistencia', [EventoIntegracionLController::class,'RegsitrarAsistencia'])->name('registro.asistencia.evento');
Route::get('/consulta/cedula/asistencia/{cedula}', [EventoIntegracionLController::class,'consultaCedulaAsistencia'])->name('corte.conculta.ced');/*->middleware(Authenticate::class)/*


//region cali
Route::get('/formulario/region/cali', [PrincipalController::class,'regionCali'])->name('publico.regionCali');
Route::post('/formulario/region/cali', [PrincipalController::class,'regionCaliSave'])->name('publico.regionCali.save');

/*Route::get('/formulario/region/cali', function () {
    return view('externo.region_cali'); 
    //return view('emails/soporte/pruebacorreo');
});*/

/*Route::get('/prueba/rutai', function () {
    return view('errors.403'); 
    //return view('emails/soporte/pruebacorreo');
});*/

Route::post('/formulario/evento/registrarse', [EventoIntegracionLController::class,'store'])->name('externo.evento.store');

Route::get('/activity', [SolicitudAudienciaController::class,'updatedActivity']);

/*Route::get('/prueba/ficha', function () {
    return view('emails.soporte.fichaRemisionPdf');
});*/
Route::get('/mesa_participacion/conversatorio_nacional_especialidad_laboral', [EventoIntegracionLController::class,'index'])->name('corte.evento.index')->middleware(Authenticate::class);
Route::get('/consulta/cedula/corte/{cedula}', [EventoIntegracionLController::class,'consultaCedula'])->name('corte.conculta.ced')->middleware(Authenticate::class);
Route::post('/store/mesa/trabajo', [EventoIntegracionLController::class,'storeMesaTrabajo'])->name('corte.evento.store')->middleware(Authenticate::class);

Route::get('/elecion/representante/empleados/funcionarios/rama/judicial', function () {
    return "HOLA, YA NO EST��� DISPONIBLE EL M���DULO";//view('target.copasst');
});



Route::get('contador/visitas/disaj',[PrincipalController::class,'contarVisitas'])->name('contador.visitas');

Route::get('excelconsolidado',    [HistorialSolicitudesController::class,'excelconsolidado'])->name('excelconsolidado');


//ruta para proceso de digitalizacion
Route::group(['prefix' => 'revision/proceso/digitalizacion'], function(){
	Route::get('/index',              [ControlDigitalizacionController::class,'index'])->name('digitalizacion.inicio'); 
	Route::get('/revisadas',              [ControlDigitalizacionController::class,'Revisado'])->name('digitalizacion.revisada'); 
	Route::get('/sin_revisar',              [ControlDigitalizacionController::class,'porRevisar'])->name('digitalizacion.sin_revisar'); 
	Route::get('/revisar/{radicado}',              [ControlDigitalizacionController::class,'revisar'])->name('digitalizacion.revisar'); 
	Route::put('radicado/update/{id}', [ControlDigitalizacionController::class,'update'])->name('digitalizacion.update');
	
	Route::put('supervision/save/{radicado}',        [ControlDigitalizacionController::class,'saveReporte'])->name('save.reporte');
	Route::delete('supervision/delete/{pdf}',        [ControlDigitalizacionController::class,'deletepdf'])->name('delete.pdf');
	
	//actualizar sin registro
	Route::get('supervisor/sin/registro/{id}',[ControlDigitalizacionController::class,'sinRegistro'])->name('supervisor.sinregistro');
	
	//SEGUNDA REVISION
	Route::put('supervisor/servisoft/{id}',[ControlDigitalizacionController::class,'RevisionSevisoft'])->name('supervisor.servisoft');
	
	//verificar la revision por parte del contratista, aca aparecen cuando el contratista ha dado repuesta a la observacion
	Route::get('segunda/revision',[ControlDigitalizacionController::class,'segundaRevision'])->name('supervisor.segundarevision');
	
	//resultado registro inventario
	Route::get('registro/inventario',[ControlDigitalizacionController::class,'registroInventario'])->name('supervisor.registroInventario');
	Route::get('registro/inventario/descarga',[ControlDigitalizacionController::class,'DescargarInvetarioD'])->name('supervisor.registroInventario.descarga');
	
	
   
   //ruta para proceso de digitalizacion protocolo dos

   Route::get('protocolo/dos',              [ControlDigitalizacionPDosController::class,'index'])->name('prodos.inicio'); 
   Route::get('protocolo/dos/revisadas',              [ControlDigitalizacionPDosController::class,'Revisado'])->name('prodos.revisada'); 
   Route::get('protocolo/dos/sin_revisar',              [ControlDigitalizacionPDosController::class,'porRevisar'])->name('prodos.sin_revisar'); 
   Route::get('protocolo/dos/revisar/{radicado}',              [ControlDigitalizacionPDosController::class,'revisar'])->name('prodos.revisar'); 
   Route::put('protocolo/dos/radicado/update/{id}', [ControlDigitalizacionPDosController::class,'update'])->name('prodos.update');
   
   Route::put('supervision/protocolo/dos/save/{radicado}',        [ControlDigitalizacionPDosController::class,'saveReporte'])->name('prodos.save.reporte');
   Route::delete('supervision/protocolo/dos/delete/{pdf}',        [ControlDigitalizacionPDosController::class,'deletepdf'])->name('prodos.delete.pdf');
   
   //actualizar sin registro
   Route::get('protocolo/dos/supervisor/sin/registro/{id}',[ControlDigitalizacionPDosController::class,'sinRegistro'])->name('supervisor.protocolo.dos.sinregistro');
   
   //actualizar sin registro
   Route::get('protocolo/dos/supervisor/corregido/{id}',[ControlDigitalizacionPDosController::class,'Corregido'])->name('supervisor.protocolo.dos.corregido');
   
   //SEGUNDA REVISION
   Route::put('protocolo/dos/supervisor/servisoft/{id}',[ControlDigitalizacionPDosController::class,'RevisionSevisoft'])->name('supervisor.protocolo.dos.servisoft');
   
   //verificar la revision por parte del contratista, aca aparecen cuando el contratista ha dado repuesta a la observacion
   Route::get('protocolo/dos/segunda/revision',[ControlDigitalizacionPDosController::class,'segundaRevision'])->name('supervisor.protocolo.dos.segundarevision');
   
   //resultado registro inventario
   Route::get('protocolo/dos/registro/inventario',[ControlDigitalizacionPDosController::class,'registroInventario'])->name('supervisor.protocolo.dos.registroInventario');
   Route::get('protocolo/dos/registro/inventario/descarga',[ControlDigitalizacionPDosController::class,'DescargarInvetarioD'])->name('supervisor.protocolo.dos.registroInventario.descarga');

   //descargar revision 
   Route::get('descarga/revision/protocolo/dos',              [ControlDigitalizacionPDosController::class,'descarga'])->name('descarga.prodos.inicio'); 
   
   
   //RUTA PARA EL REGISTRO DE TRASLADO A BESTDOC   ->middleware(DigitalizacionMiddleware::class);
   
   Route::get('bestdoc',              [BestDocController::class,'revision_index'])->name('supervisor.bestdco.inicio'); 
   Route::get('bestdoc/asignar/{id}',[BestDocController::class,'Asignar_revision'])->name('supervisor.bestdco.asignar.registro');
   Route::get('bestdoc/registro/{id}',[BestDocController::class,'Registro_revision'])->name('supervisor.bestdco.registro');
   //descargar REGISTRO DE CARGA A BESTDOC 
   Route::get('descarga/registro/bestdoc',              [BestDocController::class,'descarga'])->name('descarga.registro.traslado.bestdoc'); 
   
   //REvision de Bestdoc
   Route::get('revision/registro/bestdoc',              [BestDocController::class,'revision'])->name('revision.registro.bestdoc');
   
    //apoyo a la supervision
   Route::get('novedades/registro/bestdoc',              [ControlDigitalizacionPDosController::class,'novedades'])->name('novedades.registro.bestdoc');
   //respuesta servisoft
   Route::get('respuesta/servisoft/registro/bestdoc',              [ControlDigitalizacionPDosController::class,'revisionServisoft'])->name('revision.registro.bestdoc');
   
   
   
   //NORMALIZACION DE EXPEDIENTES   
   
   Route::get('registro/normalizacion',              [NormalizacionController::class,'Index'])->name('normalizacion.registro');
   //
   Route::get('registro/normalizacion/descarga',              [NormalizacionController::class,'DescargarInvetarioD'])->name('normalizacion.registro.descarga');
   //
   Route::post('registro/normalizacion/save',              [NormalizacionController::class,'save'])->name('normalizacion.registro.save');
   
   Route::get('registro/normalizacion/tomar',              [NormalizacionController::class,'tomar'])->name('normalizacion.registro.tomar');
   
   //NORMALIZACION SUPERVISION
   Route::get('registro/normalizacion/todo',              [NormalizacionController::class,'Todos'])->name('normalizacion.registro.todo');
   
   //TrasladoMes
   Route::POST('registro/normalizacion/traslado',              [NormalizacionController::class,'TrasladoMes'])->name('normalizacion.registro.traslado');
   //TrasladoMes
   Route::POST('registro/normalizacion/asignacion',              [NormalizacionController::class,'AsignacionExpedientes'])->name('normalizacion.registro.asignacion');
   
   //BUSCAR RADICADO
   Route::get('registro/normalizacion/buscar',              [NormalizacionController::class,'BuscarRadicado'])->name('normalizacion.registro.buscarradicado');
   
   //informe de actividades diarias
   
    //Route::get('/actividades/registro', [NormalizacionController::class, 'Informe'])->name('activities.create');
    Route::get('/', [NormalizacionController::class, 'Informe'])->name('activities.create');
    Route::post('/actividades/registro', [NormalizacionController::class, 'InformeStore'])->name('activities.store');
     Route::post('/actividades/generar-reporte', [NormalizacionController::class, 'generateMonthlyReport'])->name('activities.generate-report');
     
     //ACTIVIDADES DE REGISTRO POR DESPACHO
     //Route::get('/actividades/despachos', [NormalizacionController::class, 'createActividadDespacho'])->name('activities.despacho.create');
     
    Route::get('/despachos/actividades', [NormalizacionController::class, 'indexActividadDespacho'])->name('actividades.index');
    Route::get('/despachos/actividades/create', [NormalizacionController::class, 'createActividadDespacho'])->name('actividades.create');
    Route::post('/despachos/actividades', [NormalizacionController::class, 'storeActividadDespacho'])->name('actividades.store');
    Route::get('/despachos/actividades/{id}/edit', [NormalizacionController::class, 'editActividadDespacho'])->name('actividades.edit');
    Route::put('/despachos/actividades/{id}', [NormalizacionController::class, 'updateActividadDespacho'])->name('actividades.update');
    Route::put('/despachos/actividades/{id}/observaciones', [NormalizacionController::class, 'updateObservaciones'])->name('actividades.updateObservaciones');

   
   
   
    
});

//OFICINA DE REPARTO

//PERFIL REPORTE DE INCIDENTES
Route::group(['prefix' => 'oficina/reparto','middleware' => 'auth',], function(){
    
    
    
    Route::get('/',              [OficinaJudicialRepartoController::class,'Noticias'])->name('reparto.noticias'); 
	Route::get('/pendientes',              [OficinaJudicialRepartoController::class,'oficina'])->name('reparto.index'); 
	Route::get('/asignado',[OficinaJudicialRepartoController::class,'asignado'])->name('reparto.index.asignado'); 
	Route::get('/pendientes/trasladar/{id}',              [OficinaJudicialRepartoController::class,'traslado'])->name('reparto.traslado'); 
	Route::put('/pendientes/asignar/{id}',              [OficinaJudicialRepartoController::class,'enviarReparto'])->name('reparto.enviar.asignacion'); 
	
	//cambiar grupo
    Route::put('/formulario/reparto/despacho/{id}', [OficinaJudicialRepartoController::class,'cambiaGrupo'])->name('reparto.cambiar.grupo');
	
	//asignar reparto por select a funcioario y que el lo realice
	Route::post('/asignar/a_funcionario/',              [OficinaJudicialRepartoController::class,'asignarFuncionario'])->name('reparto.asignar.funcionario'); 
	
	//consultar los que tienen Reparto
	Route::get('/con_reparto',              [OficinaJudicialRepartoController::class,'conReparto'])->name('reparto.con.reparto'); 

   //ESTADISTICA
	Route::get('/estadistica',              [OficinaJudicialRepartoController::class,'Estadistica'])->name('reparto.con.estadistica'); 

	 //cambiar grupo
	 Route::put('/formulario/reparto/trasladar/{id}', [OficinaJudicialRepartoController::class,'trasladar'])->name('reparto.trasladar.grupo');
	 Route::put('/formulario/reparto/rechazar/{id}', [OficinaJudicialRepartoController::class,'Rechazar'])->name('reparto.rechazar.demanda');
	 
	 //FICAH DE REMISION
	 Route::get('/ficha/remision',              [OficinaJudicialRepartoController::class,'ficha_Remision'])->name('reparto.ficha.remisiones');
	 Route::get('/ficha/remision/historico',              [OficinaJudicialRepartoController::class,'historico'])->name('reparto.ficha.remisiones.historico');
	 Route::get('/ficha/remision/descarga/{id}',              [OficinaJudicialRepartoController::class,'generarFicha'])->name('reparto.ficha.remision.descarga');
	 Route::get('/ficha/remision/responder/{id}',              [OficinaJudicialRepartoController::class,'responderFicha'])->name('reparto.responder.remision');
	 Route::put('/ficha/remision/cerrar/{id}',              [OficinaJudicialRepartoController::class,'fichaUpdate'])->name('reparto.update.respuesta.ficha'); 
	 
	
	
});

//PERFIL REPORTE DE INCIDENTES
Route::group(['prefix' => 'mantenimiento/reporte/incidentes'], function(){
	Route::get('/',              [ReporteIncidenteController::class,'index'])->name('incidentes.index'); 
	Route::get('/cerrados',              [ReporteIncidenteController::class,'cerrados'])->name('incidentes.cerrados'); 
	Route::get('revision/',[ReporteIncidenteController::class,'Revision'])->name('incidentes.revision'); 	
	//Route::get('/consulta/detalles/reporte/{codigo}',[ReporteIncidenteController::class,'Revision'])->name('reporte.incidente');
	Route::get('detalles/reporte/{id}',[ReporteIncidenteController::class,'Revision'])->name('reporte.incidente');
	Route::post('save/revision/incidente/update', [ReporteIncidenteController::class,'store'])->name('reporte.incidente.update.save');
    Route::post('cerrar/revision/incidente/', [ReporteIncidenteController::class,'cerrar'])->name('reporte.incidente.cerrar');
	Route::delete('revision/incidente/delete/{id}',  [ReporteIncidenteController::class,'reporteIncidentedelete'])->name('delete.incidente');
	
	//NUEVO MODULO DE MANTENIMIENTO
	Route::get('/solicitudes',              [ReporteIncidenteController::class,'Solicitudes'])->name('reporte.incidentes.solicitudes'); 
	Route::get('/solicitudes/view/{id}',              [ReporteIncidenteController::class,'ver'])->name('reporte.incidentes.solicitudes.edit'); 
	Route::put('/solicitudes/store/{id}',              [ReporteIncidenteController::class,'guardar'])->name('reporte.incidentes.solicitudes.put'); 
	Route::get('/solicitudes/soltar/{id}',              [ReporteIncidenteController::class,'soltar'])->name('reporte.incidentes.solicitudes.soltar');
	
	//Buscar Requerimietnos de Categoria
	Route::get('/categories/elements/{id}', [ReporteIncidenteController::class, 'ElementosMantenimietno'])->name('usuario.reportar.incidente.elements');
	
	//Abrir Requerimietno por Mantenimiento
	Route::get('crear/solicitud',[ReporteIncidenteController::class,'CrearSolicitud'])->name('reporte.incidente.crear');
	Route::post('save/revision/incidente/', [ReporteIncidenteController::class,'SaveSolicitud'])->name('reporte.incidente.save');
	
    Route::get('reporte/categories/elements/{id}', [ReporteIncidenteController::class, 'ElementosMantenimietno'])->name('mantenimiento.reportar.incidente.elements');

    Route::get('reporte/incidente/select/{id}',[ReporteIncidenteController::class,'reporteIncidenteSelect'])->name('mantenimiento.reportar.incidente.select');
    //CONSULTAR INCIDENTE
    Route::get('/consulta/detalles/reporte/{codigo}',[ReporteIncidenteController::class,'Revision'])->name('mantenimiento.consulta.reporte.incidente');
    
    //ENCUESTA MATENIMIETNO
    Route::get('/modulo/estadisticas-encuestas',[EncuestaController::class, 'estadisticasMantenimiento'])->name('mantenimiento.encuestas.estadisticas.ver')->middleware(Authenticate::class);
    Route::get('/ajax/estadisticas-encuestas', [EncuestaController::class, 'ajaxEstadisticas'])->name('mantenimiento.encuestas.estadisticas.ajax')->middleware(Authenticate::class);
	//VER RESULTADO DE ENCUESTA DE CASO CERRADO
	Route::get('/ajax/encuesta/{consecutivo}', [EncuestaController::class, 'ajaxEncuesta'])->name('ajax.encuesta')->middleware(Authenticate::class);

	
});

//REPORTES SARA DE MANTENIMIENTO

Route::group(['prefix' => 'reporte/incidentes/operario'], function(){
	Route::get('/',              [OperarioController::class,'index'])->name('operario.index'); 
	Route::get('/consulta/detalles/reporte/{codigo}',[OperarioController::class,'Revision'])->name('operario.reporte.incidente');
	Route::get('/cerrados',              [OperarioController::class,'Ver'])->name('operario.index.cerrado'); 
	Route::get('/pedir-elementos/{reporteIncidente}',              [OperarioController::class,'pedirElementos'])->name('operario.pedir.elementos'); 
	Route::POST('/solicitar-elementos/',              [OperarioController::class,'SolicitarAlmacen'])->name('operario.solicitar.elementos'); 
	Route::POST('/solicitar-elementos/enviar',              [OperarioController::class,'EnviarAlmacen'])->name('operario.solicitar.elementos.enviar'); 
	Route::DELETE('delete/reporte/{id}',[OperarioController::class,'destroy'])->name('reporte.incidente.destroy'); 
	Route::post('save/revision/incidente/', [OperarioController::class,'store'])->name('operario.reporte.incidente.save');
	Route::post('comentar/revision/incidente/', [OperarioController::class,'comentar'])->name('operario.reporte.incidente.comentar');
});

//FICHAS ADMINISTRADOR FichaAdminController
Route::group(['prefix' => '/administracion/solicitud/fichas'], function(){
	Route::get('/',              [FichaAdminController::class,'index'])->name('adminfichas.index'); 
	Route::get('/consulta/solicitud/{solicitud}',[FichaAdminController::class,'solicitud'])->name('adminfichas.reporte.solicitud');
	Route::put('/save/solicitud/{solicitud}',[FichaAdminController::class,'remitirSolicitud'])->name('adminfichas.reporte.remitirSolicitud');
	Route::get('/historicos',              [FichaAdminController::class,'historicos'])->name('adminfichas.historico.cerrado'); 
	Route::post('cambiar/tipo/', [FichaAdminController::class,'cambiarTipo'])->name('adminfichas.cambiar.tipo');
	
	Route::get('/mis/registros', [FichaAdminController::class,'misRegistros'])->name('adminfichas.misRegistros');
	
	//DESPACHO TURNO NOTIFICACION NOCHE
	Route::get('/despacho/disponible',              [FichaAdminController::class,'despachoDisponible'])->name('adminfichas.despacho.disponible'); 
	Route::post('/despachos/activar/', [FichaAdminController::class, 'activar'])->name('despachos.activar');
	Route::get('/despachos/inactivar', [FichaAdminController::class, 'inactivar'])->name('despachos.inactivar');
});



//PERFIL DE SERVISOFT
Route::group(['prefix' => 'servisoft'], function(){
  
    Route::get('/',              [ServisoftController::class,'Revisado'])->name('novedades.servisoft');   
   //SEGUNDA REVISION
   Route::put('supervisor/servisoft/{id}',[ServisoftController::class,'RevisionSevisoft'])->name('revision.supervisor.servisoft');
   
    //resultado registro inventario
   Route::get('registro/inventario',[ServisoftController::class,'registroInventario'])->name('servisoft.registroInventario');
   Route::get('registro/inventario/descarga',[ServisoftController::class,'DescargarInvetarioD'])->name('servisoft.registroInventario.descarga');
   
   //PROTOCOLO DOS
   Route::get('/protocolo/dos',              [ServisoftController::class,'RevisadoPDos'])->name('novedades.servisoft.prot.dos');   
   //SEGUNDA REVISION
   Route::put('supervisor/protocolo/dos/{id}',[ServisoftController::class,'RevisionSevisoftPDos'])->name('revision.supervisor.prot.dos');
   
    //resultado registro inventario
  /* Route::get('registro/inventario/protocolo/dos/','ServisoftController@registroInventario')->name('servisoft.registroInventario.prot.dos');
   Route::get('registro/inventario/descarga/protocolo/dos/','ServisoftController@DescargarInvetarioD')->name('servisoft.registroInventario.descarga.prot.dos');
*/
    //REgistros de incidentes mercurio
    
  Route::get('/registro/incidentes/bestdoc', [RegistroIncidentesMercurioController::class,'indexServisoft'])->name('servisoft.registro.incidentes');
  Route::put('/registro/incidentes/bestdoc/update/{id}', [RegistroIncidentesMercurioController::class,'storeServisoft'])->name('servisoft.update.incidentes');
  
     //RUTA PARA EL REGISTRO DE TRASLADO A BESTDOC   ->middleware(DigitalizacionMiddleware::class);
   
   Route::get('bestdoc',              [BestDocController::class,'revision_index'])->name('supervisor.bestdco.inicio'); 
   Route::get('bestdoc/asignar/{id}',[BestDocController::class,'Asignar_revision'])->name('supervisor.bestdco.asignar.registro');
   Route::get('bestdoc/registro/{id}',[BestDocController::class,'Registro_revision'])->name('supervisor.bestdco.registro');
   
   



    
});

Route::get('/', function(){
	return Redirect::to('index'); 
});


//pagina princiapla de SIRIS

Route::get('/',[PrincipalController::class,'index'])->name('index');

//PAGINA PRINCIPAL DE BIENESTAR CON BANNER 
Route::get('/bienestar',[PrincipalController::class,'indexBienestar'])->name('indexBienestar');
Route::get('/banner/check-update', [PrincipalController::class, 'checkUpdate'])->name('banner.check-update');


//clasificados
Route::get('/clasificados',              [CompraVentaController::class,'clasificados']);
//eliminacion
Route::get('/clasificados/quitar/antiguas', [CompraVentaController::class,'edit'])->name('usuario.clasificados.quitar');

//rutas por fuera de perfiles en la principal
Route::get('mision',              [PrincipalController::class,'mision']);
Route::get('vision',              [PrincipalController::class,'vision']);
Route::get('directorio',          [PrincipalController::class,'directorio']);
Route::get('contactenos',         [PrincipalController::class,'contactenos']);
Route::get('legal',               [PrincipalController::class,'legal']);
Route::get('comite_genero',       [PrincipalController::class,'comite_genero']);

Route::get('seguridad_y_salud_en_el_trabajo',       [PrincipalController::class,'seguridad_st'])->name('seguridad.st.index');

Route::get('comite_genero_galeria',   [PrincipalController::class,'comite_genero_galeria']);
Route::get('programacion_audiencias', [PrincipalController::class,'programacion_audiencias'])->name('programacion_audiencias');
Route::get('programacion_torre_a',    [PrincipalController::class,'programacion_torre_a'])->name('programacion_torre_a');
Route::get('programacion_torre_b',    [PrincipalController::class,'programacion_torre_b'])->name('programacion_torre_b');
Route::get('buscar_audiencias',       [PrincipalController::class,'buscar_audiencias']);

Route::post('contacto', [ContactoController::class,'contacto'])->name('contactame');


//PEQTCIONES QUEJAS Y RCLAMOS

Route::get('/pqrsdf', [ContactoController::class, 'create'])
    ->name('pqrsdf.create');

Route::post('/pqrsdf/enviar', [ContactoController::class, 'storePqrsdf'])
    ->name('pqrsdf.store');


Route::get('login', [LoginController::class,'showLoginForm'])->name('login');
Route::post('login', [LoginController::class,'login']);
Route::post('logout', [LoginController::class,'logout'])->name('logout');
Route::get('logout', [LoginController::class,'logout']);
//Route::get('logout',["as" => "logout", "uses" => "Auth\LoginController@logout"]);
Route::get('/logout-redirect', function () {
     auth()->logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login')->with('message', 'Tu sesión ha expirado por inactividad.');
})->name('logout.redirect');

//RESET PASSWORD

// Password Reset Routes...
Route::get('password/reset',         [ForgotPasswordController::class,'showLinkRequestForm'])->name('password.request');
Route::post('password/email',        [ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class,'showResetForm'])->name('password.reset');
Route::post('password/reset',        [ResetPasswordController::class,'reset']);

//

//BACKUP DB COMPLETO CADA HORA
Route::get('db/backup/completo',              [PrincipalController::class,'BkDatabases']);



Route::group(['prefix' => 'estadistica'], function(){
   
   Route::get('/', [EstadisticaDigitalizacionController::class,'index'])->name('estadistica'); 
    
});
 


Route::group(['prefix' => 'administrador'], function(){
    
    //descargar backup de la db
    Route::get('/descargar/db/de/froma/manual',	[AdministradorController::class,'descargarArchivo']);
	
    Route::resource('/',	AdministradorController::class)->names( 'administrador');

	Route::get('/home', [HomeController::class,'index'])->name('home');

	Route::resource('rol',	RolController::class);

	Route::resource('user',	UserController::class);

	Route::resource('ciudad',	CiudadController::class);

	Route::resource('empleados',	EmpleadosController::class);
    Route::post('empleados/{id}/reset-device', [EmpleadosController::class, 'resetDevice'])->name('empleados.reset_device');

	Route::resource('requerimientos',	TipoRequerimientoController::class);

	Route::resource('categorias',	CategoriaController::class);

	Route::resource('elementos',	ElementoController::class);

	Route::resource('inventarios',	InventarioController::class);

	Route::put('despachos/update/{id}', [DespachoController::class,'update'])->name('despachos.update');

	Route::get('despachos/export', [DespachoController::class, 'export'])->name('despachos.export');

	Route::resource('despachos',	DespachoController::class);

	Route::resource('seccionales',	SeccionalesController::class);

	Route::get('formulario/{id}/solicitud',	[AdministradorController::class,'formulario'])->name('formulario');

	Route::put('update/{id}', [AdministradorController::class,'update'])->name('administrador.update');
	Route::get('show', [AdministradorController::class,'show'])->name('administrador/show');
	Route::get('{id}/edit', [AdministradorController::class,'edit'])->name('administrador/edit');


	Route::resource('tiempoAtencion',     TiempoAtencionController::class);


    //ivan->RESET PASSWOD DE USUARIO Y ENVIO DE CREDENCIALES
    Route::get('user/reset/password/{id}',[UserController::class,'ResetContrasenha'])->name('admin.reset.password');

	//freddy
	Route::resource('institucional',      InstitucionalController::class);

	Route::resource('directorio',         DirectorioController::class);

	Route::resource('banner',             BannerController::class);
	
	//BANNER BIENESTAR
	Route::get('banner/bienestar/index',   [BannerController::class,'Bienestar'])->name('baner.bienestar');
	Route::post('banner/bienestar',   [BannerController::class,'storeBienestar'])->name('baner.bienestar.store');
	
	
	//BANER COE
	Route::get('banner/coe/index',   [CoeController::class,'Coe'])->name('baner.coe');
	Route::post('banner/coe',   [CoeController::class,'storeCoe'])->name('baner.coe.store');

	Route::resource('noticias',           NoticiasController::class);

	Route::resource('especial',           EspecialController::class);

	Route::resource('historial',          HistorialSolicitudesController::class);

	Route::get('excel',                   [HistorialSolicitudesController::class,'excel']);
	
	Route::get('excelfiltro',             [HistorialSolicitudesController::class,'excelfiltro'])->name('excelfiltro');
	Route::get('excelrequerimientos',     [HistorialSolicitudesController::class,'excelrequerimientos'])->name('excelrequerimientos');
	Route::get('excelsolicitados',        [HistorialSolicitudesController::class,'excelsolicitados'])->name('excelsolicitados');
	
	//directorio siris Excel
	Route::get('excel/directorio/siris',                   [HistorialSolicitudesController::class,'excelDirectorio'])->name('directorio.siris');
	
	//descarga de excel de empleados despacho actualizados
	Route::get('certificado/empleados/confirmados',[HistorialSolicitudesController::class,'certificadoempleados'])->name('empleados.despacho.activos');

    //documento seguridad y salud en el trabajo
	Route::get('sst-documentos',              [SstController::class,'index'])->name('sst-documentos');
	Route::get('sst-create-documentos',       [SstController::class,'create'])->name('sst-create-documentos');
	Route::post('sst-store-documentos',       [SstController::class,'store'])->name('sst-store-documentos');
	Route::get('sst-edit-documentos/{id}',    [SstController::class,'edit'])->name('sst-edit-documentos');
	Route::put('sst-update-documentos/{id}',  [SstController::class,'update'])->name('sst-update-documentos');
	Route::delete('sst-delete-documento/{id}',[SstController::class,'destroy'])->name('sst-delete-documento');

	//nuevas siris fredy
	//documento comite genero
	Route::get('genero-documentos',       [ComiteGeneroController::class,'indexDocumentoGenero'])->name('genero-documentos');
	Route::get('create-documentos',       [ComiteGeneroController::class,'createDocumentoGenero'])->name('create-documentos');
	Route::post('store-documentos',       [ComiteGeneroController::class,'storeDocumentoGenero'])->name('store-documentos');
	Route::get('edit-documentos/{id}',    [ComiteGeneroController::class,'editDocumentoGenero'])->name('edit-documentos');
	Route::put('update-documentos/{id}',  [ComiteGeneroController::class,'updateDocumentoGenero'])->name('update-documentos');
	Route::delete('delete-documento/{id}',[ComiteGeneroController::class,'destroyDocumentoGenero'])->name('delete-documento');
	//galeria comite genero
	Route::get('genero-galeria',          [ComiteGeneroController::class,'indexComiteGaleria'])->name('genero-galeria');
	Route::get('create-galeria',          [ComiteGeneroController::class,'createComiteGaleria'])->name('create-galeria');
	Route::post('store-galeria',          [ComiteGeneroController::class,'storeComiteGaleria'])->name('store-galeria');
	Route::get('edit-galeria/{id}',       [ComiteGeneroController::class,'editComiteGaleria'])->name('edit-galeria');
	Route::put('update-galeria/{id}',     [ComiteGeneroController::class,'updateComiteGaleria'])->name('update-galeria');
	Route::delete('delete-galeria/{id}',  [ComiteGeneroController::class,'destroyComiteGaleria'])->name('delete-galeria');
	//enlacnes comite de genero
	Route::get('genero-enlaces',          [ComiteGeneroController::class,'indexComiteGeneroEnlaces'])->name('genero-enlaces');
	Route::get('create-enlaces',          [ComiteGeneroController::class,'createComiteGeneroEnlaces'])->name('create-enlaces');
	Route::post('store-enlaces',          [ComiteGeneroController::class,'storeComiteGeneroEnlaces'])->name('store-enlaces');
	Route::get('edit-enlaces/{id}',       [ComiteGeneroController::class,'editComiteGeneroEnlaces'])->name('edit-enlaces');
	Route::put('update-enlaces/{id}',     [ComiteGeneroController::class,'updateComiteGeneroEnlaces'])->name('update-enlaces');
	Route::delete('delete-enlaces/{id}',  [ComiteGeneroController::class,'destroyComiteGeneroEnlaces'])->name('delete-enlaces');

	//nuevas freddy dic 2019
	Route::get('torres-juzgados',         [DistribucionController::class,'torresJuzgados'])->name('torres-juzgados');
	Route::post('torres-store',           [DistribucionController::class,'torresStore'])->name('torres-store');
	Route::get('torres-edit/{id}',        [DistribucionController::class,'torresEdit'])->name('torres-edit');
	Route::put('torres-update/{id}',      [DistribucionController::class,'torresUpdate'])->name('torres-update');
	Route::delete('torres-delete/{id}',   [DistribucionController::class,'torresDelete'])->name('torres-delete');

	Route::get('pisos-juzgados',         [DistribucionController::class,'pisosJuzgados'])->name('pisos-juzgados');
	Route::post('pisos-store',           [DistribucionController::class,'pisosStore'])->name('pisos-store');
	Route::get('pisos-edit/{id}',        [DistribucionController::class,'pisosEdit'])->name('pisos-edit');
	Route::put('pisos-update/{id}',      [DistribucionController::class,'pisosUpdate'])->name('pisos-update');
	Route::delete('pisos-delete/{id}',   [DistribucionController::class,'pisosDelete'])->name('pisos-delete');

	Route::get('salas-juzgados',         [DistribucionController::class,'salasJuzgados'])->name('salas-juzgados');
	Route::post('salas-store',           [DistribucionController::class,'salasStore'])->name('salas-store');
	Route::get('salas-edit/{id}',        [DistribucionController::class,'salasEdit'])->name('salas-edit');
	Route::put('salas-update/{id}',      [DistribucionController::class,'salasUpdate'])->name('salas-update');
	Route::delete('salas-delete/{id}',   [DistribucionController::class,'salasDelete'])->name('salas-delete');

	Route::get('reservas-juzgados',         [ReservaSalasController::class,'reservasJuzgados'])->name('administrador.eservas-juzgados');
	Route::get('registrar-reserva',         [ReservaSalasController::class,'registrarReserva'])->name('administrador.registrar-reserva');
	Route::post('reservas-store',           [ReservaSalasController::class,'reservasStore'])->name('administrador.reservas-store');
	
	Route::get('reservas-edit/{id}',        [ReservaSalasController::class,'reservasEdit'])->name('administrador.reservas-edit');
	
	Route::put('reservas-update/{id}',      [ReservaSalasController::class,'reservasUpdate'])->name('administrador.reservas-update');
	Route::delete('reservas-delete/{id}',   [ReservaSalasController::class,'reservasDelete'])->name('administrador.reservas-delete');

	//crear un select normal que permita a los usuarios ingresar y redireccione a la vista que se necesita
	Route::get('reserva-sala',               [ReservaSalasController::class,'fullcalendar'])->name('administrador.reserva-sala');
	Route::get('getreservas/{id}',           [ReservaSalasController::class,'getreservas'])->name('administrador.getreservas');
	Route::post('getreservadestroy',         [ReservaSalasController::class,'eliminar'])->name('administrador.getreservadestroy');
	

  
//Ruta para subir despachos con excel
	Route::get('store/despachos',[ExcelDespachoController::class,'index']);
	Route::post('store/save/despachos',[ExcelDespachoController::class,'store'])->name('save.excel');
	
//Ruta para subir y actualizar despachos con excel
	Route::get('store/actualizar/despachos',[ExcelActualizarDirectorioController::class,'index']);
	Route::post('store/save/actualizacion/despachos',[ExcelActualizarDirectorioController::class,'store'])->name('save.excel.actualizacion.despachos');

//Ruta para subir despachos con excel
	Route::get('store/solcitud/audiencia',[ExcelSolicitudVirtualController::class,'index']);
	Route::post('store/save/solicitud/audiencia',[ExcelSolicitudVirtualController::class,'store'])->name('save.excel');
	
//Ruta para subir empleados con excel
	Route::get('store/empleados',[ExcelEmpleadosController::class,'index'])->name('emppleados.excel');
	Route::post('store/save/empleados',[ExcelEmpleadosController::class,'store'])->name('save.excel');
	
//Ruta para subir y actualizar segumiento digitalizacion con excel
	Route::get('store/almacenar/registro/digitalizacion',[DigitalizacionExcelController::class,'index'])->name('digitalizacion.cargue');
	Route::post('store/save/almacenar/registro/digitalizacion',[DigitalizacionExcelController::class,'store'])->name('save.excel.registro.digitalizacion');
	
//Ruta para subir empleados para ingreso al palacio
	Route::get('store/empleados/activos',[ExcelContratosActivosController::class,'index'])->name('emppleados.activos.excel');
	Route::post('store/save/empleados/activos',[ExcelContratosActivosController::class,'store'])->name('save.activos.excel');
	
//Ruta para asiganar espacio de parqueadero
	Route::get('cargar/excel/parqueadero',[ExcelParqueaderoController::class,'index'])->name('parqueadero.excel.index');
	Route::post('store/asignacion/parqueadero',[ExcelParqueaderoController::class,'store'])->name('save.excel.parqueadero');
	
//Ruta para caragar estriccion de salud
	Route::get('cargar/excel/restriccion/salud',[ExcelRestriccionSaludController::class,'index'])->name('restriccion.salud.excel.index');
	Route::post('store/asignacion/parqueadero/restriccion/salud',[ExcelRestriccionSaludController::class,'store'])->name('save.excel.restriccion.salud');
	
//Ruta para caragar FACTURAS CUMPLIDO
	Route::get('cargar/excel/factura/cumplido',[FacturaCumplidoController::class,'index'])->name('factura.cumplido.excel.index');
	Route::post('store/factura/cumplido',[FacturaCumplidoController::class,'store'])->name('save.excel.factura.cumplido');
	
	Route::get('descargar/excel/factura/cumplido',[FacturaCumplidoController::class,'FacturaCumplimiento'])->name('factura.cumplido.descargar');
	

//Rusas ocultas para modificar despacho
	Route::get('update/despachos',[UpdateDespachosController::class,'index']);
	Route::post('update/update/despachos',[UpdateDespachosController::class,'store'])->name('update.despachos.excel');
	
//Rusas ocultas para modificar user
    Route::get('update/user',[UpdateUserController::class,'index']);
	Route::post('update/update/user',[UpdateUserController::class,'store'])->name('update.users.excel');
	
	//Excel cambiar codigo despachos
    Route::get('update/codigo/despacho',[CambioCodigoDespachoController::class,'index'])->name('index.codigo.despacho.excel');
    Route::post('/actualizar-codigos', [CambioCodigoDespachoController::class, 'actualizarCodigosDesdeExcel'])->name('update.codigo.despacho.excel');


	
	
//CONSULTA DE SOLICITUD DE AUDIENCIAS
    Route::get('/solicitudes/audiencias', 			[AudienciasAdminController::class,'audiencias'])->name('administrador.audiencias');
    //busqueda por parametros
	Route::get('/solicitudes/audiencias/result', 			[AudienciasAdminController::class,'audiencias'])->name('administrador.audiencias.resultado');
	//editar audiencias solicitdas
	Route::get('/solicitudes/audiencias/editar/{id}', 			[AudienciasAdminController::class,'audienciasEditar'])->name('administrador.audiencias.editar');
	
	
//ESTADISTICA
    Route::get('/estadisticas',[AdministradorController::class,'estadistica'])->name('administrador.estadistica');
//RUTA FILTRO AGENDADORES
    Route::get('/estadisticas/agendadores',[AdministradorController::class,'estadistica'])->name('administrador.estadistica.agendadores');
//RUTA FILTO DESPACHO
    Route::get('/estadisticas/despachos',[AdministradorController::class,'estadistica'])->name('administrador.estadistica.despachos');
    
//RUTA PARA ACTUALIZAR LAS AUDIENCIAS DESDE ADMINISTRADOR actualizarAudiencia

    Route::put('/actualizar/audiencia/{id}',[AudienciasAdminController::class,'actualizarAudiencia'])->name('administrador.actualizar.audiencia');
    
//FORMULARIO DE PROCESO DIGITALIZACION DE EXPEDIENTES
Route::get('resultado/digitalizacion/expedientes/2020',[AdministradorController::class,'resultadoEncuesta'])->name('administrador.resultado.encuesta');

//INVENTARIO DE PROCESOS A DIGITALIZAR
Route::get('inventario/digitalizacion/expedientes/',[AdministradorController::class,'inventarioDigitalizacion'])->name('administrador.inventario.digitalizacion');
Route::get('registro/inventario/descarga',[AdministradorController::class,'DescargarInvetarioD'])->name('administrador.registroInventario.descarga');

//estadstica de los que se lleva en el proceso de digitalizacion


 Route::get('/estadistica/digitalizacion', [EstadisticaDigitalizacionController::class,'index'])->name('administrador.estadistica.digitalizacion');
 Route::put('/estadistica/digitalizacion/{id}', [EstadisticaDigitalizacionController::class,'actualizar'])->name('administrador.estadistica.update');
 
 //registro vacunacion   RegistroVacunacion
Route::get('registro/vacunacion',[AdministradorController::class,'RegistroVacunacion'])->name('administrador.vacunacion');
Route::delete('eliminar/registro/vacunacion/{id}',[AdministradorController::class,'ElimiRegistroVacunacion'])->name('administrador.eliminar.vacunacion');

//registro JORNADA DE SALUD
Route::get('registro/jornada/salud',[AdministradorController::class,'RegistroJornadaSalud'])->name('administrador.jornada.salud');


//encuesta vacunacion   ResultadoEncuesta

Route::get('encuesta/esquema/vacunacion',[AdministradorController::class,'ResultadoEsquemaVacunacion'])->name('administrador.encuesta.esquema.vacunacion');

//OBSERVACIONES DE SERVISOFT EN PROTOCOLO 2  $digitalizado
Route::get('observaciones/protocolo/dos',[DigitalizacionExcelController::class,'ObservacionesProtoDos'])->name('administrador.observaciones.protodos');

//ESTAN OK DE SERVISOFT EN PROTOCOLO 2  $digitalizado
Route::get('revisados/protocolo/dos/ok',[DigitalizacionExcelController::class,'RevisadosProtoDos'])->name('administrador.ok.revisados.protodos');


//REGISTROS DE IP DE LOS EQUIPOS D ELA RAMA

     Route::get('/listado/ips', [RegistroIpController::class,'listado'])->name('administrador.soporte.listado');
     Route::post('/almacenar/registro', [RegistroIpController::class,'registro_store'])->name('administrador.soporte.registro_ip.save');
      
     Route::get('/registrar/ip/{id}', [RegistroIpController::class,'editar_registro_ip'])->name('administrador.soporte.editar.registro.ip');
     Route::put('/registrar/ip/{id}', [RegistroIpController::class,'put_registro_ip'])->name('administrador.soporte.editar.ip.edit');
     
     
//RESULTADO DE REGISTRO DE EVENTOS 
 Route::get('/listado/registro/evento', [EventoIntegracionController::class,'index'])->name('administrador.listado.eventos');

 //REGISTRO DE INCIDENTES  RevisadoPDos
 //Route::get('/registro/incidentes/bestdoc', [RegistroIncidentesMercurioController::class,'index'])->name('administrador.registro.incidentes');
 
 
 Route::get('/registro/incidentes/bestdoc', [RegistroIncidentesMercurioController::class,'RevisadoPDos'])->name('administrador.registro.incidentes');
 
 Route::get('/registro/incidentes/bestdoc/corregido', [RegistroIncidentesMercurioController::class,'RevisadoPDosCorregido'])->name('administrador.corregido.incidentes');
 
 Route::post('/registro/incidentes/bestdoc/save', [RegistroIncidentesMercurioController::class,'store'])->name('administrador.save.incidentes');
 
 //SOLICITUDES DE USUARIOS
	Route::get('registro/solicitud/usuarios',[AdministradorSolicitudUsuarios::class,'index'])->name('administrador.registro.solicitud');	
	Route::get('registro/solucion/usuarios/{id}',[AdministradorSolicitudUsuarios::class,'edit'])->name('administrador.registro.solicitud.edit');
	Route::get('registro/solucion/usuarios/soltar/{id}',[AdministradorSolicitudUsuarios::class,'soltar'])->name('administrador.registro.solicitud.soltar');	
	
	//CONSULTA CEDULA
      Route::get('/consulta/cedula/corte/{cedula}', [AdministradorSolicitudUsuarios::class,'consultaCedulaE'])->name('conculta.cedula.emple');
	
	
	Route::post('registro/solicitud/usuarios/store/',[AdministradorSolicitudUsuarios::class,'registrar'])->name('administrador.registrar.solicitud.usuario');
	
	Route::put('registro/solucion/usuarios/store/{id}',[AdministradorSolicitudUsuarios::class,'resolver'])->name('administrador.registro.solicitud.resolver');
	Route::get('registro/solicitud/usuarios/resueltas',[AdministradorSolicitudUsuarios::class,'resueltas'])->name('administrador.registro.solicitud.resueltas');
	
	Route::get('registro/solicitud/usuarios/estadistica',[AdministradorSolicitudUsuarios::class,'estadistica'])->name('administrador.registro.solicitud.estadistica');
	
	//CARGA DE EXCEL CON LO QUE HAY Q MIGRAR A BESTDOC
	Route::get('carga/excel/migracion/bestdoc',[BestDocController::class,'index'])->name('administrador.carga.excel.bestdoc');
	Route::post('save/excel/migracion/bestdoc',[BestDocController::class,'store'])->name('administrador.save.excel.bestdoc');
	
	//CARGA DE EXCEL CON INFROMACION TELETRABAJO
	Route::get('carga/excel/teletrabajo/',[Teletrabajo2024Controller::class,'index'])->name('administrador.carga.excel.teletrabajo.2024');
	Route::post('save/excel/teletrabajo/2024',[Teletrabajo2024Controller::class,'store'])->name('administrador.save.excel.teletrabajo.2024');
	
	//CARGA DE EXCEL CON LO QUE HAY Q MIGRAR A BESTDOC
	Route::get('/carga/excel/estado/archivo',[BestDocController::class,'index_archivo'])->name('administrador.carga.excel.estado.archivo');
	Route::post('/save/excel/estado/archivo',[BestDocController::class,'store_archivo'])->name('administrador.save.excel.estado.archivo');
	
	
	//verificar SOLICITUDES DE TRABAJO REMOTO
	 Route::get('solicitud/trabajo/remoto',[SolicitudController::class,'index'])->name('admin.solicitud.trabajo.remoto');
	 Route::get('solicitud/trabajo/remoto/concepto/arl/{id}',[SolicitudController::class,'conceptoArl'])->name('admin.solicitud.trabajo.remoto.concepto');
	 Route::put('solicitud/trabajo/save/concepto/arl/{id}',[SolicitudController::class,'saveConceptoArl'])->name('admin.save.trabajo.remoto.concepto');
	 
	 Route::get('solicitud/trabajoremoto/concepto/arl/{id}',[SolicitudController::class,'nuevoConceptoArl'])->name('admin.trabajo.remoto.nuevoconcepto');
	 Route::put('solicitud/trabajosave/concepto/arl/{id}',[SolicitudController::class,'RecargaConceptoArl'])->name('admin.recarga.trabajo.remoto.concepto');
	 
	 //HISTORICO
	 Route::get('solicitud/historico/teletrabajo',[SolicitudController::class,'historico'])->name('admin.solicitud.trabajo.historicoremoto');
	 
     Route::get('solicitud/definir/solicitud/trabajo/remoto/{id}',[SolicitudController::class,'definirSolicitud'])->name('admin.definir.trabajo.remoto');
     Route::put('solicitud/definir/trabajo/remoto/{id}',[SolicitudController::class,'definirEstadoSolicitud'])->name('admin.definir.solicitud.trabajo.remoto');
     
     //APROBAR Y RECHAZAR FORMATO TELETRABAJO
     Route::get('definir/estado/solicitud/teletrabajo/{id}',[SolicitudController::class,'definirEstado'])->name('admin.definir.estado.teletrabajo');
     Route::put('solicitud/definir/trabajo/remoto/{id}',[SolicitudController::class,'SaveEstadoSolicitud'])->name('admin.save.estado.teletrabajo');
     Route::get('solicitud/aprobar/remoto/{id}',[SolicitudController::class,'SaveAprobarSolicitud'])->name('admin.save.aprobar.formatos');
     
     Route::get('solicitud/correo/remoto/{id}',[SolicitudController::class,'ReenviarCorreo'])->name('admin.correo.aprobar.formatos');
     
    //SUBIR TELETRABAJO MANUAL 
    Route::get('solicitud/manual/teletrabajo',[SolicitudController::class,'SolicitudTrabajo_Remoto'])->name('manual.solicitud.trabajo.remoto');
    Route::post('solicitud/create/manual/remoto',[SolicitudController::class,'SolicitudSave'])->name('manual.save.trabajo.remoto');
    //BOTON ANUENCIA
    Route::put('subir/anuencia/teletrabajo/{id}',[SolicitudController::class,'SubirAnuenciaTrabajoRemoto'])->name('admin.subir.anuencia.teletrabajo.remoto');
    //BOTON SOLICITU
    Route::put('subir/solicitud/teletrabajo/{id}',[SolicitudController::class,'SubirSolicitudTrabajoRemoto'])->name('admin.subir.solicitud.teletrabajo.remoto');
    //BOTON SOLICITU
    Route::put('subir/formalizacion/teletrabajo/{id}',[SolicitudController::class,'SubirFormalizacionTrabajoRemoto'])->name('admin.subir.formalizacion.teletrabajo.remoto');
    //DESISTIMIENTO
    Route::put('subir/desistimiento/teletrabajo/{id}',[SolicitudController::class,'SubirDesistimientoRemoto'])->name('admin.subir.desistimiento.teletrabajo.remoto');
     
    
    //siniestros
    Route::get('siniestros',[SiniestroController::class,'index'])->name('administrador.siniestro');
    Route::get('siniestros/{id}',[SiniestroController::class,'edit'])->name('administrador.siniestro.edit');
    Route::put('siniestros/update/{id}',[SiniestroController::class,'update'])->name('administrador.siniestro.update');
    
    Route::get('siniestros/aprobar/{id}',[SiniestroController::class,'aprobar'])->name('administrador.siniestro.aprobar');
    Route::get('siniestros/denegar/{id}',[SiniestroController::class,'denegar'])->name('administrador.siniestro.denegar');
    
    
	Route::delete('torres-delete/{id}',   [SiniestroController::class,'Delete'])->name('administrador.siniestro.delete');
    
    //REGIONAL CALI DESCARGA REGISTRO
	
    Route::get('listado/registro/regional/cali',[AdministradorSolicitudUsuarios::class,'ListadoRegionCali'])->name('administrador.listado.regional');
    
    //requermientos despachos

    Route::get('/requerimiento/despacho/', [RequerimientoDespachosController::class,'index'])->name('requerimientodespachos.index');
    Route::get('/requerimiento/listado/', [RequerimientoDespachosController::class,'ListadoRequerimientos'])->name('requerimientodespachos.listado.admin');
    Route::get('/requerimiento/listado/descarga', [RequerimientoDespachosController::class,'DescargaListadoRequerimientos'])->name('requerimientodespachos.descarga.admin');
    Route::get('/requerimiento/despacho/create', [RequerimientoDespachosController::class,'create'])->name('requerimientodespachos.create');
    Route::post('/requerimiento/despacho/store', [RequerimientoDespachosController::class,'store'])->name('requerimientodespachos.store');
    //Route::get('/requerimiento/despacho/show', [RequerimientoDespachosController::class,'show'])->name('requerimientodespachos.show');
    //Route::get('/requerimiento/despacho/edit', [RequerimientoDespachosController::class,'edit'])->name('requerimientodespachos.edit');
    //Route::put('/requerimiento/despacho/update', [RequerimientoDespachosController::class,'update'])->name('requerimientodespachos.update');
    Route::delete('/requerimiento/despacho/destroy/{id}', [RequerimientoDespachosController::class,'destroy'])->name('requerimientodespachos.destroy');
    
    
    
    //REGISTRO DE TANQUEO
    Route::get('/tanqueo', [TanqueoVehiculoController::class,'index'])->name('index.tanqueo.admin');
    Route::get('/registro/tanqueo', [TanqueoVehiculoController::class,'create'])->name('regsitro.tanqueo.admin');
    Route::get('/registro/vehiculo/{id}', [TanqueoVehiculoController::class,'show'])->name('regsitro.vehiculo.show.admin');
    Route::post('/registro/tanqueo/save', [TanqueoVehiculoController::class,'save'])->name('save.registro.tanqueo.admin');
    //consulta cedula conductor
    Route::get('/consulta/conductor/{id}', [TanqueoVehiculoController::class,'consultaCedulaE'])->name('regsitro.vehiculo.conductor');
    Route::get('/descarga/registro', [TanqueoVehiculoController::class,'Export'])->name('regsitro.vehiculo.export');
	
	//comodato impresoras
	Route::get('consulta/comodato/impresora/',[ComodatoImpresoraController::class,'listado'])->name('admin.show.comodato.impresora');
	
	//teletrabajo revision de registros seguimientoPresencialidad
	Route::get('consulta/teletrabajo/registro/',[SolicitudController::class,'seguimientoTeletrabajo'])->name('admin.consulta.teletrabajo.registro');
	Route::get('solicitudes/teletrabajo/registro/',[SolicitudController::class,'solicitudesTeletrabajo'])->name('admin.solicitudes.teletrabajo.registro');
	Route::get('solicitudes/teletrabajo/registro/excel',[SolicitudController::class,'SeguimientoExcel'])->name('admin.teletrabajo.registro.excel');
	Route::get('solicitudes/teletrabajo/editar/{Teletrabajo2024}',[SolicitudController::class,'EditarTeletrabajo'])->name('admin.teletrabajo.EditarTeletrabajo');
	
	Route::put('solicitudes/teletrabajo/update/{Teletrabajo2024}',[SolicitudController::class,'UpdateTeletrabajo'])->name('admin.teletrabajo.UpdateTeletrabajo');
	
	
	//dia de la familia
	
	Route::get('consulta/asistencia/dia_familia',[EventoIntegracionController::class,'diaFamilia'])->name('admin.consulta.dia.familia');
	Route::put('consulta/asistencia/dia_familia/actualizar/{usuario}',[EventoIntegracionController::class,'diaFamiliaActualizar'])->name('admin.consulta.dia.familia.actualizar');
	
	//Estadistica de uso de URL
	
    Route::get('/estadistica/acortador/', [UrlShortenerController::class, 'Estadistica'])->name('stats.acortadores')->middleware([Authenticate::class, AdministradorMiddleware::class]);
    Route::get('/acortador/stats/{code}', [UrlShortenerController::class, 'showStats'])->name('stats')->middleware([Authenticate::class, AdministradorMiddleware::class]);
    
    //USUARIOS SGDE
    
    Route::get('/listado/usuarios/sgde', [AdministradorSolicitudUsuarios::class, 'indexUsuariosSgde'])->name('listado.usuario.sgde')->middleware([Authenticate::class, AdministradorMiddleware::class]);
    
    //listado de registro de actividades de Contratista
    
     Route::get('/actividades/contratista', [AdministradorController::class, 'ActividadContratista'])->name('admin.activities.index');
     Route::get('/actividades/despachos-dashboard', [AdministradorController::class, 'actividadesDespachos'])->name('actividades.despacho.dashboard');
     
     //Registro de copias de seguridad 
     
     Route::get('/copia-servidores', [CopiaServidorDbController::class, 'index'])->name('copia.index');
     Route::post('/copia-servidores', [CopiaServidorDbController::class, 'store'])->name('copia.store');
     Route::post('/copia-servidores/firmar/{id}', [CopiaServidorDbController::class, 'firmar'])->name('copia.firmar');
     Route::get('/copia/exportar-excel', [CopiaServidorDbController::class, 'exportarExcel'])->name('copia.exportarExcel');
     
     //ESTADISTICA DE SERVICIOS Y SOPORTES
     Route::get('/estadisticas/mesa_ayuda', [EstadisticasController::class, 'index'])->name('estadisticas.index');

    
    //envio de certificaciones de recursos humanos
    Route::get('/admin/enviar-certificacion/form', [CertificacionController::class, 'adminEnviarForm'])
    ->name('admin.enviar.certificacion.form')
    ->middleware([Authenticate::class, AdministradorMiddleware::class]);
    
    Route::post('/admin/enviar-certificacion', [CertificacionController::class, 'adminEnviar'])
    ->name('admin.enviar.certificacion')
    ->middleware([Authenticate::class, AdministradorMiddleware::class]);
    
    
    //supervision contratos
    Route::resource('supervision/contratos', ContratoController::class)->names('contratos.novedades');
    
    Route::put('supervision/contratos/documento/{id}', [ContratoController::class,'Documento'])->name('contratos.novedades.documento.id');
    Route::post('supervision/contratos/novedad', [ContratoController::class,'Novedades'])->name('contratos.novedades.save');
    Route::put('/contratos/{contrato}/seguimiento', [ContratoController::class, 'updateSeguimiento'])->name('contratos.seguimiento.update');
	
	//ESCALAFON ADMINISTRADOR consulta de escalafon
	Route::get('/consulta-escalafon/siris', [EscalafonConsejoController::class, 'form'])->name('admin.consulta.escalafon.form');
    //Route::post('/consulta-escalafon/siris', [EscalafonConsejoController::class, 'buscar'])->name('consulta.escalafon.buscar');
    
    //CERTIFICACION DE ESCALAFON
    Route::get('/certificado/escalafon/descargar/{cedula}', [EscalafonConsejoController::class, 'EnviarCertificacion'])
    ->name('admin.certificacion.escalafon.descargar.url')
    /*->middleware('signed')*/;
    
    // Lector/Validador protegido para personal de portería/monitoreo
    Route::get('/monitoreo/validador-carnets', [\App\Http\Controllers\CarnetController::class, 'validador'])
        ->name('admin.carnet.validador')
        ->middleware(Authenticate::class);
	
	Route::get('/monitoreo/validador-manual', [\App\Http\Controllers\CarnetController::class, 'validadorManual'])
        ->name('admin.carnet.validador_manual')
        ->middleware(\App\Http\Middleware\Authenticate::class);


});


//tecnicos
Route::get('tecnicos/solicitudes', 			[TecnicosController::class,'solicitudes'])->name('tecnicos');
Route::get('tecnicos/solicitudes', 			[TecnicosController::class,'solicitudes'])->name('tecnicos');
Route::put('tecnicos/{id}', 			[TecnicosController::class,'update']);
Route::get('tecnicos/missolicitudes', 			[TecnicosController::class,'missolicitudes']);
Route::get('tecnicos/{id}/atender', 			[TecnicosController::class,'atender'])->name('respuesta');

Route::resource('tecnicos/',	TecnicosController::class)->names('tecnico');

//busqueda de solicitud por asignadas para la fecha actual
Route::get('/tecnicos',[TecnicosController::class,'index'])->name('tecnico.solicitud.porfecha');


//rutas tecnicos para consultar solicitudes de audiencia
Route::get('/tecnicos/cali',[TecnicoAudienciaController::class,'index'])->name('tecnico.solicitud');
Route::get('/tecnicos/mcipios',[TecnicoAudienciaController::class,'mcipios'])->name('tecnico.solicitud.mcipios');



//2020-08-06
//TECNICOS VIRTUAL DE AUDIENCIAS
Route::group(['prefix' => 'tecnico'], function()
{
	Route::get('/solicitud/audiencia/virtual',[TecnicoAudienciaController::class,'index'])->name('tecnico.solicitud');
	Route::get('/solicitud/audiencia/virtual/pendientes',[TecnicoAudienciaController::class,'pendiente'])->name('tecnico.solicitud.pendiente');
	Route::get('/solicitud/audiencia/virtual/pen-4562{id}89568',[TecnicoAudienciaController::class,'show'])->name('tecnico.solicitud.show');
	Route::get('/verificar/estado/pen-4879{id}56932',[TecnicoAudienciaController::class,'verificarEstado'])->name('tecnico.verificar.estado.solicitud');
	
	Route::put('/almacenar/reserva/audiencia/{id}',[TecnicoAudienciaController::class,'almacenar'])->name('tecnico.almacenar.solicitud');
	
	Route::put('/almacenar/reserva/audiencia/municipio/{id}',[TecnicoAudienciaController::class,'almacenarmunicipio'])->name('tecnico.almacenar.solicitud.municipio');
	
	Route::put('/almacenar/reserva/audiencia/todo/{id}',[TecnicoAudienciaController::class,'almacenartodo'])->name('tecnico.almacenar.solicitud.todo');
	
	Route::get('/solicitud/audiencias/totales',[TecnicoAudienciaController::class,'todos'])->name('todas.solicitudes');
	
	//soltar
	Route::put('/verificar/estado/municipio/{id}',[TecnicoAudienciaController::class,'soltarEstadoM'])->name('tecnico.soltar.estado.solicitud.municipio');
	Route::put('/verificar/estado/{id}',[TecnicoAudienciaController::class,'soltarEstado'])->name('tecnico.soltar.estado.solicitud');
	Route::put('/verificar/estado/todo/{id}',[TecnicoAudienciaController::class,'soltarEstadotodo'])->name('tecnico.soltar.estado.solicitud.todo');

    //asignadas por tencio
    Route::get('/solicitudes/agendadas/',[TecnicoAudienciaController::class,'asignadaTecnico'])->name('agendadas.por.tecnico');

    //RUTA PARA ACTUALIZAR LAS AUDIENCIAS DESDE tecnico actualizarAudiencia

    Route::get('/corregir/agendamiento/{id}',[TecnicoAudienciaController::class,'audienciasEditar'])->name('tecnico.corregir.audiencia');
    Route::put('/actualizar/agendamiento/{id}',[TecnicoAudienciaController::class,'actualizarAudiencia'])->name('tecnico.actualizar.audiencia.agendada');

    //RUTA PARA DECARGAR CONSOLIDADO DE SOLICITUD E AUDIENCIAS
    Route::get('/index/solicitud/audiencias',[TecnicoAudienciaController::class,'IndexSolicitudAudiencia'])->name('tecnico.index.solicitud.audiencia');
    Route::get('/consolidado/solicitud/audiencias',[AyudaController::class,'DescargarSolicitudAudiencia'])->name('tecnico.descarga.solicitud.audiencia');

 //EDITAR DATOS DE AUDICVNECIA
 //CONSULTA DE SOLICITUD DE AUDIENCIAS
    Route::get('/solicitudes/audiencias', 			[TecnicoAudienciaController::class,'audienciasBuscar'])->name('tecnico.audiencias.buscar');
    //busqueda por parametros
	Route::get('/solicitudes/audiencias/result', 	[TecnicoAudienciaController::class,'audienciasBuscar'])->name('tecnico.audiencias.buscar.resultado');
	//editar audiencias solicitdas
	Route::get('/tecnico/solicitudes/audiencias/editar/{id}', 			[TecnicoAudienciaController::class,'audienciasCambio'])->name('tecnico.audiencias.buscar.editar');
//RUTA PARA ACTUALIZAR LAS AUDIENCIAS DESDE ADMINISTRADOR actualizarAudiencia

    Route::put('/actualizar/audiencia/{id}',[TecnicoAudienciaController::class,'actualizarAudienciaBuscar'])->name('tecnico.audiencias.actualizar.audiencia');
    
    
     Route::get('/listado/ips', [RegistroIpController::class,'listado'])->name('tecnico.audiencias.listado.ip');
   	

	
});

//TECNICOS VIRTUAL DE AUDIENCIAS
Route::group(['prefix' => 'inpec'], function()
{
	Route::get('/',[InpeController::class,'index'])->name('inpec.index');
	Route::get('/citaciones',[InpeController::class,'citaciones'])->name('inpec.citaciones');
	
});


///usuarios
Route::resource('UsuariosSolicitud/',	SolicitudUsuarioController::class);

Route::get('UsuariosSolicitud/show',	[UsuariosController::class,'soporte'])->name('missolicitudes');

//filtro de index solicitud de audiencias
Route::get('/usuarios/filtro',[UsuariosController::class,'audiencias'])->name('solicitud.filtro');

Route::get('usuarios/soporte',	[UsuariosController::class,'soporte'])->name('usuarios');


  //2020-08-06
  Route::group(['prefix' => 'usuarios'],  function () {
	//SOLICITUD VIRTUAL DE AUDIENCIAS
Route::get('solicitud/audiencia/virtual',[SolicitudAudienciaController::class,'index'])->name('usuario.solicitar.audiencia');
Route::get('/',[UsuariosController::class,'Noticias'])->name('usuario.noticias');
Route::get('/audiencias',[UsuariosController::class,'audiencias'])->name('usuario.audiencias.pendientes');
Route::get('solicitud/audiencia/virtual/det/log-4512{id}455248',[SolicitudAudienciaController::class,'storedetenido'])->name('usuario.store.detenido');
Route::post('solicitud/audiencia/virtual/verificar/correo',[SolicitudAudienciaController::class,'verificarCorreo'])->name('verificar.correo.despacho');

Route::post('solicitud/audiencia/virtual/',[SolicitudAudienciaController::class,'store'])->name('virtual.audiencia');
Route::post('solicitud/audiencia/virtual/confirmar',[SolicitudAudienciaController::class,'confirmarAudiencia'])->name('virtual.audiencia.confirmar');
Route::post('solicitud/audiencia/virtual/detenido',[SolicitudAudienciaController::class,'detenido'])->name('virtual.audiencia.detenido');
Route::delete('solicitud/audiencia/virtual/detenido/destroy/{id}',[SolicitudAudienciaController::class,'destroy'])->name('virtual.audiencia.detenido.eliminar');

//EMPLEADOS DEL DESPACHO
Route::get('solicitud/empleados/despacho',[SolicitudAudienciaController::class,'empleados'])->name('usuario.empleados.despacho');

Route::post('solicitud/empleados/confirmar/',[SolicitudAudienciaController::class,'confirmarEmpleados'])->name('confirmar.empleados');


//ELIMINAR SOLICITUD DE AUDIENCIAS
Route::delete('solicitud/audiencia/destroy/{id}',[UsuariosController::class,'destroy'])->name('solicitud.audiencia.eliminar');

//FORMULARIO DE PROCESO DIGITALIZACION DE EXPEDIENTES
Route::get('formulario/digitalizacion/expedientes/2020',[SolicitudUsuarioController::class,'formularioDigitalizacion'])->name('usuario.digitalizacion.despacho');

Route::post('formulario/digitalizacion/store',[SolicitudUsuarioController::class,'guardarFormulario'])->name('confirmar.digitalizacion');


//RUTA DE AYUDAS MERCURIO
Route::get('soporte/mercurio',[AyudaController::class,'index'])->name('usuario.ayuda.mercurio');

//RUTA PARA JORNADA DE VACUNACION

Route::get('formulario/consultar/jornada/vacunacion',[SolicitudUsuarioController::class,'ConsulJornadaVacunacion'])->name('consultar.usuario.vacunacion');

Route::get('formulario/jornada/vacunacion',[SolicitudUsuarioController::class,'jornadaVacunacion'])->name('usuario.vacunacion');

Route::post('formulario/jornada/vacunacion/store',[SolicitudUsuarioController::class,'saveFormularioVacunacion'])->name('confirmar.usuario.vacunacion');
//calular edad
Route::get('consulta/anho/{edad}',[SolicitudUsuarioController::class,'calcularEdad'])->name('usuario.edad');


//RUTA PARA JORNADA DE SALUD
Route::get('formulario/consultar/jornada/salud',[JornadaSaludController::class,'index'])->name('consultar.usuario.salud.index');

Route::post('formulario/jornada/salud/horario',[JornadaSaludController::class,'Asignacionhorario'])->name('confirmar.usuario.salud.horario');

//Route::get('formulario/consultar/jornada/salud','JornadaSaludController@ConsulJornadaSalud')->name('consultar.usuario.salud');Asignacionhorario

Route::get('formulario/jornada/salud','JornadaSaludController@jornadaSalud')->name('usuario.salud');

Route::post('formulario/jornada/salud/store','JornadaSaludController@saveFormularioSalud')->name('confirmar.usuario.salud');


//REPORTAR INCIDENTES PARA MANTENIMIENTO 
Route::get('reporte/incidente',[SolicitudUsuarioController::class,'reporteIncidente'])->name('usuario.reportar.incidente');
Route::get('reporte/incidente/select/{id}',[SolicitudUsuarioController::class,'reporteIncidenteSelect'])->name('usuario.reportar.incidente.select');
Route::post('reporte/incidente/store',[SolicitudUsuarioController::class,'reporteIncidenteSave'])->name('usuario.reportar.incidente.save');
Route::delete('reporte/incidente/store/delete/{id}',[SolicitudUsuarioController::class,'reporteIncidentedelete'])->name('usuario.reportar.incidente.delete');
//CONSULTAR INCIDENTE
Route::get('/consulta/detalles/reporte/{codigo}',[SolicitudUsuarioController::class,'Revision'])->name('usuario.consulta.reporte.incidente');


Route::get('reporte/categories/elements/{id}', [SolicitudUsuarioController::class, 'ElementosMantenimietno'])->name('usuario.reportar.incidente.elements');

//RUTAS DE FORMATOS
Route::get('descargar/formatos_y_mas',[UsuariosController::class,'Formatos'])->name('usuario.descarga.formatos');

//RUTAS CAPACITACION
Route::get('solicitud/capacitacion',[ProgramacionCapcitacionController::class,'index'])->name('usuario.solicitud.capacitacion');
Route::post('solicitud/capacitacion/store',[ProgramacionCapcitacionController::class,'store'])->name('usuario.store.capacitacion');
Route::post('verificar-cupo', [ProgramacionCapcitacionController::class, 'verificarCupo']);

Route::get('solicitud/capacitacion/siugj',[ProgramacionCapcitacionController::class,'Siugj'])->name('usuario.solicitud.capacitacion.siugj');

Route::post('solicitud/capacitacion/store/siugj',[ProgramacionCapcitacionController::class,'storeSiugj'])->name('usuario.store.capacitacion.siugj');

Route::post('verificar-cupo-siugj', [ProgramacionCapcitacionController::class, 'verificarCupoSiugj']);

//visita siugj
Route::get('solicitud/visita/siugj',[ProgramacionCapcitacionController::class,'Visita'])->name('usuario.solicitud.visita.siugj');
Route::post('solicitud/visita/store/siugj',[ProgramacionCapcitacionController::class,'storeVisita'])->name('usuario.store.visita.siugj');
Route::post('verificar-cupo-visita-siugj', [ProgramacionCapcitacionController::class, 'verificarCupoVisita']);


//NUEVA CAPACITACION SIUGJ
Route::get('solicitud/capacitacion/siugj',[ProgramacionCapcitacionController::class,'ListaCapacitacionSiugj'])->name('usuario.solicitud.capacitacion.siugj');
Route::post('solicitud/capacitacion/store/siugj',[ProgramacionCapcitacionController::class,'ListastoreSiugj'])->name('usuario.solicitud.save.capacitacion.siugj');
Route::get('/eventos', [ProgramacionCapcitacionController::class, 'obtenerEventos']);




//SOLICITUD DE NOTIFICACION DE DESPACHO
Route::get('/solicitud/notificacion',[SolicitudNotificacionController::class,'index'])->name('usuario.solicitud.notificacion');
Route::get('/solicitud/notificacion/historico',[SolicitudNotificacionController::class,'historico'])->name('usuario.historico.notificacion');
Route::post('/solicitud/notificacion',[SolicitudNotificacionController::class,'store'])->name('usuario.solicitud.save.notificacion');
Route::get('/solicitud/vincular/notificacion/{id}',[SolicitudNotificacionController::class,'notificados'])->name('usuario.solicitud.vincular.notificacion');
Route::post('/solicitud/almacenar/notificacion/',[SolicitudNotificacionController::class,'save_notificados'])->name('usuario.solicitud.save.notificados');

Route::get('historico/solicitud/{id_seguimiento}', [SolicitudNotificacionController::class,'mostrarSolicitud'])->name('usuario.historico.solicitud');


//INGRESO ARCHIVO
Route::get('solicitud/ingreso/archivo', [IngresoArchivoJudicialController::class,'index'])->name('usuario.solicitud.ingreso.archivo');
Route::post('solicitud/ingreso/archivo', [IngresoArchivoJudicialController::class,'store'])->name('usuario.solicitud.ingreso.store');
Route::get('solicitud/ingreso/autorizar', [IngresoArchivoJudicialController::class,'autorizarIngreso'])->name('usuario.solicitud.ingreso.autorizar');

Route::post('solicitud/firma/despacho', [IngresoArchivoJudicialController::class,'firmaDespacho'])->name('usuario.firma.despacho');


//ficha de remision
Route::get('/ficha/remision/',              [UsuariosController::class,'Ficha_Remision'])->name('usuario.ficha.remision'); 
Route::get('/ficha/remision/historico',              [UsuariosController::class,'historicoFicha'])->name('usuario.historico.ficha.remision'); 
Route::post('/ficha/remision/',              [UsuariosController::class,'Ficha_Remision_store'])->name('usuario.ficha.remision.store'); 
Route::get('/ficha/remision/select/',              [UsuariosController::class,'Conocimiento'])->name('usuario.ficha.conocimiento'); 
Route::get('/ficha/remision/select/reparto',              [UsuariosController::class,'grupo_reparto'])->name('usuario.ficha.gr_reparto'); 


//ficha de remision
Route::get('/ficha/preliminar/',              [FichaController::class,'Ficha_Preliminar'])->name('usuario.ficha.preliminar'); 
Route::get('/ficha/preliminar/historico',              [FichaController::class,'historicoFicha'])->name('usuario.historico.ficha.preliminar'); 
Route::post('/ficha/preliminar/',              [FichaController::class,'Ficha_Preliminar_store'])->name('usuario.ficha.preliminar.store'); 
Route::get('/ficha/preliminar/select/',              [FichaController::class,'Conocimiento'])->name('usuario.ficha.conocimiento.preliminar'); 
Route::get('/ficha/preliminar/select/reparto',              [FichaController::class,'grupo_reparto'])->name('usuario.ficha.gr_reparto.preliminar'); 

//requermientos despachos

    Route::get('/requerimiento/despacho/', [RequerimientoDespachosController::class,'index'])->name('requerimientodespachos.index');
    Route::get('/requerimientos/despacho/create', [RequerimientoDespachosController::class,'create'])->name('requerimientodespachos.create');
    Route::post('/requerimiento/despacho/store', [RequerimientoDespachosController::class,'store'])->name('requerimientodespachos.store');
    //Route::get('/requerimiento/despacho/show', [RequerimientoDespachosController::class,'show'])->name('requerimientodespachos.show');
    //Route::get('/requerimiento/despacho/edit', [RequerimientoDespachosController::class,'edit'])->name('requerimientodespachos.edit');
    //Route::put('/requerimiento/despacho/update', [RequerimientoDespachosController::class,'update'])->name('requerimientodespachos.update');
    Route::delete('/requerimiento/despacho/destroy/{id}', [RequerimientoDespachosController::class,'destroy'])->name('requerimientodespachos.destroy');
    //consultar elementos por categoria 
    Route::post('/requerimiento/categories/elements', [RequerimientoDespachosController::class, 'Elementos'])->name('requerimientodespachos.elements');


});

//Usuario Registos de ingreso
Route::group(['prefix' => 'usuarios'], function(){
    Route::get('/registro/ingreso', [ControlIngresoController::class,'index'])->name('usuario.ingreso');
    Route::get('/agendar/visita', [ControlIngresoController::class,'agendamiento'])->name('usuario.agendamiento');
    Route::post('/agendar/visita/almacenar', [ControlIngresoController::class,'agendamientoEmpleado'])->name('empleado.agendamiento.store');
    
     Route::post('/agendar/visita/visitante', [ControlIngresoController::class,'agendamientoVisitante'])->name('visitante.agendamiento.store');
     
     Route::post('/agendar/visita/proveedor', [ControlIngresoController::class,'agendamientoProveedor'])->name('proveedor.agendamiento.store');
     
     //asignacion temporal de parqueadero
     Route::post('/agendar/ingreso/temporal/parqueadero', [ControlIngresoController::class,'agendamientoTemporalParqueadero'])->name('parqueadero.temporal.agendamiento.store');
    
     Route::get('/consulta/cedula/{cedula}',[ControlIngresoController::class,'consultaCedula'])->name('usuario.consulta.cedula.ingreso');
     
	//CONSULTA DE EMPLEADO EN CONTRATOS ACTIVOS
	Route::get('/consulta/cedula/contratos/{cedula}',[ControlIngresoController::class,'consultaCedulaContrato'])->name('usuario.contrato.activo.cedula.ingreso');
	
	Route::get('/consulta/placa/{placa}', [ControlIngresoController::class,'consultaPlaca'])->name('usuario.placa.vehiculo');
	

    
	//FORMULARIO PARA REPORTAR EXPEDIENTES PARA DIGITALIZACION
    Route::get('formulario/reporte/digitalizacion/expedientes/',[RegistroDigitalizacionController::class,'index'])->name('usuario.digitalizacion.reporte');
     //descargar mi reporte de invetario de digitalizacion PDF
     Route::get('descargar/inventario/expedientes/pdf',[RegistroDigitalizacionController::class,'DescargarMiInvetarioPdf'])->name('usuario.descargar.inventario.pdf');
    
    //descargar mi reporte de invetario de digitalizacion 
    Route::get('descargar/inventario/expedientes/',[RegistroDigitalizacionController::class,'DescargarMiInvetario'])->name('usuario.descargar.inventario');

    Route::post('registro/digitalizacion/almacenar',[RegistroDigitalizacionController::class,'store'])->name('reporte.digitalizacion');
    //ELIMINAR REGISTRO DE RADICADO
    Route::delete('registro/digitalizacion/{id}',   [RegistroDigitalizacionController::class,'destroy'])->name('registro-delete');
    
    //ENCUESTA VACUNACION
     Route::get('encuesta/vacunacion',[EncuestaVacunaController::class,'index'])->name('usuario.vacunacion.encuesta');
     Route::post('encuesta/vacunacion',[EncuestaVacunaController::class,'store'])->name('usuario.save.encuesta');
     Route::put('encuesta/vacunacion/update/{id}',[EncuestaVacunaController::class,'update'])->name('usuario.update.encuesta');
     Route::get('encuesta/vacunacion/editar/{id}',[EncuestaVacunaController::class,'show'])->name('usuario.vacunacion.editar');
     
   //AGENDAMIENTO CAPACITACION
   Route::get('agendamiento/capacitacion',[EncuestaVacunaController::class,'indexRegistro'])->name('usuario.capacitacion.agendamiento');
   Route::post('agendamiento/capacitacion',[EncuestaVacunaController::class,'storeRegistro'])->name('usuario.save.capacitacion.agendamiento');
   
    //ENCUESTA DE ESQUEMA DE VACUNACION
    Route::get('esquema/vacunacion',[SolicitudUsuarioController::class,'ReportePersonalVacunado'])->name('esquema.vacunacion');

    Route::post('esquema/vacunacion/store',[SolicitudUsuarioController::class,'ReportePersonalVacunadoSave'])->name('esquema.vacunacion.save');
    Route::delete('esquema/vacunacion/delete/{id}',[SolicitudUsuarioController::class,'ReportePersonalVacunadoDel'])->name('esquema.delete');
    
    
	//RUTAS CAPACITACIONPHP ARTISAN 
   // Route::get('solicitud/capacitacion',[ProgramacionCapcitacionController::class,'index'])->name('usuario.solicitud.capacitacion');
    
    //RUTAS CAPACITACION
    Route::get('solicitud/capacitacion',[ProgramacionCapcitacionController::class,'index'])->name('usuario.solicitud.capacitacion');
    Route::post('solicitud/capacitacion/store',[ProgramacionCapcitacionController::class,'store'])->name('usuario.store.capacitacion');


    //FORMULARIO REGISTRO OPTOMETRIA 
	Route::get('agendamiento/optometria',[JornadaSaludController::class,'AsignacionOptometria'])->name('usuario.optometria.agendamiento');
	Route::post('agendamiento/optometria/store',[JornadaSaludController::class,'optometria'])->name('usuario.save.optometria.agendamiento');
	Route::post('agendamiento/optometria/save',[JornadaSaludController::class,'saveOptometria'])->name('usuario.save.optometria');
	
	//FORMULARIO REGISTRO DE PETICIONES FUNCIONARIOS
    Route::get('solicitud/funcionarios',[SolicitudUsuarioSoporteController::class,'index'])->name('usuario.solicitud.servicio');
    Route::post('solicitud/funcionarios/store',[SolicitudUsuarioSoporteController::class,'store'])->name('usuario.store.servicio');
    Route::delete('solicitud/funcionarios/delete/{id}',[SolicitudUsuarioSoporteController::class,'destroy'])->name('usuario.delete.servicio');
    
    //SOLICITUD TRABAJO REMOTO
    Route::get('solicitud/funcionarios/teletrabajo',[SolicitudUsuarioSoporteController::class,'SolicitudTrabajoRemoto'])->name('usuario.solicitud.trabajo.remoto');
    Route::post('solicitud/create/trabajo/remoto',[SolicitudUsuarioSoporteController::class,'SolicitudSave'])->name('usuario.save.trabajo.remoto');
    Route::put('solicitud/revocar/trabajo/remoto/{id}',[SolicitudUsuarioSoporteController::class,'SolicitudRevocar'])->name('usuario.revocar.trabajo.remoto');
    //revocar
    Route::get('solicitud/revocar/teletrabajo/{id}',[SolicitudUsuarioSoporteController::class,'SolicitudRevocarTrabajoRemoto'])->name('usuario.solicitud.revocar.trabajo.remoto');
    Route::put('subir/revocar/trabajo/remoto/{id}',[SolicitudUsuarioSoporteController::class,'SubirRevocarTrabajoRemoto'])->name('usuario.subir.revocar.trabajo.remoto');
    //SubirFormallizacionTrabajoRemoto
    
    Route::get('solicitud/formalizacion/teletrabajo/{id}',[SolicitudUsuarioSoporteController::class,'SolicitudFormallizacionTrabajoRemoto'])->name('usuario.solicitud.formalizacion.trabajo.remoto');
    Route::put('subir/formalizacion/trabajo/remoto/{id}',[SolicitudUsuarioSoporteController::class,'SubirFormallizacionTrabajoRemoto'])->name('usuario.subir.formalizacion.trabajo.remoto');
    
    //BOTON ANUENCIA
    Route::put('subir/anuencia/trabajo/remoto/{id}',[SolicitudUsuarioSoporteController::class,'SubirAnuenciaTrabajoRemoto'])->name('usuario.subir.anuencia.trabajo.remoto');
    
    //SOLICITUD TRABAJO REMOTO 2024
    Route::get('carga/documentos/teletrabajo',[SolicitudUsuarioSoporteController::class,'soporteTeletrabajo24'])->name('usuario.docuemntos.trabajo.remoto');
    Route::post('save/documentos/teletrabajo/',[SolicitudUsuarioSoporteController::class,'AlmacenarTeletrabajo2024'])->name('usuario.save.doc.teletrabajo');
    //ConsultaFormalizacion
    Route::get('consulta/formalizacion/{cedula}',[SolicitudUsuarioSoporteController::class,'ConsultaFormalizacion'])->name('usuario.Conformalizacion.trabajo.remoto');
    
    //SDISAJ CALI SUBE ANUENCIA
   // Route::get('solicitud/formalizacion/teletrabajo/{id}',[SolicitudUsuarioSoporteController::class,'SolicitudFormallizacionTrabajoRemoto'])->name('usuario.solicitud.formalizacion.trabajo.remoto');
    //Route::put('subir/formalizacion/trabajo/remoto/{id}',[SolicitudUsuarioSoporteController::class,'SubirFormallizacionTrabajoRemoto'])->name('usuario.subir.formalizacion.trabajo.remoto');
    
    
    //consulta de cedula
      Route::get('/consulta/cedula/corte/{cedula}', [SolicitudUsuarioSoporteController::class,'consultaCedulaE'])->name('conculta.cedula.emple');
      
    //consulta de cedula
      Route::get('/consulta/cedula/anuencia/{cedula}', [SolicitudUsuarioSoporteController::class,'consultaCedulaAnuencia'])->name('conculta.cedula.emple');
      
    //eliminar solicitud
    
    Route::delete('solicitud/teletrabajo/delete/{id}',[SolicitudUsuarioSoporteController::class,'destroySolicitud'])->name('usuario.delete.teletrabajo');
    
    //reserva de sala
     Route::get('/consulta/reserva/salas', [SolicitudAudienciaController::class,'ReservaSalas'])->name('usuario.consulta.reserva.sala');
     
     //RESERVA DE SALAS POR LOS DESPACHOS
     Route::get('/reserva/salas', [ReservaSalasAudienciaUsersController::class,'index'])->name('usuario.reservas.reserva.index');
      Route::get('/reserva/sala/{sala}', [ReservaSalasAudienciaUsersController::class,'Salas'])->name('usuario.reservas.reserva.salas');
      
      Route::get('/sala/{sala}', [ReservaSalasAudienciaUsersController::class,'ReservarSalas'])->name('usuario.reservas.salas');
      Route::post('/sala/eliminar/', [ReservaSalasAudienciaUsersController::class,'ReservarSalasEliminar'])->name('usuario.eliminar.reservas.salas');
      
      Route::post('/reservas/salas/store', [ReservaSalasAudienciaUsersController::class,'store'])->name('usuario.reservas.store.salas');
      
      Route::get('/evento/salas/{sala}', [ReservaSalasAudienciaUsersController::class,'Eventos'])->name('usuario.reservas.evento.salas');
      Route::get('/reservas/historial', [ReservaSalasAudienciaUsersController::class,'ReservasSalas'])->name('usuario.reservas.all.salas');
      
      Route::get('/reservas/hoy', [ReservaSalasAudienciaUsersController::class,'ReservasHoy'])->name('usuario.reservas.hoy.salas');
      
      Route::get('/reservas/publico', [ReservaSalasAudienciaUsersController::class,'publico'])->name('usuario.reservas.publico.salas');
     
    //COMPRAVENTA
   
    Route::get('/clasificados', [CompraVentaController::class,'index'])->name('usuario.clasificados.index');
    Route::post('/clasificados/store', [CompraVentaController::class,'store'])->name('usuario.clasificados.save');
    Route::delete('/clasificados/delete/{id}', [CompraVentaController::class,'destroy'])->name('usuario.clasificados.delete');
    
    
    //SeguimientoPresencialidadController
    Route::get('/seguimiento/presencialidad', [SeguimientoPresencialidadController::class,'index'])->name('usuario.seguimient.presencialidad.index');
    Route::post('/seguimiento/presencialidad/registrar', [SeguimientoPresencialidadController::class,'store'])->name('usuario.seguimient.presencialidad.registrar');
    
     //Seguimiento Teletrabajo reporte a correo teletrabajo@disj
    Route::get('/informe/teletrabajo', [SeguimientoPresencialidadController::class,'teletrabajo'])->name('usuario.informe.teletrabajo.index');
    Route::post('/informe/teletrabajo/registrar', [SeguimientoPresencialidadController::class,'saveTeletrabajo'])->name('usuario.informe.teletrabajo.registrar');
    
    //DESPACHO
    Route::get('/seguimiento/presencialidad/despacho', [SeguimientoPresencialidadController::class,'indexDespacho'])->name('usuario.seguimient.presencialidad.despacho.index');
    Route::post('/seguimiento/presencialidad/despacho/registrar', [SeguimientoPresencialidadController::class,'storeDespacho'])->name('usuario.seguimient.presencialidad.despacho.registra');
    
    Route::get('/seguimiento/presencialidad/dowload', [SeguimientoPresencialidadController::class,'excel'])->name('usuario.seguimient.presencialidad.dowload');
    Route::get('/seguimiento/presencialidad/dowload/todo', [SeguimientoPresencialidadController::class,'excel'])->name('usuario.seguimient.presencialidad.dowload.todo');
    
    //FORMULARIO LEVANTAMIENTO
    
    //ponerle levantamiento despues  levantamineto/sgde/
    Route::get('/levantamineto/sgde/', [SeguimientoPresencialidadController::class,'levantamiento'])->name('usuario.levantamineto.index');
    Route::post('/levantamineto/sgde/', [SeguimientoPresencialidadController::class,'levantamientoStore'])->name('usuario.levantamineto.store');
    
    
    //escalafon
     Route::get('/escalafon/despachos/', [EscalafonController::class,'index'])->name('escalafon.listado.index');
     Route::get('/escalafon/despacho/{id}', [EscalafonController::class,'show'])->name('escalafon.listado.show');
     Route::PUT('/escalafon/despacho/propiedad/{id}', [EscalafonController::class,'propiedadA'])->name('escalafon.listado.put.propiedad');
     Route::PUT('/escalafon/despacho/provisionalidad/{id}', [EscalafonController::class,'provisionalidadA'])->name('escalafon.listado.put.provisionalidad');
     
     
     Route::POST('/escalafon/despacho/propiedad/{id}', [EscalafonController::class,'propiedad'])->name('escalafon.listado.post.propiedad');
     Route::POST('/escalafon/despacho/provisionalidad/{id}', [EscalafonController::class,'provisionalidad'])->name('escalafon.listado.post.provisionalidad');
     
    Route::post('/escalafon/save/', [EscalafonController::class,'index2'])->name('escalafon.listado.store');
    //listado de usuario por despacho en escalafon
    Route::get('/escalafon/funcionarios/', [EscalafonController::class,'funcionarios'])->name('escalafon.listado.funcionarios');
    //CONSULTA DE CARGOS
    Route::get('/escalafon/funcionarios/consulta/', [EscalafonController::class,'cargos'])->name('escalafon.listado.cargos.funcionarios');
    
    //INSCRIBBIR USUARIOS EN CARGO
    Route::post('/escalafon/save/inscripcion', [EscalafonController::class,'SaveInscripcion'])->name('escalafon.listado.save.inscripcion');
    
    
    //ESCALAFON DESPACHO 
    Route::get('/escalafon/funcionarios/despacho/', [DespachoEscalafonController::class,'Index'])->name('usuario.escalafon.cargos.funcionarios');
    Route::get('/escalafon/funcionarios/incorporacion/', [DespachoEscalafonController::class,'Incorporacion'])->name('usuario.escalafon.cargos.Incorporacion');
    Route::post('/escalafon/funcionarios/incorporacion/', [DespachoEscalafonController::class,'saveIncorporacion'])->name('usuario.escalafon.save.Incorporacion');
    
    
    
    
    
    
    //RESPUESTA LICENCIAS
	Route::get('respuesta/asignacion/computador/',[UsuariosController::class,'index'])->name('usuario.respuesta.asignacion.computador');
	
	Route::post('respuesta/asignacion/computador/',[UsuariosController::class,'SaveRespuesta'])->name('usuario.save.asignacion.computador');
	
	//solicitud de elementos a almacen
    Route::get('/solicitud/elementos/almacen', [SolicitudAlmacenController::class, 'index'])->name('usuario.elementos.almacen');
    Route::get('/solicitud/elementos/almacen/historico', [SolicitudAlmacenController::class, 'Historico'])->name('usuario.elementos.almacen.historico');
    Route::post('/solicitud/elementos/almacen/save', [SolicitudAlmacenController::class, 'store'])->name('usuario.elementos.almacen.save');
    Route::delete('/solicitud/elementos/almacen/delete/{id}', [SolicitudAlmacenController::class, 'destroy'])->name('usuario.elementos.almacen.delete');
    Route::get('/solicitud/elementos/almacen/enviar', [SolicitudAlmacenController::class, 'CerrarSolicitud'])->name('usuario.elementos.almacen.cerrar');
    Route::get('consulta/cedulaE/{cedula}',[SolicitudAlmacenController::class,'consultaCedulaE'])->name('usuario.consulta.cedula.empleado');
	
	
   //actualizacion de datos despacho
    Route::PUT('/actualizacion/informacion/despacho/{id}', [UsuariosController::class,'ActualizacionDespacho'])->name('usuarios.actualizacion.datos');
    
    //actualizacion de datos de los funcionarios
    Route::post('/actualizacion/informacion/empleado/', [UsuariosController::class,'ActualizacionDatosE'])->name('usuarios.actualizacion.datos.empleado');
    
    //solicitud de ususario SGDE
    Route::get('/solicitud/usuario/sgde', [UsuariosController::class, 'sgde'])->name('usuario.solicitud.sgde');
     Route::get('/solicitud/usuario/sgde/lista', [UsuariosController::class, 'getEmpleados'])->name('usuario.solicitud.lista');
    Route::post('/solicitud/sgde/save', [UsuariosController::class, 'sgdeStore'])->name('usuario.solicitud.sgde.save');
    
    
    //Escalafon
    Route::get('/consulta-carrera', [UsuariosController::class, 'Escalafon'])->name('consulta.index');
    Route::post('/consulta-carrera/buscar',[UsuariosController::class, 'ConsultaEscalafon'])->name('consulta.buscar');
    
    //Escalafon NUEVO DE FUNCIONARIOS
    
    Route::get('/consulta-escalafon/siris', [EscalafonConsejoController::class, 'form'])->name('consulta.escalafon.form');
    //Route::post('/consulta-escalafon/siris', [EscalafonConsejoController::class, 'buscar'])->name('consulta.escalafon.buscar');
    
    
    Route::get('/certificado/escalafon/descargar/{cedula}', [EscalafonConsejoController::class, 'EnviarCertificacion'])
    ->name('certificacion.escalafon.descargar.url')
    /*->middleware('signed')*/;



});

//NOTIFICACIONES POR EL SPA
Route::group(['prefix' => 'notificaciones'], function(){
	Route::get('/', [NotificacionSpaController::class,'index'])->name('notificaciones.index');
    Route::get('/en_proceso', [NotificacionSpaController::class,'enProceso'])->name('notificaciones.en_proceso');
    Route::get('historico/solicitudes', [NotificacionSpaController::class,'solicitudes'])->name('notificaciones.historico.solicitudes');
    
    Route::get('historico/solicitud/despacho/{id_seguimiento}', [NotificacionSpaController::class,'mostrarNotificacion'])->name('notificaciones.historico.solicitudes.despacho');

    Route::post('/generar/excel', [NotificacionSpaController::class,'excel'])->name('notificaciones.excel');
    //GUARDAR OFICIO
    Route::put('/almacenar/oficio/{id}', [NotificacionSpaController::class,'guardarOficio'])->name('notificaciones.guardar.oficio');

});



Route::get('/usuarios/soporte',	[UsuariosController::class,'soporte']);
Route::resource('usuarios',	UsuariosController::class);


//seleccionar categorias dinamicamente PARA SOLICITUD USUSARIO
Route::get('selectCate/{id}', [SolicitudUsuarioController::class,'selects']);
Route::get('selectEmpleado/{id}', [SolicitudUsuarioController::class,'selectsempleado']);



//seleccionar juzgados dinamicamente PARA inventario
Route::get('/selectInv/{id}', [InventarioController::class,'selectInventario']);



/*nuevas perfil reserva*/
Route::group(['prefix' => 'reservas'], function()
{
	Route::get('/',                         [ReservasController::class,'reserva'])->name('reservas');
	Route::get('registrar-reserva',         [ReservasController::class,'registrarReserva'])->name('administrador.registrar-reserva');
	Route::post('reservas-store',           [ReservasController::class,'reservasStore'])->name('reservas-store');
	Route::get('reservas-edit/{id}',        [ReservasController::class,'reservasEdit'])->name('reservas-edit');
	Route::put('reservas-update/{id}',      [ReservasController::class,'reservasUpdate'])->name('reservas-update');
	Route::delete('reservas-delete/{id}',   [ReservasController::class,'reservasDelete'])->name('reservas-delete');
	
	//reservas sin publicar
	Route::get('/sin_publicar',                         [ReservasController::class,'reservaSinPublicar'])->name('reservas_sin_publicar');
	
			//reservas spublicadas
	Route::get('/publicadas',                         [ReservasController::class,'reservaPublicada'])->name('reservas_publicadas');
	
	//reservas de full calendar
	//RESERVAR
	Route::get('/calendario',                         [ReservasController::class,'calendarioReservas'])->name('reservas.calendario');
	Route::post('/evento/store',		[ReservasController::class,'calendarioReservas'])->name('agendar.store');
	Route::post('/horario/horario/destroy/',	[ReservasController::class,'borrar'])->name('agendar.destroy');
	
	Route::get('evento/{id}',		[ReservasController::class,'getevents']);

});



//crear un select normal que permita a los usuarios ingresar y redireccione a la vista que se necesita
Route::get('reserva-sala',[ReservasController::class,'fullcalendar'])->name('reserva-sala');
Route::get('getreservas/{id}',          [ReservaSalasController::class,'getreservas']);


// cambiarContraseña...
Route::get('/cambiarPassword/nueva/contrasena',[CambioPasswordController::class,'showChangePasswordForm'])->name('formCambioPass');
Route::post('/cambioPassword',[CambioPasswordController::class,'changePassword'])->name('changePassword');



//Registro ingreso policias
use App\Http\Controllers\PoliceEntryController;

// rutas control ingreso
Route::group(['prefix' => 'monitoreo'], function()
{
	Route::get('/',[ReporteAscensorControllerController::class,'index'])->name('monitoreo.index.ascensor');
    Route::get('/reporte/ascensor', [ReporteAscensorControllerController::class,'reporte'])->name('monitoreo.reporte.ascensor');
    Route::get('/reporte/ascensor/descargar', [ReporteAscensorControllerController::class,'DescargarReporte'])->name('monitoreo.reporte.ascensor.descargar');
    Route::post('/reporte/ascensor/store', [ReporteAscensorControllerController::class,'store'])->name('monitoreo.reporte.ascensor.store');	

    Route::get('/ingreso',[MonitoreoIngresoController::class,'index'])->name('monitoreo.control.ingreso');
	/*Route::get('/buscar/ingresos',[MonitoreoIngresoController::class,'search'])->name('monitoreo.verificacion.ingreso');*/
	//verificar cedula con mensaje toas
	Route::get('/buscar/cedula/ingreso/{cedula}',[MonitoreoIngresoController::class,'verificaringreso'])->name('monitoreo.verificacion.ingreso.cedula');
	//verificar cedula con mensaje toas
	Route::get('/coordinacion/cedula/ingreso/{cedula}',[MonitoreoIngresoController::class,'CoordVerificarIngreso'])->name('monitoreo.verificacion.coordinacion.ingreso.cedula');
	//contar usuarios
	Route::get('/contar/usuarios',[MonitoreoIngresoController::class,'contarUsuarios'])->name('monitoreo.verificacion.contar.usuarios');
	//verificar vehiculo
	Route::get('/buscar/vehiculo/ingreso/{placa}',[MonitoreoIngresoController::class,'verificarVehiculo'])->name('monitoreo.verificacion.ingreso.vehiculo');
	
//verificar cedula para salida
	Route::get('/buscar/cedula/salida/{cedula}',[MonitoreoIngresoController::class,'reportarSalida'])->name('monitoreo.verificacion.salida.cedula');
	
	//autorizar vehiculo
	Route::get('/autorizar/vehiculo/ingreso/{placa}',[MonitoreoIngresoController::class,'autorizarVehiculo'])->name('monitoreo.autorizacion.ingreso.vehiculo');
	
	//Negar vehiculo
	Route::get('/negar/vehiculo/ingreso/{placa}',[MonitoreoIngresoController::class,'denegarVehiculo'])->name('monitoreo.denegar.ingreso.vehiculo');
	
/*	Route::post('/autorizar/vehiculo/ingreso/',[MonitoreoIngresoController::class,'autorizarVehiculo'])->name('monitoreo.autorizacion.ingreso.vehiculo');*/
	
	
    Route::get('/registro/ingreso', [MonitoreoIngresoController::class,'registroIngreso'])->name('monitoreo.ingreso');
    Route::get('/agendar/visita', [MonitoreoIngresoController::class,'agendamiento'])->name('monitoreo.agendamiento');
    
    //RUTA DE CRON PARA CERRAR INGRESOS 
    //Route::get('/cierre/automatico/dias/anteriores', [MonitoreoIngresoController::class,'CiereVisitasAutomaticamente'])->name('monitoreo.cierre.automatico');
    
    
    /*Route::post('/agendar/visita/almacenar', [ControlIngresoController::class,'agendamientoEmpleado'])->name('empleado.agendamiento.store');
    
     Route::post('/agendar/visita/visitante', [ControlIngresoController::class,'agendamientoVisitante'])->name('visitante.agendamiento.store');
     
     Route::post('/agendar/visita/proveedor', [ControlIngresoController::class,'agendamientoProveedor'])->name('proveedor.agendamiento.store');
    
	Route::get('/consulta/cedula/{cedula}',[ControlIngresoController::class,'consultaCedula'])->name('usuario.consulta.cedula.ingreso');
	
	Route::get('/consulta/placa/{placa}', [ControlIngresoController::class,'consultaPlaca'])->name('usuario.placa.vehiculo');*/
	
    	
    
    // Rutas para el módulo de registros de policía
    Route::resource('police-entries', PoliceEntryController::class)->only(['index', 'create', 'store']);
    Route::put('police-entries/{policeEntry}/update-salida', [PoliceEntryController::class, 'updateSalida'])->name('police-entries.update-salida');
    Route::put('police-entries/{policeEntry}/update', [PoliceEntryController::class, 'update'])->name('police-entries.update-registro');
    
    
    
    //reporte de incidentes en notificaciones telegram
    Route::get('/notificaciones/incidente', [NotificacionTelegramController::class, 'index'])->name('notificaciones.index');
    Route::get('/notificaciones/create', [NotificacionTelegramController::class, 'create'])->name('notificaciones.create');
    Route::post('/notificaciones/store', [NotificacionTelegramController::class, 'store'])->name('notificaciones.store');


});

//ingresos por parqueadero

Route::group(['prefix' => 'parqueadero'], function()
{
    // REGISTRO DE INGRESO EMPLEADOS CON VEHICULOS
    Route::get('/tanqueo', [RegistroIngreoEmpleadoController::class,'index'])->name('paqueadero.ingreso.personal');
    Route::GET('consula/ingreso/contratista/{cedula}', [RegistroIngreoEmpleadoController::class,'registrarIngreso'])->name('consulta.registro.ingreso.personal');
    Route::GET('consula/ingreso/lista', [RegistroIngreoEmpleadoController::class,'listado'])->name('consulta.registro.ingreso.listado');
    
    
    //biometira registro de ingreso por parqueadero
    Route::get('/registro/ingreso/', [BiometriaParqueaderoController::class,'Index'])->name('biometria.Parqueadero.inicio');
    Route::get('/consulta/{identif}', [BiometriaParqueaderoController::class,'Consulta'])->name('biometria.parqueadero.index.consulta');
    Route::get('/registro/biometria/save', [BiometriaParqueaderoController::class,'save'])->name('biometria.parqueadero.registro.save');
    Route::post('/registro/biometria/save/foto', [BiometriaParqueaderoController::class,'store'])->name('biometria.parqueadero.registro.save.foto');
    Route::post('/registro/biometria/cargar/foto', [BiometriaParqueaderoController::class,'cargarFoto'])->name('biometria.parqueadero.registro.cargar.foto');
    //verificar cedula con mensaje toas
	//SALIDA
	Route::get('/registro/salida/', [BiometriaParqueaderoController::class,'registrarSalida'])->name('biometria.Parqueadero.salida.index');
	Route::get('/registro/salida/strore/{cedula}', [BiometriaParqueaderoController::class,'registrarSalidaPorteria'])->name('biometria.Parqueadero.salida');
	
    
    //nuevo metodo parqueadero
    
    Route::get('/validar/ingreso/por_placa/{placa}',[PorteriaParqueaderoController::class,'verificarPlacaVehiculo'])->name('parqueadero.validar.ingreso.placa');
    
    
    Route::get('/', [IngresoParqueaderoController::class,'index'])->name('paqueadero.ingreso');
    //contar usuarios
	Route::get('/contar/usuarios',[IngresoParqueaderoController::class,'contarUsuarios'])->name('parqueadero.contar.usuarios');
	
	//verificar PLACA INGRESO 
	Route::get('/buscar/placa/ingreso/{placa}',[PorteriaParqueaderoController::class,'verificaringresoPorPlaca'])->name('parqueadero.verificacion.ingreso.placa');
	
	//consulta de ingreso paruqeadero
	Route::get('/buscar/cedula/ingreso/{cedula}',[IngresoParqueaderoController::class,'verificaringresoParqueadero'])->name('parqueadero.verificacion.ingreso.cedula');
	
	
	//registrar ingreso de vehiculo
	Route::get('/registrar/ingreso/{placa}',[IngresoParqueaderoController::class,'registrarIngreso'])->name('parqueadero.registar.ingreso.cedula');
	
	//registrar reingreso
	Route::get('/registrar/reingreso/{cedula}',[IngresoParqueaderoController::class,'registrareinngreso'])->name('parqueadero.registar.reingreso.cedula');
	
		
	//registrar salida
	Route::get('/registrar/salida/{placa}',[IngresoParqueaderoController::class,'registrarSalida'])->name('parqueadero.registar.salida.cedula');
	
	//formuarios con mas de 2 veiculo
	Route::get('/registrar/ingreso/dos/{placa}',[IngresoParqueaderoController::class,'registrarIngresoVeh'])->name('parqueadero.registar.ingreso.dos');
	Route::get('/registrar/salida/dos/{placa}',[IngresoParqueaderoController::class,'registrarSalidaVeh'])->name('parqueadero.registar.salida.dos');
	
	
	
	
	
	
	
	
		//verificar cedula con mensaje toas
        Route::get('/coordinacion/cedula/ingreso/{cedula}',[IngresoParqueaderoController::class,'CoordVerificarIngreso'])->name('parqueadero.verificacion.coordinacion.ingreso.cedula');
	
        //contar usuarios
        //verificar vehiculo
        Route::get('/buscar/vehiculo/ingreso/{placa}',[IngresoParqueaderoController::class,'verificarVehiculo'])->name('parqueadero.verificacion.ingreso.vehiculo');
        
    //verificar cedula para salida
        Route::get('/buscar/cedula/salida/{cedula}',[IngresoParqueaderoController::class,'reportarSalida'])->name('parqueadero.verificacion.salida.cedula');
        
        //autorizar vehiculo
        Route::get('/autorizar/vehiculo/ingreso/{placa}',[IngresoParqueaderoController::class,'autorizarVehiculo'])->name('parqueadero.autorizacion.ingreso.vehiculo');
        
        //Negar vehiculo
        Route::get('/negar/vehiculo/ingreso/{placa}',[IngresoParqueaderoController::class,'denegarVehiculo'])->name('parqueadero.denegar.ingreso.vehiculo');
        
        //descarga informe diario parqueadero PARQUEADERO DescargarRegistroParq
        Route::get('/descarga/informe/ingreso/',[IngresoParqueaderoController::class,'DescargarRegistroParq'])->name('parqueadero.descarga.ingreso');
        
        
        
    /*	Route::post('/autorizar/vehiculo/ingreso/',[MonitoreoIngresoController::class,'autorizarVehiculo'])->name('monitoreo.autorizacion.ingreso.vehiculo');*/
        
        
       // Route::get('/registro/ingreso', [IngresoParqueaderoController::class,'registroIngreso'])->name('parqueadero.ingreso');
       // Route::get('/agendar/visita', [IngresoParqueaderoController::class,'agendamiento'])->name('parqueadero.agendamiento');
       
     //REGISTRO DE TANQUEO
    Route::get('/tanqueo', [TanqueoVehiculoController::class,'index'])->name('index.tanqueo');
    Route::get('/registro/tanqueo', [TanqueoVehiculoController::class,'create'])->name('regsitro.tanqueo');
    Route::get('/registro/vehiculo/{id}', [TanqueoVehiculoController::class,'show'])->name('regsitro.vehiculo.show');
    Route::post('/registro/tanqueo/save', [TanqueoVehiculoController::class,'save'])->name('save.registro.tanqueo');
    //consulta cedula conductor
    Route::get('/consulta/conductor/{id}', [TanqueoVehiculoController::class,'consultaCedulaE'])->name('regsitro.vehiculo.conductor');

});

//INGRESO POR PORTERIA
Route::group(['prefix' => 'porteria/ingreso'], function()
{
    //biometira registro de ingreso
    Route::get('/', [BiometriaIngresoController::class,'Index'])->name('biometria.index');
    Route::get('/consulta/{tipo}/{identif}', [BiometriaIngresoController::class,'Consulta'])->name('biometria.index.consulta');
    Route::get('/registro/biometria/save', [BiometriaIngresoController::class,'save'])->name('biometria.registro.save');
    Route::post('/registro/biometria/save/foto', [BiometriaIngresoController::class,'store'])->name('biometria.registro.save.foto');
    Route::post('/registro/biometria/cargar/foto', [BiometriaIngresoController::class,'cargarFoto'])->name('biometria.registro.cargar.foto');
    
    // REGISTRO DE CONTRATISTAS (PORTERÍA)
    Route::get('/contratistas', [ContratistaRegRegistroController::class, 'index'])
        ->name('porteria.contratistas.index')
        ->middleware(['auth', 'checarsesion', 'parqueadero']);
    Route::post('/contratistas/auto-registrar', [ContratistaRegRegistroController::class, 'autoRegistrar'])
        ->name('parqueadero.auto.registrar')
        ->middleware(['auth', 'checarsesion', 'parqueadero']);

    //Route::get('/', [EntradaController::class,'index'])->name('ingresop.ingreso');
    //contar usuarios
	Route::get('/contar/usuarios',[EntradaController::class,'contarUsuarios'])->name('ingresop.contar.usuarios');
	
		//verificar cedula con mensaje toas
	Route::get('/buscar/cedula/ingreso/{cedula}',[EntradaController::class,'verificaringresoF'])->name('ingresop.verificacion.ingreso.cedula');
	
	//registro de visitantes
	Route::get('/registrar/cedula/visitantes/{cedula}',[EntradaController::class,'registrarVisitante'])->name('ingresop.visitantes.registro.cedula');
	Route::post('/registrar/cedula/visitantes/',[EntradaController::class,'registrarVisitanteStore'])->name('store.visitantes.registro.cedula');
	
		//registrar ingreso
	Route::get('/registrar/ingreso/{cedula}',[EntradaController::class,'registrarIngreso'])->name('ingresop.registar.ingreso.cedula');
	
	//registrar reingreso
	Route::get('/registrar/reingreso/{cedula}',[EntradaController::class,'registrareinngreso'])->name('ingresop.registar.reingreso.cedula');
	
	
	
	//registrar salida
	Route::get('/registrar/salida/{cedula}',[EntradaController::class,'registrarSalida'])->name('ingresop.registar.salida.cedula');
	
	
	//verificar cedula con mensaje toas
	Route::get('/coordinacion/cedula/ingreso/{cedula}',[EntradaController::class,'CoordVerificarIngreso'])->name('ingresop.verificacion.coordinacion.ingreso.cedula');
	
	//contar usuarios
	Route::get('/contar/usuarios',[EntradaController::class,'contarUsuarios'])->name('ingresop.verificacion.contar.usuarios');
	//verificar vehiculo
	Route::get('/buscar/vehiculo/ingreso/{placa}',[EntradaController::class,'verificarVehiculo'])->name('ingresop.verificacion.ingreso.vehiculo');
	
//verificar cedula para salida
	Route::get('/buscar/cedula/salida/{cedula}',[EntradaController::class,'reportarSalida'])->name('ingresop.verificacion.salida.cedula');
	
	//autorizar vehiculo
	Route::get('/autorizar/vehiculo/ingreso/{placa}',[EntradaController::class,'autorizarVehiculo'])->name('ingresop.autorizacion.ingreso.vehiculo');
	
	//Negar vehiculo
	Route::get('/negar/vehiculo/ingreso/{placa}',[EntradaController::class,'denegarVehiculo'])->name('ingresop.denegar.ingreso.vehiculo');
	
/*	Route::post('/autorizar/vehiculo/ingreso/',[MonitoreoIngresoController::class,'autorizarVehiculo'])->name('monitoreo.autorizacion.ingreso.vehiculo');*/
	
	
    //Route::get('/registro/ingreso', [EntradaController::class,'registroIngreso'])->name('ingresop.ingreso');
    //Route::get('/agendar/visita', [EntradaController::class,'agendamiento'])->name('ingresop.agendamiento');
	
	
	

});

//SALIDA POR PORTERIA
Route::group(['prefix' => 'porteria/salida'], function()
{
    Route::get('/', [SalidaController::class,'index'])->name('salidap.ingreso');
    //contar usuarios
	Route::get('/contar/usuarios',[SalidaController::class,'contarUsuarios'])->name('salidap.contar.usuarios');
	
		//verificar cedula con mensaje toas
	Route::get('/buscar/cedula/ingreso/{cedula}',[SalidaController::class,'verificaringreso'])->name('salidap.verificacion.ingreso.cedula');
	
		//registrar ingreso
	Route::get('/registrar/ingreso/{cedula}',[SalidaController::class,'registrarIngreso'])->name('salidap.registar.ingreso.cedula');
	
	//registrar reingreso
	Route::get('/registrar/reingreso/{cedula}',[SalidaController::class,'registrareinngreso'])->name('salidap.registar.reingreso.cedula');
	
	
	
	//registrar salida
	Route::get('/registrar/salida/{cedula}',[SalidaController::class,'registrarSalida'])->name('salidap.registar.salida.cedula');
	
	
		//registrar salida Porteria Nueva
	Route::get('/registrar/salida/porteria/{cedula}',[SalidaController::class,'registrarSalidaPorteria'])->name('salidap.registar.salida.porteria.cedula');
	
	//verificar cedula con mensaje toas
	Route::get('/coordinacion/cedula/ingreso/{cedula}',[SalidaController::class,'CoordVerificarIngreso'])->name('salidap.verificacion.coordinacion.ingreso.cedula');
	
	//contar usuarios
	Route::get('/contar/usuarios',[SalidaController::class,'contarUsuarios'])->name('salidap.verificacion.contar.usuarios');
	//verificar vehiculo
	Route::get('/buscar/vehiculo/ingreso/{placa}',[SalidaController::class,'verificarVehiculo'])->name('salidap.verificacion.ingreso.vehiculo');
	
//verificar cedula para salida
	Route::get('/buscar/cedula/salida/{cedula}',[SalidaController::class,'reportarSalida'])->name('salidap.verificacion.salida.cedula');
	
	//autorizar vehiculo
	Route::get('/autorizar/vehiculo/ingreso/{placa}',[SalidaController::class,'autorizarVehiculo'])->name('salidap.autorizacion.ingreso.vehiculo');
	
	//Negar vehiculo
	Route::get('/negar/vehiculo/ingreso/{placa}',[SalidaController::class,'denegarVehiculo'])->name('salidap.denegar.ingreso.vehiculo');
	
/*	Route::post('/autorizar/vehiculo/ingreso/',[MonitoreoIngresoController::class,'autorizarVehiculo'])->name('monitoreo.autorizacion.ingreso.vehiculo');*/
	
	
    //Route::get('/registro/ingreso', [SalidaController::class,'registroIngreso'])->name('salidap.ingreso');
    //Route::get('/agendar/visita', [SalidaController::class,'agendamiento'])->name('salidap.agendamiento');
    
    // Lector/Validador protegido para personal de portería/monitoreo
    Route::get('/monitoreo/validador-carnets', [\App\Http\Controllers\CarnetController::class, 'validador'])
        ->name('carnet.validador')
        ->middleware(IngresoPorteriaMiddleware::class);
	
	
	 

});

//COORDINADOR DE INGRESO, DA LOS PERMISOS DE INGRESO DE VEHICULOS

Route::group(['prefix' => 'coordinador/ingresos'], function()
{
    Route::get('/', [CoordinadorIngresoController::class,'index'])->name('coordinador.control.ingreso');
    //contar usuarios
	Route::get('/contar/usuarios',[CoordinadorIngresoController::class,'contarUsuarios'])->name('coordinador.contar.usuarios');
	
	//verificar cedula con mensaje toas
	Route::get('/buscar/cedula/ingreso/{cedula}',[CoordinadorIngresoController::class,'verificaringreso'])->name('coordinador.verificacion.ingreso.cedula');
	
	//registrar ingreso
	Route::get('/registrar/ingreso/{cedula}',[CoordinadorIngresoController::class,'registrarIngreso'])->name('coordinador.registar.ingreso.cedula');
	
	//registrar reingreso
	Route::get('/registrar/reingreso/{cedula}',[CoordinadorIngresoController::class,'registrareinngreso'])->name('coordinador.registar.reingreso.cedula');
	
		
	//registrar salida
	Route::get('/registrar/salida/{cedula}',[CoordinadorIngresoController::class,'registrarSalida'])->name('coordinador.registar.salida.cedula');
	
	//administrar parqueadero
	Route::get('/parqueadero',[CoordinadorIngresoController::class,'administrarParqueadero'])->name('coordinador.administrar.parqueadero');
	//crear parqueadero
	Route::get('parqueadero/form',        [CoordinadorIngresoController::class,'form'])->name('coordinador.parqueadero.form');
	Route::post('parqueadero/save',      [CoordinadorIngresoController::class,'saveForm'])->name('coordinador.parqueadero.saveForm');
	Route::put('parqueadero/update/{id}',      [CoordinadorIngresoController::class,'updateForm'])->name('coordinador.parqueadero.updateForm');
	Route::get('parqueadero/edit/{id}',   [CoordinadorIngresoController::class,'editForm'])->name('coordinador.parqueadero.editForm');

	
	
	
	//******  
	//INGRESOS POR PORTERIA
	Route::get('/registro/ingresos', [CoordinadorIngresoController::class,'registroIngresos'])->name('coordinador.control.consulta');
	Route::get('/registro/ingresos/consulta/', [CoordinadorIngresoController::class,'buscaRegistroIngresos'])->name('coordinador.control.consulta.cedula');
	Route::get('/contar/usuarios/registrados',[CoordinadorIngresoController::class,'contarUsuariosPorteria'])->name('coordinador.verificacion.contar.usuarios');
	
	
    // CRUD NOVEDADES BIOMETRIA
    Route::post('/registro/ingresos/novedad/guardar', [CoordinadorIngresoController::class,'guardarNovedad'])->name('coordinador.guardar.novedad');
    Route::post('/registro/ingresos/novedad/eliminar', [CoordinadorIngresoController::class,'eliminarNovedad'])->name('coordinador.eliminar.novedad');
    
	
	//verificar cedula con mensaje toas
	Route::get('/coordinacion/cedula/ingreso/{cedula}',[CoordinadorIngresoController::class,'CoordVerificarIngreso'])->name('coordinador.verificacion.coordinacion.ingreso.cedula');
	
	//contar usuarios
	Route::get('/contar/usuarios',[CoordinadorIngresoController::class,'contarUsuarios'])->name('coordinador.verificacion.contar.usuarios');
	//verificar vehiculo
	Route::get('/buscar/vehiculo/ingreso/{placa}',[CoordinadorIngresoController::class,'verificarVehiculo'])->name('coordinador.verificacion.ingreso.vehiculo');
	
//verificar cedula para salida
	Route::get('/buscar/cedula/salida/{cedula}',[CoordinadorIngresoController::class,'reportarSalida'])->name('coordinador.verificacion.salida.cedula');
	
	//autorizar vehiculo
	Route::get('/autorizar/vehiculo/ingreso/{placa}',[CoordinadorIngresoController::class,'autorizarVehiculo'])->name('coordinador.autorizacion.ingreso.vehiculo');
	
	//Negar vehiculo
	Route::get('/negar/vehiculo/ingreso/{placa}',[CoordinadorIngresoController::class,'denegarVehiculo'])->name('coordinador.denegar.ingreso.vehiculo');
	
/*	Route::post('/autorizar/vehiculo/ingreso/',[MonitoreoIngresoController::class,'autorizarVehiculo'])->name('coordinador.autorizacion.ingreso.vehiculo');*/

     Route::post('/agendar/visita/almacenar', [ControlIngresoController::class,'agendamientoEmpleado'])->name('empleado.agendamiento.store');
    
     Route::post('/agendar/visita/visitante', [ControlIngresoController::class,'agendamientoVisitante'])->name('visitante.agendamiento.store');
     
     Route::post('/agendar/visita/proveedor', [ControlIngresoController::class,'agendamientoProveedor'])->name('proveedor.agendamiento.store');
	
	
    Route::get('/registro/ingreso', [CoordinadorIngresoController::class,'registroIngreso'])->name('coordinador.ingreso');
    Route::get('/agendar/visita', [CoordinadorIngresoController::class,'agendamiento'])->name('coordinador.agendamiento');
    
    Route::get('listado/reportes/ingresos', [CoordinadorIngresoController::class,'ListadoRegistroIngresos'])
    ->name('listado.reportes.ingresos');
    
    
     // ADMINISTRACION DE PARQUEADERO (ROL 10)
    Route::get('/admin-parqueadero', [CoordinadorIngresoController::class, 'adminPuestos'])->name('cooringreso.parqueadero.index');
    
        Route::get('/bitacora/historial', [CoordinadorIngresoController::class, 'historialBitacora'])->name('cooringreso.bitacora.index');
   
    // VEHICULOS OFICIALES (Asignación y gestión)
    Route::get('/vehiculos-oficiales', [CoordinadorIngresoController::class, 'vehiculosOficiales'])->name('cooringreso.vehiculos_oficiales.index');
    Route::post('/vehiculos-oficiales/asignar', [CoordinadorIngresoController::class, 'asignarConductorVehiculo'])->name('cooringreso.vehiculos_oficiales.assign');
    Route::post('/vehiculos-oficiales/quitar', [CoordinadorIngresoController::class, 'quitarConductorVehiculo'])->name('cooringreso.vehiculos_oficiales.unassign');
    Route::post('/vehiculos-oficiales/toggle-visibilidad', [CoordinadorIngresoController::class, 'toggleVisibilidadVehiculo'])->name('cooringreso.vehiculos_oficiales.toggle_visibilidad');
    Route::get('/vehiculos-oficiales/reportes-globales', [CoordinadorIngresoController::class, 'historialGlobalReportes'])->name('cooringreso.vehiculos_oficiales.historial_global');
    Route::get('/vehiculos-oficiales/buscar-conductor/{cedula}', [CoordinadorIngresoController::class, 'buscarConductorAjax'])->name('cooringreso.vehiculos_oficiales.buscar');
    
    Route::get('/admin-parqueadero/asignaciones', [CoordinadorIngresoController::class, 'adminAsignaciones'])->name('cooringreso.parqueadero.assignments');
    Route::get('/admin-parqueadero/crear', [CoordinadorIngresoController::class, 'crearPuesto'])->name('cooringreso.parqueadero.create');
    Route::post('/admin-parqueadero/guardar', [CoordinadorIngresoController::class, 'guardarPuesto'])->name('cooringreso.parqueadero.store');
    Route::get('/admin-parqueadero/editar/{id}', [CoordinadorIngresoController::class, 'editarPuesto'])->name('cooringreso.parqueadero.edit');
    Route::put('/admin-parqueadero/actualizar/{id}', [CoordinadorIngresoController::class, 'actualizarPuesto'])->name('cooringreso.parqueadero.update');
    Route::get('/admin-parqueadero/asignar/{id}', [CoordinadorIngresoController::class, 'asignarPuestoForm'])->name('cooringreso.parqueadero.assign');
    Route::post('/admin-parqueadero/asignar/guardar', [CoordinadorIngresoController::class, 'guardarAsignacionPuesto'])->name('cooringreso.parqueadero.assign.store');
    Route::get('/admin-parqueadero/asignacion/editar/{id}', [CoordinadorIngresoController::class, 'editarAsignacionPuesto'])->name('cooringreso.parqueadero.assign.edit');
    Route::get('/admin-parqueadero/liberar/puesto/{id}', [CoordinadorIngresoController::class, 'liberarPuesto'])->name('cooringreso.parqueadero.liberate');
    Route::get('/admin-parqueadero/liberar/asignacion/{id}', [CoordinadorIngresoController::class, 'liberarAsignacion'])->name('cooringreso.parqueadero.liberate.assignment');
    Route::get('/admin-parqueadero/buscar-funcionario-ajax', [CoordinadorIngresoController::class, 'buscarFuncionarioAjax'])->name('cooringreso.parqueadero.buscar_funcionario.ajax');
    Route::get('/admin-parqueadero/buscar-empleado-ajax', [CoordinadorIngresoController::class, 'buscarDatosEmpleadoAjax'])->name('cooringreso.buscar_empleado.ajax');
    
    // Exportar Bitácora
    Route::get('/admin-parqueadero/bitacora/exportar', [CoordinadorIngresoController::class, 'exportarHistorico'])->name('cooringreso.bitacora.export');

    // MODULO FUNCIONARIOS (gestión independiente antes de asignar parqueadero)
    Route::get('/admin-parqueadero/funcionarios',                               [CoordinadorIngresoController::class, 'adminFuncionarios'])->name('cooringreso.funcionarios.index');
    Route::get('/admin-parqueadero/funcionarios/crear',                         [CoordinadorIngresoController::class, 'crearFuncionario'])->name('cooringreso.funcionarios.create');
    Route::post('/admin-parqueadero/funcionarios/guardar',                      [CoordinadorIngresoController::class, 'guardarFuncionario'])->name('cooringreso.funcionarios.store');
    Route::get('/funcionarios/edit/{id}', [CoordinadorIngresoController::class, 'editarFuncionario'])->name('cooringreso.funcionarios.edit');
    Route::put('/funcionarios/update/{id}', [CoordinadorIngresoController::class, 'actualizarFuncionario'])->name('cooringreso.funcionarios.update');
    Route::get('/funcionarios/inactivar/{id}', [CoordinadorIngresoController::class, 'inactivarFuncionario'])->name('cooringreso.funcionarios.inactivate');
    Route::delete('/funcionarios/delete/{id}', [CoordinadorIngresoController::class, 'eliminarFuncionario'])->name('cooringreso.funcionarios.destroy');
    Route::get('/admin-parqueadero/funcionarios/asignar-puesto/{id}',           [CoordinadorIngresoController::class, 'asignarPuestoAFuncionario'])->name('cooringreso.funcionarios.assign');
    Route::post('/admin-parqueadero/funcionarios/asignar-puesto/guardar',       [CoordinadorIngresoController::class, 'guardarPuestoFuncionario'])->name('cooringreso.funcionarios.assign.store');
    Route::get('/admin-parqueadero/funcionarios/desasignar/{id}',               [CoordinadorIngresoController::class, 'desasignarPuestoFuncionario'])->name('cooringreso.funcionarios.unassign');

    // PERMISOS ESPECIALES (fin de semana / festivos) para vehículos PARTICULARES
    Route::get('/permisos-especiales',         [CoordinadorIngresoController::class, 'listarPermisosEspeciales'])->name('cooringreso.permisos.index');
    Route::post('/permisos-especiales',        [CoordinadorIngresoController::class, 'crearPermisoEspecial'])->name('cooringreso.permisos.store');
    Route::delete('/permisos-especiales/{id}', [CoordinadorIngresoController::class, 'eliminarPermisoEspecial'])->name('cooringreso.permisos.destroy');

    // MODULO INGRESOS TEMPORALES (Contratistas / Empresa / Vigencia)
    Route::get('/admin-parqueadero/temporales',                                 [CoordinadorIngresoController::class, 'adminTemporales'])->name('cooringreso.temporales.index');
    Route::get('/admin-parqueadero/temporales/crear',                           [CoordinadorIngresoController::class, 'crearTemporal'])->name('cooringreso.temporales.create');
    Route::post('/admin-parqueadero/temporales/guardar',                        [CoordinadorIngresoController::class, 'guardarTemporal'])->name('cooringreso.temporales.store');
    Route::get('/admin-parqueadero/temporales/editar/{id}',                     [CoordinadorIngresoController::class, 'editarTemporal'])->name('cooringreso.temporales.edit');
    Route::put('/admin-parqueadero/temporales/actualizar/{id}',                 [CoordinadorIngresoController::class, 'actualizarTemporal'])->name('cooringreso.temporales.update');
    Route::delete('/admin-parqueadero/temporales/eliminar/{id}',                [CoordinadorIngresoController::class, 'eliminarTemporal'])->name('cooringreso.temporales.destroy');

    
    // Administración (Coordinador)
    Route::get('/gestion/contratistas', [ContratistaRegRegistroController::class, 'gestionContratistas'])->name('coordinador.ingresos');
    Route::post('/gestion/contratistas/store', [ContratistaRegRegistroController::class, 'storeContratista'])->name('coordinador.ingresos.store');
    Route::get('/informe', [ContratistaRegRegistroController::class, 'informeIngreso'])->name('coordinador.informe');

    //exportar los pdf de form de conductores
    Route::get('/inspeccion/ver/{id}', [CoordinadorIngresoController::class, 'verInspeccion'])->name('coordinador.inspeccion.ver');
    Route::get('/inspeccion/exportar/{id}', [CoordinadorIngresoController::class, 'exportarPdf'])->name('coordinador.inspeccion.exportar');
    Route::get('/historial/{placa}', [CoordinadorIngresoController::class, 'historial'])->name('coordinador.historial');
   

});



Route::group(['prefix' => 'tecnico/soporte'], function()
{
    Route::get('/', [RegistroIpController::class,'segmento'])->name('tecnico.soporte.noticia')->middleware(TecnicoSoporteMiddleware::class);
     Route::get('/listado/ips', [RegistroIpController::class,'listado'])->name('tecnico.soporte.listado')->middleware(TecnicoSoporteMiddleware::class);
      Route::post('/almacenar/registro', [RegistroIpController::class,'registro_store'])->name('tecnico.soporte.registro_ip.save')->middleware(TecnicoSoporteMiddleware::class);
      
      Route::get('/registrar/ip/{id}', [RegistroIpController::class,'editar_registro_ip'])->name('tecnico.soporte.editar.registro.ip')->middleware(TecnicoSoporteMiddleware::class);
      Route::put('/registrar/ip/{id}', [RegistroIpController::class,'put_registro_ip'])->name('tecnico.soporte.editar.ip.edit')->middleware(TecnicoSoporteMiddleware::class);
      
      //eliminar ip
      Route::delete('/eliminar/ip/{id}', [RegistroIpController::class,'eliminarIp'])->name('tecnico.soporte.eliminar.ip')->middleware(TecnicoSoporteMiddleware::class);
      
      //registro de segmento
      Route::get('/registrar/segmento/', [RegistroIpController::class,'segmento'])->name('tecnico.soporte.editar.segmento.ip')->middleware(TecnicoSoporteMiddleware::class);
      Route::post('/segmento/ip/', [RegistroIpController::class,'save_segmento'])->name('tecnico.soporte.segmento.ip.save')->middleware(TecnicoSoporteMiddleware::class);
      Route::get('/segmento/ip/{id}', [RegistroIpController::class,'editar_segmento'])->name('tecnico.soporte.segmento.ip.edit')->middleware(TecnicoSoporteMiddleware::class);
      
      Route::put('/segmento/ip/{id}', [RegistroIpController::class,'edit_segmento'])->name('tecnico.soporte.segmento.ip.update')->middleware(TecnicoSoporteMiddleware::class);
      
      Route::delete('/eliminar/segmento/{id}', [RegistroIpController::class,'delete_segmento'])->name('tecnico.soporte.eliminar.segmento')->middleware(TecnicoSoporteMiddleware::class);
      
      
      
      //formato soporte enviado por email y pdf
      Route::get('/formulario/soporte',              [SoporteUsuarioController::class,'index'])->name('diligenciar.soporte');
      //Route::get('/enviar/soporte/pdf',              [SoporteUsuarioController::class,'CrearPfd'])->name('enviar.soporte.pdf');
      Route::post('/almacenar/soporte/pdf',              [SoporteUsuarioController::class,'almacenarDatos'])->name('enviar.soporte.pdf.post');
     // Route::get('/enviar/soporte/pdf',              [SoporteUsuarioController::class,'almacenarDatos'])->name('enviar.soporte.pdf.post');
     
     //LISTADO DE CASOS
     Route::GET('/soporte/listado/casos',              [SoporteUsuarioController::class,'ServiciosAtendidos'])->name('listado.caso.coordinador');
     
     //SOPORTE PDF SIN NUMERO DE CASO
      Route::GET('/soporte/pdf/sin/caso',              [SoporteUsuarioController::class,'formularioSinCaso'])->name('sincaso.soporte.pdf.post');
     // Route::POST('/enviar/soporte/pdf',              [SoporteUsuarioController::class,'almacenarDatosSinCaso'])->name('guardar.sincaso.soporte.pdf.post');
      
      //consulta de cedula
      Route::get('/consulta/cedula/corte/{cedula}', [SoporteUsuarioController::class,'consultaCedulaE'])->name('conculta.cedula.emple');
       //consulta de inventario placa
      Route::get('/consulta/inventario/{placa}', [SoporteUsuarioController::class,'consultaPlacaE'])->name('conculta.placa.equipo');
      
      //asignar tecnico
      Route::put('/asignar/tecnico/{id}', [SoporteUsuarioController::class,'asignarTecnico'])->name('asignar.tecnico.equipo');

      //LISTdo de servicios
      Route::get('/listado/soportes/',              [SoporteUsuarioController::class,'listadoServicios'])->name('listado.soportes.servicio');
      Route::get('/tramitar/soporte/firmar/{id}',              [SoporteUsuarioController::class,'AtenderServicios'])->name('tramitar.soporte.servicio');
      Route::put('/tramitar/soporte/{id}',              [SoporteUsuarioController::class,'CerrarServicio'])->name('cerrar.soporte.servicio');
      Route::get('/listado/firmas/pendientes',              [SoporteUsuarioController::class,'PendienteFirma'])->name('pendiente.firma.servicio');
      //Route::get('/firma/documento/soporte/{id}/{numcaso}/{tecnico}/{fecha}',              [FirmaExternaController::class,'PendienteFirma'])->name('pendiente.firma.servicio');
      
          //siniestros
        Route::get('siniestros',[SiniestroController::class,'index'])->name('tecnico.siniestro');
        Route::get('siniestros/{id}',[SiniestroController::class,'edit'])->name('tecnico.siniestro.edit');
        Route::put('siniestros/update/{id}',[SiniestroController::class,'update'])->name('tecnico.siniestro.update');
        
        Route::get('siniestros/aprobar/{id}',[SiniestroController::class,'aprobar'])->name('tecnico.siniestro.aprobar');
        Route::get('siniestros/denegar/{id}',[SiniestroController::class,'denegar'])->name('tecnico.siniestro.denegar');
        
        //REENVIO DE CORREO
        Route::get('reenvio/correo/',[SoporteUsuarioController::class,'ReenviarCorreo'])->name('tecnico.siniestro.reenviar.correo');
        
        //FORMATO COMODATO
        Route::get('firma/acta/instalacion/impresora',[ComodatoImpresoraController::class,'index'])->name('tecnico.firma.comodato.impresora');
        Route::post('firma/acta/instalacion/impresora/save',              [ComodatoImpresoraController::class,'store'])->name('tecnico.firma.comodato.impresora.store');
        
        Route::get('consulta/serie/impresora/{serial}',[ComodatoImpresoraController::class,'show'])->name('tecnico.show.serial.impresora');
        
        //comodato impresoras
	    Route::get('listado/comodato/impresora/',[ComodatoImpresoraController::class,'listadoTec'])->name('tecnico.show.comodato.impresora');
	    
	    //descargarPdf
       Route::get('descarga/listado/impresora/',[ComodatoImpresoraController::class,'descargarPdf'])->name('tecnico.descargas.listado.impresora');
       
       //TODO EN UNO ACTAS 
        Route::get('firma/acta/instalacion/todoenuno',[TodoUnoController::class,'index'])->name('tecnico.firma.instalacion.todoenuno');
        Route::post('firma/acta/instalacion/todoenuno/save',              [TodoUnoController::class,'store'])->name('tecnico.firma.instalacion.todoenuno.store');
        
        //LISTADO JSON
        Route::get('lista/instalacion/todoenuno/{placa}',[TodoUnoController::class,'consulta'])->name('tecnico.consulta.todoenuno');
        
        
        //PortatilesController
         //FORMATO PORTATILES
        Route::get('firma/acta/instalacion/portatiles',[PortatilesController::class,'index'])->name('tecnico.firma.portatiles');
        Route::post('firma/acta/instalacion/portatil/save',              [PortatilesController::class,'store'])->name('tecnico.firma.portatiles.store');
        
        Route::get('consulta/serie/portatil/{serial}',[PortatilesController::class,'show'])->name('tecnico.show.serial.portatiles');
        
        //comodato impresoras
	    Route::get('listado/instalacion/portatil/',[PortatilesController::class,'listadoTec'])->name('tecnico.show.listado.portatiles');
	    
	    //descargarPdf
       Route::get('descarga/listado/portatil/',[PortatilesController::class,'descargarPdf'])->name('tecnico.descargas.listado.portatiles');
       
       
        //TODO EN UNO INSTALACION
        Route::get('firma/acta/instalacion/todo_en_uno',[TodoEnUnoController::class,'index'])->name('tecnico.firma.todo_en_uno');
        Route::post('firma/acta/instalacion/todo_en_uno/save',              [TodoEnUnoController::class,'store'])->name('tecnico.firma.todo_en_uno.store');
        //CONSULTA CEDULA TODO EN UNO
        Route::get('consulta/cedula/asignacion/{cedula}',[TodoEnUnoController::class,'consultaCedulaE'])->name('consulta.cedula.asignacion.todoenuno');
        
        
        
        Route::get('consulta/serie/todo_en_uno/{serial}',[TodoEnUnoController::class,'show'])->name('tecnico.show.serial.todo_en_uno');
        
        //comodato impresoras
	    Route::get('listado/instalacion/todo_en_uno/',[TodoEnUnoController::class,'listadoTec'])->name('tecnico.show.listado.todo_en_uno');
	    
	    //descargarPdf
       Route::get('descarga/listado/todo_en_uno/',[TodoEnUnoController::class,'descargarPdf'])->name('tecnico.descargas.listado.todo_en_uno');
       
       //formato de inventario
       Route::get('formulario/inventario/equipos/',[SoporteUsuarioController::class,'indexInventario'])->name('tecnico.inventario.equipos');
       Route::post('formulario/inventario/equipos/save',[SoporteUsuarioController::class,'saveInventario'])->name('tecnico.inventario.equipos.save');
       
       
       //lista asistencia tecnicos
       Route::get('asistencia/',[AsistenciaTecnicoController::class,'index'])->name('tecnico.asistencia');
       Route::get('asistencia/listado',[AsistenciaTecnicoController::class,'indexListado'])->name('tecnico.asistencia.listado');
       Route::post('asistencia/ingreso',[AsistenciaTecnicoController::class,'store'])->name('tecnico.asistencia.ingreso');
       Route::post('asistencia/salida',[AsistenciaTecnicoController::class,'storeSalida'])->name('tecnico.asistencia.salida');
       
       
        

});

Route::group(['prefix' => 'almacen'], function()
{
    
       Route::get('/',[AlmacenController::class,'Index'])->name('almacen.index');
       Route::get('/solicitudes',[AlmacenController::class,'Solicitudes'])->name('almacen.Solicitudes');
       Route::get('/historial',[AlmacenController::class,'Historial'])->name('almacen.Historial');
       Route::get('/elementos',[AlmacenController::class,'Elementos'])->name('almacen.Elementos');
       Route::get('/solicitud/excel',[AlmacenController::class,'solicitudExcel'])->name('almacen.solicitudelemento.excel');
       
       //DAR SOLUCION A DESPACHO
       Route::get('/solicitud/despacho/{id}',[AlmacenController::class,'SolicitudDespacho'])->name('almacen.solicitudelemento.despacho');
       
       //notificacion a despacho
       Route::post('/solicitud/notificacion',[AlmacenController::class,'sendEmail'])->name('almacen.Elementos.Notificacion');
       // web.php
       Route::post('/update-cantidad', [AlmacenController::class, 'updateCantidad'])->name('almacen.updateCantidad');
       //historial excel
       Route::get('/solicitud/historico/excel',[AlmacenController::class,'solicitudExcelHistorial'])->name('almacen.solicitud.Historial.excel');
              //historial excel
       Route::get('/estado/elemento',[AlmacenController::class,'Elementos'])->name('almacen.Elementos');
       
       Route::get('/generate-csv/{num_seguimiento}', [AlmacenController::class, 'generateCsv'])->name('generate.csv');
       Route::get('/generate-csv-solicitud/{num_seguimiento}', [AlmacenController::class, 'generateCsvPedido'])->name('generate.csv.solicitud');
       
       Route::post('/cambiar-estado-elemento', [AlmacenController::class, 'cambiarEstado'])->name('cambiar.estado.elemento');
       //cambiarEstadoCircuito
       Route::post('/cambiar-estado-elemento/circuito', [AlmacenController::class, 'cambiarEstadoCircuito'])->name('cambiar.estado.elemento.circuito');
       
       //cargar Elementos por Excel
       Route::get('/inventario/cargar', [AlmacenController::class, 'indexExcel'])->name('almacen.inventario.cargar');
       Route::post('/inventario/importar', [AlmacenController::class, 'importarExcel'])->name('almacen.inventario.importar');
       
       //cargar Elementos por Excel Circuito
       Route::post('/inventario/importar/circuito', [AlmacenController::class, 'importarElementosDesdeExcelCircuito'])->name('inventario.importarExcel.Circuito');

       
       //elementos Circuitos
       Route::get('/inventarios-circuitos/create', [AlmacenController::class, 'ElementoCircuito'])->name('inventarios_circuitos.create');
       Route::post('/inventarios-circuitos', [AlmacenController::class, 'ElementoCircuitoSave'])->name('inventarios_circuitos.save');
       
       Route::get('/solicitudes/dashboard', [AlmacenController::class, 'dashboard'])->name('solicitudes.dashboard');
       
       Route::get('/solicitudes/mis_solicitudes', [AlmacenController::class, 'misSolicitudes'])->name('solicitudes.missolicitudes');



       

});





//RUTA DE CRON PARA CERRAR INGRESOS 
    Route::get('/cierre/automatico/dias/anteriores', [PrincipalController::class,'CiereVisitasAutomaticamente'])->name('monitoreo.cierre.automatico');
    



Route::get('/carnet/{id}', [CarnetController::class, 'mostrar'])->name('carnet.mostrar');
    




//SOLICITUD VIRTUAL DE AUDIENCIAS
/*Route::get('solicitud/audiencia/virtual','Audiencias\SolicitudAudienciaController@index');
Route::get('solicitud/audiencia/virtual/det/log-4512{id}455248','Audiencias\SolicitudAudienciaController@storedetenido');
Route::post('solicitud/audiencia/virtual/verificar/correo','Audiencias\SolicitudAudienciaController@verificarCorreo')->name('verificar.correo.despacho');

Route::post('solicitud/audiencia/virtual/','Audiencias\SolicitudAudienciaController@store')->name('virtual.audiencia');
Route::post('solicitud/audiencia/virtual/confirmar','Audiencias\SolicitudAudienciaController@confirmarAudiencia')->name('virtual.audiencia.confirmar');
Route::post('solicitud/audiencia/virtual/detenido','Audiencias\SolicitudAudienciaController@detenido')->name('virtual.audiencia.detenido');
Route::delete('solicitud/audiencia/virtual/detenido/destroy/{id}','Audiencias\SolicitudAudienciaController@destroy')->name('virtual.audiencia.detenido.eliminar');
*/

//TECNICOS VIRTUAL DE AUDIENCIAS
/*Route::group(['prefix' => 'tecnico'], function()
{
	Route::get('/solicitud/audiencia/virtual','Audiencias\TecnicoAudienciaController@index')->name('tecnico.solicitud');
	Route::get('/solicitud/audiencia/virtual/pendientes','Audiencias\TecnicoAudienciaController@pendiente')->name('tecnico.solicitud.pendiente');
	Route::get('/solicitud/audiencia/virtual/pen-4562{id}89568','Audiencias\TecnicoAudienciaController@show')->name('tecnico.solicitud.show');

});*/

/* auth()->routes();

Route::get('/home', 'HomeController@index')->name('home');*/

use App\Http\Controllers\Monitoreo\ConductorController;

Route::middleware(['conductor'])->prefix('conductores')->group(function () {
    Route::get('/', [ConductorController::class, 'index'])->name('conductores.index');
    Route::get('/inspeccion/crear/{placa}', [ConductorController::class, 'crearInspeccion'])->name('conductores.inspeccion.crear');
    Route::post('/inspeccion/guardar', [ConductorController::class, 'guardarInspeccion'])->name('conductores.inspeccion.guardar');
    Route::get('/inspeccion/ver/{id}', [ConductorController::class, 'verInspeccion'])->name('conductores.inspeccion.ver');
    Route::get('/inspeccion/exportar/{id}', [ConductorController::class, 'exportarPdf'])->name('conductores.inspeccion.exportar');
    Route::get('/historial/{placa}', [ConductorController::class, 'historial'])->name('conductores.historial');
    Route::get('/buscar-conductor/{cedula}', [ConductorController::class, 'buscarConductor'])->name('conductores.buscar');
});

//Ruta para correccion de texto
Route::get('/correccion/texto', function () {
    return view('servicio.correccion.texto');
})->name('correccion.texto');

// ==========================================
// MÓDULO SOLICITUD DE INGRESO (Autorización) Administrador
// ==========================================
Route::middleware(['auth'])->group(function () {
    // Rutas para el administrador (Almacén)
    Route::prefix('administrador/ingresos')->group(function () {
        Route::get('/', [AdminAutorizacionIngresoController::class, 'index'])->name('admin.solicitud_ingreso.index');
        Route::post('/{id}/responder', [AdminAutorizacionIngresoController::class, 'responder'])->name('admin.solicitud_ingreso.responder');
        Route::get('/{seguimiento}/pdf', [AdminAutorizacionIngresoController::class, 'descargarPdf'])->name('admin.solicitud_ingreso.pdf');
    });
});



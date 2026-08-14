<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServicioJudicial extends Model
{
    protected $table = 'servicios_judiciales';
    
    protected $fillable = [
        'despacho_id',
        'despacho',
        'email_despacho',
        'servicio',
        'tipo_servicio',
        'contacto_direccion',
        'contacto_telefono',
        'horario_atencion',
        'enlace_portal',
        'observaciones',
        'otro_servicio'
    ];
    
    protected $casts = [
        'horario_atencion' => 'array'
    ];
    
    public static function serviciosPredefinidos()
    {
        return [
        'Alimentos en el exterior',
        'Desarchivo de procesos',
        'Radicaci&oacute;n de demandas, acciones constitucionales y otras solicitudes',
        'Vigilancia Judicial Administrativa',
        'Informaci&oacute;n sobre el pago de sentencias y conciliaciones - DEAJ',
        'Informaci&oacute;n Reparto Oficina de Apoyo Penal',
        'Consulta &oacute;rdenes de captura vigente con fecha de los hechos anterior al a&ntilde;o 2005',
        'Dep&oacute;sitos Judiciales',
        'Diligencia Acta de Compromiso Penal',
        'Presentaciones personales para las medidas de aseguramiento no privativas de la libertad',
        'Autorizaci&oacute;n especiales de personas privadas de la libertad (PPL)',
        'Registro de solicitudes de audiencias de control de garant&iacute;as',
        'Registro de escritos de acusaci&oacute;n para juzgados penales de conocimiento',
        'Radicaci&oacute;n de memoriales',
        'Consulta de programaci&oacute;n y grabaciones de audiencias judiciales',
        'Reclamaci&oacute;n sobre la prescripci&oacute;n de dep&oacute;sitos judiciales',
        'Radicaci&oacute;n de demandas, acciones constitucionales y otras solicitudes',
        'Tr&aacute;mites cobro coactivo Direcciones Seccionales',
        'Radicaci&oacute;n de demandas, acciones constitucionales y otras solicitudes',
        'Consulta de procesos nacional unificada',
        'Validaci&oacute;n de sentencias judiciales',
        'Radicaci&oacute;n de demandas, acciones constitucionales y otras solicitudes',
        'Consulta de personas emplazadas',
        'Consulta de Programaci&oacute;n y grabaciones de audiencias judiciales',
        'Reclamaci&oacute;n sobre la prescripci&oacute;n de dep&oacute;sitos judiciales',
        'Consulta de Programaci&oacute;n y grabaciones de audiencias judiciales',
        'Biblioteca Virtual - SIDN',
        'Tr&aacute;mites cobro coactivo Direcciones Seccionales'
        ];
    }
    
    public static function despachosDisponibles()
    {
        return [
            'Despacho 1 - Jurisdicción Civil',
            'Despacho 2 - Jurisdicción Penal',
            'Despacho 3 - Jurisdicción Familia',
            'Despacho 4 - Jurisdicción Laboral',
            'Despacho 5 - Jurisdicción Administrativo'
        ];
    }
}
<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class EncuestaExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        // Unificamos todas las categorías con su observación en filas individuales
        return collect(DB::select("
            SELECT
                -- Email
                COALESCE(email, '') AS valor_email,
                COALESCE(observaciones_email, '') AS observacion_email,
            
                -- Página Rama Judicial
                COALESCE(pagina_rama_judicial, '') AS valor_paginaramajudicial,
                COALESCE(observaciones_paginaramajudicial, '') AS observacion_paginaramajudicial,
            
                -- Justicia XXI
                COALESCE(justiciaxxi, '') AS valor_justiciaxxi,
                COALESCE(observaciones_justiciaxxi, '') AS observacion_justiciaxxi,
            
                -- TYBA
                COALESCE(tybajusticiaxxi, '') AS valor_tybajusticiaxxi,
                COALESCE(observaciones_tybajusticiaxxi, '') AS observacion_tybajusticiaxxi,
            
                -- Internet
                COALESCE(internet, '') AS valor_internet,
                COALESCE(observaciones_internet, '') AS observacion_internet,
            
                -- Usuario Dominio
                COALESCE(usuariodominio, '') AS valor_usuariodominio,
                COALESCE(observaciones_usuariodominio, '') AS observacion_usuariodominio,
            
                -- Firma Electrónica
                COALESCE(firmaelectronica, '') AS valor_firmaelectronica,
                COALESCE(observaciones_firmaelectronica, '') AS observacion_firmaelectronica,
            
                -- Mesa de Ayuda
                COALESCE(mesadeayuda, '') AS valor_mesadeayuda,
                COALESCE(observaciones_mesadeayuda, '') AS observacion_mesadeayuda,
            
                -- Sala de Audiencia
                COALESCE(salaaudiencia, '') AS valor_salaaudiencia,
                COALESCE(observaciones_salaaudiencia, '') AS observacion_salaaudiencia,
            
                -- SIUG/SGDE
                COALESCE(siug_sgde, '') AS valor_siug_sgde,
                COALESCE(observaciones_siugj_sgde, '') AS observacion_siugj_sgde,
            
                -- Fecha
                created_at
            
            FROM encuesta
            WHERE created_at >= '2025-10-14'
            ORDER BY created_at DESC;


        "));
    }

    public function headings(): array
{
    return [
    'Email',
    'Observación Email',
    'Página Rama Judicial',
    'Observación Página Rama Judicial',
    'Justicia XXI',
    'Observación Justicia XXI',
    'TYBA',
    'Observación TYBA',
    'Internet',
    'Observación Internet',
    'Usuario Dominio',
    'Observación Usuario Dominio',
    'Firma Electrónica',
    'Observación Firma Electrónica',
    'Mesa de Ayuda',
    'Observación Mesa de Ayuda',
    'Sala de Audiencia',
    'Observación Sala de Audiencia',
    'SIUG-SGDE',
    'Observación SIUG-SGDE',
    'Fecha de Registro',
];

}


    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true, 'size' => 12]],
        ];
    }
}

<?php

namespace App\Exports;

use App\Models\InventarioSalaAudiencia;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\Exportable;

class InventarioExport implements FromCollection, WithHeadings, WithMapping
{
    use Exportable;

    protected $salas;

    public function __construct($salas = null)
    {
        $this->salas = $salas;
    }

    /**
     * Obtener la colecci��n de datos.
     */
    public function collection()
    {
        return $this->salas ?: InventarioSalaAudiencia::with(['usuario', 'elementosAsignados.elemento'])->get();
    }

    /**
     * Mapear cada fila del Excel.
     */
    public function map($sala): array
    {
        $rows = [];

        // Si la sala no tiene elementos
        if ($sala->elementosAsignados->isEmpty()) {
            $rows[] = [
                $sala->id,
                $sala->nombre,
                $sala->ciudad,
                $sala->municipio,
                $sala->sede,
                $sala->direccion,
                $sala->piso,
                $sala->observaciones_generales ?: 'SIN OBSERVACIONES',
                'N/A',
                'N/A',
                'N/A',
                'N/A',
                optional($sala->usuario)->full_name ?? 'N/A'
            ];
        } else {
            $first = true;
            foreach ($sala->elementosAsignados as $el) {
                $rows[] = [
                    $sala->id,
                    $sala->nombre,
                    $sala->municipio,
                    $sala->sede,
                    $sala->direccion,
                    $sala->piso,
                    $first ? ($sala->observaciones_generales ?: 'SIN OBSERVACIONES') : '', // �9�6 Solo la primera vez
                    $el->elemento->codigoElemento ?? 'N/A',
                    $el->elemento->nombreElemento ?? 'N/A',
                    $el->cantidad ?? 1,
                    $el->estado ?? 'N/A',
                    $el->observaciones ?? 'N/A',
                    optional($sala->usuario)->full_name ?? 'N/A'
                ];
                $first = false;
            }
        }

        return $rows;
    }

    /**
     * Encabezados de la hoja de Excel.
     */
    public function headings(): array
    {
        return [
            "ID SALA",
            "NOMBRE SALA",
            "MUNICIPIO",
            "SEDE",
            "DIRECCI�0�7N",
            "PISO",
            "OBSERVACIONES SALA",
            "C�0�7DIGO ELEMENTO",
            "NOMBRE ELEMENTO",
            "CANTIDAD",
            "ESTADO",
            "OBSERVACIONES ELEMENTO",
            "USUARIO RESPONSABLE"
        ];
    }
}

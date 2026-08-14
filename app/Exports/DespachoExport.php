<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DespachoExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        $despachos = DB::select("
            SELECT 
                codigoDespacho, 
                nombreDespacho, 
                (SELECT ciudades.nombreCiudad FROM ciudades WHERE ciudades.codigoCiudad = despachos.codCiudad) AS ciudad, 
                direccion, 
                sede, 
                telefono, 
                extension, 
                correoD,
                districto AS distrito,
                circuito
            FROM despachos 
            WHERE estado IS NULL OR LOWER(TRIM(estado)) != 'Inactivo'
            ORDER BY codigoDespacho ASC
        ");

        return collect($despachos)->map(function ($item) {
            return [
                'codigo'      => $item->codigoDespacho,
                'nombre'      => $item->nombreDespacho,
                'ciudad'      => strtoupper($item->ciudad ?? ''),
                'direccion'   => $item->direccion,
                'sede'        => $item->sede ?? '',
                'telefono'    => $item->telefono,
                'extension'   => $item->extension ?? '',
                'correo'      => $item->correoD,
                'distrito'    => $item->distrito ?? '',
                'circuito'    => $item->circuito ?? '',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'CÓDIGO',
            'NOMBRE DESPACHO',
            'CIUDAD',
            'DIRECCIÓN',
            'SEDE',
            'TELÉFONO',
            'EXTENSIÓN',
            'CORREO',
            'DISTRITO',
            'CIRCUITO',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => [
                    'bold'  => true,
                    'size'  => 12,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType'   => 'solid',
                    'startColor' => ['rgb' => '003F75'],
                ],
                'alignment' => [
                    'horizontal' => 'center',
                    'vertical'   => 'center',
                ],
            ],
        ];
    }
}

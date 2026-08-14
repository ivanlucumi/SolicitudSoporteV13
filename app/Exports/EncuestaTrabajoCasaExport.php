<?php

namespace App\Exports;

use App\Models\EncuestaTrabajoCasa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EncuestaTrabajoCasaExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return EncuestaTrabajoCasa::orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Cédula',
            'Correo Electrónico',
            'Código Despacho',
            'Despacho',
            'Ciudad',
            'Cuenta con VPN',
            'Requiere VPN',
            'Cuenta todos los elementos',
            'Computador',
            'Impresora',
            'Escáner',
            'Conectividad (Internet)',
            'Silla Ergonómica',
            'Escritorio',
            'Aplicaciones',
            'Fecha de Registro'
        ];
    }

    public function map($encuesta): array
    {
        return [
            $encuesta->id,
            $encuesta->cedula,
            $encuesta->correo,
            $encuesta->cod_despacho,
            $encuesta->dependencia,
            $encuesta->ciudad,
            $encuesta->tiene_vpn ?? 'N/A',
            $encuesta->requiere_vpn ?? 'N/A',
            $encuesta->cuenta_todos_elementos ?? 'N/A',
            $encuesta->computador,
            $encuesta->impresora,
            $encuesta->escaner,
            $encuesta->conectividad,
            $encuesta->silla,
            $encuesta->escritorio,
            $encuesta->aplicaciones ?? 'N/A',
            $encuesta->created_at->format('Y-m-d H:i:s'),
        ];
    }
}

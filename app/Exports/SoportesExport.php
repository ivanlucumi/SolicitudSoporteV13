<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class SoportesExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $datos;

    public function __construct($datos)
    {
        $this->datos = $datos;
    }

    public function collection()
    {
        return collect($this->datos);
    }

    public function headings(): array
    {
        return [
            'Fecha Solicitud',
            'Despacho',
            'Funcionario (Solicitante)',
            'Identificación Solicitante',
            'Email Despacho',
            'Tipo Solicitud',
            'Medio Solicitud',
            'Solicitud',
            'Estado',
            'Quien da Solución',
            'Fecha Solución',
            'Respuesta'
        ];
    }

    public function map($registro): array
    {
        return [
            $registro->fecha_solicitud,
            $registro->despacho,
            $registro->funcionario,
            $registro->id_funcionario,
            $registro->email_despacho,
            $registro->tipo_solicitud,
            $registro->medio_solicitud,
            strip_tags($registro->solicitud),
            $registro->estado,
            $registro->quien_da_solucion,
            $registro->fecha_solucion,
            strip_tags($registro->respuesta)
        ];
    }
}

<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Carbon\Carbon;

class BiometriaIngresosExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
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
            'Fecha',
            'Hora',
            'Cédula / Identificación',
            'Nombres y Apellidos',
            'Acción',
            'Portería / Evento',
            'Observaciones Generales'
        ];
    }

    public function map($registro): array
    {
        $fecha = $registro->fecha_ingreso ?? $registro->fecha_salida;
        $hora = $registro->hora_ingreso ?? $registro->hora_salida;
        $accion = strtoupper($registro->accion);
        $porteria = $registro->direccion_ingreso ?? $registro->porteria_salida;

        return [
            $fecha,
            $hora,
            $registro->identificacion,
            trim($registro->p_nombre . ' ' . $registro->s_nombre . ' ' . $registro->p_apellido . ' ' . $registro->s_apellido),
            $accion,
            $porteria,
            $registro->observaciones
        ];
    }
}

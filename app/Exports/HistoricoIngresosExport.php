<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class HistoricoIngresosExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    protected $datos;

    public function __construct($datos)
    {
        $this->datos = $datos;
    }

    public function collection()
    {
        return $this->datos;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Cédula/Identificación',
            'Nombre Completo',
            'Juzgado / Despacho',
            'Placa',
            'Tipo',
            'Lugar/Portería',
            'Fecha Ingreso',
            'Hora Ingreso',
            'Hora Salida',
            'Duración (aprox)',
            'Novedades',
        ];
    }

    public function map($registro): array
    {
        $duracion = 'N/A';
        if ($registro->hora_ingreso && $registro->hora_salida) {
            try {
                $ing = \Carbon\Carbon::parse($registro->hora_ingreso);
                $sal = \Carbon\Carbon::parse($registro->hora_salida);
                $duracion = $ing->diffForHumans($sal, true);
            } catch (\Exception $e) {
                $duracion = 'Error';
            }
        }

        $despacho = 'N/A';
        if ($registro->empleado) {
            $cargo = $registro->empleado->cargo_titular ?? $registro->empleado->cargo;
            $despacho = trim($cargo . ' - ' . $registro->empleado->dependencia_titular);
        }

        return [
            $registro->id,
            $registro->cedula,
            $registro->nombre,
            $despacho,
            $registro->placa,
            $registro->tipo_ingreso,
            $registro->porteria . ' ' . $registro->edificio,
            $registro->fecha,
            $registro->hora_ingreso,
            $registro->hora_salida,
            $duracion,
            $registro->novedades,
        ];
    }
}

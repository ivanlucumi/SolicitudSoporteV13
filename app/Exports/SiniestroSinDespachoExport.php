<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SiniestroSinDespachoExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{
    use Exportable;

    protected array $filtros;

    public function __construct(array $filtros = [])
    {
        $this->filtros = $filtros;
    }

    public function collection()
    {
        // Despachos activos que NO tienen siniestro registrado (estados activos)
        $subQuery = DB::table('encuesta_siniestros')
            ->whereIn('estado', ['registrado', 'enviado', 'en_revision', 'cerrado'])
            ->select('despacho_codigo');

        $query = DB::table('despachos')
            ->leftJoin('ciudades', 'despachos.codCiudad', '=', 'ciudades.codigoCiudad')
            ->whereRaw("(despachos.estado IS NULL OR LOWER(TRIM(despachos.estado)) != 'Inactivo')")
            ->whereNotIn('despachos.codigoDespacho', $subQuery)
            ->select(
                'despachos.codigoDespacho',
                'despachos.nombreDespacho',
                'ciudades.nombreCiudad',
                'despachos.direccion',
                'despachos.correoD',
                'despachos.telefono',
                'despachos.circuito',
                'despachos.especialidad'
            );

        // Filtros opcionales
        if (!empty($this->filtros['despacho'])) {
            $query->where('despachos.nombreDespacho', 'LIKE', '%' . $this->filtros['despacho'] . '%');
        }
        if (!empty($this->filtros['ciudad'])) {
            $query->where('ciudades.nombreCiudad', 'LIKE', '%' . $this->filtros['ciudad'] . '%');
        }

        return $query->orderBy('despachos.nombreDespacho')->get()->map(function ($d) {
            return [
                'codigo'      => $d->codigoDespacho,
                'despacho'    => $d->nombreDespacho,
                'ciudad'      => $d->nombreCiudad,
                'direccion'   => $d->direccion,
                'correo'      => $d->correoD,
                'telefono'    => $d->telefono,
                'circuito'    => $d->circuito,
                'especialidad'=> $d->especialidad,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'CÓDIGO DESPACHO',
            'NOMBRE DEL DESPACHO / JUZGADO',
            'CIUDAD',
            'DIRECCIÓN',
            'CORREO',
            'TELÉFONO',
            'CIRCUITO',
            'ESPECIALIDAD',
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font'      => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF'], 'size' => 11],
                'fill'      => ['fillType' => 'solid', 'startColor' => ['argb' => 'FF27AE60']],
                'alignment' => ['horizontal' => 'center'],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 18, 'B' => 45, 'C' => 20,
            'D' => 35, 'E' => 35, 'F' => 16,
            'G' => 16, 'H' => 25,
        ];
    }
}

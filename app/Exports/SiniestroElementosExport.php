<?php

namespace App\Exports;

use App\Models\EncuestaSiniestroElemento;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Http\Request;

class SiniestroElementosExport implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{
    use Exportable;

    protected array $filtros;

    public function __construct(array $filtros = [])
    {
        $this->filtros = $filtros;
    }

    public function collection()
    {
        $query = EncuestaSiniestroElemento::with('siniestro')
            ->join('encuesta_siniestros', 'encuesta_siniestro_elementos.encuesta_siniestro_id', '=', 'encuesta_siniestros.id')
            ->whereIn('encuesta_siniestros.estado', ['registrado', 'enviado', 'en_revision', 'cerrado'])
            ->select(
                'encuesta_siniestros.consecutivo',
                'encuesta_siniestros.despacho_codigo',
                'encuesta_siniestros.despacho_nombre',
                'encuesta_siniestros.despacho_ciudad',
                'encuesta_siniestros.despacho_direccion',
                'encuesta_siniestros.titular_nombre',
                'encuesta_siniestros.titular_cedula',
                'encuesta_siniestros.titular_cargo',
                'encuesta_siniestros.fecha_siniestro',
                'encuesta_siniestros.estado',
                'encuesta_siniestros.observaciones_generales',
                'encuesta_siniestro_elementos.tipo_elemento',
                'encuesta_siniestro_elementos.nombre_elemento',
                'encuesta_siniestro_elementos.placa',
                'encuesta_siniestro_elementos.serial',
                'encuesta_siniestro_elementos.marca',
                'encuesta_siniestro_elementos.modelo',
                'encuesta_siniestro_elementos.estado_anterior',
                'encuesta_siniestro_elementos.estado_posterior',
                'encuesta_siniestro_elementos.descripcion_dano',
                'encuesta_siniestro_elementos.observaciones'
            );

        // Filtros opcionales
        if (!empty($this->filtros['despacho'])) {
            $query->where('encuesta_siniestros.despacho_nombre', 'LIKE', '%' . $this->filtros['despacho'] . '%');
        }
        if (!empty($this->filtros['ciudad'])) {
            $query->where('encuesta_siniestros.despacho_ciudad', 'LIKE', '%' . $this->filtros['ciudad'] . '%');
        }
        if (!empty($this->filtros['tipo_elemento'])) {
            $query->where('encuesta_siniestro_elementos.tipo_elemento', 'LIKE', '%' . $this->filtros['tipo_elemento'] . '%');
        }
        if (!empty($this->filtros['estado'])) {
            $query->where('encuesta_siniestros.estado', $this->filtros['estado']);
        }
        if (!empty($this->filtros['fecha_inicio'])) {
            $query->whereDate('encuesta_siniestros.fecha_siniestro', '>=', $this->filtros['fecha_inicio']);
        }
        if (!empty($this->filtros['fecha_fin'])) {
            $query->whereDate('encuesta_siniestros.fecha_siniestro', '<=', $this->filtros['fecha_fin']);
        }

        $estadoLabels = [
            'borrador'    => 'Borrador',
            'registrado'  => 'Registrado',
            'enviado'     => 'Enviado',
            'en_revision' => 'En Revisión',
            'cerrado'     => 'Cerrado',
        ];

        return $query->orderBy('encuesta_siniestros.fecha_siniestro', 'desc')->get()->map(function ($item) use ($estadoLabels) {
            return [
                'consecutivo'          => $item->consecutivo,
                'despacho_codigo'      => $item->despacho_codigo,
                'despacho'             => $item->despacho_nombre,
                'ciudad'               => $item->despacho_ciudad,
                'direccion'            => $item->despacho_direccion,
                'titular'              => $item->titular_nombre,
                'cedula_titular'       => $item->titular_cedula,
                'cargo_titular'        => $item->titular_cargo,
                'fecha_siniestro'      => $item->fecha_siniestro,
                'estado_siniestro'     => $estadoLabels[$item->estado] ?? ucfirst($item->estado),
                'tipo_elemento'        => $item->tipo_elemento,
                'nombre_elemento'      => $item->nombre_elemento,
                'placa'                => $item->placa,
                'serial'               => $item->serial,
                'marca'                => $item->marca,
                'modelo'               => $item->modelo,
                'descripcion_dano'     => $item->descripcion_dano,
                'observaciones'        => $item->observaciones,
                'obs_generales'        => $item->observaciones_generales,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'CONSECUTIVO',
            'CÓDIGO DESPACHO',
            'DESPACHO / JUZGADO',
            'CIUDAD',
            'DIRECCIÓN',
            'TITULAR',
            'CÉDULA TITULAR',
            'CARGO TITULAR',
            'FECHA SINIESTRO',
            'ESTADO SINIESTRO',
            'TIPO DE EQUIPO',
            'NOMBRE ELEMENTO',
            'PLACA',
            'SERIAL',
            'MARCA',
            'MODELO',
            'DESCRIPCIÓN DEL DAÑO',
            'OBSERVACIONES ELEMENTO',
            'OBSERVACIONES GENERALES',
        ];
    }

    public function styles(Worksheet $sheet): array
    {
        return [
            1 => [
                'font'      => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF'], 'size' => 11],
                'fill'      => ['fillType' => 'solid', 'startColor' => ['argb' => 'FF0A2A4A']],
                'alignment' => ['horizontal' => 'center'],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 22, 'B' => 40, 'C' => 18, 'D' => 30,
            'E' => 28, 'F' => 16, 'G' => 20, 'H' => 16,
            'I' => 16, 'J' => 22, 'K' => 25, 'L' => 14,
            'M' => 20, 'N' => 16, 'O' => 16, 'P' => 20,
            'Q' => 20, 'R' => 40, 'S' => 35, 'T' => 40,
        ];
    }
}

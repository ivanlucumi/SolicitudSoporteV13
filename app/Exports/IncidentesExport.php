<?php

namespace App\Exports;

use App\Models\ReporteAscensor;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class IncidentesExport implements FromQuery, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $fechaInicio;
    protected $fechaFin;
    protected $sede;
    protected $tipoIncidente;
    
    public function __construct($fechaInicio, $fechaFin, $sede, $tipoIncidente)
    {
        $this->fechaInicio = $fechaInicio;
        $this->fechaFin = $fechaFin;
        $this->sede = $sede;
        $this->tipoIncidente = $tipoIncidente;
    }
    
    public function query()
    {
        $query = ReporteAscensor::query()
            ->orderBy('fecha_reporte', 'desc')
            ->orderBy('hora_reporte', 'desc');
            
        if ($this->fechaInicio) {
            $query->where('fecha_reporte', '>=', $this->fechaInicio);
        }
        
        if ($this->fechaFin) {
            $query->where('fecha_reporte', '<=', $this->fechaFin);
        }
        
        if ($this->sede) {
            $query->where('sede', $this->sede);
        }
        
        if ($this->tipoIncidente) {
            $query->where('tipo_incidente', $this->tipoIncidente);
        }
        
        return $query;
    }
    
    public function headings(): array
    {
        return [
            'Código',
            'Fecha Reporte',
            'Hora Reporte',
            'Sede',
            'Ascensor',
            'Tipo Incidente',
            'hora_incidente',
            'Descripción',
            'Reportante',
            'Operador',
            'Estado',
            'Fecha Creación'
        ];
    }
    
    public function map($incidente): array
    {
        return [
            $incidente->codigoAsignado,
            $incidente->fecha_reporte,
            $incidente->hora_reporte,
            $incidente->sede,
            $incidente->ascensor,
            ucfirst($incidente->tipo_incidente),
            $incidente->hora_incidente,
            $incidente->descripcion,
            $incidente->nombre_reportante,
            $incidente->operador ?? 'N/A',
            ucfirst(str_replace('_', ' ', $incidente->estado)),
            $incidente->created_at,
        ];
    }
    
    public function styles(Worksheet $sheet)
    {
        return [
            // Estilo para la primera fila (encabezados)
            1 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FFD9D9D9'],
                ],
                'borders' => [
                    'bottom' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ],
        ];
    }
}
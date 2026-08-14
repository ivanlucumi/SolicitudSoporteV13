<?php

namespace App\Exports;

use App\Models\SolicitudPrestamoEquipo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class PrestamoEquiposExport implements FromCollection, WithHeadings
{
    use Exportable;

    protected $circuito;

    public function __construct($circuito = null)
    {
        $this->circuito = $circuito;
    }

    public function collection()
    {
        $query = SolicitudPrestamoEquipo::orderBy('created_at', 'desc');
        
        if ($this->circuito) {
            $query->where('circuito', $this->circuito);
        }

        $solicitudes = $query->get();
        $rows = [];

        foreach ($solicitudes as $sol) {
            foreach ((array)($sol->equipos ?? []) as $emp) {
                foreach ((array)($emp['elementos'] ?? []) as $el) {
                    $rows[] = [
                        'radicado'         => '#' . str_pad($sol->id, 4, '0', STR_PAD_LEFT),
                        'fecha_solicitud'  => $sol->created_at->format('d/m/Y h:i A'),
                        'despacho'         => $sol->despacho,
                        'codigo_despacho'  => $sol->codigo_despacho,
                        'cedula_titular'   => $sol->cedula_juez,
                        'nombre_titular'   => $sol->nombre_juez,
                        'cargo_titular'    => $sol->cargo_titular,
                        'cedula_empleado'  => $emp['cedula'] ?? '',
                        'nombre_empleado'  => $emp['nombre'] ?? '',
                        'cargo_empleado'   => $emp['cargo'] ?? '',
                        'lugar_uso'        => $emp['lugar'] ?? '',
                        'elemento'         => $el['elemento'] ?? '',
                        'placa'            => $el['placa'] ?? '',
                        'serial'           => $el['serial'] ?? '',
                        'marca'            => $el['marca'] ?? '',
                        'estado_fisico'    => $el['estado'] ?? '',
                        'entregado'        => (isset($el['entregado']) && $el['entregado']) ? 'SÍ' : 'NO',
                        'estado_solicitud' => $sol->estado,
                    ];
                }
            }
        }

        return collect($rows);
    }

    public function headings(): array
    {
        return [
            "RADICADO",
            "FECHA SOLICITUD",
            "DESPACHO",
            "CÓDIGO DESPACHO",
            "CÉDULA TITULAR",
            "NOMBRE TITULAR",
            "CARGO TITULAR",
            "CÉDULA EMPLEADO",
            "NOMBRE EMPLEADO",
            "CARGO EMPLEADO",
            "LUGAR DE USO",
            "ELEMENTO",
            "PLACA",
            "SERIAL",
            "MARCA",
            "ESTADO FÍSICO",
            "ENTREGADO",
            "ESTADO SOLICITUD",
        ];
    }
}

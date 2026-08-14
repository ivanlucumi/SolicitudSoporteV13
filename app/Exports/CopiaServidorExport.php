<?php

namespace App\Exports;

use App\Models\CopiaSeguridad;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class CopiaServidorExport implements FromCollection, WithHeadings
{
    protected $mes;
    protected $anio;

    public function __construct($mes, $anio)
    {
        $this->mes = $mes;
        $this->anio = $anio;
    }

    public function collection()
    {
        $query = CopiaSeguridad::query()
            ->when($this->mes, fn($q) => $q->whereMonth('fecha_copia', $this->mes))
            ->when($this->anio, fn($q) => $q->whereYear('fecha_copia', $this->anio));

        $registros = $query->get();

        return $registros->map(function ($r) {
            $usuario = DB::connection('mysql')
                ->table('users')
                ->where('id', $r->firma_quien_verifica)
                ->first();

            $nombre = $usuario ? $usuario->name . ' ' . $usuario->lastname : 'No firmado';
            $firma  = $usuario && $usuario->firma ? "✍️ " : '❌';

            return [
                'Fecha'          => $r->fecha_copia,
                'Servidor'       => $r->nombre_servidor,
                'Base de Datos'  => $r->base_datos,
                'Carpeta'        => $r->carpeta,
                'Estado'         => $r->estado,
                'Azure'          => $r->copia_azure,
                'Observaciones'  => $r->observaciones,
                'Fecha Carga'    => $r->created_at,
                'Usuario Firma'  => $nombre,
                'Firma'          => $firma,
            ];
        });
    }

    public function headings(): array
    {
        return [
            '📅 Fecha',
            '🖥 Servidor',
            '🗄 Base Datos',
            '📂 Carpeta',
            '⚡ Estado',
            '☁ Azure',
            '📝 Observaciones',
            '📅 Fecha Carga',
            '👤 Usuario',
            '✍️ Firma (base64)',
        ];
    }
}
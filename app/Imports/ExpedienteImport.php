<?php

namespace App\Imports;

use App\Models\EstadoExpediente;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;

class ExpedienteImport implements ToCollection, WithHeadingRow
{
    public $insertados = 0;
    public $omitidos = 0;

    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        $creado_por = Auth::check() ? Auth::user()->name . " " . Auth::user()->lastname : 'Importación Excel';

        foreach ($rows as $row) {
            // Ignorar filas vacías
            if (!isset($row['radicado']) || empty($row['radicado'])) {
                continue;
            }

            // Verificar si el expediente ya existe en esa sede
            $existe = EstadoExpediente::where('radicado', $row['radicado'])
                ->where('sede', $row['sede'])
                ->first();

            if ($existe) {
                $this->omitidos++;
                continue;
            }

            // Crear el expediente
            EstadoExpediente::create([
                'radicado'           => $row['radicado'],
                'ni'                 => $row['ni'] ?? '',
                'cedula_procesado'   => $row['cedula_procesado'] ?? '',
                'nombre_procesado'   => $row['nombre_procesado'] ?? '',
                'delito'             => $row['delito'] ?? '',
                'sede'               => $row['sede'] ?? '',
                'almacenado_en'      => $row['almacenado_en'] ?? '',
                'no_caja'            => $row['no_caja'] ?? '',
                'cuadernos'          => $row['cuadernos'] ?? 0,
                'folios'             => $row['folios'] ?? 0,
                'tipo_expediente'    => $row['tipo_expediente'] ?? '',
                'fecha_digitalizado' => isset($row['fecha_digitalizado']) ? $this->transformDate($row['fecha_digitalizado']) : null,
                'asunto_archivo'     => $row['asunto_archivo'] ?? '',
                'fecha_archivo'      => isset($row['fecha_archivo']) ? $this->transformDate($row['fecha_archivo']) : null,
                'observaciones'      => $row['observaciones'] ?? '',
                'creado_por'         => $creado_por,
                'estado'             => 'DISPONIBLE'
            ]);

            $this->insertados++;
        }
    }

    /**
     * Helper para transformar fecha de excel a string Y-m-d, si viene en formato serial numérico.
     */
    private function transformDate($value, $format = 'Y-m-d')
    {
        if (empty($value)) return null;

        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value))->format($format);
        } catch (\ErrorException $e) {
            // Si falla, significa que ya es un string de fecha como "2023-01-01"
            return \Carbon\Carbon::parse($value)->format($format);
        } catch (\Exception $e) {
            return null;
        }
    }
}

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
    public $fallas = 0;
    public $detalles_errores = [];

    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        // "creado por es el usuario que lo sube"
        $creado_por = Auth::check() ? Auth::user()->name . " " . Auth::user()->lastname : 'Importación Excel';

        $fila = 1;
        foreach ($rows as $row) {
            $fila++;
            
            // Ignorar filas vacías
            if (!isset($row['radicado']) || trim($row['radicado']) === '') {
                continue;
            }

            $radicado = trim((string)$row['radicado']);

            // "valida que radicado sea de 23 digitos ni mas ni menos"
            if (strlen($radicado) !== 23 || !ctype_digit($radicado)) {
                $this->fallas++;
                $this->detalles_errores[] = "Fila {$fila}: El radicado '{$radicado}' debe tener exactamente 23 dígitos.";
                continue;
            }

            // Verificar si el expediente ya existe en esa sede
            $sede = $row['sede'] ?? '';
            $existe = EstadoExpediente::where('radicado', $radicado)
                ->where('sede', $sede)
                ->first();

            if ($existe) {
                $this->omitidos++;
                $this->detalles_errores[] = "Fila {$fila}: Duplicado, el radicado '{$radicado}' ya existe en la sede '{$sede}'.";
                continue;
            }

            // Crear el expediente
            EstadoExpediente::create([
                'radicado'           => $radicado,
                'ni'                 => $row['ni'] ?? '',
                'cedula_procesado'   => $row['cedula_procesado'] ?? '',
                'nombre_procesado'   => $row['nombre_procesado'] ?? '',
                'delito'             => $row['delito'] ?? '',
                'sede'               => $sede,
                'no_caja'            => $row['no_caja'] ?? '',
                'almacenado_en'      => $row['almacenado_en'] ?? '',
                'cuadernos'          => $row['cuadernos'] ?? 0,
                'folios'             => $row['folios'] ?? 0,
                'tipo_expediente'    => $row['tipo_expediente'] ?? '',
                'fecha_digitalizado' => isset($row['fecha_digitalizado']) ? $this->transformDate($row['fecha_digitalizado']) : null,
                'asunto_archivo'     => $row['asunto_archivo'] ?? '',
                'fecha_archivo'      => isset($row['fecha_archivo']) ? $this->transformDate($row['fecha_archivo']) : null,
                'observaciones'      => $row['observaciones'] ?? '',
                'creado_por'         => $creado_por,
                'estado'             => !empty($row['estado']) ? $row['estado'] : 'DISPONIBLE'
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
            if (is_numeric($value)) {
                return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value))->format($format);
            } else {
                return \Carbon\Carbon::parse($value)->format($format);
            }
        } catch (\Throwable $e) {
            return null;
        }
    }
}

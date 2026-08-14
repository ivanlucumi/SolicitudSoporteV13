<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Illuminate\Support\Facades\Log;
use App\Models\Empleado;
use Carbon\Carbon;

class EmpleadosImports implements ToCollection, WithChunkReading
{
    public $rowsImported = 0;
    public $rowsSkipped = 0;
    public $rowsError = 0;

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {

            try {

                if (isset($row[0]) && $row[0] == 'CODIGO_SECCIONAL') {
                    continue;
                }

                $cedula = isset($row[6]) ? preg_replace('/[^0-9]/', '', $row[6]) : null;

                if (!$cedula) {
                    $this->rowsSkipped++;
                    continue;
                }

                $nombre = strtoupper(trim(($row[14] ?? '') . ' ' . ($row[15] ?? '')));
                $apellido = strtoupper(trim(($row[12] ?? '') . ' ' . ($row[13] ?? '')));

                $fechaExpedicion = $this->parseFecha($row[5] ?? null);
                $fechaFin = $this->parseFecha($row[28] ?? null);
                $fechaRetiro = $this->parseFecha($row[19] ?? null);

                if (empty($fechaFin)) {
                    $fechaFin = $fechaRetiro;
                }

                // ==========================================
                // 🔥 ARRAY DINÁMICO (CLAVE DE LA SOLUCIÓN)
                // ==========================================
                $dataUpdate = [
                    'nameE' => $nombre,
                    'lastnameE' => $apellido,
                    'clase_nombramiento' => strtoupper(trim($row[25] ?? '')),
                    'ciudad_ubicacion_laboral' => strtoupper(trim($row[39] ?? '')),
                    'cod_despacho' => $row[0] ?? null,
                    'fecha_expedicion' => $fechaExpedicion,
                    'fecha_retiro' => $fechaFin,
                    'estado' => 'A'
                ];

                // ==========================================
                // 🔥 CARGO (PRIORIDAD 43 / 42)
                // ==========================================
                if (!empty($row[43])) {
                    $dataUpdate['cargo_titular'] = strtoupper(trim($row[43]));
                    $dataUpdate['cod_cargo'] = $row[42] ?? null;
                }

                // ==========================================
                // 🔥 DEPENDENCIA PRINCIPAL (45 / 46)
                // ==========================================
                if (!empty($row[45]) || !empty($row[46])) {

                    $codDependencia = $row[45] ?? null;

                    // Si tiene exactamente 12 dígitos no hacer nada
                    if (strlen($codDependencia) > 12) {

                    // quitar 127 si existe
                    if (!empty($codDependencia)) {
                        $codDependencia = trim((string) $codDependencia);
                        if (substr($codDependencia, 0, 3) === '127') {
                            $codDependencia = substr($codDependencia, 3);
                        }
                    }

                }

                    $dataUpdate['cod_dependencia'] = $codDependencia;
                    $dataUpdate['dependencia_titular'] = strtoupper(trim($row[46] ?? ''));
                }

                // ==========================================
                // 🔥 DEPENDENCIA PROVISIONAL (47)
                // ==========================================
                if (!empty($row[47])) {
                    $dataUpdate['dependencia_provisional'] = strtoupper(trim($row[47]));
                }

                // ==========================================
                // 🔥 GUARDADO SEGURO (NO SOBREESCRIBE VACÍOS)
                // ==========================================
                Empleado::updateOrCreate(
                    ['cedulaE' => $cedula],
                    $dataUpdate
                );

                $this->rowsImported++;

            } catch (\Throwable $e) {

                $this->rowsError++;

                Log::error('ERROR EN IMPORTACIÓN', [
                    'fila' => $index,
                    'mensaje' => $e->getMessage(),
                ]);
            }
        }

        Log::info('RESUMEN IMPORTACIÓN', [
            'importados' => $this->rowsImported,
            'omitidos' => $this->rowsSkipped,
            'errores' => $this->rowsError
        ]);
    }

    public function chunkSize(): int
    {
        return 500;
    }

    private function parseFecha($value)
    {
        try {
            if (empty($value)) return null;

            if (is_numeric($value)) {
                return Carbon::instance(
                    \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value)
                );
            }

            return Carbon::parse($value);

        } catch (\Exception $e) {
            return null;
        }
    }
}
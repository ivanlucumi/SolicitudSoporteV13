<?php

namespace App\Imports;

use App\Models\InventarioAlmacen;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Str;


class InventarioAlmacenImport implements ToCollection
{
    protected $idsCargados = [];

    public function collection(Collection $rows)
    {
        dd($rows);
        // Omitir encabezado
        $rows->shift();

        foreach ($rows as $row) {
            dd($row);
            // Validación básica para evitar errores
            if (!isset($row[0]) || !isset($row[1]) || !isset($row[2])) {
                continue; // Saltar fila incompleta
            }

            $inventarioId = trim($row[0]);

            if (empty($inventarioId)) {
                continue; // Saltar si el ID está vacío
            }

            $descripcion = strtoupper(trim(preg_replace('/\s+/', ' ', $row[1]))); // Convertir a mayúsculas
            $cantidad = is_numeric($row[2]) ? intval($row[2]) : 0;

            $this->idsCargados[] = $inventarioId;

            InventarioAlmacen::updateOrCreate(
                ['inventario_id' => $inventarioId],
                [
                    'descripcion'    => $descripcion,
                    'cantidad_final' => $cantidad,
                    'status'         => 'Disponible',
                ]
            );
        }

        // Marcar como No Disponible los que no estén en el Excel
        InventarioAlmacen::whereNotIn('inventario_id', $this->idsCargados)
            ->update(['status' => 'No Disponible']);
    }
}

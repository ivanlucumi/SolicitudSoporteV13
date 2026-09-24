<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\ShortenedUrl;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class AcortadorDespachosImport implements ToCollection, WithHeadingRow
{
    public $procesados = 0;
    public $errores = 0;
    
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Buscamos las columnas independientemente de minúsculas/mayúsculas
            // Maatwebsite Excel normaliza los encabezados a minúsculas
            $codigo = $row['codigodespacho'] ?? $row['codigo_despacho'] ?? null;
            $urlOriginal = $row['link'] ?? $row['url'] ?? null;

            if ($codigo && $urlOriginal) {
                // Generar código corto
                $shortCode = Str::random(6);
                while (ShortenedUrl::where('short_code', $shortCode)->exists()) {
                    $shortCode = Str::random(6);
                }

                // Crear URL acortada
                ShortenedUrl::create([
                    'original_url' => $urlOriginal,
                    'short_code'   => $shortCode
                ]);

                // Armar URL final 
                $urlFinal = url('a/' . $shortCode);

                // Actualizar Despacho
                $actualizado = DB::table('despachos')
                                ->where('codigoDespacho', $codigo)
                                ->update(['atencion_virtual' => $urlFinal]);
                
                if ($actualizado) {
                    $this->procesados++;
                } else {
                    $this->errores++;
                }
            } else {
                $this->errores++;
            }
        }
    }
}

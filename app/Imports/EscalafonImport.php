<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

//use Maatwebsite\Excel\Concerns\ToCollection;

use App\Models\Empleado;
use App\Models\Despacho;
use App\Models\Cargo;
use App\Models\Escalafon;
use App\Models\Posesion;
use App\Models\Observacion;
use App\Models\EscalafonRegistro;
use App\Models\Licencia;

use App\Models\ObservacionEscalafon;
use App\Models\NotaEscalafon;

use Maatwebsite\Excel\Concerns\{ToCollection, WithHeadingRow, WithChunkReading};

class EscalafonImport implements ToCollection, WithHeadingRow, WithChunkReading
{
    public function chunkSize(): int { return 200; }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            
            $codigo = rtrim($row['codigo_despacho_judicial_udae_dj']);

            //dd($row['codigo_despacho_judicial_udae_dj'], Despacho::where('codigoDespacho', $codigo)->get());
            
            // 1. Despacho Judicial
            $despacho = Despacho::updateOrCreate(
                ['codigoDespacho' => $codigo ?? null],
                [
                    'jurisdiccion'        => $row['jurisdiccion'] ?? null,
                    'tipo_despacho'       => $row['tipo_de_despacho'] ?? null,
                    'competencia'         => $row['competencia'] ?? null,
                    'especialidad'        => $row['especialidad'] ?? null,
                    'subespecialidad'     => $row['subespecialidad'] ?? null,
                    'despacho_transformado' => $row['despacho_transformado'] ?? null,
                ]
                
               
            );
             //dd($despacho,$codigo);

            // 2. Cargo
            $cargo = Cargo::updateOrCreate(
                [
                    'despacho_judicial_id' => $codigo,
                    'codigo_cargo'         => $row['codigo_cargo_cargo'] ?? null,
                ],
                [
                    'codigo_cargo_nomina'       => $row['codigo_cargo_nomina_cargo'] ?? null,
                    'codigo_registro_elegibles' => $row['codigo_registro_elegibles_cargo'] ?? null,
                    'nombre_cargo'              => $row['cargo_cargo'] ?? 'SIN CARGO',
                    'grado'                     => $row['grado_cargo'] ?? null,
                    'acogimiento'               => $row['acog_cargo'] ?? null,
                    'id_ocurrencia_titular'     => $row['id_ocurrencia_titular_cargo'] ?? null,
                    'fecha_inicial_vinculacion' => $this->parseDate($row['fecha_inicial_de_vinculacion_a_la_rama_cargo'] ?? null),
                    'estado_actual'             => $row['estado_actual'] ?? null,
                ]
            );
            
            //dd($cargo,$despacho,$codigo);

            // 3. Persona Propietario (solo si tiene cédula)
            $propietario = null;
            if (!empty($row['cedula_prop'])) {
                $propietario = Empleado::updateOrCreate(
                    ['cedulaE' => $row['cedula_prop']],
                    [
                        'lastnameE' => $row['apellidos_prop'] ?? '',
                        'nameE'   => $row['nombres_prop'] ?? '',
                        'genero'    => $row['genero_prop'] ?? null,
                    ]
                );
            }

            // 4. Persona Provisional (solo si tiene cédula)
            $provisional = null;
            if (!empty($row['cedula_prov'])) {
                $provisional = Empleado::updateOrCreate(
                    ['cedulaE' => $row['cedula_prov']],
                    [
                        'lastnameE' => $row['apellidos_prov'] ?? '',
                        'nameE'   => $row['nombres_prov'] ?? '',
                        'genero'    => $row['genero_prov'] ?? null,
                    ]
                );
            }

            // 5. Escalafón
            
            
                $escalafon = Escalafon::updateOrCreate([
                    'novedad'         => $row['novedad_del_escalafon_esc'] ?? null,
                    'tipo_acto'       => $row['tipo_de_acto_esc'] ?? null,
                    'numero_acto'          => $row['no_esc'] ?? null,
                    'fecha_acto'           => $this->parseDate($row['fecha_esc'] ?? null),
                    'entidad'         => $row['entidad_esc'] ?? null,
                    'convocatoria' => $row['no_de_convocatoria'] ?? null,
                ]);
            
                //dd($cargo,$despacho,$codigo,$escalafon);
            // 6. Posesión
            
            //dd($escalafon,$row['tipo_de_nombramiento_propiedad_provisionalidad_posesion']);
            
            
                $posesion = Posesion::updateOrCreate([
                    'tipo_nombramiento'        => $row['tipo_de_nombramiento_propiedad_provisionalidad_posesion'],
                    'tipo_acto_adtivo'         => $row['tipo_de_acto_adtivo_posesion'] ?? null,
                    'no_acto_adtivo'           => $row['no_de_acto_adtivo_de_nombramiento_posesion'] ?? null,
                    'fecha_acto_administrativo'=> $this->parseDate($row['fecha_acto_administrativo'] ?? null),
                    'fecha_posesion'           => $this->parseDate($row['fecha_de_posesion_posesion'] ?? null),
                ]);
            
            //dd($posesion->id,$row['tipo_de_nombramiento_propiedad_provisionalidad_posesion']);
            // 7. Licencia
            
            //dd($cargo,$despacho,$codigo,$escalafon,$posesion);
            
                $licencia = Licencia::updateOrCreate([
                    'no_resolucion' => $row['no_resolucion_lic'],
                    'fecha'         => $this->parseDate($row['fecha_lic'] ?? null),
                    'tiempo'        => $row['tiempo_lic'] ?? null,
                ]);
                
                
            //dd($cargo->id,$despacho->id,$codigo,$escalafon->id,$posesion->id,$licencia->id,$propietario,$provisional);

            // 8. Registro principal
           $registro = EscalafonRegistro::updateOrCreate(
                [
                    'cargo_id'               => $cargo->id ?? null,
                    'persona_propietario_id' => $propietario->id ?? null,
                    'persona_provisional_id' => $provisional->id ?? null,
                    'escalafon_id'           => $escalafon->id ?? null,
                    'posesion_id'            => $posesion->id ?? null,
                    'licencia_id'            => $licencia->id ?? null,
                ],
                [
                    'fecha_posesion_provisional' => $this->parseDate($row['fecha_de_posesion_prov'] ?? null),
                    'act_csjvac'                 => $row['act_csjvac2326'] ?? null,
                    'estado_actual'              => $row['estado_actual'] ?? null,
                    'reporte_lista'              => $row['reporte_lista'] ?? null,
                    'observaciones'              => implode(' | ', array_filter([
                        $row['observacion_pre'] ?? null,
                        $row['observacion_pre_2'] ?? null,
                        $row['observacion_pre_3'] ?? null,
                    ])),
                    'comentarios'                => $row['comentarios_circular_csjvac2326_23_junio_2023'] ?? null,
                ]
            );
            
           $camposObservaciones = [
                'observacion_pre',
                'observacion_pre_2',
                'observacion_pre_3',
            ];
            
            foreach ($camposObservaciones as $campo) {
            
                if (!empty($row[$campo])) {
            
                    ObservacionEscalafon::updateOrCreate(
                        [
                            'escalafon_registro_id' => $registro->id, // �9�6 clave obligatoria
                            'tipo' => $campo,
                        ],
                        [
                            'observaciones' => trim($row[$campo]),
                        ]
                    );
                }
            }
            
            $camposNotas = [
                'nota_1',
                'nota_2',
                'nota_3',
                'nota_4',
                'nota_5',
            ];
            
            foreach ($camposNotas as $campo) {
            
                if (!empty($row[$campo])) {
            
                    NotaEscalafon::updateOrCreate(
                        [
                            'escalafon_registro_id' => $registro->id, // �9�6 clave obligatoria
                            'tipo' => $campo,
                        ],
                        [
                            'notas' => trim($row[$campo]),
                        ]
                    );
                }
            }
            
            
            
            

            
            
        }
    }

    private function parseDate($value): ?string
    {
        if (empty($value) || $value === '0') return null;
        try {
            if (is_numeric($value)) {
                return Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value))->toDateString();
            }
            return Carbon::parse($value)->toDateString();
        } catch (\Exception $e) {
            return null;
        }
    }
}

<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Support\Facades\Response;
//use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

use Auth;
use Illuminate\Support\Facades\Mail;

use App\Imports\EscalafonImport;
use Maatwebsite\Excel\Facades\Excel;


use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

use App\Models\EscalafonRegistro;
use App\Models\Cargo;
use App\Models\Empleado;
use App\Models\Escalafon;
use App\Models\Posesion;
use App\Models\Licencia;
use App\Models\Despacho;

class EscalafonConsejoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['descargar']);
    }
    
     public function index()
    {
        $registros = EscalafonRegistro::with([
            'cargo.despachoJudicial',
            'propietario',
            'provisional',
            'escalafon',
            'posesion',
            'licencia',
        ])->paginate(20);
        
        //dd($registros);

        return view('administrador.Escalafon.vista', compact('registros'));
    }

   /* public function edit($id)
    {
        $registro = EscalafonRegistro::with([
            'cargo.despachoJudicial',
            'propietario',
            'provisional',
            'escalafon',
            'posesion',
            'licencia',
        ])->findOrFail($id);
    
        $cargos = Cargo::orderBy('nombre_cargo')->get();
    
        $empleados = Empleado::orderBy('nameE')->get();
    
        $escalafones = Escalafon::orderBy('id')->get();
    
        $posesiones = Posesion::orderBy('id')->get();
    
        $licencias = Licencia::orderBy('id')->get();
        $despachos = Despacho::orderBy('codigoDespacho')->get();
        
        //dd($registro);
    
        return view('administrador.Escalafon.Edit', [
            'registro'    => $registro,
            'cargos'      => $cargos,
            'escalafones' => $escalafones,
            'empleados' => $empleados,
            'posesiones'  => $posesiones,
            'licencias'   => $licencias,
            'despachos'   => $despachos,
            'modo'        => 'edit' // útil si usas el mismo form para create/edit
        ]);
    }*/

   

    public function destroy($id)
    {
        EscalafonRegistro::destroy($id);

        return back()->with('success', 'Registro eliminado correctamente');
    }
    

    public function vistaImport()
    {
        return view('administrador.Escalafon.Index');
    }

    public function importar(Request $request)
    {
        $request->validate([
            'archivo' => 'required|mimes:xlsx,xls|max:10240',
        ]);

        try {
            DB::beginTransaction();
            Excel::import(new EscalafonImport, $request->file('archivo'));
            DB::commit();

            return redirect()->route('despachos.index.escalafon')
                ->with('success', 'Archivo importado correctamente.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al importar: ' . $e->getMessage());
        }
    }
    
    public function form(Request $request)
    {
        if(empty($request->all())){
            $registros = null;
            $empleado = null;
            $email = null; 
        }else{
             $request->validate([
            'cedula' => 'required',
           // 'fecha_expedicion' => 'required|date',
            'email' => 'required'
        ]);
        
        $email = $request->email; 
    
        $empleado = Empleado::where('cedulaE', $request->cedula)
            //->whereDate('fecha_expedicion', $request->fecha_expedicion)
            ->first();
    
        if (!$empleado) {
            return back()->with('error', 'No se encontró el empleado');
        }
    
        
        
        $registros = EscalafonRegistro::with([
            'cargo.despachoJudicial',
            'escalafon',
            'propietario' // �9�6 solo esta relaci��n
        ])
        ->where('persona_propietario_id', $empleado->id)
        ->orderByDesc('id')
        ->get();
        
        
        
        //dd($registros);
        if($registros->isEmpty()){
            $registros = null;
            $empleado = null;
            
            
        }
        }
        
        
        if(auth()->user()->rol == 1){
          return view('administrador.Escalafon.form', compact('registros', 'empleado','email'));  
        }else{
          return view('usuario.Escalafon.CosnultaEscalafon', compact('registros', 'empleado','email'));    
        }
        
        
    }
    
    public function buscar(Request $request)
    {
        $request->validate([
            'cedula' => 'required',
           // 'fecha_expedicion' => 'required|date'
           'email' => 'required',
        ]);
    
        $empleado = Empleado::where('cedulaE', $request->cedula)
            //->whereDate('fecha_expedicion', $request->fecha_expedicion)
            ->first();
    
        if (!$empleado) {
            return back()->with('error', 'No se encontró el empleado');
        }
    
        /*$registros = EscalafonRegistro::with([
            'cargo.despachoJudicial', // 👈 relación anidada correcta
            'cargo',
            'escalafon',
            'propietario',
            'provisional'
        ])
        ->where(function ($query) use ($empleado) {
            $query->where('persona_propietario_id', $empleado->id)
                  ->orWhere('persona_provisional_id', $empleado->id);
        })
        ->orderBy('id', 'desc')
        ->get();*/
        
        $registros = EscalafonRegistro::with([
            'cargo.despachoJudicial',
            'escalafon',
            'propietario' // �9�6 solo esta relaci��n
        ])
        ->where('persona_propietario_id', $empleado->id)
        ->orderByDesc('id')
        ->get();
        
        $email =null;
        if(!$registros->isEmpty()){
          $email = $request->email;  
        }
        //dd($registros);
    
        return view('administrador.Escalafon.resultado', compact('registros', 'empleado','email'));
    }
    
    public function descargar(Request $request,$cedula)
    {
        //dd($cedula,$request->all());
         $fileName = $cedula . '.pdf';

        if (!Storage::disk('Escalafon')->exists($fileName)) {
            abort(404, 'El archivo no existe.');
        }

        return Storage::disk('Escalafon')->download($fileName, "certificacion_$cedula.pdf");
    
    }
    
    
    
    //adminEnviar
    public function EnviarCertificacion(Request $request,$cedula)
    {
        
       DB::beginTransaction();
        try{  
        
        // VALIDACI�0�7N
        $request->validate([
            //'cedula' => 'required|numeric',
            'email'         => 'required|email'
        ]);
        
       
         //dd($request->all(),$cedula);
    
        // CONSULTAR EMPLEADO
        
        
        $empleado = Empleado::where('cedulaE',$cedula)->first();
        
        
        if (!$empleado) {
            
            return back()->with([
                'swal_error' => 'La identificacion no se encuentra. Por favor comun��quese al correo para recibir asistencia',
                'correo_solicitud' => 'ssadmvalle@cendoj.ramajudicial.gov.co',
            ]);
        }
    
        
    
        // ARCHIVO EN DISCO RecursosHumanos
        $fileName = $cedula. '.pdf';
    
        
        
        if (!Storage::disk('Escalafon')->exists($fileName)) {
            return back()->with([
                'swal_error' => 'El documento no se encuentra generado. Por favor comun��quese al correo para recibir asistencia',
                'correo_solicitud' => 'ssadmvalle@cendoj.ramajudicial.gov.co',
            ]);
        }
        
        
    
        // RUTA DEL ARCHIVO
        $rutaDocumento = Storage::disk('Escalafon')->path($fileName);
    
        // URL FIRMADA 24 HORAS
        $url = URL::temporarySignedRoute(
            'public.certificacion.escalafon.descargar',
            now()->addHours(72),
            ['cedula' => $cedula]
        );
    
        // DATOS PARA LA VISTA DEL CORREO
        $data = [
            'empleado' =>  $empleado,
            'identificacion' => $cedula,
            'url_consulta' => $url
        ];
        
        //dd($empleado);
        
        $data              =  json_decode(json_encode($data), true);
    
        // ASUNTO DEL CORREO
        $asunto = "Consulta Escalafon - " . $cedula;
        
        
        // ENV�0�1O DE CORREO EXACTAMENTE COMO LO PEDISTE
        Mail::send('emails/Certificaciones/CorreoEscalafon', $data, function ($mail) use ($rutaDocumento, $request, $asunto, $fileName) {
    
            $mail->from('informacion@disajcali.gov.co', 'SIRISCALI');
            $mail->to($request->email);
            $mail->subject($asunto);
            $mail->priority(1); // alta prioridad
    
        });
        
        /*$empleado->certificacion = $empleado->certificacion."; ".$request->email;
        $empleado->email = $request->email;
        $empleado->estado = true;
        $empleado->save();*/
        
        
        
        
        DB::commit();
    
        return back()->with([
            'success' => 'Correo enviado correctamente a:',
            'correo_enviado' => $request->email
        ]);
        
        
        }catch (\Exception $e) {
            DB::rollback();
           return back()
            ->with('mensaje_error', 'Ocurri�� un error inesperado. Por favor, contacte al ��rea de soporte.')
            ->withInput();
        } catch (\Throwable $e) {
            DB::rollback();
            return back()
            ->with('mensaje_error', 'Ocurri�� un error inesperado. Por favor, contacte al ��rea de soporte.')
            ->withInput();
        }
    }
    
    
    
    
    public function edit($id)
    {
        $registro = EscalafonRegistro::with([
            'cargo.despachoJudicial',
            'propietario',
            'provisional',
            'escalafon',
            'posesion',
            'licencia',
        ])->findOrFail($id);
    
        $despachos = Despacho::orderBy('nombreDespacho')->get();
        $escalafones = Escalafon::orderBy('id')->get();
        $empleados = Empleado::orderBy('lastnameE')->get();
    
        $cargos = Cargo::with('despachoJudicial')
            ->orderBy('despacho_judicial_id')
            ->orderBy('nombre_cargo')
            ->get();
    
        // Cargos agrupados por despacho para los selects din��micos
        $cargosPorDespacho = $cargos
            ->filter(function ($cargo) {
                return optional($cargo->despachoJudicial)->codigoDespacho;
            })
            ->groupBy(function ($cargo) {
                return $cargo->despachoJudicial->codigoDespacho;
            })
            ->map(function ($grupo) {
                return $grupo->map(function ($cargo) {
                    return [
                        'id'              => $cargo->id,
                        'nombre'          => $cargo->nombre_cargo ?? 'Sin nombre',
                        'despacho_codigo' => optional($cargo->despachoJudicial)->codigoDespacho ?? '',
                        'despacho_nombre' => optional($cargo->despachoJudicial)->nombreDespacho ?? '',
                    ];
                })->values();
            });
    
        $nombreEmpleado = function ($empleado) {
            if (!$empleado) {
                return '';
            }
    
            $nombre = $empleado->nombre ?? $empleado->firstnameE ?? '';
            $apellido = $empleado->apellido ?? $empleado->lastnameE ?? '';
    
            return trim($nombre . ' ' . $apellido);
        };
    
        // Todos los registros para el m��dulo de b��squeda/filtro
        $registrosBusqueda = EscalafonRegistro::with([
            'cargo.despachoJudicial',
            'propietario',
            'provisional',
            'escalafon',
        ])
        ->orderByDesc('id')
        ->get()
        ->map(function ($item) use ($nombreEmpleado) {
            $despacho = optional(optional($item->cargo)->despachoJudicial);
    
            $tienePropiedad = !empty($item->propietario_id);
            $tieneProvisionalidad = !empty($item->provisional_id);
    
            if ($tienePropiedad && $tieneProvisionalidad) {
                $tipo = 'ambos';
            } elseif ($tienePropiedad) {
                $tipo = 'propiedad';
            } elseif ($tieneProvisionalidad) {
                $tipo = 'provisionalidad';
            } else {
                $tipo = 'sin_asignacion';
            }
            
            
    
            return [
                'id'                 => $item->id,
                'despacho_codigo'    => $despacho->codigoDespacho ?? '',
                'despacho_nombre'    => $despacho->nombreDespacho ?? '',
                'cargo_id'           => $item->cargo_id,
                'cargo_nombre'       => optional($item->cargo)->nombre_cargo ?? 'Sin cargo',
                'propietario_id'     => $item->propietario_id,
                'propietario_nombre' => $nombreEmpleado($item->propietario),
                'provisional_id'     => $item->provisional_id,
                'provisional_nombre' => $nombreEmpleado($item->provisional),
                'tipo'               => $tipo,
                'estado'             => $item->estado ?? 'activo',
                'escalafon'          => optional($item->escalafon)->novedad ?? '',
                // Ajusta este route si en tu proyecto tiene otro nombre
                'edit_url'           => route('despachos.import.escalafon.edit', $item->id),
            ];
        })
        ->values();
        
        dump($registrosBusqueda[0]);
    
        return view('administrador.Escalafon.Edit', compact(
            'registro',
            'despachos',
            'cargos',
            'escalafones',
            'empleados',
            'cargosPorDespacho',
            'registrosBusqueda'
        ));
    } //edit  funcional

    /**
     * Actualizar el registro.
     * Si el despacho cambi�� �� actualizar TODOS los cargos dependientes.
     */
   /*public function update(Request $request, $id)
    {
        $request->validate([
            'escalafon_id'   => 'required|exists:escalafones,id',
            'cargo_id'       => 'required|exists:cargos,id',
            'despacho_id'    => 'required',
            'estado'         => 'in:activo,inactivo',
            'propietario_id' => 'nullable|exists:empleados,id',
            'provisional_id' => 'nullable|exists:empleados,id',
            'fecha_posesion' => 'nullable|date',
            'acto_posesion'  => 'nullable|string|max:255',
            'tipo_licencia'  => 'nullable|string|max:255',
            'fecha_inicio_licencia' => 'nullable|date',
            'fecha_fin_licencia'    => 'nullable|date|after_or_equal:fecha_inicio_licencia',
            'observaciones'  => 'nullable|string',
        ]);
    
        DB::transaction(function () use ($request, $id) {
    
            $registro = EscalafonRegistro::with([
                'posesion', 'licencia'
            ])->findOrFail($id);
    
            // ���� 1. Actualizar registro principal ����������������������������������������������������
            $registro->update([
                'escalafon_id'   => $request->escalafon_id,
                'cargo_id'       => $request->cargo_id,
                'propietario_id' => $request->propietario_id ?: null,
                'provisional_id' => $request->provisional_id ?: null,
                'estado'         => $request->estado ?? 'activo',
                'observaciones'  => $request->observaciones,
            ]);
    
            // ���� 2. Cambio de despacho en cascada ����������������������������������������������������
            if ($request->despacho_changed === '1') {
                $nuevoCodigo = $request->despacho_id;
                $nuevoDespacho = Despacho::where('codigoDespacho', $nuevoCodigo)->firstOrFail();
    
                // Actualizar el cargo seleccionado con el nuevo despacho
                Cargo::where('id', $request->cargo_id)
                    ->update(['despacho_judicial_id' => $nuevoDespacho->id]);
            }
    
            // ���� 3. Posesi��n (upsert) ����������������������������������������������������������������������������
            if ($request->filled('fecha_posesion') || $request->filled('acto_posesion')) {
                $registro->posesion()->updateOrCreate(
                    ['escalafon_registro_id' => $registro->id],
                    [
                        'fecha_posesion' => $request->fecha_posesion,
                        'acto_posesion'  => $request->acto_posesion,
                    ]
                );
            } elseif ($registro->posesion) {
                $registro->posesion()->delete();
            }
    
            // ���� 4. Licencia (upsert) ����������������������������������������������������������������������������
            if ($request->filled('tipo_licencia') || $request->filled('fecha_inicio_licencia')) {
                $registro->licencia()->updateOrCreate(
                    ['escalafon_registro_id' => $registro->id],
                    [
                        'tipo_licencia' => $request->tipo_licencia,
                        'fecha_inicio'  => $request->fecha_inicio_licencia,
                        'fecha_fin'     => $request->fecha_fin_licencia,
                    ]
                );
            } elseif ($registro->licencia) {
                $registro->licencia()->delete();
            }
        });
    
        return redirect()
            ->route('despachos.show.escalafon', $id)
            ->with('success', 'Registro actualizado correctamente.');
    }*/
    
    
    protected function empleadoNombre($empleado)
    {
        if (!$empleado) {
            return '';
        }
    
        $nombre = $empleado->nombre ?? $empleado->firstnameE ?? '';
        $apellido = $empleado->apellido ?? $empleado->lastnameE ?? '';
    
        return trim($nombre . ' ' . $apellido);
    }
    
    protected function empleadoLabel($empleado)
    {
        $nombre = $this->empleadoNombre($empleado);
        $cedula = $empleado->cedula ?? '';
    
        return trim($nombre . ($cedula ? ' �� ' . $cedula : ''));
    }
    
    protected function tipoRelacionRegistro($registro)
    {
        $tienePropietario = !empty($registro->propietario_id);
        $tieneProvisional = !empty($registro->provisional_id);
    
        if ($tienePropietario && $tieneProvisional) {
            return 'ambos';
        }
    
        if ($tienePropietario) {
            return 'propiedad';
        }
    
        if ($tieneProvisional) {
            return 'provisionalidad';
        }
    
        return 'sin_asignacion';
    }

    /*public function edit($id)
    {
        $registro = EscalafonRegistro::with([
            'cargo.despachoJudicial',
            'propietario',
            'provisional',
            'escalafon',
            'posesion',
            'licencia',
        ])->findOrFail($id);
    
        $despachos = Despacho::orderBy('nombreDespacho')->get();
    
        $cargos = Cargo::with('despachoJudicial')
            ->orderBy('despacho_judicial_id')
            ->orderBy('nombre_cargo')
            ->get();
    
        $escalafones = Escalafon::orderByDesc('id')->get();
    
        $columnaOrdenEmpleado = Schema::hasColumn('empleados', 'lastnameE')
            ? 'lastnameE'
            : (Schema::hasColumn('empleados', 'apellido') ? 'apellido' : 'id');
    
        $empleados = Empleado::orderBy($columnaOrdenEmpleado)->get();
    
        $cargosPorDespacho = $cargos
            ->filter(function ($cargo) {
                return optional($cargo->despachoJudicial)->codigoDespacho;
            })
            ->groupBy(function ($cargo) {
                return $cargo->despachoJudicial->codigoDespacho;
            })
            ->map(function ($grupo) {
                return $grupo->map(function ($cargo) {
                    return [
                        'id'               => $cargo->id,
                        'nombre'           => $cargo->nombre_cargo ?? 'Sin nombre',
                        'despacho_codigo'  => optional($cargo->despachoJudicial)->codigoDespacho ?? '',
                        'despacho_nombre'  => optional($cargo->despachoJudicial)->nombreDespacho ?? '',
                    ];
                })->values();
            });
    
        $empleadosJson = $empleados->map(function ($emp) {
            return [
                'id'     => $emp->id,
                'nombre' => $this->empleadoNombre($emp),
                'cedula' => $emp->cedula ?? '',
                'label'  => $this->empleadoLabel($emp),
            ];
        })->values();
    
        $escalafonesJson = $escalafones->map(function ($esc) {
            return [
                'id'          => $esc->id,
                'nombre'      => $esc->nombre ?? ('Escalaf��n #' . $esc->id),
                'tipo_acto'   => $esc->tipo_acto ?? '',
                'numero_acto' => $esc->numero_acto ?? '',
                'fecha_acto'  => $esc->fecha_acto ? Carbon::parse($esc->fecha_acto)->format('Y-m-d') : '',
                'label'       => ($esc->nombre ?? ('Escalaf��n #' . $esc->id)),
            ];
        })->values();
    
        $registrosBusqueda = EscalafonRegistro::with([
            'cargo.despachoJudicial',
            'propietario',
            'provisional',
            'escalafon',
        ])
        ->orderByDesc('id')
        ->get()
        ->map(function ($item) {
            $despacho = optional(optional($item->cargo)->despachoJudicial);
            $escalafon = $item->escalafon;
    
            return [
                'id'                 => $item->id,
                'despacho_codigo'    => $despacho->codigoDespacho ?? '',
                'despacho_nombre'    => $despacho->nombreDespacho ?? '',
                'cargo_id'           => $item->cargo_id,
                'cargo_nombre'       => optional($item->cargo)->nombre_cargo ?? 'Sin cargo',
                'propietario_id'     => $item->propietario_id,
                'propietario_nombre' => $this->empleadoLabel($item->propietario),
                'provisional_id'     => $item->provisional_id,
                'provisional_nombre' => $this->empleadoLabel($item->provisional),
                'tipo'               => $this->tipoRelacionRegistro($item),
                'estado'             => $item->estado ?? 'activo',
                'escalafon_nombre'   => optional($escalafon)->nombre ?? '',
                'tipo_acto'          => optional($escalafon)->tipo_acto ?? '',
                'numero_acto'        => optional($escalafon)->numero_acto ?? '',
                'fecha_acto'         => optional($escalafon)->fecha_acto
                    ? Carbon::parse($escalafon->fecha_acto)->format('d/m/Y')
                    : '',
                'edit_url'           => route('despachos.import.escalafon.edit', $item->id),
            ];
        })
        ->values();
    
        return view('administrador.Escalafon.Edit', compact(
            'registro',
            'despachos',
            'cargos',
            'escalafones',
            'empleados',
            'cargosPorDespacho',
            'empleadosJson',
            'escalafonesJson',
            'registrosBusqueda'
        ));
    }*/

    public function update(Request $request, $id)
    {
        $registro = EscalafonRegistro::with(['posesion', 'licencia', 'cargo.despachoJudicial'])->findOrFail($id);
    
        $validator = Validator::make($request->all(), [
            'despacho_id'             => 'required|string',
            'cargo_id'                => 'required|exists:cargos,id',
            'escalafon_id'            => 'required|exists:escalafones,id',
            'estado'                  => 'nullable|in:activo,inactivo',
            'propietario_id'          => 'nullable|exists:empleados,id',
            'provisional_id'          => 'nullable|exists:empleados,id|different:propietario_id',
            'fecha_posesion'          => 'nullable|date',
            'acto_posesion'           => 'nullable|string|max:255',
            'tipo_licencia'           => 'nullable|string|max:255',
            'fecha_inicio_licencia'   => 'nullable|date',
            'fecha_fin_licencia'      => 'nullable|date|after_or_equal:fecha_inicio_licencia',
            'observaciones'           => 'nullable|string',
        ], [
            'provisional_id.different' => 'Propietario y provisional no pueden ser la misma persona.',
        ]);
    
        $validator->after(function ($validator) use ($request) {
            $cargo = Cargo::with('despachoJudicial')->find($request->cargo_id);
    
            if (!$cargo) {
                return;
            }
    
            $codigoDespachoCargo = optional($cargo->despachoJudicial)->codigoDespacho;
    
            if ((string) $codigoDespachoCargo !== (string) $request->despacho_id) {
                $validator->errors()->add('cargo_id', 'El cargo seleccionado no pertenece al juzgado elegido.');
            }
        });
    
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
    
        $data = $validator->validated();
    
        $registro->cargo_id = $data['cargo_id'];
        $registro->escalafon_id = $data['escalafon_id'];
        $registro->estado = $data['estado'] ?? 'activo';
        $registro->propietario_id = $data['propietario_id'] ?? null;
        $registro->provisional_id = $data['provisional_id'] ?? null;
        $registro->observaciones = $data['observaciones'] ?? null;
        $registro->save();
    
        $tienePosesion = $request->filled('fecha_posesion') || $request->filled('acto_posesion');
    
        if ($tienePosesion) {
            $registro->posesion()->updateOrCreate(
                ['escalafon_registro_id' => $registro->id],
                [
                    'fecha_posesion' => $data['fecha_posesion'] ?? null,
                    'acto_posesion'  => $data['acto_posesion'] ?? null,
                ]
            );
        } elseif ($registro->posesion) {
            $registro->posesion()->delete();
        }
    
        $tieneLicencia = $request->filled('tipo_licencia')
            || $request->filled('fecha_inicio_licencia')
            || $request->filled('fecha_fin_licencia');
    
        if ($tieneLicencia) {
            $registro->licencia()->updateOrCreate(
                ['escalafon_registro_id' => $registro->id],
                [
                    'tipo_licencia' => $data['tipo_licencia'] ?? null,
                    'fecha_inicio'  => $data['fecha_inicio_licencia'] ?? null,
                    'fecha_fin'     => $data['fecha_fin_licencia'] ?? null,
                ]
            );
        } elseif ($registro->licencia) {
            $registro->licencia()->delete();
        }
    
        return redirect()
            ->route('despachos.import.escalafon.edit', $registro->id)
            ->with('success', 'Registro actualizado correctamente.');
    }
    
    
    public function storeDespachoAjax(Request $request, $id)
    {
        // Validar filtros (opcional, pero recomendado)
        $validated = $request->validate([
            'despacho' => 'nullable|string|exists:despachos,codigoDespacho',
            'cargo'    => 'nullable|integer|exists:cargos,id',
            'tipo'     => 'nullable|in:todos,propiedad,provisionalidad,ambos',
        ]);
    
        $despachoSeleccionado = $validated['despacho'] ?? null;
        $cargoSeleccionado    = $validated['cargo'] ?? null;
        $tipoSeleccionado     = $validated['tipo'] ?? 'todos';
    
        // Construir consulta base con relaciones necesarias
        $query = EscalafonRegistro::with([
            'cargo.despachoJudicial',
            'propietario',
            'provisional',
            'escalafon',
            'posesion',
            'licencia',
            //'observaciones', // si se necesitan en la vista
            //'notas',          // si se necesitan en la vista
        ]);
    
        // Aplicar filtros
        if ($despachoSeleccionado) {
            $query->whereHas('cargo.despachoJudicial', function ($q) use ($despachoSeleccionado) {
                $q->where('codigoDespacho', $despachoSeleccionado);
            });
        }
    
        if ($cargoSeleccionado) {
            $query->where('cargo_id', $cargoSeleccionado);
        }
    
        // Filtro por tipo (propietario/provisional)
        if ($tipoSeleccionado !== 'todos') {
            switch ($tipoSeleccionado) {
                case 'propiedad':
                    $query->whereNotNull('persona_propietario_id');
                    break;
                case 'provisionalidad':
                    $query->whereNotNull('persona_provisional_id');
                    break;
                case 'ambos':
                    $query->whereNotNull('persona_propietario_id')
                          ->whereNotNull('persona_provisional_id');
                    break;
            }
        }
    
        // Ordenar y obtener resultados (con paginaci��n opcional)
        $registro = $query->orderByDesc('id')->paginate(20); // o get() si prefieres
    
        // Obtener datos para selects (solo si es necesario, se puede cachear)
        $despachos = cache()->remember('despachos_list', 3600, function () {
            return Despacho::orderBy('nombreDespacho')->get(['codigoDespacho', 'nombreDespacho']);
        });
    
        $cargos = Cargo::with('despachoJudicial')
            ->orderBy('nombre_cargo')
            ->get(['id', 'nombre_cargo', 'despacho_judicial_id']);
    
        // Empleados y escalafones (solo si se usan en la vista)
        $escalafones = Escalafon::orderBy('id')->get(['id', 'novedad']); // campos m��nimos
        $empleados = Empleado::orderBy('lastnameE')->get(['id', 'cedulaE', 'nameE', 'lastnameE']);
    
        // Agrupar cargos por despacho para JS (en lugar de procesar en la vista)
        
    
        return view('administrador.Escalafon.Edit', compact(
            'registro', // cambi�� el nombre a plural para consistencia
            'despachos',
            'cargos',
            'escalafones',
            'empleados',
            //'cargosPorDespacho',
            'id',
            'despachoSeleccionado',
            'cargoSeleccionado',
            'tipoSeleccionado'
        ));
    }

   
}
<?php

namespace App\Http\Controllers;

use App\Models\PoliceEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Carbon\Carbon;

class PoliceEntryController extends Controller
{
    public function index(Request $request)
    {
        $query = PoliceEntry::with('user')->latest();
        if ($search = $request->get('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                  ->orWhere('fecha_ingreso', 'like', "%{$search}%");
            });
        }
        $entries = $query->paginate(15);
        return view('police_entries.index', compact('entries'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'fecha_ingreso'  => 'required|date',
            'cedula'         => 'required|string|max:50',
            'nombre'         => 'required|string|max:255',
            'hora_ingreso'   => 'required|date_format:H:i',
            'hora_salida'    => 'nullable|date_format:H:i',
            'observaciones'  => 'nullable|string',
        ]);

        $data['user_id'] =  auth()->id();

        // Validación lógica opcional: hora_salida >= hora_ingreso
        if (!empty($data['hora_salida'])) {
            $ing = Carbon::createFromFormat('H:i', $data['hora_ingreso']);
            $sal = Carbon::createFromFormat('H:i', $data['hora_salida']);
            if ($sal->lt($ing)) {
                throw ValidationException::withMessages([
                    'hora_salida' => 'La hora de salida no puede ser menor que la hora de ingreso.',
                ]);
            }
        }

        $entry = PoliceEntry::create($data)->load('user');

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'entry' => $this->serializeEntry($entry),
                'message' => 'Registro creado correctamente',
            ]);
        }

        return redirect()->route('police-entries.index')->with('success', 'Registro creado correctamente');
    }

   public function update(Request $request, PoliceEntry $police_entry,$id)
    {
       // �7�3 Validaci��n de datos
            $validatedData = $request->validate([
                'fecha_ingreso'  => 'required|date',
                'cedula'         => 'required|string|max:50',
                'nombre'         => 'required|string|max:255',
                'hora_ingreso'   => 'required|date_format:H:i:s',
                'hora_salida'    => 'nullable|date_format:H:i:s',
                'observaciones'  => 'nullable|string|max:1000',
            ]);
        
            // �7�3 Validaci��n l��gica: la hora de salida debe ser posterior a la hora de ingreso
            if (!empty($validatedData['hora_salida']) && $validatedData['hora_ingreso'] > $validatedData['hora_salida']) {
                return back()->withErrors(['hora_salida' => 'La hora de salida no puede ser menor que la hora de ingreso.']);
            }
        
            // �7�3 Actualizar todos los campos del registro
            try {
                
                $police_entry = PoliceEntry::findOrFail($id);
                
                $police_entry->update($validatedData);
        
                // Si la petici��n es AJAX, responder con JSON
                if ($request->ajax()) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Registro actualizado correctamente',
                        'data' => $police_entry
                    ]);
                }
        
                // Si no es AJAX, redirigir con mensaje
                return redirect()
                    ->route('police-entries.index')
                    ->with('success', 'Registro actualizado correctamente');
        
            } catch (\Exception $e) {
                // �7�3 Manejo de errores (opcional)
                return back()->withErrors(['error' => 'Ocurri�� un error al actualizar: ' . $e->getMessage()]);
            }
    
        
    }
    
   /* public function updateSalida(Request $request, PoliceEntry $police_entry,$id)
    {
          dd($police_entry->all(),$request->all(),$police_entry);
         
        $data = $request->validate([
            'hora_salida' => 'required|date_format:H:i',
        ]);
    
        if ($police_entry->hora_ingreso && $data['hora_salida'] < $police_entry->hora_ingreso) {
            return response()->json([
                'success' => false,
                'message' => 'La hora de salida no puede ser menor que la hora de ingreso.'
            ], 422);
        }
        
        $police_entry= PoliceEntry::findorfail($id);
        
       // dd($police_entry->all(),$request->all(),$police_entry);
    
        $police_entry->hora_salida = $data['hora_salida'];
        $police_entry->save();
    
        return response()->json([
            'success' => true,
            'hora_salida' => $police_entry->hora_salida,
            'message' => 'Hora de salida actualizada correctamente',
        ]);
    }*/
    
    public function updateSalida(Request $request, PoliceEntry $police_entry, $id)
    {
        $data = $request->validate([
            'hora_salida' => 'required|date_format:H:i',
            'fecha_salida' => 'nullable|date_format:Y-m-d',
            'observaciones' => 'nullable|string|max:500',
        ]);
    
        $police_entry = PoliceEntry::findOrFail($id);
        
        // Obtener fecha de salida (si no se env��a, usar la misma fecha de ingreso)
        $fechaSalida = $data['fecha_salida'] ?? $police_entry->fecha_ingreso;
        
        // Crear objetos DateTime para comparaci��n completa
        $fechaHoraIngreso = \Carbon\Carbon::parse($police_entry->fecha_ingreso . ' ' . $police_entry->hora_ingreso);
        $fechaHoraSalida = \Carbon\Carbon::parse($fechaSalida . ' ' . $data['hora_salida']);
        
        // Validar que la fecha/hora de salida no sea anterior a la de ingreso
        if ($fechaHoraSalida->lt($fechaHoraIngreso)) {
            return response()->json([
                'success' => false,
                'message' => 'La fecha y hora de salida no puede ser anterior a la fecha y hora de ingreso.'
            ], 422);
        }
        
        // Validar que no sea m��s de 7 d��as despu��s (opcional, ajusta seg��n necesites)
        if ($fechaHoraSalida->diffInDays($fechaHoraIngreso) > 7) {
            return response()->json([
                'success' => false,
                'message' => 'La fecha de salida no puede ser m��s de 7 d��as posterior al ingreso.'
            ], 422);
        }
        
        // Actualizar datos
        $police_entry->hora_salida = $data['hora_salida'];
        
        // Si tu tabla tiene campo fecha_salida, descomenta la siguiente l��nea
        // $police_entry->fecha_salida = $fechaSalida;
        
        if (isset($data['observaciones'])) {
            $police_entry->observaciones = $data['observaciones'];
        }
        
        $police_entry->save();
    
        return response()->json([
            'success' => true,
            'entry' => [
                'id' => $police_entry->id,
                'created_at' => $police_entry->created_at->format('Y-m-d H:i'),
                'fecha_ingreso' => $police_entry->fecha_ingreso,
                'cedula' => $police_entry->cedula,
                'nombre' => $police_entry->nombre,
                'hora_ingreso' => $police_entry->hora_ingreso,
                'hora_salida' => $police_entry->hora_salida,
                'observaciones' => $police_entry->observaciones,
            ],
            'message' => 'Hora de salida registrada correctamente.',
        ]);
    }

    private function serializeEntry(PoliceEntry $e): array
    {
        return [
            'id'             => $e->id,
            'user_name'      => $e->user->name ?? 'Desconocido',
            'created_at'     => $e->created_at->format('Y-m-d H:i'),
            'fecha_ingreso'  => $e->fecha_ingreso,
            'cedula'         => $e->cedula,
            'nombre'         => $e->nombre,
            'hora_ingreso'   => $e->hora_ingreso,
            'hora_salida'    => $e->hora_salida,
            'observaciones'  => $e->observaciones ?? 'N/A',
        ];
    }
}
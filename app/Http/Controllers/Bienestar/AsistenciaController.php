<?php

namespace App\Http\Controllers\Bienestar;

use App\Http\Controllers\Controller;

use App\Models\BienestarFuncionario;
use App\Models\BienestarAcompanante;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AsistenciaExport;

class AsistenciaController extends Controller
{
    public function index(Request $request)
    {
        $query = BienestarFuncionario::with('acompanantes');
        
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nombre', 'like', "%$search%")
                  ->orWhere('cedula', 'like', "%$search%")
                  ->orWhere('despacho', 'like', "%$search%");
            });
        }
        
        $funcionarios = $query->paginate(10);
        
        return view('asistencia.index', compact('funcionarios'));
    }

    public function create()
    {
        return view('asistencia.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cedula' => 'required|string|max:20|unique:funcionarios',
            'correo' => 'required|email',
            'telefono' => 'required|string|max:20',
            'cargo' => 'required|string|max:255',
            'despacho' => 'required|string|max:255',
            'acompanantes' => 'array|max:4',
            'acompanantes.*.parentezco' => 'required|string|max:255',
            'acompanantes.*.nombre' => 'required|string|max:255',
            'acompanantes.*.cedula' => 'required|string|max:20',
        ]);

        $funcionario = BienestarFuncionario::create($request->only([
            'nombre', 'cedula', 'correo', 'telefono', 'cargo', 'despacho'
        ]));

        if ($request->has('acompanantes')) {
            foreach ($request->acompanantes as $acompanante) {
                $funcionario->acompanantes()->create($acompanante);
            }
        }

        return redirect()->route('asistencia.index')
            ->with('success', 'Registro de asistencia completado exitosamente.');
    }

    public function reporteExcel()
    {
        return Excel::download(new AsistenciaExport, 'asistencia_evento.xlsx');
    }
}
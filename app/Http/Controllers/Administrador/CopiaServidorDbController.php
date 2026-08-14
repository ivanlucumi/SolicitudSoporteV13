<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

use App\Models\CopiaSeguridad;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

use App\Exports\CopiaServidorExport;

class CopiaServidorDbController extends Controller
{
    public function index()
    {
        // Traer valores únicos de servidores y bases de datos
        $servidores = CopiaSeguridad::select('nombre_servidor')
                        ->distinct()
                        ->orderBy('nombre_servidor', 'asc')
                        ->pluck('nombre_servidor');

        $basesDatos = CopiaSeguridad::select('base_datos')
                        ->distinct()
                        ->orderBy('base_datos', 'asc')
                        ->pluck('base_datos');
        
        $registros = CopiaSeguridad::orderBy('fecha_copia', 'desc')
        ->limit(1000)
        ->get();

        
       // dd($registros);
        
        return view('administrador.CopiaDb.Index', compact('servidores', 'basesDatos','registros'));
    }

    public function store(Request $request)
    {
        CopiaSeguridad::create([
            'fecha_copia'   => $request->fecha_copia,
            'nombre_servidor' => $request->nombre_servidor,
            'base_datos'    => $request->base_datos,
            'carpeta'       => $request->carpeta,
            'estado'        => $request->estado,
            'observaciones' => $request->observaciones,
            'copia_azure'   => $request->copia_azure
        ]);

        return redirect()->back()->with('success', 'Registro creado correctamente');
    }

    public function firmar(Request $request, $id)
    {
        $registro = CopiaSeguridad::findOrFail($id);

        // Solo se puede firmar si no está firmado
        if (!$registro->firma_quien_verifica) {
            $registro->update([
                'observaciones' => $request->observaciones,
                'firma_quien_verifica' =>  auth()->user()->id
            ]);
        }

        return redirect()->back()->with('success', 'Registro firmado correctamente');
    }
    
    public function exportarExcel(Request $request)
    {
        $mes = $request->get('mes');
        $anio = $request->get('anio');
    
        return Excel::download(new CopiaServidorExport($mes, $anio), "backups_filtrados.xlsx");
    }
    
}

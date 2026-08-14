<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EncuestaTrabajoCasa;
use App\Exports\EncuestaTrabajoCasaExport;
use Maatwebsite\Excel\Facades\Excel;

class AdminEncuestaTrabajoCasaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $encuestas = EncuestaTrabajoCasa::orderBy('created_at', 'desc')->paginate(20);
        
        return view('administrador.encuestas_trabajo_casa.index', compact('encuestas'));
    }

    /**
     * Download Excel report.
     */
    public function exportarExcel()
    {
        return Excel::download(new EncuestaTrabajoCasaExport, 'reporte_trabajo_casa_' . date('Y-m-d_H-i-s') . '.xlsx');
    }
}

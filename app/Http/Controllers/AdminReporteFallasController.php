<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReporteFalla;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminReporteFallasController extends Controller
{
    /**
     * Muestra el listado de todos los reportes de fallas para el administrador.
     */
    public function index()
    {
        // Traemos todos los reportes ordenados del más reciente al más antiguo
        $reportes = ReporteFalla::orderBy('created_at', 'desc')->get();
        return view('administrador.reporteDanos.index', compact('reportes'));
    }

    /**
     * Genera un PDF de un reporte específico con todas sus imágenes.
     */
    public function generarPDF($id)
    {
        $reporte = ReporteFalla::findOrFail($id);

        // Convertir imágenes a Base64 para que DomPDF pueda renderizarlas sin problemas de rutas
        $reporte = $this->prepararImagenesBase64($reporte);

        // Habilitar estilos HTML5 avanzados e imágenes remotas si es necesario, y cargar la vista
        $pdf = Pdf::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                  ->loadView('administrador.reporteDanos.pdf', compact('reporte'));
        
        // Configurar tamaño de papel legal
        $pdf->setPaper('legal', 'portrait');

        // Usamos $reporte->juzgado que es el campo real en base de datos y lo sanitizamos
        $nombreDespacho = preg_replace('/[^A-Za-z0-9\-]/', '_', $reporte->juzgado);
        
        return $pdf->download('Reporte_Fallas_' . $nombreDespacho . '_' . $reporte->created_at->format('Ymd') . '.pdf');
    }

    /**
     * Función auxiliar para recorrer los arrays de evidencias y convertirlas a Base64.
     */
    private function prepararImagenesBase64($reporte)
    {
        $categorias = ['evidencia_conectividad', 'evidencia_computo', 'evidencia_impresoras', 'evidencia_escaner', 'evidencia_telefonia', 'evidencia_ups', 'evidencia_televisor', 'evidencia_sala_audiencia'];

        foreach ($categorias as $cat) {
            $evidencias = $reporte->$cat;
            if (is_array($evidencias)) {
                $base64Array = [];
                foreach ($evidencias as $index => $item) {
                    if (is_array($item)) {
                        // En caso de que sea dinámico, cada index puede tener un array de imágenes
                        $subArray = [];
                        foreach ($item as $path) {
                            $subArray[] = $this->pathToBase64($path);
                        }
                        $base64Array[$index] = $subArray;
                    } else {
                        // Conectividad (array plano)
                        $base64Array[$index] = $this->pathToBase64($item);
                    }
                }
                $reporte->$cat = $base64Array; // Reemplazamos temporalmente para la vista
            }
        }
        return $reporte;
    }

    /**
     * Convierte una ruta relativa de storage a Base64
     */
    private function pathToBase64($path)
    {
        if (!$path) return null;
        
        $fullPath = storage_path('app/public/' . $path);
        if (file_exists($fullPath)) {
            $type = pathinfo($fullPath, PATHINFO_EXTENSION);
            $data = file_get_contents($fullPath);
            return 'data:image/' . $type . ';base64,' . base64_encode($data);
        }
        return null; // Si no es imagen o no existe
    }
}

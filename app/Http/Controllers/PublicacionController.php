<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Publicacion;
use App\Models\Contador;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class PublicacionController extends Controller
{
    // ==========================================
    // SECCIÓN DE ADMINISTRACIÓN
    // ==========================================
    public function adminIndex(Request $request)
    {
        $publicaciones = Publicacion::orderBy('created_at', 'desc')->get();
        return view('publicaciones.admin_index', compact('publicaciones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipo_publicacion' => 'required',
            'numero_acta' => 'nullable|string|max:255',
            'fecha' => 'nullable|date',
            'asunto' => 'required|string',
            'documento' => 'required|mimes:pdf|max:10240' // max 10MB
        ]);

        $publicacion = new Publicacion();
        $publicacion->tipo_publicacion = $request->tipo_publicacion;
        $publicacion->numero_acta = $request->numero_acta;
        $publicacion->fecha = $request->fecha;
        $publicacion->asunto = $request->asunto;
        
        if($request->hasFile('documento')){
            $archivo = $request->file('documento');
            $nombreArchivo = time() . '' . $archivo->getClientOriginalName();
            \Illuminate\Support\Facades\Storage::disk('circulares')->put($nombreArchivo, \File::get($archivo));
            $link="https://www.disajcali.gov.co/Circulares/".$nombreArchivo;
            $publicacion->archivo_pdf = $link;
        }
        
        $publicacion->save();

        Session::flash('message', 'Publicación registrada con éxito!');
        return Redirect::back();
    }

    public function destroy($id)
    {
        $publicacion = Publicacion::findOrFail($id);
        
        // El archivo se subió al disco 'circulares', puedes borrarlo de allí si quieres extrayendo el nombre
        // de la url, pero por precaución solo borramos el registro.
        // Si quisieras borrarlo: 
        // $nombre = basename($publicacion->archivo_pdf); 
        // \Illuminate\Support\Facades\Storage::disk('circulares')->delete($nombre);
        
        $publicacion->delete();

        Session::flash('message', 'Publicación eliminada correctamente.');
        return Redirect::back();
    }

    // ==========================================
    // SECCIÓN PÚBLICA
    // ==========================================
    public function publicoIndex()
    {
        $fechaA = Carbon::now()->toDateString();
        $global = Contador::where('user_visita', 'GLOBAL')->select('visitas')->first();
        $diaria = Contador::where('fecha_visita', $fechaA)->where('user_visita', 'DIARIA')->select('visitas')->first();

        // Obtenemos todas las publicaciones agrupadas por tipo
        $publicaciones = Publicacion::orderBy('fecha', 'desc')
            ->orderBy('created_at', 'desc')
            ->get()
            ->groupBy('tipo_publicacion');

        $ordenTipos = [
            'ACUERDO CONSEJO SUPERIOR DE LA JUDICATURA BOGOTA',
            'ACUERDO CONSEJO SECCIONAL CALI',
            'CIRCULARES DIRECCION EJECUTIVA ADMINISTRACION JUDICIAL BOGOTA',
            'CIRCULARES DIRECCION SECCIONAL CALI'
        ];

        // Reordenamos la colección agrupada basándonos en el arreglo especificado
        $publicacionesPorTipo = collect();
        foreach ($ordenTipos as $tipo) {
            if ($publicaciones->has($tipo)) {
                $publicacionesPorTipo->put($tipo, $publicaciones->get($tipo));
            }
        }
        
        // Incluimos cualquier otro tipo que pudiera existir en la base de datos pero no en el orden estricto
        foreach ($publicaciones as $tipo => $items) {
            if (!in_array($tipo, $ordenTipos)) {
                $publicacionesPorTipo->put($tipo, $items);
            }
        }

        return view('publicaciones.public_index', compact('publicacionesPorTipo', 'global', 'diaria'));
    }
}

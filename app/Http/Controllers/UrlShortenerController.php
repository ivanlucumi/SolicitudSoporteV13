<?php

namespace App\Http\Controllers;

use App\Models\ShortenedUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UrlShortenerController extends Controller
{
    public function index()
    {
        return view('Acortador.welcome');
    }

    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|url'
        ]);

        $originalUrl = $request->input('url');
        $shortCode = Str::random(6);
        //dd($shortCode);

        // Verificar si el código ya existe
        while (ShortenedUrl::where('short_code', $shortCode)->exists()) {
            $shortCode = Str::random(6);
        }

        $shortenedUrl = ShortenedUrl::create([
            'original_url' => $originalUrl,
            'short_code' => $shortCode
        ]);
        
        $url="a/".$shortCode;
        
       //dd( url($url));

        return redirect()->back()->with('shortened_url', url($url));
    }

   /* public function showStats($code)
    {
        $shortenedUrl = ShortenedUrl::where('short_code', $code)->firstOrFail();
        $clicks = $shortenedUrl->clicks()->latest()->paginate(10);
       // dd(shortenedUrl);
        return view('Acortador.stats', compact('shortenedUrl', 'clicks'));
    }*/
    
   public function Estadistica(Request $request)
{
    // Listado general de URLs
    $shortenedUrls = ShortenedUrl::withCount('clicks')
       // ->with(['lastClick'])
        ->orderBy('created_at', 'desc')
        ->paginate(100);

    // Si se solicita una URL específica
    if ($request->has('code')) {
        $selectedUrl = ShortenedUrl::where('short_code', $request->code)
            ->withCount('clicks')
            //->with(['lastClick'])
            ->firstOrFail();

        $clicks = $selectedUrl->clicks()
            ->latest()
            ->paginate(10, ['*'], 'clicks_page');

        // Estadísticas de dispositivos
        $deviceStats = $this->getDeviceStats($selectedUrl);
        $browserStats = $this->getBrowserStats($selectedUrl);

        return view('administrador.Acortador.Url', compact(
            'shortenedUrls',
            'selectedUrl',
            'clicks',
            'deviceStats',
            'browserStats'
        ));
    }

    return view('administrador.Acortador.Url', compact('shortenedUrls'));
}

protected function getDeviceStats($url)
{
    $devices = $url->clicks()
        ->selectRaw('
            SUM(CASE WHEN user_agent LIKE "%Mobile%" THEN 1 ELSE 0 END) as mobile,
            SUM(CASE WHEN user_agent LIKE "%Tablet%" THEN 1 ELSE 0 END) as tablet,
            SUM(CASE WHEN user_agent LIKE "%Windows%" OR user_agent LIKE "%Macintosh%" THEN 1 ELSE 0 END) as desktop,
            SUM(CASE WHEN user_agent NOT LIKE "%Mobile%" AND user_agent NOT LIKE "%Tablet%" 
                     AND user_agent NOT LIKE "%Windows%" AND user_agent NOT LIKE "%Macintosh%" THEN 1 ELSE 0 END) as other
        ')
        ->first();

    return [
        'labels' => ['Móvil', 'Tablet', 'Escritorio', 'Otros'],
        'data' => [
            $devices->mobile,
            $devices->tablet,
            $devices->desktop,
            $devices->other
        ]
    ];
}

protected function getBrowserStats($url)
{
    $browsers = $url->clicks()
        ->selectRaw('
            SUM(CASE WHEN user_agent LIKE "%Chrome%" THEN 1 ELSE 0 END) as chrome,
            SUM(CASE WHEN user_agent LIKE "%Firefox%" THEN 1 ELSE 0 END) as firefox,
            SUM(CASE WHEN user_agent LIKE "%Safari%" AND user_agent NOT LIKE "%Chrome%" THEN 1 ELSE 0 END) as safari,
            SUM(CASE WHEN user_agent LIKE "%Edge%" THEN 1 ELSE 0 END) as edge,
            SUM(CASE WHEN user_agent LIKE "%Opera%" THEN 1 ELSE 0 END) as opera
        ')
        ->first();

    return [
        'labels' => ['Chrome', 'Firefox', 'Safari', 'Edge', 'Opera'],
        'data' => [
            $browsers->chrome,
            $browsers->firefox,
            $browsers->safari,
            $browsers->edge,
            $browsers->opera
        ]
    ];
}

public function parseUserAgent($userAgent)
{
    // Lógica para parsear el user agent y devolver un string legible
    // Implementación básica:
    if (strpos($userAgent, 'Mobile') !== false) {
        return 'Dispositivo Móvil';
    } elseif (strpos($userAgent, 'Tablet') !== false) {
        return 'Tablet';
    } elseif (strpos($userAgent, 'Windows') !== false || strpos($userAgent, 'Macintosh') !== false) {
        return 'Computadora';
    }
    return 'Otro dispositivo';
}
    
    public function showStats($code)
    {
        $shortenedUrl = ShortenedUrl::where('short_code', $code)->firstOrFail();
        $clicks = $shortenedUrl->clicks()->latest()->paginate(10);
        //dd($shortenedUrl->short_code);
        $url= "a/".$shortenedUrl->short_code;
        return view('administrador.Acortador.Estadistica', compact('shortenedUrl', 'clicks','url'));
    }

    public function importarMasivo(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls,csv|max:10240'
        ]);

        try {
            $import = new \App\Imports\AcortadorDespachosImport();
            \Maatwebsite\Excel\Facades\Excel::import($import, $request->file('excel_file'));

            return redirect()->back()->with('success', "Importación completada. Se actualizaron {$import->procesados} despachos. (Errores/No encontrados: {$import->errores})");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al procesar el archivo: ' . $e->getMessage());
        }
    }
}
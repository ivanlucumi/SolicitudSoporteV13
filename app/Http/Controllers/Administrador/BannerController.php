<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller\Administrador;
use App\Models\Banner;
use App\Http\Requests\BannerCreateRequest;
use App\Http\Requests\BannerUpdateRequest;
use Carbon\Carbon;


use Auth;

use App\Models\ShortenedUrl;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('checarsesion');
        $this->middleware('administrador');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $banner = Banner::where('bCreador', '!=', 'BIENESTAR')
        ->where('bCreador', '!=', 'COE')
        ->orderBy('created_at', 'DESC')->limit(300)->get();
       
        
        return view('administrador.banner.index',compact('banner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        return view('administrador.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BannerCreateRequest $request)
    {
        //dd($request->all());
        $fechademas = Carbon::now();
        $fechademas->addDays((int)$request->bTiempo)->toDateString(); 
        $extension= pathinfo($_FILES["bFoto"]['name'], PATHINFO_EXTENSION);
        
        $activos = Banner::where('bEstado',1)->where('bCreador',"!=","BIENESTAR")->count();
        
        $shortCode = Str::random(6);
        //dd($shortCode);

        // Verificar si el código ya existe
        while (ShortenedUrl::where('short_code', $shortCode)->exists()) {
            $shortCode = Str::random(6);
        }
        
        /* if($activos>5){
                $Estado =0;
                Session::flash('message', 'Hay mas de 5 Banners Activos, se almacena banner en estado inactivo porque no se puede visualizar demaciados');
            }else{
                Session::flash('message', 'creado correctamente');
               $Estado =1; 
            }*/
        
        
        if(empty( $request['bLink'])){
            
               // C贸digo para manejar el archivo si la validaci贸n es exitosa
            if ($request->hasFile('documento')) {
                $archivo = $request->file('documento');
                //dd($archivo->getClientOriginalName());
                $nombreArchivo = time() . '' . $archivo->getClientOriginalName();
                \Storage::disk('circulares')->put($nombreArchivo, \File::get($request->file('documento')));
                 $link="https://www.disajcali.gov.co/Circulares/".$nombreArchivo;
                 
                 
                
                $url="a/".$shortCode;
                
                $linkShortCode=url($url);
                
                $shortenedUrl = ShortenedUrl::create([
                    'original_url' => $link,
                    'short_code' => $shortCode
                ]);
                
                $link=url($url);
                 
            }else{
                $link=null;
            }
            
            
           
           
            
        }else{
            
            $link=$request['bLink'];
            
            $url = trim($link);
    
            // Si ya es una URL válida con HTTPS, devolverla tal cual
            if (Str::startsWith($url, 'https://')) {
                $link= $url;
            }
            
            // Si tiene HTTP, reemplazarlo por HTTPS
            if (Str::startsWith($url, 'http://')) {
                $link= Str::replaceFirst('http://', 'https://', $url);
            }
            
            // Si no tiene protocolo pero comienza con www.
            if (Str::startsWith($url, 'www.')) {
                $link= 'https://' . $url;
            }
            
            
            $shortenedUrl = ShortenedUrl::create([
                    'original_url' => $link,
                    'short_code' => $shortCode
                ]);
                
            $url="a/".$shortCode;
            $link=url($url);
        }
        
        
        
        
        //dd($url);
        
        if($activos>5){
                $Estado =0;
                Session::flash('message', 'Hay mas de 5 Banners Activos, se almacena banner en estado inactivo porque no se puede visualizar demaciados');
            }else{
                Session::flash('message', 'creado correctamente');
               $Estado =1; 
            }
        
        //quitar https al link 
        $link = trim($link);
    
            $link = preg_replace('#^https?://#', '', $link);
        
        //dd($link);
        //
        Banner::create([
            'bNombre'        => $request['bNombre'],
            'bFoto'          => $request['bFoto'],
            'bLink'          => $link,
            'bTiempo'        => $fechademas,
            'bextension'    =>  $extension,
            'bEstado'        => $Estado,
            'bCreador'       => $request['bCreador'],
            'bModificador'   => $request['bModificador'],
        ]);
        
        
        
        return Redirect::to('/administrador/banner');
    }
    
    //banner Bienestar  Bienestar
    
     public function Bienestar()
    {
        //
        //dd('hola');
        $banner = Banner::where('bCreador',"BIENESTAR")
        ->orderBy('created_at', 'DESC')
        ->limit(300)
        ->get();
       
       
       //dd($banner);
        
        return view('administrador.banner.Bienestar',compact('banner'));
    }
    
    
    public function storeBienestar(Request $request)
    {
        $this->validate($request, [
                'bFoto' => 'required|file|max:15288|mimetypes:image/*,video/*', // Máximo 12288 KB = 12 MB
                'bNombre'=>'required'
            ]);
        
       // dd($request->all());
        $fechademas = Carbon::now()->addDays($request->bTiempo)->toDateString();
        $activos = Banner::where('bEstado', 1)->where('bCreador',"BIENESTAR")->count();
        $shortCode = Str::random(6);
    
        // Verificar unicidad del shortCode
        while (ShortenedUrl::where('short_code', $shortCode)->exists()) {
            $shortCode = Str::random(6);
        }
    
        // 1. MANEJO DE LINK O DOCUMENTO
        $link = null;
        if (empty($request->bLink)) {
            if ($request->hasFile('documento')) {
                $archivo = $request->file('documento');
                $nombreArchivo = time() . '_' . $archivo->getClientOriginalName();
    
                // Puedes usar 'local' o 'circulares' según prefieras visibilidad pública
                \Storage::disk('circulares')->put($nombreArchivo, \File::get($archivo));
    
                $originalUrl = "https://www.disajcali.gov.co/Circulares/" . $nombreArchivo;
                ShortenedUrl::create([
                    'original_url' => $originalUrl,
                    'short_code' => $shortCode
                ]);
    
                $link = url("a/" . $shortCode);
            }
        } else {
            $link = $this->normalizeUrl($request->bLink);
            ShortenedUrl::create([
                'original_url' => $link,
                'short_code' => $shortCode
            ]);
    
            $link = url("a/" . $shortCode);
        }
    
        // 2. MANEJO DE ARCHIVO MULTIMEDIA (imagen o video)
        $filePath = null;
        $extension = null;
    
        if ($request->hasFile('bFoto')) {
            //dd('bmedia');
            $file = $request->file('bFoto');
            $extension = strtolower($file->getClientOriginalExtension());
    
            $isVideo = in_array($extension, ['mp4', 'webm']);
            $isImage = in_array($extension, ['jpg', 'jpeg', 'png', 'gif']);
    
            if (!($isVideo || $isImage)) {
                return back()->withInput()->withErrors([
                    'bFoto' => 'Solo se permiten imágenes (JPG, PNG, GIF) o videos (MP4, WEBM)'
                ]);
            }
    
            // Validación lógica: no se puede subir imagen y video al mismo tiempo
            if ($request->hasFile('documento') && ($isVideo )) {
                return back()->withInput()->withErrors([
                    'bFoto' => 'No puede subir imagen o video junto con un documento. Use solo uno.'
                ]);
            }
    
            /*$fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $fileName;*/
    
           /* if ($isVideo) {
                \Storage::disk('videos')->put($request['bFoto'], \File::get($file));
            } */
        }
        
        //dd($request['bFoto']);
    
        // 3. MANEJO DEL ESTADO
        $Estado = ($activos > 7) ? 0 : 1;
    
        Session::flash('message', ($Estado == 0)
            ? 'Hay más de 5 banners activos. Se almacena en estado inactivo.'
            : 'Banner creado correctamente.');
    
        // 4. CREAR BANNER
        Banner::create([
            'bNombre'      => $request->bNombre,
            'bFoto'        => $request['bFoto'],
            'bextension'   => $extension,
            'bLink'        => $link,
            'bTiempo'      => $fechademas,
            'bEstado'      => $Estado,
            'bCreador'     => $request->bCreador,
            'bModificador' => $request->bModificador,
        ]);
        
        //dd('bmedia3');
    
        return redirect()->back();
    }

    
    // Función para normalizar URLs
    private function normalizeUrl($url)
    {
        $url = trim($url);
        
        if (Str::startsWith($url, 'https://')) {
            return $url;
        }
        
        if (Str::startsWith($url, 'http://')) {
            return Str::replaceFirst('http://', 'https://', $url);
        }
        
        if (Str::startsWith($url, 'www.')) {
            return 'https://' . $url;
        }
        
        return $url;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $banner  = Banner::find($id);
        $fechademas = Carbon::now();
        $fechademas->addDays(5)->toDateString();
        return view('administrador/banner.edit', compact('banner','fechademas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BannerUpdateRequest $request, $id)
    {
        $fechademas = Carbon::now();
        $fechademas->addDays(5)->toDateString();
        
        $banner = Banner::find($id);
        $banner->fill($request->All());/*metodo fill sirve para actualizar informacion en la bd */
        if($request['bEstado'] == 1){
          $banner->bTiempo = $fechademas;  
        };
        
        //dd($banner);
        
        $banner->save();

        Session::flash('message', ' actualizado correctamente');
        
        if( auth()->user()->email !="bienestar@disajcali.gov.co"){
            return Redirect::to('administrador/banner');
        }else{
           return redirect()->route('baner.bienestar'); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $banner = Banner::destroy($id);
        Session::flash('message','Eliminado Correctamente');
        return redirect()->back();
        //return Redirect::to('administrador/banner');
    }
}

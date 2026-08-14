<?php

namespace App\Http\Controllers\Coe;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller\Administrador;
use App\Models\Banner;
use App\Models\CoeDocumentos;

use App\Models\Sst;
use App\Models\ControlIngreso;
use App\Models\Contador;
use Carbon\Carbon;


use Auth;

use App\Models\ShortenedUrl;
use Illuminate\Support\Str;

class CoeController extends Controller
{
    
    public function IndexCoe(Request $request){
        
        $seguridad_st            =  Sst::where('ubicacion',"COE")
        ->get(); 

        $fechaA = Carbon::now()->toDateString();
        $global = Contador::where('user_visita','GLOBAL')
        ->select('visitas')
        ->first();
        
        $diaria = Contador::where('fecha_visita',$fechaA)
        ->where('user_visita','DIARIA')
        ->select('visitas')
        ->first();
        
        $banner = Banner::where('bEstado', 1)
        ->where('bCreador', 'COE')
        ->orderBy('created_at', 'desc')
        ->get();
        //dd($banner);
        
        return view('Coe.Coe',compact('banner','seguridad_st','global','diaria'));
    }
    
   
    
    
      //banner Bienestar  Bienestar
    
     public function Coe()
    {
        //
        //dd('hola');
        $banner = Banner::where('bCreador',"COE")
        ->orderBy('created_at', 'DESC')
        ->limit(300)
        ->get();
       
       
       //dd($banner);
        
        return view('administrador.banner.Coe',compact('banner'));
    }
    
       public function storeCoe(Request $request)
    {
        $this->validate($request, [
                'bFoto' => 'required|file|max:12288|mimetypes:image/*,video/*', // Máximo 12288 KB = 12 MB
                'bNombre'=>'required'
            ]);
        
       // dd($request->all());
        $fechademas = Carbon::now()->addDays($request->bTiempo)->toDateString();
        $activos = Banner::where('bEstado', 1)->where('bCreador',"COE")->count();
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
            'bCreador'     => "COE",
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
        
        return redirect()->route('baner.coe'); 
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
    
    
    //documentos coe
    public function createDocumentoCoe()
    {
        //
        return view('administrador.comite.create');
    }

    public function storeDocumentoCoe(Request $request)
    {
        //
        CoeDocumentos::create([
            'cgtitulo'        => $request['cgtitulo'],
            'cgdocumento'     => $request['cgdocumento'],
            'cgcreador'       =>  auth()->user()->cedula,
        ]);
        Session::flash('message', 'Creado Correctamente');
        return Redirect::to('/administrador/genero-documentos');
    }

    public function editDocumentoCoe($id)
    {
        //
        $comite = CoeDocumentos::find($id);
        return view('administrador/comite.edit', compact('comite'));
    }

    public function updateDocumentoCoe(Request $request, $id)
    {
        //
        $comite                = CoeDocumentos::find($id);
        $comite->cgtitulo      = $request->get('cgtitulo');
        $comite->cgdocumento   = $request->get('cgdocumento');
        $comite->cgmodificador =  auth()->user()->cedula;
        //$comite->fill($request->All());/*metodo fill sirve para actualizar informacion en la bd */
        $comite->save();

        Session::flash('message', ' Actualizado Correctamente');
        return Redirect::to('administrador/genero-documentos');
    }

    public function destroyDocumentoCoe($id)
    {
        //
        $comite = CoeDocumentos::destroy($id);
        Session::flash('message','Eliminado Correctamente');
        return Redirect::to('administrador/genero-documentos');
    }

    
    
}
<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Support\Facades\Response;
//use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

use Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;


use App\Models\User;
use App\Models\Contrato;
use App\Models\ContratoNovedad;


class ContratoController extends Controller
{
    
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('administrador');
        
    }
    
  public function index(Request $request)
    {
        $numero      = $request->get('numero');
        $contratista = $request->get('contratista');
    
        // ===============================
        // CONTRATOS ACTIVOS
        // ===============================
        $contratos = Contrato::where('estado', 'ACTIVO')
            ->when(!empty($numero), function ($q) use ($numero) {
                // LIKE para número de contrato
                $q->where('numero', 'LIKE', '%' . $numero . '%');
            })
            ->when(!empty($contratista), function ($q) use ($contratista) {
                $q->where('contratista', 'LIKE', '%' . $contratista . '%');
            })
            ->orderBy('fecha_inicio', 'asc')
            ->select(
                'id',
                'numero',
                'tipo',
                'contratista',
                'objeto',
                'valor',
                'fecha_inicio',
                'fecha_cierre',
                'fecha_terminacion',
                'forma_pago',
                'estado',
                'apoyo_supervision_id'
            )
            ->get();
    
        // ===============================
        // CONTRATOS INACTIVOS
        // ===============================
        $contratosInactivos = Contrato::where('estado', '!=', 'ACTIVO')
            ->when(!empty($numero), function ($q) use ($numero) {
                // LIKE para número de contrato
                $q->where('numero', 'LIKE', '%' . $numero . '%');
            })
            ->when(!empty($contratista), function ($q) use ($contratista) {
                $q->where('contratista', 'LIKE', '%' . $contratista . '%');
            })
            ->orderBy('fecha_terminacion', 'asc')
            ->select(
                'id',
                'numero',
                'tipo',
                'contratista',
                'objeto',
                'valor',
                'fecha_inicio',
                'fecha_cierre',
                'fecha_terminacion',
                'forma_pago',
                'estado',
                'apoyo_supervision_id'
            )
            ->get();
    
        return view(
            'administrador.Contratos.Index',
            compact('contratos', 'contratosInactivos')
        );
    }

    public function create()
    {
        $usuarios = User::orderBy('name')->get();
        return view('administrador.Contratos.Create', compact('usuarios'));
    }

    
    
    public function store(Request $request)
    {
        $request->validate([
            'numero' => 'required|max:80',
            'tipo' => 'required',
            'contratista'=> 'required',
            'objeto' => 'required',
            'valor' => 'required|max:120',
            'fecha_inicio' => 'required|date',
            'fecha_terminacion' => 'required|date',
            'documento_inicial' => 'nullable|file|mimes:pdf,doc,docx'
        ]);
        
        DB::beginTransaction();
         try{      
          
        
    
        $data = $request->all();
    
        // LIMPIAR VALOR (101.463.535.90 → 101463535.90)
        //$data['valor'] = str_replace('.', '', $request->valor);
    
        // USUARIO QUE CREA
        $data['apoyo_supervision_id'] = auth()->user()->name." ".auth()->user()->lastname;
    
        // DOCUMENTO
        
        if(!empty($request->file('documento_inicial'))){
        $file = $request->file('documento_inicial');
        
        // Nombre original SIN extensión
        $nombreBase = pathinfo(
            $file->getClientOriginalName(),
            PATHINFO_FILENAME
        );
    
        // Extensión real
        $extension = $file->getClientOriginalExtension();
    
        // Nombre final limpio
        $nombre =$request->contratista.'\\'. $request->numero.'\\'
            .'_'.$nombreBase
            .'_'.Carbon::now()->format('Ymd_His')
            .'.'.$extension;
        
        \Storage::disk('supervisionContrato')->put($nombre, \File::get($file));
        
        
        
        
        
        $data['documento_inicial'] = $nombre;
        }
        
        $data['apoyo_supervision_id']= auth()->user()->name." ". auth()->user()->lastname;
        Contrato::create($data);
  
    
        DB::commit();
        
        return redirect()
            ->route('contratos.novedades.index')
            ->with('success', 'Contrato registrado correctamente'); 
            
           
            
         }catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with('error', "Se presento un error, informe a soporte ".$e->getMessage())->withInput();
        }
        
       
        
    }
    
    

    public function show(Contrato $contrato)
    {
        
        return view('administrador.Contratos.Show', compact('contrato'));
    }

    public function edit(Contrato $contrato)
    {
        $usuarios = User::all();
       // dd($contrato);
        return view('administrador.Contratos.Edit', compact('contrato','usuarios'));
    }

    public function update(Request $request, Contrato $contrato)
    {
        $contrato->update($request->all());
        return back()->with('success','Contrato actualizado');
    }
    
    
    public function Documento(Request $request, $id)
    {
        
        $contrato= Contrato::findOrFail($id);
        
       // dd($contrato,$request->file('documento_inicial'));
        
         if(!empty($request->file('documento_inicial'))){
        $file = $request->file('documento_inicial');
        
        // Nombre original SIN extensión
        $nombreBase = pathinfo(
            $file->getClientOriginalName(),
            PATHINFO_FILENAME
        );
    
        // Extensión real
        $extension = $file->getClientOriginalExtension();
    
        // Nombre final limpio
        $nombre =$request->contratista.'\\'. $request->numero.'\\'
            .'_'.$nombreBase
            .'_'.Carbon::now()->format('Ymd_His')
            .'.'.$extension;
        
        \Storage::disk('supervisionContrato')->put($nombre, \File::get($file));
        
        
        
        
        
        $contrato->documento_inicial = $nombre;
        $contrato->save();
        
        }
        
        return back()->with('success','Contrato actualizado');
    }
    
    public function Novedades(Request $request)
    {
        $novedad = new ContratoNovedad();
        
        $novedad->contrato_id=$request->contrato_id;
        $novedad->descripcion=$request->descripcion;
        $novedad->fecha=Carbon::Now();;
        $novedad->usuario_id= auth()->user()->name." ". auth()->user()->lastname;
        $novedad->save();
        
        return back()->with('success','Novedad Registrada');
    }
    
    
    public function updateSeguimiento(Request $request, Contrato $contrato)
    {
        $data = $request->only([
            'firmo_acta',
            'subio_secop',
            'cerro_contrato',
            'subio_secop2',
            'termino_contrato_secop2'
        ]);

        // Convertir checkboxes a booleanos
        foreach ($data as $key => $value) {
            $data[$key] = $value ? true : false;
        }
        
        //dd($data,$contrato);


        $contrato->fill($data);
        $contrato->save();

        return back()->with('success', 'Seguimiento actualizado correctamente');
    }
    
    
}

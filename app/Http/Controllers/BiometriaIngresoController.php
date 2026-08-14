<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BiometriaIngreso;
use App\Models\BiometriaIngresoRegistro;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;

class BiometriaIngresoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('ingresoporteria');
    }

    public function index(Request $request)
    {
        return view('Biometria.Index');
    }

    public function save(Request $request)
    {        
        //dd($request->all());
        $request->validate([
            //'tipo_doc' => 'required',
            'tipo_doc' => ['required', 'string', Rule::in(['CC', 'CE', 'PAS','TI'])], 
            'identificacion' => 'required|min:6|max:13',     
            'p_apellido' => 'required',
            'p_nombre' => 'required|max:50',
        ]);

        $identificacion = (int) $request->identificacion;
        $verificacion = BiometriaIngreso::where('identificacion', $identificacion)
        ->where('tipo_doc', $request->tipo_doc)
        ->first();

        if (!$verificacion) {
            $request->validate([
                'identificacion' => 'required|min:6|max:13',//|unique:biometria_ingresos,identificacion'
            ]);

            $BiometriaIngreso = new BiometriaIngreso();

            $BiometriaIngreso->tipo_doc = strtoupper($request->tipo_doc);
            $BiometriaIngreso->identificacion = $identificacion;
            $BiometriaIngreso->p_apellido = strtoupper($request->p_apellido);
            $BiometriaIngreso->s_apellido = strtoupper($request->s_apellido);
            $BiometriaIngreso->p_nombre = strtoupper($request->p_nombre);
            $BiometriaIngreso->s_nombre = strtoupper($request->s_nombre);
            $BiometriaIngreso->id_porteria =  auth()->user()->id;
            $BiometriaIngreso->save();

           //dd($request->all(),$BiometriaIngreso);

            $verificacion = $BiometriaIngreso;
            return view('Biometria.CargarFoto', compact('verificacion'));
        }

        return empty($verificacion->url_imagen)
            ? view('Biometria.CargarFoto', compact('verificacion'))
            : view('Biometria.MostrarFoto', compact('verificacion'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        
        $request->validate([
            'tipo_doc' => ['required', 'string', Rule::in(['CC', 'CE', 'PAS','TI'])],
            'identificacion' => 'required|min:6',
            'p_apellido' => 'required',
            'p_nombre' => 'required|max:50',
        ]);

        DB::beginTransaction();

        $identificacion = (int) $request->identificacion;
        $verificacion = BiometriaIngreso::where('identificacion', $identificacion)
        ->where('tipo_doc', $request->tipo_doc)
        ->first();

        if (!$verificacion || empty($verificacion->url_imagen)) {
            $request->validate(['imagen_base64' => 'required']);
            //dd($verificacion);
        }

        

        try {
            $BiometriaIngreso = $verificacion ?? new BiometriaIngreso();
            $BiometriaIngreso->identificacion = $identificacion;
            $BiometriaIngreso->p_apellido = strtoupper($request->p_apellido);
            $BiometriaIngreso->s_apellido = strtoupper($request->s_apellido);
            $BiometriaIngreso->p_nombre = strtoupper($request->p_nombre);
            $BiometriaIngreso->s_nombre = strtoupper($request->s_nombre);
            $BiometriaIngreso->observaciones = strtoupper($request->observaciones);
            $BiometriaIngreso->id_porteria =  auth()->user()->id;

            // 🔹 Guardar imagen en carpeta pública (public/Biometria)
            
            if(empty($verificacion))
                 {
                    if (!empty($request->imagen_base64)) {
                        $fileName = $identificacion ."_".$verificacion->p_apellido .'_' . time() . '.jpg';
                        $this->guardarImagenBase64EnPublic($request->imagen_base64, $fileName);
                        $BiometriaIngreso->url_imagen = $fileName;
                    }
                    
                 }

            $BiometriaIngreso->save();

            // 🔹 Crear registro de ingreso
            $BiometriaIngresoRegistro = new BiometriaIngresoRegistro();
            $BiometriaIngresoRegistro->biometria_ingresos_id = $BiometriaIngreso->id;
            $BiometriaIngresoRegistro->fecha = Carbon::now()->toDateString();
            $BiometriaIngresoRegistro->accion = "INGRESO";
            $BiometriaIngresoRegistro->fecha_ingreso = Carbon::now()->toDateString();
            $BiometriaIngresoRegistro->hora_ingreso = Carbon::now()->toTimeString();
            $BiometriaIngresoRegistro->id_porteria =  auth()->user()->id;
            $BiometriaIngresoRegistro->direccion_ingreso =  auth()->user()->direccion_porteria;
            $BiometriaIngresoRegistro->save();

            
            DB::commit();

            Session::flash('success', 'El registro de ingreso ha sido exitoso!');
            return redirect()->route('biometria.index');
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with('error', "Error al guardar: " . $e->getMessage())->withInput();
        }
    }

    public function cargarFoto(Request $request)
    {
        
        if (empty($request->imagen_base64)) {
            Session::flash('error', 'Debe tomar la foto para almacenar.');
            return redirect()->back();
        }

        $request->validate(['imagen_base64' => 'required']);

        DB::beginTransaction();

        try {
            $identificacion = (int) $request->identificacion;
            $verificacion = BiometriaIngreso::where('identificacion', $identificacion)
            ->where('tipo_doc', $request->tipo_doc)
            ->first();//BiometriaIngreso::where('identificacion', $identificacion)->first();
            //dd($verificacion);

            if (empty($verificacion->url_imagen)) {
                $fileName = $identificacion ."_".$verificacion->p_apellido .'_' . time() . '.jpg';
                $this->guardarImagenBase64EnPublic($request->imagen_base64, $fileName);

                $verificacion->url_imagen = $fileName;
                $verificacion->id_porteria =  auth()->user()->id;
                $verificacion->observaciones = strtoupper($request->observaciones);
                $verificacion->save();
            }

            $registro = new BiometriaIngresoRegistro();
            $registro->biometria_ingresos_id = $verificacion->id;
            $registro->fecha = Carbon::now()->toDateString();
            $registro->accion = "INGRESO";
            $registro->fecha_ingreso = Carbon::now()->toDateString();
            $registro->hora_ingreso = Carbon::now()->toTimeString();
            $registro->id_porteria =  auth()->user()->id;
            $registro->direccion_ingreso =  auth()->user()->direccion_porteria;
            $registro->save();

            DB::commit();

            Session::flash('success', 'El registro de ingreso ha sido exitoso!');
            return redirect()->route('biometria.index');
        } catch (\Throwable $e) {
            DB::rollback();
            return back()->with('error', "Error al guardar la foto: " . $e->getMessage());
        }
    }

    /**
     * 🔹 Convierte base64 a archivo físico en /public/Biometria
     */
    private function guardarImagenBase64EnPublic($base64, $fileName)
    {
        try {
            // Eliminar encabezado data:image/jpeg;base64, si existe
            $imageData = preg_replace('/^data:image\/\w+;base64,/', '', $base64);
            $imageData = str_replace(' ', '+', $imageData);
            $image = base64_decode($imageData);

            //$path = public_path('Biometria');
            $path = base_path('../public_html/Biometria');
            if (!file_exists($path)) {
               // mkdir($path, 0755, true);
            }

            file_put_contents($path . '/' . $fileName, $image);
        } catch (\Throwable $e) {
            throw new \Exception("No se pudo guardar la imagen: " . $e->getMessage());
        }
    }

    public function Consulta(Request $request,$tipo,$cedula)
    {
       // dd($request->all(),$cedula,$tipo);
        $identificacion = (int) $cedula;
        $consulta = BiometriaIngreso::where('identificacion', $identificacion)        
        ->where('tipo_doc', $tipo)
        ->first();
        
        //dd($consulta);
        if(empty($consulta)){
            $consulta->p_apellido = "";
            $consulta->s_apellido = "";
            $consulta->p_nombre = "";
            $consulta->s_nombre = "";
        }

        return $request->ajax() ? response()->json($consulta) : null;
    }

    public function registrarSalidaPorteria(Request $request, $id)
    {
        $id = intval($id);
        $verificacion = BiometriaIngreso::where('identificacion', $id)->first();

        if ($verificacion) {
            $registro = new BiometriaIngresoRegistro();
            $registro->biometria_ingresos_id = $verificacion->id;
            $registro->fecha = Carbon::now()->toDateString();
            $registro->accion = "SALIDA";
            $registro->fecha_salida = Carbon::now()->toDateString();
            $registro->hora_salida = Carbon::now()->toTimeString();
            $registro->id_porteria =  auth()->user()->id;
            $registro->porteria_salida =  auth()->user()->direccion_porteria;
            $registro->save();

            $mensaje = ['mensaje' => 'Registro de salida exitoso... <br> Feliz dia!!', 'codigo' => '1'];
        } else {
            $mensaje = ['mensaje' => 'Error al registrar la salida, cedula ' . $id . ' no esta registrada.<br>Feliz dia!', 'codigo' => '0'];
        }

        return $request->ajax() ? response()->json($mensaje) : null;
    }
}

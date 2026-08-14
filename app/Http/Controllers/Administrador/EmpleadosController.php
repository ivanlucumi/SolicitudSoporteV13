<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller\Administrador;
use App\Http\Requests\EmpleadosCreateRequest;
use App\Http\Requests\EmpleadosUpdateRequest;
use App\Models\Empleado;
use App\Models\SolicitudUsuario;
use Illuminate\Support\Facades\Storage;

class EmpleadosController extends Controller
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
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = Empleado::query();

        if (!empty($search)) {
            $query->where('cedulaE', 'LIKE', "%{$search}%")
                  ->orWhere('nameE', 'LIKE', "%{$search}%")
                  ->orWhere('lastnameE', 'LIKE', "%{$search}%")
                  ->orWhere('cargo_titular', 'LIKE', "%{$search}%")
                  ->orWhere('ciudad_ubicacion_laboral', 'LIKE', "%{$search}%");
        }

        $totalConFoto = Empleado::whereNotNull('foto')->count();
        $totalInstalados = Empleado::whereNotNull('dispositivo_id')->count();

        // Limit results per page to improve performance significantly
        $empleados = $query->paginate(30);

        return view('administrador.empleados.index', compact('empleados', 'search', 'totalConFoto', 'totalInstalados'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $despachos = \App\Models\Despacho::despachoIndex() ?? [];
        
        // Fetch cargos ONLY from the empleados table as requested
        $cargos = Empleado::select('cargo_titular')
                            ->whereNotNull('cargo_titular')
                            ->where('cargo_titular', '!=', '')
                            ->distinct()
                            ->orderBy('cargo_titular', 'asc')
                            ->pluck('cargo_titular');

        return view('administrador.empleados.create', compact('despachos', 'cargos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // ✅ Validación
        $request->validate([
            'cedula' => 'required|numeric|unique:empleados,cedulaE',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
        ], [
            'cedula.unique' => 'Ya existe un empleado registrado con esta cédula.',
            'cedula.required' => 'La cédula es obligatoria.',
        ]);
    
        // ✅ Validación adicional (doble seguridad)
        $existe = Empleado::where('cedulaE', $request->cedula)->first();
        if ($existe) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'El empleado ya se encuentra registrado en el sistema.');
        }
    
        $empleado = new Empleado();
        $empleado->cedulaE = $request->input('cedula');
        $empleado->nameE = $request->input('nombre');
        $empleado->lastnameE = $request->input('apellido');
        $empleado->cargo_titular = $request->input('cargo_titular');
        $empleado->ciudad_ubicacion_laboral = $request->input('ciudad_ubicacion_laboral');
        $empleado->fecha_expedicion = $request->input('fecha_expedicion');
        $empleado->fecha_retiro = $request->input('fecha_retiro');
        $empleado->estado = $request->input('estado', 'A');
    
        // ✅ Manejo despacho
        if ($request->filled('cod_despacho')) {
            if ($request->cod_despacho === 'CONTRATISTA') {
                $empleado->cod_despacho = 'CONTRATISTA';
                $empleado->cod_dependencia = 'CONTRATISTA';
                $empleado->dependencia_titular = 'CONTRATISTA';
            } else {
                $despacho = \App\Models\Despacho::find($request->cod_despacho);
                if ($despacho) {
                    $empleado->cod_despacho = $despacho->codigoDespacho;
                    $empleado->cod_dependencia = $despacho->codigoDespacho;
                    $empleado->dependencia_titular = $despacho->nombreDespacho;
                }
            }
        }
    
        // ✅ Foto
        if ($request->filled('foto_base64')) {
            $base_to_php = explode(',', $request->foto_base64);
            if (count($base_to_php) === 2) {
                $data = base64_decode($base_to_php[1]);
                $filename = $empleado->cedulaE . '_' . now()->format('Ymd_His') . '.jpg';
    
                Storage::disk('FotosCarnet')->put($filename, $data);
                $empleado->foto = $filename;
            }
        }
    
        $empleado->save();
    
        Session::flash('message', 'Empleado creado correctamente');
        return Redirect::to('/administrador/empleados');
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
        $empleado = Empleado::findOrFail($id);
        
        // Fetch despachos using the optimized joint query
        $despachos = \App\Models\Despacho::despachoIndex() ?? [];
        
        // Fetch cargos ONLY from the empleados table as requested
        $cargos = Empleado::select('cargo_titular')
                            ->whereNotNull('cargo_titular')
                            ->where('cargo_titular', '!=', '')
                            ->distinct()
                            ->orderBy('cargo_titular', 'asc')
                            ->pluck('cargo_titular');
              
        return view('administrador.empleados.edit', compact('empleado', 'despachos', 'cargos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $empleado = Empleado::findOrFail($id);
    
        // ✅ Validación
        $request->validate([
            'cedula' => 'required|numeric|unique:empleados,cedulaE,' . $id,
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
        ], [
            'cedula.unique' => 'La cédula ya está registrada en otro empleado.',
        ]);
    
        // ✅ Validación adicional manual
        $existe = Empleado::where('cedulaE', $request->cedula)
            ->where('id', '!=', $id)
            ->first();
    
        if ($existe) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'La cédula ya pertenece a otro empleado.');
        }
    
        // ✅ Asignación manual (mejor que fill en este caso)
        $empleado->cedulaE = $request->input('cedula');
        $empleado->nameE = $request->input('nombre');
        $empleado->lastnameE = $request->input('apellido');
        $empleado->cargo_titular = $request->input('cargo_titular');
        $empleado->ciudad_ubicacion_laboral = $request->input('ciudad_ubicacion_laboral');
        $empleado->fecha_expedicion = $request->input('fecha_expedicion');
        $empleado->fecha_retiro = $request->input('fecha_retiro');
        $empleado->estado = $request->input('estado', 'A');
    
        // ✅ Foto
        if ($request->filled('foto_base64')) {
            if ($empleado->foto && Storage::disk('FotosCarnet')->exists($empleado->foto)) {
                Storage::disk('FotosCarnet')->delete($empleado->foto);
            }
    
            $base_to_php = explode(',', $request->foto_base64);
            if (count($base_to_php) === 2) {
                $data = base64_decode($base_to_php[1]);
                $filename = $empleado->cedulaE . '_' . now()->format('Ymd_His') . '.jpg';
    
                Storage::disk('FotosCarnet')->put($filename, $data);
                $empleado->foto = $filename;
            }
        }
    
        // ✅ Despacho
        if ($request->filled('cod_despacho')) {
            if ($request->cod_despacho === 'CONTRATISTA') {
                $empleado->cod_despacho = 'CONTRATISTA';
                $empleado->cod_dependencia = 'CONTRATISTA';
                $empleado->dependencia_titular = 'CONTRATISTA';
            } else {
                $despacho = \App\Models\Despacho::find($request->cod_despacho);
                if ($despacho) {
                    $empleado->cod_despacho = $despacho->codigoDespacho;
                    $empleado->cod_dependencia = $despacho->codigoDespacho;
                    $empleado->dependencia_titular = $despacho->nombreDespacho;
                }
            }
        }
    
        $empleado->save();
    
        Session::flash('message', 'Empleado actualizado correctamente');
        return Redirect::to('/administrador/empleados');
    }

    public function resetDevice($id)
    {
        $empleado = Empleado::findOrFail($id);
        $empleado->dispositivo_id = null;
        $empleado->estado = "A";
        $empleado->save();
        
        Session::flash('message', 'El dispositivo vinculado fue desenlazado exitosamente. Ahora el empleado puede instalar el PWA en un nuevo equipo.');
        return Redirect::to('/administrador/empleados');
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
        $comprobar = 0;
        $dato = SolicitudUsuario::where('idEmpleado',$id)->get();

        $comprobar = count($dato);
        //dd($comprobar);
        if($comprobar == 0){
            $ciudad = Empleado::destroy($id);
            Session::flash('message','Eliminado Correctamente');
            return Redirect::to('/administrador/empleados');
        }else{
            Session::flash('message','No se puede eliminar Empleado, está siendo utilizado en Solicitud Usuario');
            return Redirect::to('/administrador/empleados');
        }
        
        
    }
}

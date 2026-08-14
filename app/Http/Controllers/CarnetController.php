<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class CarnetController extends Controller
{
    // ─── GET /carnet/consulta  —  Formulario de consulta ──────────────
    public function form()
    {
        return view('carnet.consulta_carnet');
    }
    
    public function redireccion(){
        return redirect()->route('carnet.consulta');
    }

    // ─── GET /mi-carnet — Vista local (PWA) ─────────────────────────────────
    public function miCarnet()
    {
        // Esta vista se renderiza por JS con los datos de localStorage.
        return view('carnet.mi_carnet');
    }

    // ─── GET /monitoreo/validador-carnets — Scanner PWA (Portería) ──────────
    public function validador()
    {
        return view('carnet.validador');
    }

    // ─── GET /monitoreo/validador-manual — Ingreso Manual ───────────────────
    public function validadorManual()
    {
        return view('carnet.validador_manual');
    }

    // ─── POST /carnet/consultar  —  Procesa el formulario y muestra el carnet ─
    public function consultarCarnet(Request $request)
    {
        $request->validate([
            'cedula'           => 'required|string|max:15',
            'fecha_expedicion' => 'required|date|before_or_equal:today',
        ], [
            'cedula.required'            => 'El número de cédula es obligatorio.',
            'cedula.max'                 => 'La cédula no puede tener más de 15 caracteres.',
            'fecha_expedicion.required'  => 'La fecha de expedición es obligatoria.',
            'fecha_expedicion.date'      => 'La fecha de expedición no es válida.',
            'fecha_expedicion.before_or_equal' => 'La fecha de expedición no puede ser futura.',
        ]);

        $cedula           = preg_replace('/\D/', '', $request->cedula);
        $fechaExpedicion  = Carbon::parse($request->fecha_expedicion)->format('Y-m-d');

        $empleado = Empleado::where('cedulaE', $cedula)
                            ->where('fecha_expedicion', $fechaExpedicion)
                            ->first();

        if (! $empleado) {
            return redirect()
                ->route('carnet.consulta')
                ->with('error', 'No se encontró un empleado con la cédula y la fecha de expedición ingresadas. Verifique los datos e inténtelo nuevamente.
                                Si el inconveniente persiste, envíe un correo a cldisajcali@cendoj.ramajudicial.gov.co
                                ; si es su primera solicitud, adjunte una foto tipo carné con fondo blanco.');
        }
        
        if (empty($empleado->foto) || !is_string($empleado->foto) || trim($empleado->foto) === '') {
            return redirect()
                ->route('carnet.consulta')
                ->with('error', 'No se encontró una fotografía válida para la generación del carné. Por favor, remita una imagen actualizada al correo institucional cldisajcali@cendoj.ramajudicial.gov.co.');
        }

        if (!empty($empleado->dispositivo_id)) {
            return redirect()
                ->route('carnet.consulta')
                 ->with('error', 'Acceso Denegado: Este carnet ya se encuentra instalado en un dispositivo móvil. Comuníquese al correo institucional cldisajcali@cendoj.ramajudicial.gov.co si necesita generarlo en un nuevo equipo.');
       
        }

        $this->checkAndDeactivateVencido($empleado);

        if (empty($empleado->carnet_token)) {
            $empleado->carnet_token = \Illuminate\Support\Str::uuid()->toString();
            $empleado->save();
        }

        return redirect()->route('carnet.public', ['token' => $empleado->carnet_token]);
    }

    // ─── GET /carnet/ver/{token}  —  Vista Blade (acceso directo público) ───────────────
    public function showPublic(string $token)
    {
        $empleado = Empleado::where('carnet_token', $token)->first();

        if (!$empleado) {
            return redirect()
                ->route('carnet.consulta')
                ->with('error', 'El enlace o el carnet ha sido revocado o ya no de encuentra disponible.');
        }

        $this->checkAndDeactivateVencido($empleado);
        return view('carnet.carnet_resultado', compact('empleado'));
    }

    // ─── POST /api/carnet/revocar ───────────────────────────────────────────
    public function revocar(Request $request): JsonResponse
    {
        $request->validate(['cedula' => 'required|string']);
        $cedula = preg_replace('/\D/', '', $request->cedula);
        
        $empleado = Empleado::where('cedulaE', $cedula)->first();
        if ($empleado) {
            $empleado->carnet_token = null;
            $empleado->save();
        }
        
        return response()->json(['success' => false]);
    }

    // ─── GET /api/carnet/validar?cedula=XXX ──────────────────────────────────
    public function validar(Request $request): JsonResponse
    {
        $request->validate(['cedula' => 'required|string|max:20']);

        $empleado = Empleado::where('cedulaE', $request->cedula)->first();

        if (! $empleado) {
            return response()->json([
                'encontrado' => false,
                'activo'     => false,
                'message'    => 'Empleado no encontrado en el sistema',
            ], 404);
        }

        $this->checkAndDeactivateVencido($empleado);

        $deviceId = $request->device_id;
        $transfer = $request->transfer;
        $isStandalone = $request->standalone == '1';

        if ($deviceId) {
            if ($isStandalone && $transfer && $empleado->dispositivo_id === $transfer) {
                // The PWA has been launched. Claim the device slot permanently.
                $empleado->dispositivo_id = $deviceId;
                $empleado->save();
            }

            if (!empty($empleado->dispositivo_id)) {
                if ($empleado->dispositivo_id !== $deviceId && $empleado->dispositivo_id !== $transfer) {
                    return response()->json([
                        'encontrado' => true,
                        'activo'     => false,
                        'status'     => 'error',
                        'message'    => '❌ CARNET VINCULADO A OTRO DISPOSITIVO. Comuníquese con Recursos Humanos al correo cldisajcali@cendoj.ramajudicial.gov.co  para autorizar su liberación.'           
                    ]);
                }
            } else if ($isStandalone) {
                $empleado->dispositivo_id = $transfer ? $transfer : $deviceId;
                $empleado->save();
            }
        }

        return response()->json([
            'encontrado' => true,
            'activo'     => $empleado->estaVigente(),
            'nombre'     => $empleado->nameE . ' ' . $empleado->lastnameE,
            'cargo'      => $empleado->cargo_titular,
            'cedula'     => $empleado->cedulaE,
            'vigencia'   => $empleado->fecha_retiro_formateada,
            'sede'       => $empleado->ciudad_ubicacion_laboral,
            'observacion'=> $empleado->observacion,
            'foto'       => $empleado->foto,
            'message'    => $empleado->estaVigente()
                             ? '✅ IDENTIDAD VERIFICADA Y ACTIVA'
                             : '❌ Funcionario no cuenta con Carnet Activo.',
        ]);
    }

    // ─── PATCH /api/carnet/{cedula}/estado ────────────────────────────────────
    public function actualizarEstado(Request $request, string $cedula): JsonResponse
    {
        $request->validate([
            'estado' => 'required|in:ACTIVE,INACTIVE,EXPIRED'
        ]);

        $empleado = Empleado::where('cedulaE', $cedula)->firstOrFail();
        $empleado->update(['estado' => $request->estado === 'ACTIVE' ? 'A' : 'I']);

        return response()->json([
            'success' => true,
            'cedula'  => $cedula,
            'estado'  => $request->estado,
        ]);
    }
    // ─── GET /api/carnet/token/{token} ────────────────────────────────────
    public function getByToken(Request $request, string $token): JsonResponse
    {
        $empleado = Empleado::where('carnet_token', $token)->first();

        if (! $empleado) {
            return response()->json(['error' => 'not_found'], 404);
        }

        $deviceId = $request->device_id;
        $transfer = $request->transfer;
        $isStandalone = $request->standalone == '1';

        if ($transfer && empty($empleado->dispositivo_id)) {
             $empleado->dispositivo_id = $transfer;
             $empleado->save();
        }

        if ($deviceId && !empty($empleado->dispositivo_id)) {
            if ($empleado->dispositivo_id !== $deviceId && $empleado->dispositivo_id !== $transfer) {
                return response()->json(['error' => 'bound_to_other_device'], 403);
            }
        } else if ($deviceId && $isStandalone && empty($empleado->dispositivo_id)) {
             $empleado->dispositivo_id = $deviceId;
             $empleado->save();
        }

        $this->checkAndDeactivateVencido($empleado);

        return response()->json([
            'nombre'     => strtoupper($empleado->nameE) . ' ' . strtoupper($empleado->lastnameE),
            'iniciales'  => substr($empleado->nameE, 0, 1) . substr($empleado->lastnameE, 0, 1),
            'cedula'     => $empleado->cedulaE,
            'cargo'      => strtoupper($empleado->cargo_titular ?? $empleado->clase_nombramiento ?? 'EMPLEADO JUDICIAL'),
            'foto'       => $empleado->foto ?? substr($empleado->nameE, 0, 1) . substr($empleado->lastnameE, 0, 1),
            'observacion'=> $empleado->observacion,
            'esActivo'   => $empleado->estaActivo()
        ]);
    }

    private function checkAndDeactivateVencido($empleado)
    {
        // Si no existe el empleado o no tiene fecha de vigencia, no hace nada.
        if (!$empleado || empty($empleado->fecha_retiro)) {
            return;
        }
    
        // Fecha de vencimiento + 40 días de gracia.
        $fechaLimite = $empleado->fecha_retiro
            ->copy()
            ->addDays(40)
            ->endOfDay();
    
        // Si ya pasó la fecha límite y aún está activo, lo inactiva.
        if (now()->greaterThan($fechaLimite) && $empleado->estaActivo()) {
            $empleado->estado = 'I';
            $empleado->save();
        }
        // Solo inactiva si la vigencia (fecha_retiro) es estrictamente MENOR al día de hoy.
        // Si la vigencia está en blanco o nula, no hace nada (sigue vigente si estaba activo).
        /*if ($empleado && !empty($empleado->fecha_retiro)) {
            if ($empleado->fecha_retiro->startOfDay()->lessThan(now()->startOfDay()) && $empleado->estaActivo()) {
                $empleado->estado = 'I';
                $empleado->save();
            }
        }*/
    }
}

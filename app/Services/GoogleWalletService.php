<?php

namespace App\Services;

use Google\Client;
use Google\Service\Walletobjects;
use App\Models\Empleado;
use Firebase\JWT\JWT;
use Google\Service\Walletobjects\GenericObject;
use Google\Service\Walletobjects\Barcode;
use Google\Service\Walletobjects\Image;
use Google\Service\Walletobjects\ImageUri;
use Google\Service\Walletobjects\LocalizedString;
use Google\Service\Walletobjects\TranslatedString;
use Google\Service\Walletobjects\TextModuleData;
use Illuminate\Support\Facades\Log;
 
class GoogleWalletService
{
    private Client $client;
    private Walletobjects $wallet;
    private array $creds;
    private string $issuerId;
    private string $classId;
 
    public function __construct()
    {
        $credPath = base_path(config('services.google_wallet.credentials'));

        // Validacion defensiva: error claro si la ruta o el archivo no existen
            if (empty($credPath) || !file_exists($credPath)) {
                throw new \RuntimeException(
                    "Google Wallet: archivo de credenciales no encontrado en: {$credPath}\n" .
                    "Verificar GOOGLE_WALLET_CREDENTIALS en .env y ejecutar php artisan config:clear"
                );
            }

        $this->creds    = json_decode(file_get_contents($credPath), true);
        $this->issuerId = config('services.google_wallet.issuer_id');
        $this->classId  = $this->issuerId . '.' . config('services.google_wallet.class_id');
 
        $this->client = new Client();
        $this->client->setAuthConfig($credPath);
        $this->client->addScope(Walletobjects::WALLET_OBJECT_ISSUER);
        $this->wallet = new Walletobjects($this->client);
    }
 
    // ─── Crear o actualizar PassObject en Google Wallet ──────
    public function crearPassObject(Empleado $empleado): string
    {
        $objectId = $this->issuerId . '.EMP_' . $empleado->cedulaE;

        // Construir nombre completo desde los campos reales
        $nombreCompleto = trim(
            strtoupper($empleado->nameE ?? '') . ' ' .
            strtoupper($empleado->lastnameE ?? '')
        );

        // Vigencia: usar fecha_retiro si existe, si no calcular 1 año desde hoy
        $fechaRetiro = $empleado->fecha_retiro
            ? \Carbon\Carbon::parse($empleado->fecha_retiro)->format('d/m/Y')
            : now()->addYear()->format('d/m/Y');

        // Estado activo: basado en el campo 'estado' real
        $activo = !empty($empleado->estado) && $empleado->estado !== 'INACTIVO';

        $passObject = new GenericObject([
            'id'        => $objectId,
            'classId'   => $this->classId,
            'state'     => $activo ? 'ACTIVE' : 'INACTIVE',
            'cardTitle' => $this->local('DISAJ Cali'),
            'subheader' => $this->local('Carnet de Identificacion'),
            'header'    => $this->local($nombreCompleto ?: 'SIN NOMBRE'),
            'heroImage' => new Image([
                'sourceUri'          => new ImageUri([
                    'uri' => $empleado->foto_url ?? asset('img/foto-default.jpg')
                ]),
                'contentDescription' => $this->local('Foto empleado'),
            ]),
            'textModulesData' => [
                new TextModuleData([
                    'id'     => 'cedula',
                    'header' => 'CEDULA',
                    'body'   => (string)($empleado->cedulaE ?? 'N/A'),
                ]),
                new TextModuleData([
                    'id'     => 'cargo',
                    'header' => 'CARGO',
                    'body'   => strtoupper($empleado->cargo_titular ?? 'SIN CARGO'),
                ]),
                new TextModuleData([
                    'id'     => 'dependencia',
                    'header' => 'DEPENDENCIA',
                    'body'   => strtoupper($empleado->dependencia_titular ?? ''),
                ]),
                new TextModuleData([
                    'id'     => 'ciudad',
                    'header' => 'CIUDAD',
                    'body'   => strtoupper($empleado->ciudad_ubicacion_laboral ?? ''),
                ]),
                new TextModuleData([
                    'id'     => 'vigencia',
                    'header' => 'VIGENTE HASTA',
                    'body'   => $fechaRetiro,
                ]),
            ],
            'barcode' => new Barcode([
                'type'          => 'CODE_128',
                'value'         => (string)($empleado->cedulaE ?? '000000'),
                'alternateText' => (string)($empleado->cedulaE ?? '000000'),
            ]),
            'hexBackgroundColor' => '#1A73E8',
        ]);

        try {
            $this->wallet->genericobject->insert($passObject);
        } catch (\Google\Service\Exception $e) {
            if ($e->getCode() === 409) {
                $this->wallet->genericobject->patch($objectId, $passObject);
            } else {
                Log::error('Google Wallet: ' . $e->getMessage());
                throw $e;
            }
        }

        return $objectId;
    }
 
    // ─── Generar JWT firmado con RS256 ───────────────────────
    public function generarJWT(string $objectId): string
    {
        $payload = [
            'iss' => $this->creds['client_email'],
            'aud' => 'google',
            'typ' => 'savetowallet',
            'iat' => time(),
            'payload' => [
                'genericObjects' => [['id' => $objectId]]
            ],
        ];
 
        return JWT::encode($payload, $this->creds['private_key'], 'RS256');
    }
 
    // ─── Actualizar estado ACTIVE | INACTIVE | EXPIRED ───────
    public function actualizarEstado(string $cedula, string $estado): void
    {
        $objectId = $this->issuerId . '.EMP_' . $cedula;
        $patch = new GenericObject(['state' => $estado]);
        $this->wallet->genericobject->patch($objectId, $patch);
    }
 
    // ─── Helper LocalizedString ──────────────────────────────
    private function local(string $value): LocalizedString
    {
        return new LocalizedString([
            'defaultValue' => new TranslatedString([
                'language' => 'es',
                'value'    => $value,
            ])
        ]);
    }
}

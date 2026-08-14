<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EncuestaUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $email = 'Encuesta@disajcali.gov.co';
        
        $user = User::where('email', $email)->first();

        if (!$user) {
            User::create([
                'name' => 'Admin',
                'lastname' => 'Encuestas',
                'email' => $email,
                'password' => 'secret123', // La contraseña será secret123
                'cedula' => '00000000',
                'rol' => 1, // Asumiendo que 1 es un rol válido (admin)
                'estado_rol' => 1,
            ]);
            echo "Usuario {$email} creado con contraseña: secret123\n";
        } else {
            $user->update([
                'password' => 'secret123'
            ]);
            echo "El usuario ya existía. La contraseña de {$email} se restableció a: secret123\n";
        }
    }
}

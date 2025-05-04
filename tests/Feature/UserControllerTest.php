<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    public function test_usuario_puede_registrarse()
    {
        // Datos de registro simulados
        $datos = [
            'alias' => 'nuevo_usuario',
            'name' => 'Juan Pérez',
            'email' => 'juan@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        // Usamos withoutEvents para evitar que se disparen eventos que guarden el usuario en la base de datos
        $this->withoutEvents(function () use ($datos) {
            // Enviar POST a la ruta de registro
            $response = $this->post('/register', $datos);

            // Verificar la redirección (por defecto a /home)
            $response->assertRedirect('/');
        });

        // Verificar que no hay usuario guardado en la base de datos
        $this->assertDatabaseMissing('users', [
            'email' => 'juan@example.com',
        ]);
    }
}

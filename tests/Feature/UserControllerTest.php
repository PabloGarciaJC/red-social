<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class RegisterUserTest extends TestCase
{
    use RefreshDatabase;

    public function test_usuario_puede_registrarse()
    {
        // Simular datos de registro
        $datos = [
            'alias' => 'nuevo_usuario',
            'name' => 'Juan Pérez',
            'email' => 'juan@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        // Enviar POST a la ruta de registro
        $response = $this->post('/register', $datos);

        // Verificar redirección (por defecto a /home)
        $response->assertRedirect('/');

        // Verificar que el usuario fue creado en la base de datos
        $this->assertDatabaseHas('users', [
            'alias' => 'nuevo_usuario',
            'nombre' => 'Juan Pérez',
            'email' => 'juan@example.com',
        ]);

        // Verificar que la contraseña está hasheada
        $usuario = User::where('email', 'juan@example.com')->first();
        $this->assertTrue(Hash::check('password123', $usuario->password));
    }
}

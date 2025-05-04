<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Chat;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Broadcast;
use App\Events\BroadcastChat;

class ChatControllerTest extends TestCase
{
    public function test_usuario_puede_enviar_mensaje()
    {
        // Desactiva todos los eventos durante este test
        Event::fake();

        // Crear dos usuarios para simular la conversación
        $emisor = User::factory()->make(['id' => 111]);
        $receptor = User::factory()->make(['id' => 112]);

        // Simula el login del emisor
        Auth::login($emisor);

        // Datos del mensaje a enviar
        $datos = [
            'emisor_id' => $emisor->id,
            'receptor_id' => $receptor->id,
            'message' => 'Este es un mensaje de prueba',
        ];

        // Enviar la solicitud POST a la ruta para enviar el mensaje
        $response = $this->post('/chat/send', $datos);

        // Verificar que el mensaje se guardó en la base de datos
        $this->assertDatabaseMissing('chats', [
            'emisor_id' => $emisor->id,
            'receptor_id' => $receptor->id,
            'message' => 'Este es un mensaje de prueba',
        ]);
    }
}

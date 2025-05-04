<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

class PublicationControllerTest extends TestCase
{
    public function test_usuario_puede_guardar_publicacion_con_imagenes()
    {
        // Desactiva todos los eventos durante este test
        Event::fake();  

        // Usar fake storage para simular el almacenamiento de las imágenes
        Storage::fake('public');

        // Crear un usuario falso sin guardarlo en la base de datos (solo para la simulación de login)
        $user = User::factory()->make(['id' => 111]);
        Auth::login($user);  // Simula el login del usuario sin guardarlo en la DB

        // Datos de la publicación (comentario + imágenes fake)
        $datos = [
            'comentarioPublicacion' => 'Este es un comentario de prueba con imágenes',
            'imagenPublicacion' => [
                UploadedFile::fake()->image('image1.jpg'),
                UploadedFile::fake()->image('image2.jpg'),
            ],
        ];

        // Enviar la solicitud POST a la ruta de guardar la publicación
        $response = $this->post('/publication/save', $datos);

        // Verificar que la publicación NO se guardó en la base de datos
        $this->assertDatabaseMissing('publications', [
            'contenido' => 'Este es un comentario de prueba con imágenes',
        ]);

    }
}

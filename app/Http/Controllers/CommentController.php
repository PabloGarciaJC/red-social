<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Events\BroadcastComment;

class CommentController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function save(Request $request)
  {
    // Obtener el comentario y el ID de la publicación si existen
    $comentarioPublicacion = $request->input('comentario', null);
    $idPublicacionForm = $request->input('post_id');
    $imagenPublicacion = $request->file('imagen', null);

    // Instanciar el objeto Comment
    $comments = new Comment();

    // Configurar el objeto Comment solo si se recibe un comentario
    if ($comentarioPublicacion) {
      $comments->user_id = Auth::user()->id;
      $comments->contenido = $comentarioPublicacion;
      $comments->publication_id = $idPublicacionForm;
    }

    // Guardar la imagen si se ha subido
    if ($imagenPublicacion) {
      // Generar un nombre único para la imagen
      $imagenPathName = time() . '-' . $imagenPublicacion->getClientOriginalName();

      // Guardar la imagen en la carpeta de 'comments'
      Storage::disk('comments')->put($imagenPathName, File::get($imagenPublicacion));

      // Configurar el nombre de la imagen en el objeto Comment
      $comments->imagen = $imagenPathName;

      // Si no hay contenido en el comentario, asociar solo la imagen con la publicación
      if (!$comentarioPublicacion) {
        $comments->user_id = Auth::user()->id;
        $comments->publication_id = $idPublicacionForm;
      }
    }

    // Verificar si hay algo que guardar (comentario o imagen)
    if ($comentarioPublicacion || $imagenPublicacion) {
      // Guardar el comentario en la base de datos
      $comments->save();

      // Preparar la respuesta JSON
      $response = [
        'success' => true,
        'data' => [
          'id' => $comments->id,
          'contenido' => $comments->contenido,
          'publication_id' => $comments->publication_id,
          'imagen' => $comments->imagen,
          'user' => [
            'id' => $comments->user_id,
            'name' => Auth::user()->alias,
            'fotoPerfil' => Auth::user()->fotoPerfil,
          ],
          'created_at' => $comments->created_at->toDateTimeString(),
        ]
      ];

      // Emitir la notificación a través de Pusher
      event(new BroadcastComment(response()->json($response), 'success'));

      return response()->json(['message' => 'success', 'data' => $response['data']]);
    }

    // Si no se recibe ni comentario ni imagen, devolver un error
    return response()->json(['message' => 'No se ha enviado ni comentario ni imagen.'], 400);
  }


  public function getImage($filename)
  {
    $file = Storage::disk('comments')->get($filename);
    return new Response($file, 200);
  }
}

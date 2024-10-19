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

  public function edit(Request $request)
  {
    // Obtener los valores del formulario
    $commentId = $request->input('comment_id');
    $content = $request->input('editcomentariopublicacion', null);

    // Encontrar el comentario en la base de datos
    $comment = Comment::where('id', $commentId)
      ->where('user_id', Auth::user()->id)
      ->first();

    if ($comment) {
      // Preparar la respuesta inicial
      $response = [
        'idPublication' => $comment->publication_id,
        'idComment' => $comment->id
      ];

      // Comprobar si hay contenido
      if (is_null($content) || trim($content) === '') {
        // Si no hay contenido, eliminar el comentario
        $comment->delete();

        // Emitir la notificación a través de Pusher
        event(new BroadcastComment($response, 'delete'));

        return response()->json(['message' => 'Comentario eliminado porque no había contenido.']);
      }

      // Si hay contenido, actualizar el comentario
      if (!is_null($content) && trim($content) !== '') {
        $comment->contenido = $content;
      }

      // Guardar el comentario actualizado
      $comment->save();

      // Preparar la respuesta de éxito
      $response = [
        'success' => true,
        'data' => [
          'id' => $comment->id,
          'contenido' => $comment->contenido,
          'idPublication' => $comment->publication_id,
          'user' => [
            'id' => $comment->user_id,
            'name' => Auth::user()->alias,
            'fotoPerfil' => Auth::user()->fotoPerfil,
          ],
          'updated_at' => $comment->updated_at->toDateTimeString(),
        ]
      ];

      // Emitir la notificación de edición
      event(new BroadcastComment($response, 'edit'));

      return response()->json(['message' => 'Comentario actualizado con éxito.', 'data' => $response['data']]);
    }

    return response()->json(['message' => 'Comentario no encontrado o no autorizado.'], 404);
  }


  public function delete(Request $request)
  {
    // Buscar el comentario por usuario, publicación y ID de comentario
    $comments = Comment::where('user_id', Auth::user()->id)
      ->where('publication_id', $request->idPublication)
      ->where('id', $request->idComments)
      ->first();

    // Si el comentario existe
    if ($comments) {
      // Verificar si el comentario tiene una imagen
      if ($comments->imagen) {
        // Eliminar la imagen del almacenamiento si existe
        Storage::disk('comments')->delete($comments->imagen);
      }

      // Eliminar el comentario de la base de datos
      $comments->delete();

      // Preparar la respuesta JSON
      $response = [
        'idPublication' => $request->idPublication,
        'idComment' => $request->idComments
      ];
      // Emitir la notificación a través de Pusher
      event(new BroadcastComment($response, 'delete'));
    }
  }
}

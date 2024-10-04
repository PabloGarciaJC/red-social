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
      // Validar el archivo
      $request->validate([
          'post_id' => 'required|integer',
          'imagen' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048', // Ajustar según sea necesario
      ]);
  
      // Obtener los datos del formulario
      $comentarioPublicacion = $request->input('comentario');
      $idPublicacionForm = $request->input('post_id');
      $imagenPublicacion = $request->file('imagen');
  
      // Instanciar el objeto Comment
      $comments = new Comment();
  
      // Configurar el objeto Comment
      $comments->user_id = Auth::user()->id;
      $comments->contenido = $comentarioPublicacion;
      $comments->publication_id = $idPublicacionForm;
  
      // Guardar la imagen si se ha subido
      if ($imagenPublicacion) {
          // Generar un nombre único para la imagen
          $imagenPathName = time() . '-' . $imagenPublicacion->getClientOriginalName();
  
          // Guardo la Imagen en la carpeta del Proyecto
          Storage::disk('comments')->put($imagenPathName, File::get($imagenPublicacion));

          // Configurar el nombre de la imagen en el objeto Comment
          $comments->imagen = $imagenPathName;
      }
  
      // Guardar el comentario
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
                  'fotoPerfil' => Auth::user()->fotoPerfil
              ],
              'created_at' => $comments->created_at->toDateTimeString()
          ]
      ];
  
      // Emitir la notificación a través de Pusher
      event(new BroadcastComment(response()->json($response), 'success'));
      // return response()->json($response);
  }
  
  public function getImage($filename)
  {
    $file = Storage::disk('comments')->get($filename);
    return new Response($file, 200);
  }
}

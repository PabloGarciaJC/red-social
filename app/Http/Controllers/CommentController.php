<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

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
    $comentarioPublicacion = $request->input('comentario');
    $idPublicacionForm = $request->input('id');
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

      // Guardar la imagen en la carpeta de almacenamiento
      $imagenPublicacion->storeAs('comments', $imagenPathName);

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
        'imagen' => $comments->imagen,
        'user' => [
          'id' => $comments->user_id,
          'name' => Auth::user()->alias, // Asume que quieres incluir el nombre del usuario
          'fotoPerfil' => Auth::user()->fotoPerfil

        ],
        'created_at' => $comments->created_at->toDateTimeString()
      ]
    ];

    return response()->json($response, 200);
  }

  public function getImage($filename)
  {
    $file = Storage::disk('comments')->get($filename);
    return new Response($file, 200);
  }
}

<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\file;

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
    $comentarioPublicacion = $request->input('comentPublication');
    $idPublicacionForm = $request->input('idPublication');
    $imagenPublicacion = $request->file('imagenPublication');

    // Instacio Objeto User
    $comments = new Comment();

    // Seteo Objeto
    $comments->user_id = Auth::user()->id;
    $comments->contenido = $comentarioPublicacion;
    $comments->publication_id = $idPublicacionForm;

    // Guardo Imagen en los Archivos, Seteo Objeto
    if ($imagenPublicacion) {

      // Nombre de la Imagen Original del Usuario y el Tiempo en que lo Sube
      $imagenPathName = time() . $imagenPublicacion->getClientOriginalName();

      //Guardo la Imagen en la carpeta del Proyecto
      Storage::disk('comments')->put($imagenPathName, File::get($imagenPublicacion));

      // Seteo el Objeto con el Nombre Original del Usuario
      $comments->imagen = $imagenPathName;
    }

    // Guardo
    $save = $comments->save();

    return redirect()->route('publicationDetail', ['publicationId' => $idPublicacionForm]);
  }

  public function getImage($filename)
  {
    $file = Storage::disk('comments')->get($filename);
    return new Response($file, 200);
  }
}

<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\file;

class PublicationController extends Controller
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
        $comentarioPublicacion = $request->input('comentarioPublicacion');
        $imagenPublicacion = $request->file('imagenPublicacion');

        // Instacio Objeto User
        $publication = new Publication();

        // Seteo Objeto
        $publication->user_id = Auth::user()->id;
        $publication->contenido = $comentarioPublicacion;

        // Guardo Imagen en los Archivos, Seteo Objeto
        if ($imagenPublicacion) {

            // Nombre de la Imagen Original del Usuario y el Tiempo en que lo Sube
            $imagenPathName = time() . $imagenPublicacion->getClientOriginalName();

            //Guardo la Imagen en la carpeta del Proyecto
            Storage::disk('publication')->put($imagenPathName, File::get($imagenPublicacion));

            // Seteo el Objeto con el Nombre Original del Usuario
            $publication->imagen = $imagenPathName;
        }

        $publication->save();

        return redirect()->route('home');
    }

    public function getImage($filename)
    {
        $file = Storage::disk('publication')->get($filename);
        return new Response($file, 200);
    }

    public function delete($idPublicacion)
    {
        $publication = Publication::where('user_id', '=', Auth::user()->id)
                                    ->where('id', '=', $idPublicacion);

        $conteoPublication = $publication->count();

        if ($conteoPublication > 0) {
            
            $getPublicacion = $publication->first();

            $borraPublicacion = Publication::find($getPublicacion->id);

            $borraPublicacion->delete();
            
        } else {

            echo $conteoPublication;
        }
    }

    public function detail($idPublication)
    {
        $getPublication = Publication::find($idPublication);
        return view('publication.detail', ['getPublication' => $getPublication]);
    }
 
}

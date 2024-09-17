<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PublicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function save(Request $request)
    {
        $comentarioPublicacion = $request->input('comentarioPublicacion');
        $imagenPublicacion = $request->file('imagenPublicacion');

        // Instancio Objeto User
        $publication = new Publication();

        // Seteo Objeto
        $publication->user_id = Auth::user()->id;
        $publication->contenido = $comentarioPublicacion;

        // Guardo Imagen en los Archivos, Seteo Objeto
        if ($imagenPublicacion) {
            // Nombre de la Imagen Original del Usuario y el Tiempo en que lo Sube
            $imagenPathName = time() . $imagenPublicacion->getClientOriginalName();

            // Guardo la Imagen en la carpeta del Proyecto
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
        $publication = Publication::where('user_id', Auth::user()->id)
            ->where('id', $idPublicacion)
            ->first();  // Obtenemos la primera coincidencia directamente
    
        if ($publication) {
            // Eliminar la publicación (esto también eliminará los comentarios asociados por la restricción ON DELETE CASCADE)
            $publication->delete();
    
            // Respondemos con un mensaje de éxito
            return response()->json(['message' => 'success'], 200);
        } else {
            // Si no se encuentra la publicación, respondemos con un error
            return response()->json(['message' => 'Publication not found'], 404);
        }
    }
    
    public function detail($idPublication)
    {
        $getPublication = Publication::find($idPublication);
        return view('publication.detail', ['getPublication' => $getPublication]);
    }
}

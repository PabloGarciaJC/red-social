<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Events\BroadcastPublication;

class PublicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $publications = Publication::orderBy('id', 'desc')->get();
        return view('home', ['publications' => $publications]);
    }

    public function save(Request $request)
    {
        $comentarioPublicacion = $request->input('comentarioPublicacion');
        $imagenPublicacion = $request->file('imagenPublicacion');

        // Instancio Objeto Publication
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
        
        // Cargar la relación del usuario y los comentarios asociados
        $publication = Publication::with('user', 'comment')->find($publication->id);

        // Emitir la notificación a través de Pusher
        event(new BroadcastPublication($publication));
        
        return response()->json(['publication' => $publication], 201);
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
            return response()->json(['message' => 'Publication not found'], 200);
        }
    }
    
    public function detail($idPublication)
    {
        $getPublication = Publication::find($idPublication);
        return view('publication.detail', ['getPublication' => $getPublication]);
    }
}

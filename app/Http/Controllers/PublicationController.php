<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use App\Models\PublicationImage;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Events\BroadcastPublication;
use Illuminate\Support\Facades\DB;

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
        $imagenesPublicacion = $request->file('imagenPublicacion'); // Debes asegurarte de que esto sea un array

        // Instancio Objeto Publication
        $publication = new Publication();

        // Seteo Objeto
        $publication->user_id = Auth::user()->id;
        $publication->contenido = $comentarioPublicacion;
        $publication->save(); // Primero guarda la publicación

        $imagePaths = [];

        // Ahora guarda las imágenes en la tabla publication_images
        if ($imagenesPublicacion) {
            foreach ($imagenesPublicacion as $imagen) {
                // Nombre de la Imagen Original del Usuario y el Tiempo en que lo Sube
                $imagenPathName = time() . '_' . $imagen->getClientOriginalName();

                var_dump($imagenPathName);

                // // Guardo la Imagen en la carpeta del Proyecto
                // Storage::disk('publication')->put($imagenPathName, File::get($imagen));

                // // Guarda la ruta de la imagen en la tabla publication_images
                // DB::table('publication_images')->insert([
                //     'publication_id' => $publication->id,
                //     'image_path' => $imagenPathName,
                //     'created_at' => now(),
                //     'updated_at' => now(),
                // ]);

                // array_push($imagePaths, $imagenPathName);
            }
        }

        // Cargar la relación del usuario y los comentarios asociados
        $publication = Publication::with('user', 'comment')->find($publication->id);

        // Emitir la notificación a través de Pusher
        event(new BroadcastPublication(['publication' => $publication, 'imagePaths' => $imagePaths], 'success'));

        return response()->json(['publication' => $publication], 201);
    }

    public function getImage($filename)
    {
        $file = Storage::disk('publication')->get($filename);
        return new Response($file, 200);
    }

    public function delete($idPublicacion)
    {
        // Buscar la publicación por el ID y el usuario autenticado
        $publication = Publication::where('user_id', Auth::user()->id)
            ->where('id', $idPublicacion)
            ->first();  // Obtenemos la primera coincidencia directamente

        if ($publication) {
            // Emitir la notificación a través de Pusher
            event(new BroadcastPublication($idPublicacion, 'delete'));

            // Obtener las imágenes relacionadas a la publicación
            $images = PublicationImage::where('publication_id', $publication->id)->get();

            // Eliminar las imágenes del sistema de archivos y de la base de datos
            foreach ($images as $image) {
                // Eliminar el archivo físico
                Storage::disk('publication')->delete($image->image_path);
                // // Eliminar la imagen de la base de datos
                $image->delete();
            }

            // Eliminar la publicación
            $publication->delete();

            // Respondemos con un mensaje de éxito
            return response()->json(['message' => 'delete'], 200);
        } else {
            // Si no se encuentra la publicación, respondemos con un error
            return response()->json(['message' => 'Publication not found'], 200);
        }
    }
}

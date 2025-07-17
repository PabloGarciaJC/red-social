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
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\DB;

class PublicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        // Obtén las publicaciones con likes, comentarios y ordena las imágenes
        $publications = Publication::with(['like', 'comment', 'images' => function ($query) {
            $query->orderBy('created_at', 'asc'); // O el campo que determines para ordenar
        }])
            ->orderBy('id', 'desc')
            ->get();

        return view('home', ['publications' => $publications]);
    }

    public function save(Request $request)
    {
        $user = Auth::user();
        if ($user->status === 'active') {
            return json_encode([
                'permissions' => 'success',
                'protectionTitle' => 'Acceso Restringido',
                'protectionMessage' => 'Para autorizar el acceso a los módulos de esta red social, no dudes en contactarme a través de cualquiera de mis redes sociales.',
                'protectionBtnText' => 'Cerrar'
            ]);
        }

        $comentarioPublicacion = $request->input('comentarioPublicacion');
        $imagenesPublicacion = $request->file('imagenPublicacion');

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
                // Nombre de la Imagen Original del Usuario y el Tiempo en que lo Subee
                $imagenPathName = time() . '_' . $imagen->getClientOriginalName();

                // Guardo la Imagen en la carpeta del Proyecto
                Storage::disk('publication')->put($imagenPathName, File::get($imagen));

                // Guarda la ruta de la imagen en la tabla publication_images
                DB::table('publication_images')->insert([
                    'publication_id' => $publication->id,
                    'image_path' => $imagenPathName,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                array_push($imagePaths, $imagenPathName);
            }
        }

        // Cargar la relación del usuario y los comentarios asociados
        $publication = Publication::with('user', 'comment', 'like')->find($publication->id);

        // Emitir la notificación a través de Pusher
        event(new BroadcastPublication(['publication' => $publication, 'imagePaths' => $imagePaths], 'success'));

        return response()->json(['publication' => $publication], 201);
    }

    public function edit(Request $request)
    {
        $user = Auth::user();
        if ($user->status === 'active') {
            return json_encode([
                'permissions' => 'success',
                'protectionTitle' => 'Acceso Restringido',
                'protectionMessage' => 'Para autorizar el acceso a los módulos de esta red social, no dudes en contactarme a través de cualquiera de mis redes sociales.',
                'protectionBtnText' => 'Cerrar'
            ]);
        }

        $postId = $request->input('post-id');
        $comentarioPublicacion = $request->input('editcomentariopublicacion');
        $imagenesPublicacion = $request->file('imagenPublicacion'); // Nuevas imágenes

        $publication = Publication::find($postId);

        if ($publication && $publication->user_id == Auth::user()->id) {

            // Guardo Texto de Publicacion
            $publication->user_id = Auth::user()->id;
            $publication->contenido = $comentarioPublicacion;
            $publication->save();

            // Obtener las imágenes relacionadas a la publicación
            $images = PublicationImage::where('publication_id', $postId)->get();

            // Eliminar las imágenes del sistema de archivos y de la base de datos
            foreach ($images as $image) {
                // Eliminar la imagen del almacenamiento
                Storage::disk('publication')->delete($image->image_path);
                $image->delete();
            }

            $imagePaths = [];

            // Ahora guarda las imágenes en la tabla publication_images
            if ($imagenesPublicacion) {
                foreach ($imagenesPublicacion as $imagen) {
                    // Nombre de la Imagen Original del Usuario y el Tiempo en que lo Subee
                    $imagenPathName = time() . '_' . $imagen->getClientOriginalName();

                    // Guardo la Imagen en la carpeta del Proyecto
                    Storage::disk('publication')->put($imagenPathName, File::get($imagen));

                    // Guarda la ruta de la imagen en la tabla publication_images
                    DB::table('publication_images')->insert([
                        'publication_id' => $publication->id,
                        'image_path' => $imagenPathName,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    array_push($imagePaths, $imagenPathName);
                }
            }

            // Cargar la relación del usuario y los comentarios asociados
            $publication = Publication::with('user', 'comment', 'like')->find($publication->id);

            // Emitir la notificación a través de Pusher
            event(new BroadcastPublication(['publication' => $publication, 'imagePaths' => $imagePaths], 'edit'));

            return response()->json(['publication' => $publication], 201);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Esta Publicación no tienes permiso para editarla.'
            ], 403);
        }
    }

    public function getImage($filename)
    {
        $path = storage_path('app/publication/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        return response($file, 200)->header('Content-Type', $type);
    }

    public function delete($idPublicacion)
    {

        $user = Auth::user();
        if ($user->status === 'active') {
            return json_encode([
                'permissions' => 'success',
                'protectionTitle' => 'Acceso Restringido',
                'protectionMessage' => 'Para autorizar el acceso a los módulos de esta red social, no dudes en contactarme a través de cualquiera de mis redes sociales.',
                'protectionBtnText' => 'Cerrar'
            ]);
        }

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

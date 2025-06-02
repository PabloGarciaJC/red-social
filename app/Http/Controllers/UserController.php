<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Follower;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
// use Storage;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function perfil()
    {
        return view('user.perfil');
    }

    public function actualizar(Request $request)
    {
 
        //Instacio Objeto
        $user = Auth::user();

        //Capturo informacion del formulario      
        $nombre = $request->input('nombre');
        $apellido = $request->input('apellido');
        $empresa = $request->input('empresa');
        $cargo = $request->input('cargo');
        $pais = $request->input('pais');
        $direccion = $request->input('direccion');
        $movil = $request->input('movil');
        $sobreMi = $request->input('sobreMi');

        //Capturo pathName y fileName de la imagen
        $fotoPerfile = $request->file('fotoPerfil');

        //Seteo el Objeto      
        $user->nombre = $nombre;
        $user->apellido = $apellido;
        $user->empresa = $empresa;
        $user->cargo = $cargo;
        $user->pais = $pais;
        $user->direccion = $direccion;
        $user->movil = $movil;
        $user->sobreMi = $sobreMi;

        //Valido si la imagen llega
        if ($fotoPerfile) {

            // Nombre de la Imagen Original del Usuario y el Tiempo en que lo Sube
            $fotoPerfilPathName = time() . $fotoPerfile->getClientOriginalName();

            //Guardo la Imagen en la carpeta del Proyecto
            Storage::disk('users')->put($fotoPerfilPathName, File::get($fotoPerfile));

            // Seteo el Objeto con el Nombre Original del Usuario
            $user->fotoPerfil = $fotoPerfilPathName;
        }

        // Guardo
        $user->save();

        return redirect()->action('UserController@perfil')
            ->with(['message' => 'Perfil Actualizado con Exito']);
    }

    public function getImage($filename)
    {
        $path = storage_path('app/users/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        return response($file, 200)->header('Content-Type', $type);
    }

    public function search(Request $request)
    {
        $term = $request->get('term');
        $currentUserId = Auth::id();
        
        $query = DB::table('users as u')
            ->leftJoin('followers as f1', function ($join) use ($currentUserId) {
                $join->on('u.id', '=', 'f1.seguido')
                     ->where('f1.user_id', '=', $currentUserId);
            })
            ->leftJoin('followers as f2', function ($join) use ($currentUserId) {
                $join->on('u.id', '=', 'f2.user_id')
                     ->where('f2.seguido', '=', $currentUserId);
            })
            ->leftJoin('notifications as n', function ($join) use ($currentUserId) {
                $join->on('u.id', '=', 'n.notifiable_id')
                     ->where('n.notifiable_type', '=', 'App\\Models\\User')
                     ->where('n.type', '=', 'App\\Notifications\\AgregarAmigoNotification')
                     ->where('n.data->user_id', '=', $currentUserId)
                     ->whereNull('n.read_at'); // Solo notificaciones no leídas
            })
            ->select(
                'u.id',
                'u.alias',
                'u.nombre',
                'u.apellido',
                'u.fotoPerfil',
                DB::raw('COALESCE(f1.estado, f2.estado, \'desconocido\') AS estado'),
                DB::raw('IF(n.id IS NOT NULL, 1, 0) as tieneNotificacion') // Indicador de si tiene notificación
            )
            ->where('u.nombre', 'LIKE', '%' . $term . '%')
            ->where('u.id', '<>', $currentUserId)
            ->get();
    
        $data = [];
        
        foreach ($query as $user) {
            $termArray = [];
            $termArray['value'] = $user->alias;
            $termArray['id'] = $user->apellido;
            $termArray['estado'] = !empty($user->estado) ? $user->estado : 'desconocido';
            $termArray['tieneNotificacion'] = $termArray['estado'] == 'desconocido' ? 0 : $user->tieneNotificacion;; // Si tiene notificación (1 o 0)
            
            // Maneja la imagen de perfil
            if (!empty($user->fotoPerfil)) {
                $termArray['label'] = '<img src="' . url('fotoPerfil/' . $user->fotoPerfil) . '" width="60" class="pointer"> <span>' . $user->alias . '</span>';
            } else {
                $termArray['label'] = '<img src="' . asset('assets/img/profile-img.jpg') . '" width="60" class="pointer"><span>' . $user->alias . '</span>';
            }
            
            // Añadir los datos al arreglo de resultados
            $data[] = $termArray;
        }
    
        // Devuelve la respuesta JSON
        return response()->json($data);
    }
    
    public function detallesPerfil($alias)
    {
        $showUser = User::where('alias', '=', $alias)->get();
        return view('user.detail', ['usuario' => $showUser]);
    }
}

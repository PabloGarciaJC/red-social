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
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }

    public function search(Request $request)
    {
        $term = $request->get('term');
    
        $querys = User::where('nombre', 'LIKE', '%' . $term . '%')
            ->orWhere('alias', 'LIKE', "%$term%")
            ->orWhere('email', 'LIKE', "%$term%")
            ->where('id', '!=', Auth::id())  // Excluye el usuario autenticado
            ->get();
    
        $data = [];
    
        foreach ($querys as $query) {
            $termArray = [];
            $termArray['value'] = $query->alias;
            $termArray['id'] = $query->apellido;
            if ($query->fotoPerfil != '') {
                $termArray['label'] = '<img src="http://localhost:8081/fotoPerfil/' . $query->fotoPerfil . '" width="60" class="pointer">&nbsp' .  $query->alias;
            } else {
                $termArray['label'] = '<img src="http://localhost:8081/assets/img/profile-img.jpg" width="60" class="pointer">&nbsp' .  $query->alias;
            }
    
            $data[] = $termArray;
        }
        return response()->json($data);  // Usa response()->json para devolver una respuesta JSON
    }
    

    public function buscadorPerfil($alias, $idNotificacion)
    {
        $showUser = User::where('alias', '=', $alias)->get();

        foreach ($showUser as $showUserReceived) {

            $friendRequestSend = Follower::where('user_id', '=', Auth::user()->id)->where('seguido', '=', $showUserReceived->id)->where('aprobada', '=', 1)->count();
            $friendRequestReceived = Follower::where('user_id', '=', $showUserReceived->id)->where('seguido', '=', Auth::user()->id)->where('aprobada', '=', 1)->count();
        }

        return view('user.detail', ['usuario' => $showUser, 'friendRequestSend' => $friendRequestSend, 'friendRequestReceived' => $friendRequestReceived, 'idNotificacion' => $idNotificacion]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\file;

class LikeController extends Controller
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

    public function like($idPublicacion)
    {

        $like = Like::where('user_id', Auth::user()->id)
            ->where('publication_id', $idPublicacion);

        $conteoLikes = $like->count();

        if ($conteoLikes == 0) {

            $like = new Like();
            $like->user_id = Auth::user()->id;
            $like->publication_id = (int)$idPublicacion;

            $like->save();

            return response()->json([
                'like' => $like
            ]);
        } else {
            return response()->json([
                'message' => 'El like ya existe'
            ]);
        }
    }

    public function dislike($idPublicacion)
    {
        $like = Like::where('user_id', Auth::user()->id)
            ->where('publication_id', $idPublicacion)
            ->first();

        if ($like) {

            $like->delete();

            return response()->json([
                'like' => $like,
                'message' => 'Has dado dislike correctamente'
            ]);
            
        } else {
            return response()->json([
                'message' => 'El like no existe'
            ]);
        }
    }
}

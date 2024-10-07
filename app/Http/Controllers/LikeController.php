<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Manejar likes y dislikes
     *
     * @param int $idPublicacion
     * @param string $type ('like' o 'dislike')
     * @return \Illuminate\Http\JsonResponse
     */
    public function like($idPublicacion)
    {
        $userId = Auth::user()->id;

        // Verifica si ya hay un dislike
        $dislike = Like::where('user_id', $userId)
            ->where('publication_id', $idPublicacion)
            ->where('type', 'dislike')
            ->first();

        if ($dislike) {
            // Si hay un dislike, lo eliminamos
            $dislike->delete();
        }

        // Ahora verifica si ya hay un like
        $like = Like::where('user_id', $userId)
            ->where('publication_id', $idPublicacion)
            ->where('type', 'like')
            ->first();

        if ($like) {
            
            // Si ya existe un like, lo eliminamos
            $like->delete();
            $status = 'removed_like';

        } else {
            // Si no existe un like, lo creamos
            $like = new Like();
            $like->user_id = $userId;
            $like->publication_id = $idPublicacion;
            $like->type = 'like';
            $like->save();
            $status = 'like';
        }

        // Contamos likes y dislikes
        $likesCount = Like::where('publication_id', $idPublicacion)->where('type', 'like')->count();
        $dislikesCount = Like::where('publication_id', $idPublicacion)->where('type', 'dislike')->count();

        return response()->json([
            'status' => $status,
            'likes_count' => $likesCount,
            'dislikes_count' => $dislikesCount,
        ]);
    }

    public function dislike($idPublicacion)
    {
        $userId = Auth::user()->id;

        // Verifica si ya hay un like
        $like = Like::where('user_id', $userId)
            ->where('publication_id', $idPublicacion)
            ->where('type', 'like')
            ->first();

        if ($like) {
            // Si hay un like, lo eliminamos
            $like->delete();
        }

        // Ahora verifica si ya hay un dislike
        $dislike = Like::where('user_id', $userId)
            ->where('publication_id', $idPublicacion)
            ->where('type', 'dislike')
            ->first();

        if ($dislike) {
            // Si ya existe un dislike, lo eliminamos
            $dislike->delete();
            $status = 'removed_dislike';
        } else {
            // Si no existe un dislike, lo creamos
            $dislike = new Like();
            $dislike->user_id = $userId;
            $dislike->publication_id = $idPublicacion;
            $dislike->type = 'dislike';
            $dislike->save();
            $status = 'dislike';
        }

        // Contamos likes y dislikes
        $likesCount = Like::where('publication_id', $idPublicacion)->where('type', 'like')->count();
        $dislikesCount = Like::where('publication_id', $idPublicacion)->where('type', 'dislike')->count();

        return response()->json([
            'status' => $status,
            'likes_count' => $likesCount,
            'dislikes_count' => $dislikesCount,
        ]);
    }
}

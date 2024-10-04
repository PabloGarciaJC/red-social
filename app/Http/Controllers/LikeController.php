<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\file;
use App\Events\BroadcastLikes;

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

            $response = [
                'status' => 'like',
                'data' => [
                    'id' => $like->id,
                    'user' => $like->user_id,
                    'publication_id' => $like->publication_id
                ]
            ];

            return response()->json($response);
        }
    }

    public function dislike($idPublicacion)
    {
        $like = Like::where('user_id', Auth::user()->id)
            ->where('publication_id', $idPublicacion)
            ->first();

        if ($like) {
            $like->delete();


            $response = [
                'status' => 'dislike',
                'data' => [
                    'id' => $like->id,
                    'user' => $like->user_id,
                    'publication_id' => $like->publication_id
                ]
            ];

            return response()->json($response);

        }
    }
}

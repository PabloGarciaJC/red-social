<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Events\BroadcastChat;

class ChatController extends Controller
{
  
    /**
     * Obtener los mensajes entre dos usuarios.
     *
     * @param int $userId1
     * @param int $userId2
     * @return \Illuminate\Http\Response
     */
    public function getMessages($userId1, $userId2)
    {
        // Obtener los mensajes enviados entre userId1 y userId2 (en ambas direcciones)
        $messages = DB::table('chats')
            ->where(function ($query) use ($userId1, $userId2) {
                $query->where('emisor_id', $userId1)
                    ->where('receptor_id', $userId2);
            })
            ->orWhere(function ($query) use ($userId1, $userId2) {
                $query->where('emisor_id', $userId2)
                    ->where('receptor_id', $userId1);
            })
            ->orderBy('created_at', 'asc')
            ->get();

        // Retornar los mensajes como respuesta JSON
        return response()->json($messages, 200);
    }

    // Función para enviar un mensaje
    public function sendMessage(Request $request)
    {

        // Validar los datos entrantes
        $validator = Validator::make($request->all(), [
            'emisor_id' => 'required|integer|exists:users,id',
            'receptor_id' => 'required|integer|exists:users,id',
            'message' => 'required|string|max:1000',
        ]);

        // Si la validación falla, devolver un error
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        try {
            // Crear un nuevo mensaje
            $chat = new Chat();
            $chat->emisor_id = $request->input('emisor_id');
            $chat->receptor_id = $request->input('receptor_id');
            $chat->message = $request->input('message');
            $chat->created_at = now();
            $chat->updated_at = now();
            $chat->save();

            // Emitir la notificación a través de Pusher
            broadcast(new BroadcastChat($chat));

            // Devolver una respuesta de éxito
            return response()->json(['data' => $chat], 201);
            
        } catch (\Exception $e) {
            // En caso de error, devolver una respuesta de error
            return response()->json(['error' => 'Error al enviar el mensaje'], 500);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use App\Events\BroadcastChat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
            $chat->leido = 0; // Inicialmente no está leído
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
    

    public function markAllAsRead(Request $request, $emisorId)
    {
        // Obtener el ID del receptor (el usuario que está autenticado)
        $receptorId = Auth::user()->id;
    
        // Verificar que el emisor es el que está enviando la solicitud
        if ($receptorId === $emisorId) {
            return response()->json(['error' => 'No puedes marcar tus propios mensajes como leídos.'], 403);
        }
    
        // Obtener todos los mensajes entre el emisor y el receptor que aún no han sido leídos
        $messages = Chat::where('emisor_id', $emisorId)
                        ->where('receptor_id', $receptorId)
                        ->where('leido', 0)
                        ->get();
    
        // Marcar cada mensaje como leído
        foreach ($messages as $message) {
            $message->leido = 1;
            $message->save();
        }
    
        return response()->json(['success' => 'Todos los mensajes han sido marcados como leídos.'], 200);
    }
    
    
}

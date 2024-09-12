<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\User;

class ChatController extends Controller
{
    /**
     * Enviar un nuevo mensaje.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function sendMessage(Request $request)
    {
        // Validar la solicitud
        $validated = $request->validate([
            'emisor_id' => 'required|exists:users,id',
            'receptor_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        // Crear el nuevo mensaje
        $chat = Chat::create($validated);

        return response()->json($chat, 201);
    }

    /**
     * Obtener los mensajes entre dos usuarios.
     *
     * @param int $userId1
     * @param int $userId2
     * @return \Illuminate\Http\Response
     */
    public function getMessages($userId1, $userId2)
    {
        // Validar los usuarios
        if (!User::find($userId1) || !User::find($userId2)) {
            return response()->json(['error' => 'Invalid users'], 400);
        }
    
        // Obtener los mensajes entre los dos usuarios
        $messages = Chat::where(function ($query) use ($userId1, $userId2) {
            $query->where('emisor_id', $userId1)
                  ->where('receptor_id', $userId2);
        })->orWhere(function ($query) use ($userId1, $userId2) {
            $query->where('emisor_id', $userId2)
                  ->where('receptor_id', $userId1);
        })->get();
    
        return response()->json($messages);
    }
    
}

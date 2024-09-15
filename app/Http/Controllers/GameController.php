<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GameController extends Controller
{
    public function show()
    {
        // Genera un nuevo número para adivinar si no hay uno en la sesión
        if (!session()->has('numberToGuess')) {
            session()->put('numberToGuess', rand(1, 100));
        }

        return view('game.game');
    }

    public function guess(Request $request)
    {
        $guess = $request->input('guess');
        $numberToGuess = session()->get('numberToGuess');

        $message = '';

        if (!is_numeric($guess) || $guess < 1 || $guess > 100) {
            $message = 'Por favor, ingresa un número válido entre 1 y 100.';
        } elseif ($guess < $numberToGuess) {
            $message = 'Demasiado bajo. Intenta de nuevo.';
        } elseif ($guess > $numberToGuess) {
            $message = 'Demasiado alto. Intenta de nuevo.';
        } else {
            $message = '¡Felicidades! ¡Adivinaste el número!';
            session()->put('numberToGuess', rand(1, 100)); // Reinicia el juego
        }

        return response()->json(['message' => $message]);
    }
}

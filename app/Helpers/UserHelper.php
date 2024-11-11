<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserHelper
{
    public static function existeFotoPerfil($user = null)
    {
        // Usar usuario autenticado por defecto
        $user = $user ?? Auth::user();
        
        if ($user && $user->fotoPerfil) {
            $fotoPerfilPath = 'users/' . $user->fotoPerfil;
            return Storage::disk('public')->exists($fotoPerfilPath);
        }

        return false;
    }
}

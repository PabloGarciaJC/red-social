<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'likes';

    // Relación de Muchos a Uno
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    // Relación de Muchos a Uno
    public function publication()
    {
        return $this->belongsTo('App\Models\Publication', 'publication_id');
        // App\Models\Publication => Es la Entidad Padre / publication_id => es la clave Foranea para relacion
    }
}

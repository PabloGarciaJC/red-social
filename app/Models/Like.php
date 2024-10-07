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
    }

    // Relación de Una Publicación con muchos "Likes"
    public function likes()
    {
        return $this->hasMany('App\Models\Like', 'publication_id');
    }
}

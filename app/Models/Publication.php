<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $table = 'publications';

    // Relación de Muchos a Uno
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    // Relación One To Many para Likes
    public function like()
    {
        return $this->hasMany('App\Models\Like');
    }

    // Relación One To Many para Comments
    public function comment()
    {
        return $this->hasMany('App\Models\Comment')->orderBy('id', 'desc');
    }

    // Nueva relación One to Many con publication_images
    public function images()
    {
        return $this->hasMany('App\Models\PublicationImage', 'publication_id');
    }

    // Evento que se ejecuta antes de eliminar una publicación
    protected static function booted()
    {
        static::deleting(function ($publication) {
            // Eliminar los likes relacionados
            $publication->like()->delete();
            // Eliminar las imágenes relacionadas
            $publication->images()->delete();
        });
    }
}

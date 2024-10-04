<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicationImage extends Model
{
    use HasFactory;

    // Especifica la tabla asociada a este modelo
    protected $table = 'publication_images';

    // Campos que pueden ser llenados masivamente
    protected $fillable = [
        'publication_id', // ID de la publicación asociada
        'image_path',     // Ruta de la imagen
    ];

    // Relación de Muchos a Uno con Publication
    public function publication()
    {
        return $this->belongsTo(Publication::class, 'publication_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'chats';

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'emisor_id',
        'receptor_id',
        'message'
    ];

    // Si no utilizas timestamps automáticos en tu base de datos, puedes especificar esto
    public $timestamps = true;

    /**
     * Obtiene el usuario que envió el mensaje.
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'emisor_id');
    }

    /**
     * Obtiene el usuario que recibió el mensaje.
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receptor_id');
    }
}

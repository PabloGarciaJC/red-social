<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'alias',
        'nombre',
        'apellido',
        'pais',
        'direccion',
        'empresa',
        'cargo',
        'movil',
        'email',
        'fotoPerfil',
        'password',
        'sobreMi',
        'conectado',
    ];

    /**
     * Los atributos que deben ser ocultos para la serialización.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relación uno a muchos con los seguidores.
     */
    public function followers()
    {
        return $this->hasMany(Follower::class, 'user_id');
    }

    /**
     * Relación uno a muchos con los mensajes enviados.
     */
    public function sentMessages()
    {
        return $this->hasMany(Chat::class, 'emisor_id');
    }

    /**
     * Relación uno a muchos con los mensajes recibidos.
     */
    public function receivedMessages()
    {
        return $this->hasMany(Chat::class, 'receptor_id');
    }

    /**
     * Relación con el rol del usuario.
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $allowed = ['active', 'inactive'];
        if (!in_array($status, $allowed, true)) {
            throw new \InvalidArgumentException("Estado inválido");
        }
        $this->status = $status;
        return $this;
    }

    /**
     * Verifica si el usuario es superusuario.
     */
    public function isSuper()
    {
        return $this->role && $this->role->nombre === 'Super';
    }
}

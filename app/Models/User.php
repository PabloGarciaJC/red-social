<?php

namespace App\Models;

// use App\Events\UserCreated;
// use App\Events\UserDeleted;
// use App\Events\UserUpdated;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'alias',
        'nombre',
        'email',
        'fotoPerfil',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function publication()
    // {
    //     return $this->hasMany('App\Models\publication');
    // }

    /**
     * The event map for the model.
     *
     * Allows for object-based events for native Eloquent events.
     *
     * @var array
     */
    // protected $dispatchesEvents = [
    //     'created' => UserCreated::class,
    //     'updated' => UserUpdated::class,
    //     'deleted' => UserDeleted::class,
    // ];

     // Relación One To Many 
     public function follower()
     {
         return $this->hasMany('App\Models\Follower', 'user_id');
     }

}

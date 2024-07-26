<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follower extends Model
{
    protected $table = 'followers';

    // Relación de Many to One
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $table = 'publications';

    // Relación de Muchos a Uno
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    // Relación One To Many 
    public function like()
    {
        return $this->hasMany('App\Models\Like');
    }

      // Relación One To Many 
      public function comment()
      {
          return $this->hasMany('App\Models\Comment')->orderBy('id', 'desc');
      }


}

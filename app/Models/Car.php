<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\User;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Car extends Model  implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

      protected $fillable = [
         'plate_NO',
         'model',
         'color',
      ];

    public function users()
    {
        return $this->belongsToMany(User::class,'user_cars');
    }


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}

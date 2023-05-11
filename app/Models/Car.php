<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\User;


class Car extends Model
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



}

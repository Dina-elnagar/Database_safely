<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'notification',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class,'User_Notification');
    }
}

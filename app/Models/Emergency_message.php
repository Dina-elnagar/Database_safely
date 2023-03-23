<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emergency_message extends Model
{
    use HasFactory;
    protected $fillable =
        [
            'message',
            'latitude',
            'longitude',
        ];
}

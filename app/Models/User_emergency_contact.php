<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_emergency_contact extends Model
{
    use HasFactory;

    protected $fillable =
        ['emergency_contact_id',
         'user_id',
         'relationship',];

}
